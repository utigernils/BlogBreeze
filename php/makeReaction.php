<?php
require('loginhandler.php');
$username = getUser();

function connectToDatabase() {
    $servername = "xxx";
    $db_username = "xxx";
    $db_password = "xxx";
    $dbname = "xxx";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function updateLikes($id) {
    $conn = connectToDatabase();
    
    $check_likes = "SELECT * FROM post_reactions WHERE post_id = ? AND action = 'like'";
    $checkl_stmt = $conn->prepare($check_likes);
    $checkl_stmt->bind_param("i", $id);
    $checkl_stmt->execute();
    $checkl_result = $checkl_stmt->get_result();
    
    $check_dislikes = "SELECT * FROM post_reactions WHERE post_id = ? AND action = 'dislike'";
    $checkd_stmt = $conn->prepare($check_dislikes);
    $checkd_stmt->bind_param("i", $id);
    $checkd_stmt->execute();
    $checkd_result = $checkd_stmt->get_result();

    $likes = $checkl_result->num_rows; 
    $dislikes = $checkd_result->num_rows; 
    
    $save_likes = "UPDATE posts SET post_likes=$likes WHERE id=$id";
    $insert_likes = $conn->prepare($save_likes);
    $insert_likes->execute();
    
    $save_dislikes = "UPDATE posts SET post_dislikes=$dislikes WHERE id=$id";
    $insert_dislikes = $conn->prepare($save_dislikes);
    $insert_dislikes->execute();

    header("location: ../sites/posts.php"); 
    
}


function handleReaction($post_id, $username, $action) {
    if (!isloggedin()) {
        header("location: ../sites/login.php?redirect=posts.php");
    }


    $conn = connectToDatabase();

    $check_query = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("is", $post_id, $username);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    $check_action = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ? AND action = ?";
    $checka_stmt = $conn->prepare($check_action);
    $checka_stmt->bind_param("iss", $post_id, $username, $action);
    $checka_stmt->execute();
    $checka_result = $checka_stmt->get_result();

    if ($check_result->num_rows == 0) {
        $insert_query = "INSERT INTO post_reactions (post_id, user_name, action) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("iss", $post_id, $username, $action);
        $insert_stmt->execute();
    } else {
        if ($checka_result->num_rows == 1) {
            $delete_query = "DELETE FROM post_reactions WHERE post_id = ? AND user_name = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("is", $post_id, $username);
            $delete_stmt->execute();
        } else {
            $delete_query = "DELETE FROM post_reactions WHERE post_id = ? AND user_name = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("is", $post_id, $username);
            $delete_stmt->execute();
            $insert_query = "INSERT INTO post_reactions (post_id, user_name, action) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("iss", $post_id, $username, $action);
            $insert_stmt->execute();
        }

    }

    updateLikes($post_id);

}

function getLikeState($id) {
    $username = getUser();

    $conn = connectToDatabase();

    $check_action = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ? AND action = 'like'";
    $checka_stmt = $conn->prepare($check_action);
    $checka_stmt->bind_param("is", $id, $username);
    $checka_stmt->execute();
    $checka_result = $checka_stmt->get_result();

    if ($checka_result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}

function getDislikeState($id) {
    $username = getUser();

    $conn = connectToDatabase();

    $check_action = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ? AND action = 'dislike'";
    $checka_stmt = $conn->prepare($check_action);
    $checka_stmt->bind_param("is", $id, $username);
    $checka_stmt->execute();
    $checka_result = $checka_stmt->get_result();

    if ($checka_result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['like'])) {
        handleReaction($_POST['post_id'], getUser(), 'like');
    } elseif (isset($_POST['dislike'])) {
        handleReaction($_POST['post_id'], getUser(), 'dislike');
    }
}
?>


