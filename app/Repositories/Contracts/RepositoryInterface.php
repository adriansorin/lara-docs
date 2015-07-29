<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));
}