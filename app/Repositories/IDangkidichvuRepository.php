<?php

namespace App\Repositories;

interface IDangkidichvuRepository
{
    public function getAll();
    public function find($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function query();
    public function countAll();
    public function countByStatus($status);

}
