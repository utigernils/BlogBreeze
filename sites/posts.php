<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <title>BlogBreeze - Posts</title>
    <link href="../bootstrap-5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/posts_style.css" rel="stylesheet">
    <?php
    require("../php/getPosts.php");
    require("../php/makeReaction.php");
    ?>
    <script src="../bootstrap-5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="d-flex h-auto text-left text-dark bg-dark">
    </div>
    <div class="container-fluid d-flex w-75 min-vh-100 pt-0 pb-3 px-3 mx-auto flex-column">
        <div class="cover-container d-flex w-100 h-25 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <div>
                    <h3 class="float-md-start mb-0">BlogBreeze</h3>
                    <nav class="nav nav-masthead justify-content-center float-md-end">
                        <a class="nav-link fw-bold py-1 px-0" href="../index.html">Wilkommen</a>
                        <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="posts.php">Beiträge</a>
                        <a class="nav-link fw-bold py-1 px-0" href="profile.php">MyBlogBreeze</a>
                        <a class="nav-link fw-bold py-1 px-0" href="other_blogs.php">Weitere Blogseiten</a>
                    </nav>
                </div>
        </div>
        </header>
        <a class="btn btn-lg btn-dark mt-5 mb-5 fw-bold" href="posts_write.php">Beitrag schreiben</a>
        <main>
            <?php foreach ($postsData as $post): ?>
                <div class="bg-dark text-light mb-5 p-3 rounded" style="overflow-wrap: break-word">
                    <h3>
                        <?= $post["post_title"] ?>
                    </h3>
                    <p class="fs-5">
                        <?= $post["post_text"] ?>
                    </p>
                    <?php if (!empty($post["picture_url"])): ?>
                        <img class="img-fluid rounded" style="max-width: 25%;" src="<?= $post["picture_url"] ?>"
                            alt="Post Bild">
                    <?php endif; ?>

                    <div class="d-flex flex-row justify-content-between mb-3 align-items-center">
                        <p class="fw-bold fs-6 mb-0 text-white-50 bg-dark">
                            Gepostet von
                            <?= $post["created_by"] ?> am
                            <?= $post["created_at"] ?>
                        </p>
                    </div>

                    <?php
                    $commentsData = getCommentsForPost($pdo, $post['id']);
                    $commentsData = array_reverse($commentsData);
                    ?>
                    <div class="accordion" data-bs-theme="dark" id="accordion">
                        <div class="accordion-item ">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?php echo $post['id']; ?>" aria-expanded="true"
                                    aria-controls="collapse">
                                    Mitreden bei
                                    <?php echo count($commentsData); ?> Kommentaren
                                </button>
                            </h2>
                            <div id="collapse<?php echo $post['id']; ?>" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php foreach ($commentsData as $comment): ?>
                                        <div class="mb-3 p-3 border rounded">
                                            <p class="fw-bold fs-6 mb-0 text-white-50 bg-dark">
                                                Kommentiert von
                                                <?= $comment["created_by"] ?> am
                                                <?= $comment["created_at"] ?>
                                            </p>
                                            <p class="fw-bold fs-6 mb-0 text-white bg-dark">
                                                <?= $comment["comment_text"] ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>

                                    <div class="d-flex flex-row justify-content-between mb-3 ">
                                        <form class="w-50" data-bs-theme="light" action='../php/makeComment.php'
                                            method='post'>
                                            <div class="d-flex flex-row mb-3">
                                                <input type="text" class="form-control" id="comment" name="comment"
                                                    required>
                                                <input type="hidden" class="form-control" id="post_id" name="post_id"
                                                    value="<?php echo $post['id']; ?>" required>
                                                <button name="push" type="submit"
                                                    class="btn btn-dark fw-bold">Kommentieren</button>
                                            </div>
                                        </form>
                                        <form method='post'>
                                            <div class="d-flex flex-row mb-3">
                                                <input type="hidden" class="form-control" id="post_id" name="post_id"
                                                    value="<?php echo $post['id']; ?>" required>
                                                <button name="like" id="like" type="submit" class="btn btn-<?php if (getLikeState($post['id']) == true) {
                                                    echo 'light';
                                                } else {
                                                    echo 'dark';
                                                } ?>">Liken
                                                    (
                                                    <?php echo $post['post_likes']; ?>)
                                                </button>
                                                <button name="dislike" id="dislike" type="submit" class="btn btn-<?php if (getDislikeState($post['id']) == true) {
                                                    echo 'light';
                                                } else {
                                                    echo 'dark';
                                                } ?>">Disliken
                                                    (
                                                    <?php echo $post['post_dislikes']; ?>)
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="w-100 d-flex justify-content-center">
                <a class="btn btn-lg w-50 btn-dark me-3 mt-1 mb-1"  href="other_posts.php">Beiträge von anderen Seiten
                    anschauen</a>
                <a class="btn btn-lg w-50 btn-dark ms-3 mt-1 mb-1" href="../php/api.php">Diese Beiträge per API
                    anschauen</a>
            </div>

            <footer class="mt-5 text-white-50 text-center">
                <p>Projekt von Nils Utiger</p>
            </footer>

    </div>
</body>

</html>