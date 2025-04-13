<?php
require 'db_connect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) die("Post not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, link = ?, likescount = ? WHERE id = ?");
    $stmt->execute([
        $_POST['title'],
        $_POST['content'],
        $_POST['link'],
        $_POST['likescount'],
        $id
    ]);
    header('Location: admin.php');
    exit;
}
?>

<h1>Edit Post</h1>
<form method="post">
    Title: <br><input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
    Content: <br><textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
    Link: <br><input type="text" name="link" value="<?= htmlspecialchars($post['link']) ?>"><br><br>
    Likes Count: <br><input type="number" name="likescount" value="<?= $post['likescount'] ?>"><br><br>
    <button type="submit">Update</button>
</form>
<a href="admin.php">← Back to Admin</a>
