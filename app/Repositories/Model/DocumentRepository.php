<?php

namespace App\Repositories\Model;

use App\Repositories\Contracts\RepositoryInterface;
use App\Document;

class DocumentRepository implements RepositoryInterface
{
    protected $document = null;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {

    }

    public function create(array $data)
    {
        return $this->document->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->document->where(['id' => $id])->update($data);
    }

    public function delete($id)
    {

    }

    public function find($id, $columns = array('*'))
    {
        return $this->document->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        return $this->document->where($field, '=', $value)->get($columns);
    }
}