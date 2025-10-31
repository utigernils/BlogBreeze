<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <title>BlogBreeze - Registrieren</title>
    <link href="../bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../styles/standart_style.css" rel="stylesheet" />
    <?php
    require("../php/loginhandler.php");
    require("components/header.php");
    require("components/footer.php");
    if (isloggedin()) {
        header('Location: profile.php');
    }

    ?>

</head>

<body class="d-flex h-100 text-left text-dark bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php renderHeader('profile.php'); ?>
        <main class="px-3 text-dark">
            <h1 class="mb-4">Registrierung</h1>
            <div class="bg-dark text-light mb-5 p-3 rounded ">
                <form method="Post">
            <div class="mb-3">
                    <label for="firstname" class="form-label ">Vorname</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label ">Nachname</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
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
                    if ($_GET['e'] == 'userexists') {
                        echo '<div class="alert alert-danger"><p>Dieser Benutzernamen ist schon vergeben.</p></div>';
                    } else {
                        echo '<div class="alert alert-danger"><p>Unbekannter Fehler!</p></div>';
                    }
                }
                ?>
                <button name="register" value="register" type="submit"
                    class="btn btn-lg btn-dark mt-2 fw-bold">Konto erstellen</button>
                </form>
            </div>

        </main>
        <?php renderFooter(); ?>
    </div>
</body>

</html>