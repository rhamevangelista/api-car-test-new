<?php

/**
 * Class Model
 *
 * CRUD Query template for different table Model
 */

namespace App\Model;

abstract class Model
{
    protected $conn;

    protected $table;

    /**
     * Constructor
     *
     * Initialize db connection and table
     *
     * @param object $db    Database instance
     * @param string $table Table name
     *
     * @return none
     *
     * @access public
     */
    public function __construct($db, $table)
    {
        $this->conn = $db;
        $this->table = $table;
    }
}
