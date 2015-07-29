<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories\Model\DocumentRepository;
use App\Repositories\Model\DocumentIndexRepository;
use Auth;

class CreateDocumentJob extends Job implements SelfHandling
{
    protected $title;
    protected $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DocumentRepository $documentRepo, DocumentIndexRepository $documentIndexRepo)
    {
        $document = [
            'content' => $this->content,
            'owner' => Auth::user()->id,
            'title' => $this->title
        ];

        $savedDoc = $documentRepo->create($document);

        if ($savedDoc->id) {
            $index['words'] = str_word_count(strip_tags($this->content), 1);
            $index['id_document'] = $savedDoc->id;
            $index['title'] = $this->title;

            $mongoDoc = $documentIndexRepo->create($index);
        }
    }
}
