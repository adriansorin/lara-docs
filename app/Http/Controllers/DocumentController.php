<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CreateDocumentJob;
use App\Jobs\UpdateDocumentJob;
use App\Repositories\Model\DocumentIndexRepository;
use Auth;
use App\User;

class DocumentController extends Controller
{
    /**
     * Load create edit view
     */
    public function create(Request $request, DocumentIndexRepository $documentIndexRepo, $id = null)
    {
        if ($id) {
        	$documentToEdit = $documentIndexRepo->find($id, ['id', 'title', 'owner', 'content']);

        	if ($documentToEdit && $documentToEdit->owner == Auth::user()->id) {
        		$data['loadedDocument'] = $documentToEdit;
        	} else {
        		return redirect()->to('document/create')->withErrors(['document' => 'The requested document was not found or you do not have permission to edit it.']);
        	}
        }

        $data['documents'] = $documentIndexRepo->findBy('owner', Auth::user()->id, ['id', 'title']);

        return view('document.create', $data);
    }

    /**
     * SHow document details
     */
    public function show(Request $request, DocumentIndexRepository $documentIndexRepo, $id)
    {
    	$data['document'] = $documentIndexRepo->find($id, ['id', 'title', 'owner', 'content', 'words']);

    	$docUser = User::find($data['document']->owner);

        $data['ownerName'] = $docUser->name;

    	return view('document.show', $data);
    }

    /**
     * Create new document
     */
    public function add(Request $request)
    {
        $this->dispatch(new CreateDocumentJob($request->input('title'), $request->input('content')));

        return redirect()->to('document/create')->with('success', 'Succesfully added document!');
    }

    /**
     * Update existing document
     */
    public function update(Request $request, $id)
    {
        if ($request->input('owner') != Auth::user()->id) {
        	return redirect()->to('document/create/' . $id)->withErrors(['document' => 'You do not have permission to edit this document.']);
        }

        $this->dispatch(new UpdateDocumentJob($id, $request->input('title'), $request->input('content')));

        return redirect()->to('document/create')->with('success', 'Succesfully updated document!');
    }
}
