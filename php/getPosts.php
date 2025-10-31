<?php
require_once __DIR__ . '/DBConnector.php';

$pdo = getDB();

$stmt = $pdo->query('SELECT * FROM `posts`');
$postsData = $stmt->fetchAll();

$stmt = $pdo->query('SELECT * FROM `comments`');
$allComments = $stmt->fetchAll();

$postsData = array_reverse($postsData);
$allComments = array_reverse($allComments);

function getCommentsForPost($pdo, $postId) {
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE post_id = ?');
    $stmt->execute([$postId]);
    return $stmt->fetchAll();
}