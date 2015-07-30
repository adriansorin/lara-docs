<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\Model\DocumentIndexRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show dashboard
     */
    public function index(DocumentIndexRepository $documentIndexRepo)
    {
        $documents = $documentIndexRepo->paginate(10, ['id', 'title', 'owner']);

        return view('dashboard', ['documents' => $documents]);
    }

    /**
     * Search for word in documents
     */
    public function search(Request $request, DocumentIndexRepository $documentIndexRepo)
    {
    	$data['documents'] = $documentIndexRepo->paginateCriteria(10, 'words', $request->input('word'), ['id', 'title', 'owner']);
    	$data['word'] = $request->input('word');

        return view('search', $data);
    }
}
