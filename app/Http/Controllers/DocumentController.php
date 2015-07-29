<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CreateDocumentJob;
use App\Jobs\UpdateDocumentJob;
use App\Repositories\Model\DocumentRepository;
use Auth;

class DocumentController extends Controller
{
    public function create(Request $request, DocumentRepository $documentRepo, $id = null)
    {
        if ($id) {
        	$documentToEdit = $documentRepo->find($id, ['id', 'title', 'owner', 'content']);

        	if ($documentToEdit && $documentToEdit->owner == Auth::user()->id) {
        		$data['loadedDocument'] = $documentToEdit;
        	} else {
        		return redirect()->to('document/create')->withErrors(['document' => 'The requested document was not found or you do not have permission to edit it.']);
        	}
        }

        $data['documents'] = $documentRepo->findBy('owner', Auth::user()->id, ['id', 'title']);

        return view('document.create', $data);
    }

    /**
     * Create new document
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:documents|max:255',
            'content' => 'required',
        ]);

        $this->dispatch(new CreateDocumentJob($request->input('title'), $request->input('content')));

        return redirect()->to('document/create')->with('success', 'Succesfully added document!');
    }

    /**
     * Update existing document
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        if ($request->input('owner') != Auth::user()->id) {
        	return redirect()->to('document/create/' . $id)->withErrors(['document' => 'You do not have permission to edit this document.']);
        }

        $this->dispatch(new UpdateDocumentJob($id, $request->input('title'), $request->input('content')));

        return redirect()->to('document/create')->with('success', 'Succesfully updated document!');
    }
}
