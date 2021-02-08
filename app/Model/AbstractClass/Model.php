<?php

/**
 * Class Model
 *
 * CRUD Query template for different table Model
 */

namespace App\Model\AbstractClass;

abstract class Model
{
    protected $conn;

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
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
