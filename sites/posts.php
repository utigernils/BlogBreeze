<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <title>BlogBreeze - Posts</title>
    <link href="../bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/posts_style.css" rel="stylesheet">
    <?php
    require("../php/getPosts.php");
    require("../php/makeReaction.php");
    require("components/header.php");
    require("components/footer.php");
    require("components/post.php");
    ?>
    <script src="../bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="d-flex h-auto text-left text-dark bg-dark">
    </div>
    <div class="container-fluid d-flex w-75 min-vh-100 pt-0 pb-3 px-3 mx-auto flex-column">
        <?php renderHeader('posts.php'); ?>
        <a class="btn btn-lg btn-dark mt-5 mb-5 fw-bold" href="posts_write.php">Beitrag schreiben</a>
        <main>
            <?php foreach ($postsData as $post): ?>
                <?php renderPost($post, $pdo); ?>
            <?php endforeach; ?>

            <?php renderFooter(); ?>

    </div>
</body>

</html>