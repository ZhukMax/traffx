<?php

namespace App;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;
use UserAgentParser\Exception\NoResultFoundException;
use UserAgentParser\Provider\Http\UserAgentStringCom;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

/**
 * Class Statistics
 * @package App
 */
class Statistics
{
    const TYPE_PLATFORMS = 'Platforms';
    const TYPE_BROWSERS  = 'Browsers';
    const TYPE_REFERERS  = 'Referers';
    const TYPE_GEO       = 'Geolocations';
    private $minutes;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->minutes = 60 * 24 * 7;
    }

    /**
     * Get statistics for page or all site.
     *
     * @param string $type
     * @param int $pageID
     * @return array
     */
    public function get($type, $pageID = -1)
    {
        $data = array();
        foreach (Redis::smembers('Statistics:' . $type) as $statisticsType) {
            if ($pageID === -1) {
                $key = 'Statistics:' . $type . ':' . $statisticsType;
            } else {
                $key = 'Statistics:Page:' . $pageID . ':' . $type . ':' . $statisticsType;
            }

            $data[$statisticsType]['name']         = $statisticsType;
            $data[$statisticsType]['hits']         = Redis::get($key . ':hits') ?? 0;
            $data[$statisticsType]['ipUnique']     = Redis::get($key . ':ipUnique') ?? 0;
            $data[$statisticsType]['cookieUnique'] = Redis::get($key . ':cookieUnique') ?? 0;
        }

        return $data;
    }

    /**
     * Add new set data.
     *
     * @param $type
     * @param $data
     */
    private function sadd($type, $data)
    {
        Redis::sadd('Statistics:' . $type, $data);
    }

    /**
     * Add sets from array.
     *
     * @param array $data
     */
    private function addSets($data)
    {
        foreach ($data as $key => $value) {
            self::sadd($key, $value);
        }
    }

    /**
     * Add IP-address to sets.
     *
     * @param int $pageID
     * @param string $ip
     * @param array $data
     */
    private function addSetsIPs($pageID, $ip, $data)
    {
        foreach ($data as $key => $value) {
            self::sadd($pageID . ':' . $key. ':' . $value, $ip);
        }
    }

    /**
     * Increment Statistic data.
     *
     * @param int $pageID
     * @param string $type
     * @param array $data
     * @param $ip
     */
    private static function incrStatistics($pageID, $type, $data, $ip = null)
    {
        foreach ($data as $key => $value) {
            if ($type === 'ipUnique' &&
                Redis::sismember('Statistics:' . $pageID . ':' . $key. ':' . $value, $ip) === 1
            ) {
                continue;
            }
            /**
             * Statistics for page.
             */
            Redis::incr('Statistics:Page:' . $pageID . ':' . $key. ':' . $value . ':' . $type);

            /**
             * Statistics for all site.
             */
            Redis::incr('Statistics:' . $key . ':' . $value . ':' . $type);
        }
    }

    /**
     * Add statistics.
     *
     * @param int $pageID
     */
    public function addStatisticsData($pageID = 0)
    {
        $client = new Client([
            'handler' => HandlerStack::create(new CurlHandler()),
        ]);

        $provider = new UserAgentStringCom($client);

        try {
            /* @var $result \UserAgentParser\Model\UserAgent */
            $result = $provider->parse($_SERVER['HTTP_USER_AGENT']);

            if($result->isBot() === false) {
                $ip                            = $_SERVER['REMOTE_ADDR'];
                $data[self::TYPE_PLATFORMS]    = $result->getOperatingSystem()->getName();
                $data[self::TYPE_BROWSERS]     = $result->getBrowser()->getName();
                $data[self::TYPE_REFERERS]     = $_SERVER["HTTP_REFERER"];
                $data[self::TYPE_GEO]          = self::getLocate($ip);

                self::addSets($data);

                /*
                 * Increment Statistic data
                 */
                self::incrStatistics($pageID, 'hits', $data);
                self::incrStatistics($pageID, 'ipUnique', $data, $ip);

                $cookie = Cookie::get('stat-' . $pageID);
                if (!$cookie) {
                    Cookie::queue('stat-' . $pageID, '1', $this->minutes);
                    self::incrStatistics($pageID, 'cookieUnique', $data);
                }

                /**
                 * Add IP in set.
                 */
                self::addSetsIPs($pageID, $ip, $data);
            }
        } catch (NoResultFoundException $ex){
            // nothing found
        }
    }

    /**
     * Get city from www.geoplugin.net
     *
     * @param string $ip
     * @return string
     */
    private function getLocate($ip)
    {
        $host = 'http://www.geoplugin.net/php.gp?ip={IP}';

        $host = str_replace('{IP}', $ip, $host);
        $response = file_get_contents($host, 'r');
        $data = unserialize($response);

        return $data['geoplugin_city'];
    }
}
