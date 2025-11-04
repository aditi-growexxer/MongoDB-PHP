<?php
require 'config.php';

// Handle form submission for insert
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'insert') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($name && $email) {
        $collection->insertOne([
            'name' => $name,
            'email' => $email,
            'created_at' => new MongoDB\BSON\UTCDateTime()
        ]);
        $message = "User inserted successfully!";
    } else {
        $message = "Please fill both name and email.";
    }
}

// Fetch all users
$users = $collection->find([], ['sort' => ['created_at' => -1]]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MongoDB PHP CRUD Demo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { margin-bottom: 30px; }
        input { padding: 5px; margin: 5px; }
        table { border-collapse: collapse; width: 80%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .message { color: green; margin-bottom: 20px; }
        a { margin-right: 10px; }
    </style>
</head>
<body>

<h2>MongoDB PHP CRUD Demo</h2>

<?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>

<h3>Insert New User</h3>
<form method="POST" action="">
    <input type="hidden" name="action" value="insert">
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <button type="submit">Insert User</button>
</form>

<h3>Users in Database</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= (string)$user->_id ?></td>
            <td><?= htmlspecialchars($user->name) ?></td>
            <td><?= htmlspecialchars($user->email) ?></td>
            <td><?= date('Y-m-d H:i:s', $user->created_at->toDateTime()->getTimestamp()) ?></td>
            <td>
                <a href="edit_user.php?id=<?= (string)$user->_id ?>">Edit</a>
                <a href="delete_user.php?id=<?= (string)$user->_id ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
