<?php

namespace App\Model;

interface ModelInterface
{
    public function getAll();
    public function find($id);
    public function create($payload);
    public function update($payload);
    public function delete($id);
}
