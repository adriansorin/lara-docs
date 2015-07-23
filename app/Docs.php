<?php

namespace App;

use Jenssegers\Mongodb\Model;

class Docs extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'docs';
    protected $fillable = ['owner', 'words', 'form', 'properties'];
    public $timestamps = false;
}
