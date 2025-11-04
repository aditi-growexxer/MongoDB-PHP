<?php
require 'config.php';
use MongoDB\BSON\ObjectId;

$id = $_GET['id'] ?? '';
if ($id) {
    $collection->deleteOne(['_id' => new ObjectId($id)]);
}

header('Location: index.php');
exit;
