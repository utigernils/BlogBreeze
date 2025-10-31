<?php
require_once __DIR__ . '/DBConnector.php';
require("../php/loginhandler.php");

if (isloggedin()) {
    try {
        $pdo = getDB();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $comment = htmlspecialchars($_POST["comment"], ENT_QUOTES, 'UTF-8');
            $id = htmlspecialchars($_POST["post_id"], ENT_QUOTES, 'UTF-8');
            $user = getUser();

            $stmt = $pdo->prepare("INSERT INTO comments (post_id, comment_text, created_by) VALUES (?, ?, ?)");
            $stmt->execute([$id, $comment, $user]);

            header('Location: ../sites/posts.php');

            $stmt = null;
        }
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    } finally {

        $pdo = null;

    }
} else {
    header('Location: ../sites/login.php?redirect=posts.php');
}
?>