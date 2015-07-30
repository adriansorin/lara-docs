<?php

namespace App;

use Jenssegers\Mongodb\Model;

class DocumentIndex extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'docs';
    protected $fillable = ['title', 'owner', 'content', 'words'];
    public $timestamps = false;
}
