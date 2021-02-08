<?php

/**
 * Bootstrap file
 * Declares necessary class that will be used in the app
 */

require 'vendor/autoload.php';

use Dotenv\Dotenv;

use App\Connection\MySQLDatabase;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new MySQLDatabase(
    $_ENV['DBTYPE'],
    $_ENV['HOST'],
    $_ENV['PORT'],
    $_ENV['DB'],
    $_ENV['USER'],
    $_ENV['PASSWORD']
);

$conn = $db->connect();
