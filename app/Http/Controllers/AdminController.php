<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Page;
use App\Statistics;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application statistics.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statistics = new Statistics();

        $platforms    = $statistics->get($statistics::TYPE_PLATFORMS);
        $browsers     = $statistics->get($statistics::TYPE_BROWSERS);
        $referers     = $statistics->get($statistics::TYPE_REFERERS);
        $geolocations = $statistics->get($statistics::TYPE_GEO);

        return view('admin.statistics', [
            'browsers'     => $browsers,
            'platforms'    => $platforms,
            'referers'     => $referers,
            'geolocations' => $geolocations
        ]);
    }

    /**
     * Show the pages list.
     *
     * @return \Illuminate\Http\Response
     */
    public function pages()
    {
        return view('admin.pages', ['pages' => Page::get()]);
    }

    /**
     * Show the page statistics.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function page($id)
    {
        $statistics = new Statistics();

        $platforms    = $statistics->get($statistics::TYPE_PLATFORMS, $id);
        $browsers     = $statistics->get($statistics::TYPE_BROWSERS, $id);
        $referers     = $statistics->get($statistics::TYPE_REFERERS, $id);
        $geolocations = $statistics->get($statistics::TYPE_GEO, $id);

        return view('admin.statistics', [
            'platforms'    => $platforms,
            'browsers'     => $browsers,
            'referers'     => $referers,
            'geolocations' => $geolocations,
            'pageID'       => $id
        ]);
    }
}
