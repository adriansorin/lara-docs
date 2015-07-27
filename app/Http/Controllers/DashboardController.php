<?php

namespace App\Http\Controllers;

use Auth;
use App\Documents;
use App\Docs;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
