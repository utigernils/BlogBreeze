<?php
require_once __DIR__ . '/DBConnector.php';

function getUserData($username_toget, $attribute)
{
    $pdo = getDB();

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $username_toget);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result[$attribute];


}

?>