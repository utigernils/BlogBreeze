<?php
$host = 'xxx';
$dbname = 'xxx';
$username = 'xxx';
$password = 'xxx';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->query('SELECT * FROM `blogs`');
$blogsData = $stmt->fetchAll();
?>

