<?php

namespace App;

use Jenssegers\Mongodb\Model;

class DocumentIndex extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'docs';
    protected $fillable = ['id_document', 'words', 'title'];
    public $timestamps = false;
}
