<?php
require 'config.php';
use MongoDB\BSON\ObjectId;

$id = $_GET['id'] ?? '';
if (!$id) die('Invalid ID');

$user = $collection->findOne(['_id' => new ObjectId($id)]);
if (!$user) die('User not found');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($name && $email) {
        $collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['name' => $name, 'email' => $email]]
        );
        header('Location: index.php');
        exit;
    } else {
        $message = "Please fill both name and email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
<h2>Edit User</h2>

<?php if (!empty($message)) echo "<div style='color:red'>$message</div>"; ?>

<form method="POST" action="">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user->name) ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user->email) ?>" required>
    <button type="submit">Update</button>
</form>

<p><a href="index.php">Back to User List</a></p>
</body>
</html>
