<?php
function getUserData($username_toget, $attribute)
{
    $host = 'xxx';
    $dbname = 'xxx';
    $username = 'xxx';
    $password = 'xxx';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $username_toget);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result[$attribute];


}

?>