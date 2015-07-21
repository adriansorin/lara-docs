<?php

namespace App;

use Jenssegers\Mongodb\Model;

class Test extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'test';
    protected $fillable = ['owner', 'words', 'form', 'properties'];
    public $timestamps = false;
}
