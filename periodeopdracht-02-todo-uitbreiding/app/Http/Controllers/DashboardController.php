<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Item;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	$items = Auth::user()->items;

        return view('dashboard');
    }
}
