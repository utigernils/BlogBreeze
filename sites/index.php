<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <title>BlogBreeze - Posts</title>
    <link
      href="../bootstrap-5.3.8-dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="../styles/index_style.css" rel="stylesheet" />
    <?php
    require("components/header.php");
    ?>
  </head>
  <body class="d-flex h-100 text-center text-dark bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <?php renderHeader('index.php'); ?>
      <main class="px-3 text-dark">
        <h1>Wilkommen bei BlogBreeze!</h1>
        <p class="lead">
          BlogBreeze: Deine einfache und moderne Plattform fürs Bloggen. Teile
          deine Gedanken und entdecke eine Community voller Inspiration.
        </p>
        <p class="lead">
          <a href="posts.php" class="btn btn-lg btn-dark fw-bold"
            >Zu den Beiträgen</a
          >
        </p>
      </main>
      <footer class="mt-auto text-white-50">
        <p>Projekt von Nils Utiger</p>
      </footer>
    </div>
  </body>
</html>
