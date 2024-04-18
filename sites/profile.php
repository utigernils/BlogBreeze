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
                    <h3 class="mb-3">Wilkommen zurück
                        <?php echo getUser(); ?>
                    </h3>
                    <div class="accordion" data-bs-theme="dark" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Mein Konto
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body ">
                                    <h4>Meine Angaben</h4>
                                    <div class="d-flex flex-wrap border rounded mb-3 ps-3">
                                        <p class="w-50 mt-3">Vorname:
                                            <?php echo getUserData(getUser(), "firstname"); ?>
                                        </p>
                                        <p class="w-50 mt-3">Nachname:
                                            <?php echo getUserData(getUser(), "lastname"); ?>
                                        </p>
                                        <p class="w-50 mt-3">Benutzername:
                                            <?php echo getUserData(getUser(), "username"); ?>
                                        </p>
                                        <p class="w-50 mt-3">Erstelldatum:
                                            <?php echo getUserData(getUser(), "joined_on"); ?>
                                        </p>
                                    </div>
                                    <h4>Mein Konto verwalten</h4>
                                    <div class="d-flex flex-wrap border rounded mb-3 p-3">
                                        <div class="d-flex w-100 mb-3">
                                            <p class="my-auto">
                                                Mein Passwort ändern
                                            <p>
                                            <div class="ms-auto w-25">
                                            <button onclick="window.location.href = 'changePassword.php'"
                                                    class="btn btn-light w-100">Ändern</button>
                                            </div>
                                        </div>
                                        <div class="d-flex w-100">

                                            <p class="my-auto">
                                                Mein Konto Löschen
                                            <p>
                                            <form class="ms-auto w-25" method='post' action="../php/deletePost.php">
                                                <input type="hidden" class="form-control" id="username" name="username"
                                                    value="<?php echo getUser(); ?>" required>
                                                <button name="UserDelete" id="UserDelete" type="submit"
                                                    class="btn btn-danger w-100">Löschen</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Meine Posts
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse mh-25"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body " style="max-height: 30vh; overflow-y: auto;">
                                    <?php $count = 0;
                                    foreach ($postsData as $post): ?>
                                        <?php if ($post["created_by"] == getUser()):
                                            $count++; ?>
                                            <div class="d-flex mb-2">
                                                <p>
                                                    <?php echo $post['post_title']; ?>
                                                <p>
                                                <form class="ms-auto" method='post' action="../php/deletePost.php">
                                                    <input type="hidden" class="form-control" id="post_id" name="post_id"
                                                        value="<?php echo $post['id']; ?>" required>
                                                    <button name="delete" id="delete" type="submit"
                                                        class="btn btn-danger">Löschen</button>
                                                </form>

                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <p>
                                        <?php echo $count; ?> Post/s gefunden.
                                    <p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    Meine Komentare
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body " style="max-height: 30vh; overflow-y: auto;">
                                    <?php $count = 0;
                                    foreach ($allComments as $comment): ?>
                                        <?php if ($comment["created_by"] == getUser()):
                                            $count++; ?>
                                            <div class="d-flex mb-2">
                                                <p style=' overflow:hidden;'>
                                                    <?php echo $comment['comment_text']; ?>
                                                <p>
                                                <form class="ms-auto" method='post' action="../php/deletePost.php">
                                                    <input type="hidden" class="form-control" id="comment_id" name="comment_id"
                                                        value="<?php echo $comment['id']; ?>" required>
                                                    <button name="Commentdelete" id="Commentdelete" type="submit"
                                                        class="btn btn-danger">Löschen</button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <p>
                                        <?php echo $count; ?> Komentar/e gefunden.
                                    <p>
                                </div>
                            </div>
                        </div>


                    </div>

                    <form method="post">
                        <input type="hidden">
                        <Button type="submit" name="logout" value="logout"
                            class="btn btn-lg btn-dark fw-bold">Ausloggen</Button>
                    </form>
            </main>
        <?php endif; ?>
        <footer class="mt-auto text-center text-white-50">
            <p>Projekt von Nils Utiger</p>
        </footer>
    </div>
</body>

</html>