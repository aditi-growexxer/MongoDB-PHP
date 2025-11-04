<?php
require 'vendor/autoload.php';

use MongoDB\Client;

try {
    $client = new Client("mongodb://127.0.0.1:27017"); // local MongoDB
    $db = $client->my_web_db;       // Database name
    $collection = $db->users;       // Collection name
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
