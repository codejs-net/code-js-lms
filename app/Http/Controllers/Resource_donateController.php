<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Resource_donateController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:resource_support_data-list|resource_support_data-create|resource_support_data-edit|resource_support_data-delete', ['only' => ['index','show']]);
         $this->middleware('permission:resource_support_data-create', ['only' => ['create','store']]);
         $this->middleware('permission:resource_support_data-edit', ['only' => ['edit_detail','update_detail']]);
         $this->middleware('permission:resource_support_data-delete', ['only' => ['delete']]);
         $this->middleware('permission:resource_support_data-import', ['only' => ['import']]);
    }
}
