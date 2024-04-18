<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <title>BlogBreeze - Posts</title>
    <link href="../bootstrap-5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../styles/standart_style.css" rel="stylesheet" />
    <?php
    require("../php/makePost.php");
    ?>
</head>

<body class="d-flex h-100 text-left text-dark bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">BlogBreeze</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0 " href="../index.html">Wilkommen</a>
                    <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="posts.php">Beiträge</a>
                    <a class="nav-link fw-bold py-1 px-0" href="profile.php">MyBlogBreeze</a>
                    <a class="nav-link fw-bold py-1 px-0" href="other_blogs.php">Weitere Blogseiten</a>
                </nav>
            </div>
        </header>
        <main class="px-3 text-dark">
            <?php
            if (isloggedin()) {
                echo '
                <h1 class="mb-4">Neuer Beitrag erstellen</h1>
                <div class="bg-dark text-light mb-5 p-3 rounded ">
                    <form action="../php/makePost.php" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label ">Titel</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Inhalt</label>
                            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Bild URL</label>
                            <textarea class="form-control" id="picture" name="picture" rows="1"></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-dark mt-5 mb-5 fw-bold">Beitrag veröffentlichen</button>
                    </form>
                </div>
                ';
            } else {
                header('Location: login.php?redirect=posts_write.php');
            }
            ?>

        </main>
        <footer class="mt-auto text-center text-white-50">
            <p>Projekt von Nils Utiger</p>
        </footer>
    </div>
</body>

</html>