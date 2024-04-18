<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <title>BlogBreeze - Posts</title>
    <link href="../bootstrap-5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/posts_style.css" rel="stylesheet">
    <?php
    require("../php/getOtherPosts.php");
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
        <main class="mt-5">
        <h1 class="mb-4">Posts von Yannick's Seite</h1>

            <?php  foreach ($postsData as $post): ?>
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
                    <div class="w-100 d-flex justify-content-center">
                        <a class="btn btn-lg w-100 btn-dark  mt-1 mb-1" href="https://www.041er-blj.ch/2023/blogs/yannick/">Auf Originalwebseite anzeigen</a>
                    </div>

                </div>
            <?php endforeach; ?>
            <div class="w-100 d-flex justify-content-center">
                <a class="btn btn-lg w-100 btn-dark  mt-1 mb-1" href="posts.php">Zurück</a>
            </div>

            <footer class="mt-5 text-white-50 text-center">
                <p>Projekt von Nils Utiger</p>
            </footer>

    </div>
</body>

</html>