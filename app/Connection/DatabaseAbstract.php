<?php

namespace App\Connection;

abstract class DatabaseAbstract
{
    protected $db_type;
    protected $host;
    protected $port;
    protected $database_name;
    protected $username;
    protected $password;
    protected $options;

    public function __construct(
        $db_type,
        $host,
        $port,
        $db_name,
        $username,
        $password,
        $options
    ) {
        $this->db_type = $db_type;
        $this->host = $host;
        $this->port = $port;
        $this->database_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }
}
