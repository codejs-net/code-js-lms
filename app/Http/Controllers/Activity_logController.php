<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Activity_logController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:activity-log', ['only' => ['index']]);

    }
    public function index()
    {
        
    }
}
