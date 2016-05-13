<?php

namespace rvs\Http\Controllers;

use rvs\Http\Requests;
use Illuminate\Http\Request;

class ExecuteController extends Controller
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
        $message = "";
        return view('execute.output')->with('message', $message);
    }
}