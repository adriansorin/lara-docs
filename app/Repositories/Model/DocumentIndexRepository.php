<?php

namespace App\Repositories\Model;

use App\Repositories\Contracts\RepositoryInterface;
use App\DocumentIndex;

class DocumentIndexRepository implements RepositoryInterface
{
    protected $documentIndex = null;

    public function __construct(DocumentIndex $documentIndex)
    {
        $this->documentIndex = $documentIndex;
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {

    }

    public function create(array $data)
    {
        return $this->documentIndex->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->documentIndex->where(['id_document' => intval($id)])->update($data, ['upsert' => true]);
    }

    public function delete($id)
    {

    }

    public function find($id, $columns = array('*'))
    {

    }

    public function findBy($field, $value, $columns = array('*'))
    {

    }
}