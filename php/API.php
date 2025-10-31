<?php
require_once __DIR__ . '/DBConnector.php';

$pdo = getDB();

$stmt = $pdo->query('SELECT * FROM `posts`');
$postsData = $stmt->fetchAll(PDO::FETCH_ASSOC); 

header('Content-Type: application/json');

$postsData = array_reverse($postsData);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($postsData);
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}
?>
