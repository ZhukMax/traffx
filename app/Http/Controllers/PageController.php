<?php

namespace App\Http\Controllers;

use App\Page;
use App\Statistics;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Show the lost of pages.
     *
     * @return Response
     */
    public function index()
    {
        $stat = new Statistics();
        $stat->addStatisticsData();
        return view('pages.index', ['pages' => Page::get()]);
    }

    /**
     * Show the page.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $stat = new Statistics();
        $stat->addStatisticsData($id);
        return view('pages.show', ['page' => Page::findOrFail($id)]);
    }
}