<?php
require_once __DIR__ . '/DBConnector.php';

$pdo = getDB();

$stmt = $pdo->query('SELECT * FROM `blogs`');
$blogsData = $stmt->fetchAll();
?>

