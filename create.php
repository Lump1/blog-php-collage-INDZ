<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, link, likescount) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['title'],
        $_POST['content'],
        $_POST['link'] ?: null,
        $_POST['likescount'] ?: 0
    ]);
    header('Location: admin.php');
    exit;
}
?>

<h1>Create New Post</h1>
<form method="post">
    Title: <br><input type="text" name="title" required><br><br>
    Content: <br><textarea name="content" required></textarea><br><br>
    Link: <br><input type="text" name="link"><br><br>
    Likes Count: <br><input type="number" name="likescount" value="0"><br><br>
    <button type="submit">Save</button>
</form>
<a href="admin.php">← Back to Admin</a>
