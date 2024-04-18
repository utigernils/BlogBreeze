<?php

require("makeReaction.php");



if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete'])) {
    $conn = connectToDatabase();

    $posttodelete = $_POST['post_id'];
    $delete_query = "DELETE FROM posts WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $posttodelete);
    $delete_stmt->execute();

    header("location: ../sites/profile.php");


}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Commentdelete'])) {
    $conn = connectToDatabase();

    $commenttodelete = $_POST['comment_id'];
    $delete_query = "DELETE FROM comments WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $commenttodelete);
    $delete_stmt->execute();

    header("location: ../sites/profile.php");

}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['UserDelete'])) {
    $conn = connectToDatabase();

    $userToDelete = $_POST['username'];

    // Delete user from 'users' table
    $delete_user_query = "DELETE FROM users WHERE username = ?";
    $delete_user_stmt = $conn->prepare($delete_user_query);
    $delete_user_stmt->bind_param("s", $userToDelete);
    $delete_user_stmt->execute();

    // Delete user's posts from 'posts' table
    $delete_posts_query = "DELETE FROM posts WHERE created_by = ?";
    $delete_posts_stmt = $conn->prepare($delete_posts_query);
    $delete_posts_stmt->bind_param("s", $userToDelete);
    $delete_posts_stmt->execute();

    // Delete user's comments from 'comments' table
    $delete_comments_query = "DELETE FROM comments WHERE created_by = ?";
    $delete_comments_stmt = $conn->prepare($delete_comments_query);
    $delete_comments_stmt->bind_param("s", $userToDelete);
    $delete_comments_stmt->execute();

    // Fetch dislikes for the user
    $check_dislikes_query = "SELECT post_id FROM post_reactions WHERE user_name = ? AND action = 'dislike'";
    $check_dislikes_stmt = $conn->prepare($check_dislikes_query);
    $check_dislikes_stmt->bind_param("s", $userToDelete);
    $check_dislikes_stmt->execute();
    $dislike_result = $check_dislikes_stmt->get_result();
    $dislike_array = $dislike_result->fetch_all(MYSQLI_ASSOC);

    // Fetch likes for the user
    $check_likes_query = "SELECT post_id FROM post_reactions WHERE user_name = ? AND action = 'like'";
    $check_likes_stmt = $conn->prepare($check_likes_query);
    $check_likes_stmt->bind_param("s", $userToDelete);
    $check_likes_stmt->execute();
    $like_result = $check_likes_stmt->get_result();
    $like_array = $like_result->fetch_all(MYSQLI_ASSOC);

    // Delete reactions for the user
    $delete_reactions_query = "DELETE FROM post_reactions WHERE user_name = ?";
    $delete_reactions_stmt = $conn->prepare($delete_reactions_query);
    $delete_reactions_stmt->bind_param("s", $userToDelete);
    $delete_reactions_stmt->execute();

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