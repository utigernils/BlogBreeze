<!DOCTYPE html>
<html lang="de" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <title>BlogBreeze - Andere Blogs</title>
    <link href="../bootstrap-5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../styles/standart_style.css" rel="stylesheet" />
</head>

<body class="d-flex h-100 text-left text-dark bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">BlogBreeze</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0 " href="../index.html">Wilkommen</a>
                    <a class="nav-link fw-bold py-1 px-0 " href="posts.php">Beiträge</a>
                    <a class="nav-link fw-bold py-1 px-0 " href="profile.php">MyBlogBreeze</a>
                    <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="other_blogs.php">Weitere Blogseiten</a>
                </nav>
            </div>
        </header>
        <main class="px-3 text-dark h-75">
            <div class="d-flex flex-row justify-content-center flex-wrap h-100">
                <?php require('../php/get_blogs.php');
                foreach ($blogsData as $blog): ?>
                <?php if($blog['blog_von'] != 'Nils Utiger'): ?>
                    <button class="btn btn-dark  mx-1 mb-2" style="width: 48%;"
                        onclick="window.location.href = '<?php echo $blog['blog_url']; ?>'">
                        <?php echo $blog['blog_von']; ?>
                    </button>
                <?php endif;?>
                <?php endforeach; ?>
            </div>
        </main>
        <footer class="mt-auto text-center text-white-50">
            <p>Projekt von Nils Utiger</p>
        </footer>
    </div>
</body>

</html>