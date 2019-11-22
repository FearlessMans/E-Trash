<?php

namespace App\Http\Controllers;

class PageController extends Controller
{

    // Starting Admin Section

    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        return view('pages.tables');
    }

    public function product()
    {
        return view('pages.product');
    }
    // End of Admin Section

    // Starting User Section

    // End of Admin Section
}
