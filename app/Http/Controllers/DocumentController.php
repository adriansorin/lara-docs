<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CreateDocumentJob;
use App\Repositories\Model\DocumentRepository;
use Auth;

class DocumentController extends Controller
{
    public function create(Request $request, DocumentRepository $documentRepo)
    {
        return view('document.create', ['documents' => $documentRepo->findBy('owner', Auth::user()->id, ['id', 'title'])]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:documents|max:255',
            'content' => 'required',
        ]);

        $this->dispatch(new CreateDocumentJob($request->input('title'), $request->input('content')));

        return redirect()->to('document/create')->with('success', 'Succesfully added document!');
    }
}
