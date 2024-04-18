<?php
session_start();

$host = 'xxx';
$dbname = 'xxx';
$username = 'xxx';
$password = 'xxx';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function isloggedin() {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

function login($username, $password) {
    global $error, $pdo;

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user'] = $username;
        if (isset($_GET['redirect'])) {
            header("Location: ../sites/".$_GET['redirect']);
        } else {
            header('Location: ../sites/profile.php');
        }
        exit();
    } else {
        header('Location: ../sites/login.php?e=crederror');
        exit();
    }
}

function getUser() {
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        return null;
    }
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: ../sites/login.php?s=logout');
    exit();
}

function logoutAfterDel() {
    session_unset();
    session_destroy();
    header('Location: ../sites/login.php?s=accDel');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])) {
    logout();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['register'])) {
    $firstname = htmlspecialchars($_POST["firstname"], ENT_QUOTES, 'UTF-8');
    $lastname = htmlspecialchars($_POST["lastname"], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Check if the username already exists
    $checkQuery = "SELECT * FROM users WHERE username = ?";
    $checkStmt = $pdo->prepare($checkQuery);
    $checkStmt->bindParam(1, $username);
    $checkStmt->execute();
    $existingUser = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        header('Location: ../sites/register.php?e=userexists');
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO users (username, password, firstname, lastname, joined_on) VALUES (?, ?, ?, ?, CURDATE())");
    $stmt->execute([$username, $password, $firstname, $lastname]);

    header('Location: ../sites/login.php?s=accCre');
    $stmt = null;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['setPassword'])) {
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->execute([password_hash($_POST["newPassword"], PASSWORD_BCRYPT), $_POST["user"]]); // Hash the new password

    header('Location: ../sites/login.php?s=');
    $stmt = null;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    login($username, $password);
}
?>
