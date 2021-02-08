<?php

namespace App\Connection\InterfaceClass;

interface DatabaseInterface
{
    public function connect();
    public function getData($query);
    public function create($query);
    public function update($query);
    public function delete($query, $id);
}
