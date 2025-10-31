<?php
require_once __DIR__ . '/DBConnector.php';
require('loginhandler.php');
$username = getUser();

function updateLikes($id) {
    $pdo = getDB();
    
    $check_likes = "SELECT COUNT(*) as count FROM post_reactions WHERE post_id = ? AND action = 'like'";
    $checkl_stmt = $pdo->prepare($check_likes);
    $checkl_stmt->execute([$id]);
    $likes = $checkl_stmt->fetch()['count'];
    
    $check_dislikes = "SELECT COUNT(*) as count FROM post_reactions WHERE post_id = ? AND action = 'dislike'";
    $checkd_stmt = $pdo->prepare($check_dislikes);
    $checkd_stmt->execute([$id]);
    $dislikes = $checkd_stmt->fetch()['count'];
    
    $save_likes = "UPDATE posts SET post_likes = ? WHERE id = ?";
    $insert_likes = $pdo->prepare($save_likes);
    $insert_likes->execute([$likes, $id]);
    
    $save_dislikes = "UPDATE posts SET post_dislikes = ? WHERE id = ?";
    $insert_dislikes = $pdo->prepare($save_dislikes);
    $insert_dislikes->execute([$dislikes, $id]);

    header("location: ../sites/posts.php"); 
    
}


function handleReaction($post_id, $username, $action) {
    if (!isloggedin()) {
        header("location: ../sites/login.php?redirect=posts.php");
    }

    $pdo = getDB();

    $check_query = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ?";
    $check_stmt = $pdo->prepare($check_query);
    $check_stmt->execute([$post_id, $username]);
    $check_result = $check_stmt->fetchAll();

    $check_action = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ? AND action = ?";
    $checka_stmt = $pdo->prepare($check_action);
    $checka_stmt->execute([$post_id, $username, $action]);
    $checka_result = $checka_stmt->fetchAll();

    if (count($check_result) == 0) {
        $insert_query = "INSERT INTO post_reactions (post_id, user_name, action) VALUES (?, ?, ?)";
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->execute([$post_id, $username, $action]);
    } else {
        if (count($checka_result) == 1) {
            $delete_query = "DELETE FROM post_reactions WHERE post_id = ? AND user_name = ?";
            $delete_stmt = $pdo->prepare($delete_query);
            $delete_stmt->execute([$post_id, $username]);
        } else {
            $delete_query = "DELETE FROM post_reactions WHERE post_id = ? AND user_name = ?";
            $delete_stmt = $pdo->prepare($delete_query);
            $delete_stmt->execute([$post_id, $username]);
            $insert_query = "INSERT INTO post_reactions (post_id, user_name, action) VALUES (?, ?, ?)";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->execute([$post_id, $username, $action]);
        }

    }

    updateLikes($post_id);

}

function getLikeState($id) {
    $username = getUser();

    $pdo = getDB();

    $check_action = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ? AND action = 'like'";
    $checka_stmt = $pdo->prepare($check_action);
    $checka_stmt->execute([$id, $username]);
    $checka_result = $checka_stmt->fetchAll();

    if (count($checka_result) == 1) {
        return true;
    } else {
        return false;
    }
}

function getDislikeState($id) {
    $username = getUser();

    $pdo = getDB();

    $check_action = "SELECT * FROM post_reactions WHERE post_id = ? AND user_name = ? AND action = 'dislike'";
    $checka_stmt = $pdo->prepare($check_action);
    $checka_stmt->execute([$id, $username]);
    $checka_result = $checka_stmt->fetchAll();

    if (count($checka_result) == 1) {
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


