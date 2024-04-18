<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <title>BlogBreeze - Login</title>
    <link href="../bootstrap-5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../styles/standart_style.css" rel="stylesheet" />
    <?php
    require("../php/loginhandler.php");
    if (isloggedin()) {
        header('Location: profile.php');
    }

    ?>

</head>

<body class="d-flex h-100 text-left text-dark bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
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
        <main class="px-3 text-dark">
            <h1 class="mb-4">Anmeldung</h1>
            <div class="bg-dark text-light mb-5 p-3 rounded ">
                <?php
                if (isset($_GET['redirect'])) {
                    $redirect = $_GET['redirect'];
                    echo "<form action='../php/loginhandler.php?redirect=$redirect' method='post'>";
                } else {
                    echo "<form action='../php/loginhandler.php' method='post'>";
                }
                ?>

                <div class="mb-3">
                    <label for="username" class="form-label ">Benutzername</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Passwort</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <?php
                if (isset($_GET['e'])) {
                    if ($_GET['e'] == 'crederror') {
                        echo '<div class="alert alert-danger"><p>Die eingegebenen Benutzerdaten sind Falsch.</p></div>';
                    } else {
                        echo '<div class="alert alert-danger"><p>Unbekannter Fehler!</p></div>';
                    }
                }
                ?>

                <?php
                if (isset($_GET['s'])) {
                    if ($_GET['s'] == "accDel") {
                        echo '<div class="alert alert-success"><p>Das Konto wurde erfolgreich gelöscht!</p></div>';
                    } elseif ($_GET['s'] == "accCre") {
                        echo '<div class="alert alert-success"><p>Das Konto wurde erfolgreich erstellt!</p></div>';
                    } else {
                        echo '<div class="alert alert-success"><p>Erfolgreich ausgelogt!</p></div>';
                    }
                }
                ?>

                <button name="login" value="Login" type="submit" class="btn btn-lg btn-dark fw-bold">Einloggen
                </button>
                </form>
            </div>
            <button class="btn btn-lg btn-dark fw-bold w-100"  onclick="window.location.href = 'register.php'">
                Konto erstellen
            </button>
        </main>
        <footer class="mt-auto text-center text-white-50">
            <p>Projekt von Nils Utiger</p>
        </footer>
    </div>
</body>

</html>