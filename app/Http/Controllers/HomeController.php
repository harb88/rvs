<?php

namespace rvs\Http\Controllers;

use rvs\Http\Requests;
use Illuminate\Http\Request;

use rvs\Models\Village;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/villages');
    }

    public function viewVillages()
    {
        $villages = Village::orderBy('v_name')->get();
        return view('home')->with('villages', $villages);
    }

    public function viewVillage($id)
    {
        $village = Village::findOrFail($id);
        return view('home')->with('village', $village);
    }
}
