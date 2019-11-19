<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        return view('pages.tables');
    }
}
