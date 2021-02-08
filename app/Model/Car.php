<?php

/**
 * Class Car
 *
 * Car data connected to Car Table in DB
 */

namespace App\Model;

use App\Model\Model;

class Car extends Model implements ModelInterface
{
    protected $table = 'model';
    protected $primaryKey = 'id';
    protected $fillable = array('model_name', 'model_type', 'model_brand', 'model_year');
    protected $additionalFillableOnCreate = array('model_date_added');
    protected $nonfillable = array('model_date_modified');

    /**
     * Constructor
     *
     * Initialize variables in the Model Class
     *
     * @param string $db Database connection
     *
     * @return none
     *
     * @access public
     */
    public function __construct($db)
    {
        parent::__construct($db, $this->table);
    }

    /**
     * Get All Method
     *
     * Get all records from the table
     *
     * @return array
     *
     * @access public
     */
    public function getAll()
    {
        $query = "
            SELECT * FROM " . $this->table;

        $return = $this->conn->getData($query);

        return array(
            "error" => $return['error'],
            "message" => $return['message'],
            "count" => $return['count'],
            "status" => $return['status']
        );
    }

    /**
     * Find Method
     *
     * Search record by ID
     *
     * @param string $id Record ID
     *
     * @return array
     *
     * @access public
     */
    public function find($id = 0)
    {
        $query = "
            SELECT 
                *
            FROM
            " . $this->table . "
            WHERE id = $id;
        ";

        $return = $this->conn->getData($query);

        return array(
            "error" => $return['error'],
            "message" => $return['message'],
            "count" => $return['count'],
            "status" => $return['status']
        );
    }

    /**
     * Create Method
     *
     * Create a new record
     *
     * @param array $payload Input Parameters
     *
     * @return array
     *
     * @access public
     */
    public function create($payload)
    {
        //build the insert query
        $fillFields = array_merge($this->fillable, $this->additionalFillableOnCreate);
        $keys = implode(', ', $fillFields);
        foreach ($fillFields as $field) {
            $fieldValues[] = $payload[$field];
        }
        $fieldValues = "'" . implode("', '", $fieldValues) . "'";

        $query = "
            INSERT INTO " . $this->table . " 
            ($keys) 
            VALUES ($fieldValues)";

        $return = $this->conn->create($query);

        return array(
            "error" => $return['error'],
            "message" => $return['message'],
            "status" => $return['status']
        );
    }

    /**
     * Update Method
     *
     * Update existing record
     *
     * @param array $payload Input Parameters
     *
     * @return array
     *
     * @access public
     */
    public function update($payload)
    {
        //build the update query
        $id = $payload[$this->primaryKey];
        foreach ($this->fillable as $field) {
            $updateDataArr[] = $field . " = '" . $payload[$field] . "'";
        }
        $updateData = implode(", ", $updateDataArr);

        $query = "UPDATE 
            " . $this->table . " 
            SET 
                $updateData
            WHERE $this->primaryKey = $id";

        $return = $this->conn->update($query);

        return array(
            "error" => $return['error'],
            "message" => $return['message'],
            "status" => $return['status']
        );
    }

    /**
     * Delete Method
     *
     * Delete existing record
     *
     * @param string $id Record ID
     *
     * @return array
     *
     * @access public
     */
    public function delete($id)
    {
        //process delete
        $query = "DELETE FROM " . $this->table . " WHERE id = $id";

        $return = $this->conn->delete($query, $id);

        return array(
            "error" => $return['error'],
            "message" => $return['message'],
            "status" => $return['status']
        );
    }
}
