<?php
require 'db_connect.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);
header('Location: admin.php');
exit;
