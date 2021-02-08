<?php

namespace App\Model\InterfaceClass;

interface ModelInterface
{
    public function getAll();
    public function find($id);
    public function create($payload);
    public function update($payload);
    public function delete($id);
}
