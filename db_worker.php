<?php 
    require 'db_connect.php';

    function getPosts($pdo) {
        $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    $posts = getPosts($pdo);


    function increeseLikes($postId, $amount) {
        global $pdo;
        $sql = "UPDATE posts SET likescount = likescount + {$amount} WHERE id = :postId";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Likes count increased successfully!";
            } else {
                echo "No post found with that ID or likes count is already at max.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (isset($_POST['postId']) && isset($_POST['amount'])) {
        $id = $_POST['postId'];
        $amount = $_POST['amount'];

        try {
            $stmt = $pdo->prepare("UPDATE posts SET likescount = likescount + :amount WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Failed to update likes count']);
        }
    }
?>