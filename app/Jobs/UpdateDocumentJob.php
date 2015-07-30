<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories\Model\DocumentRepository;
use App\Repositories\Model\DocumentIndexRepository;
use Auth;

class UpdateDocumentJob extends Job implements SelfHandling
{
    protected $title;
    protected $content;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $title, $content)
    {
        $this->title = $title;
        $this->content = $content;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DocumentIndexRepository $documentIndexRepo)
    {
        $document = [
            'content' => $this->content,
            'title' => $this->title,
            'words' => str_word_count(strip_tags($this->content), 1)
        ];

        $documentIndexRepo->update($document, $this->id);
    }
}
