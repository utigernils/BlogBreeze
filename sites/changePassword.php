<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <title>BlogBreeze - MyBlogBreeze</title>
    <link href="../bootstrap-5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../styles/standart_style.css" rel="stylesheet" />
    <script src="../bootstrap-5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    require("../php/getPosts.php");
    require("../php/deletePost.php");
    require("../php/getUserData.php");
    ?>
    <?php
    if (!isloggedin()) {
        header('Location: login.php');
    } ?>
</head>

<body class="d-flex text-left text-dark bg-dark">
    <div class="cover-container d-flex w-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">BlogBreeze</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0 " href="../index.html">Wilkommen</a>
                    <a class="nav-link fw-bold py-1 px-0 " href="posts.php">Beiträge</a>
                    <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="profile.php">MyBlogBreeze</a>
                    <a class="nav-link fw-bold py-1 px-0" href="other_blogs.php">Weitere Blogseiten</a>
                </nav>
            </div>
        </header>
        <?php if (isloggedin()): ?>
            <main class="px-3 text-dark">
                <h1 class="mb-4">MyBlogBreeze</h1>
                <div class="bg-dark text-light mb-5 p-3 rounded ">
                    <form method="Post">
                    <input type="hidden" id="user" name="user" value="<?php echo getUser();?>" required>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label ">Neues Passwort</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <button name="setPassword" value="setPassword" type="submit"
                            class="btn btn-lg btn-dark mt-2 fw-bold">Passwort ändern</button>
                        <Button onclick="window.location.href = 'profile.php'"
                            class="btn btn-lg btn-dark mt-2 fw-bold">zurück</Button>
                    </form>

                </div>
            </main>
        <?php endif; ?>
        <footer class="mt-auto text-center text-white-50">
            <p>Projekt von Nils Utiger</p>
        </footer>
    </div>
</body>

</html>