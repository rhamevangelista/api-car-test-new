<?php

/**
 * Class Database
 *
 * Database connection class
 */

namespace App\Connection;

use App\Connection\DatabaseAbstract;
use App\Connection\DatabaseInterface;

class MySQLDatabase extends DatabaseAbstract implements DatabaseInterface
{
    private $conn;

    public function __construct(
        $db_type = "mysql",
        $host = "localhost",
        $port = "3306",
        $db_name = "test",
        $username = "root",
        $password = "",
        $options = ""
    ) {
        parent::__construct(
            $db_type,
            $host,
            $port,
            $db_name,
            $username,
            $password,
            $options
        );
    }

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new \PDO(
                $this->db_type . ":host=" . $this->host . ";
                port=" . $this->port . ";
                dbname=" . $this->database_name . $this->options,
                $this->username,
                $this->password
            );
        } catch (\PDOException $exception) {
            header('HTTP/1.1 500');
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function getData($query)
    {
        try {
            $data = $this->conn->query($query);
            $data->execute();

            if ($data->rowCount()) {
                $result = $data->fetchAll(\PDO::FETCH_ASSOC);
                return array(
                    "error" => false,
                    "message" => $result,
                    "count" => $data->rowCount(),
                    "status" => "200 OK"
                );
            } else {
                return array(
                    "error" => true,
                    "message" => "No records found in the table.",
                    "count" => 0,
                    "status" => "404 Not Found"
                );
            }
        } catch (\PDOException $e) {
            return array(
                "error" => true,
                "message" => $e->getMessage(),
                "count" => 0,
                "status" => "500"
            );
        }
    }

    public function create($query)
    {
        try {
            $data = $this->conn->query($query);
            $data->execute();

            if ($data->rowCount()) {
                return array(
                    "error" => false,
                    "message" => "Record successfully added.",
                    "status" => "201 Created"
                );
            } else {
                return array(
                    "error" => true,
                    "message" => "Record not saved.",
                    "status" => "404 Not Found"
                );
            }
        } catch (\PDOException $e) {
            return array(
                "error" => true,
                "message" => $e->getMessage(),
                "status" => "500"
            );
        }
    }

    public function update($query)
    {
        try {
            $data = $this->conn->query($query);
            $data->execute();

            if ($data->execute()) {
                return array(
                    "error" => false,
                    "message" => "Record successfully updated.",
                    "status" => "200 OK"
                );
            } else {
                return array(
                    "error" => true,
                    "message" => "Record not updated.",
                    "status" => "404 Not Found"
                );
            }
        } catch (\PDOException $e) {
            return array(
                "error" => true,
                "message" => $e->getMessage(),
                "status" => "500"
            );
        }
    }

    public function delete($query, $id)
    {
        try {
            $data = $this->conn->query($query);

            if ($data->execute()) {
                return array(
                    "error" => false,
                    "message" => "Record ID " . $id . " successfully deleted.",
                    "status" => "200 OK"
                );
            } else {
                return array(
                    "error" => true,
                    "message" => "Record not found.",
                    "status" => "404 Not Found"
                );
            }
        } catch (\PDOException $e) {
            return array(
                "error" => true,
                "message" => $e->getMessage(),
                "status" => "500"
            );
        }
    }
}
