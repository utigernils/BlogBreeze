<?php
require_once __DIR__ . '/DBConnector.php';
require("makeReaction.php");



if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete'])) {
    $pdo = getDB();

    $posttodelete = $_POST['post_id'];
    $delete_query = "DELETE FROM posts WHERE id = ?";
    $delete_stmt = $pdo->prepare($delete_query);
    $delete_stmt->execute([$posttodelete]);

    header("location: ../sites/profile.php");


}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Commentdelete'])) {
    $pdo = getDB();

    $commenttodelete = $_POST['comment_id'];
    $delete_query = "DELETE FROM comments WHERE id = ?";
    $delete_stmt = $pdo->prepare($delete_query);
    $delete_stmt->execute([$commenttodelete]);

    header("location: ../sites/profile.php");

}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['UserDelete'])) {
    $pdo = getDB();

    $userToDelete = $_POST['username'];

    // Delete user from 'users' table
    $delete_user_query = "DELETE FROM users WHERE username = ?";
    $delete_user_stmt = $pdo->prepare($delete_user_query);
    $delete_user_stmt->execute([$userToDelete]);

    // Delete user's posts from 'posts' table
    $delete_posts_query = "DELETE FROM posts WHERE created_by = ?";
    $delete_posts_stmt = $pdo->prepare($delete_posts_query);
    $delete_posts_stmt->execute([$userToDelete]);


    // Delete user's comments from 'comments' table
    $delete_comments_query = "DELETE FROM comments WHERE created_by = ?";
    $delete_comments_stmt = $pdo->prepare($delete_comments_query);
    $delete_comments_stmt->execute([$userToDelete]);

    // Fetch dislikes for the user
    $check_dislikes_query = "SELECT post_id FROM post_reactions WHERE user_name = ? AND action = 'dislike'";
    $check_dislikes_stmt = $pdo->prepare($check_dislikes_query);
    $check_dislikes_stmt->execute([$userToDelete]);
    $dislike_array = $check_dislikes_stmt->fetchAll();

    // Fetch likes for the user
    $check_likes_query = "SELECT post_id FROM post_reactions WHERE user_name = ? AND action = 'like'";
    $check_likes_stmt = $pdo->prepare($check_likes_query);
    $check_likes_stmt->execute([$userToDelete]);
    $like_array = $check_likes_stmt->fetchAll();

    // Delete reactions for the user
    $delete_reactions_query = "DELETE FROM post_reactions WHERE user_name = ?";
    $delete_reactions_stmt = $pdo->prepare($delete_reactions_query);
    $delete_reactions_stmt->execute([$userToDelete]);

    // Update likes for posts where the user liked or disliked
    foreach ($dislike_array as $dislike) {
        updateLikes($dislike['post_id']);
    }

    foreach ($like_array as $like) {
        updateLikes($like['post_id']);
    }

    // Logout after deletion
    logoutAfterDel();

}