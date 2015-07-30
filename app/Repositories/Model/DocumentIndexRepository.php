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
        return $this->documentIndex->paginate($perPage, $columns);
    }

    public function paginateCriteria($perPage = 15, $field, $value, $columns = array('*'))
    {
        return $this->documentIndex->where([$field => $value])->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->documentIndex->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->documentIndex->where(['_id' => $id])->update($data, ['upsert' => true]);
    }

    public function delete($id)
    {
        return $this->documentIndex->destroy($id);
    }

    public function find($id, $columns = array('*'))
    {
        return $this->documentIndex->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        if (is_int($value)) {
            $value = intval($value);
        }

        return $this->documentIndex->where([$field => $value])->get($columns);
    }
}