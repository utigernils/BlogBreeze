<?php
$host = 'xxx';
$dbname = 'xxx';
$username = 'xxx';
$password = 'xxx';



require("../php/loginhandler.php");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
        $picture = htmlspecialchars($_POST["picture"], ENT_QUOTES, 'UTF-8');
        $user = getUser();

        $stmt = $pdo->prepare("INSERT INTO posts (post_title, post_text, picture_url, created_by) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $picture, $user]);

        header('Location: ../sites/posts.php');

        $stmt = null;
    }
} catch (PDOException $e) {
    die('Error: ' . $e->getMessage());
} finally {

    $pdo = null;

}
?>