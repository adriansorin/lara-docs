<?php

namespace App\Http\Controllers;

use Auth;

class DocumentController extends Controller
{
    public function create()
    {
        return view('document.create');
    }
}
