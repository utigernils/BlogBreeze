<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <title>BlogBreeze - Posts</title>
    <link href="../bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../styles/standart_style.css" rel="stylesheet" />
    <?php
    require("../php/makePost.php");
    require("components/header.php");
    require("components/protect.php");
    ?>
</head>

<body class="d-flex h-100 text-left text-dark bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php renderHeader('posts.php'); ?>
        <main class="px-3 text-dark">
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
        </main>
        <footer class="mt-auto text-center text-white-50">
            <p>Projekt von Nils Utiger</p>
        </footer>
    </div>
</body>

</html>