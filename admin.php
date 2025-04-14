<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require 'db_connect.php';
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Admin Panel</h1>
<a href="create.php">+ Add New Post</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Link</th>
        <th>Likes</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?= $post['id'] ?></td>
        <td><?= htmlspecialchars($post['title']) ?></td>
        <td><a href="<?= htmlspecialchars($post['link']) ?>" target="_blank">Link</a></td>
        <td><?= $post['likescount'] ?></td>
        <td><?= $post['created_at'] ?></td>
        <td>
            <a href="edit.php?id=<?= $post['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="logout.php">Log out</a>
