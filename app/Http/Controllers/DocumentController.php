<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Documents;
use App\Docs;

class DocumentController extends Controller
{
    public function create(Request $request)
    {
        return view('document.create');
    }

    public function add(Request $request)
    {
    	$res['words'] = str_word_count(strip_tags($request->input('content')), 1);

        $doc = [
            'content' => $request->input('content'),
            'owner' => Auth::user()->id,
            'title' => $request->input('title')
        ];

        $document = Documents::create($doc);

        if ($document->id) {
        	$res['id_document'] = $document->id;

        	Docs::create($res);
        }

        return redirect()->route('document/create');
    }
}
