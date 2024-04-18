<?php
$host = 'xxx';
$dbname = 'xxx';
$username = 'xxx';
$password = 'xxx';



require("../php/loginhandler.php");

if (isloggedin()) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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