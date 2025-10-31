<?php

function getPages() {
    return [
        'index.php' => 'Willkommen',
        'posts.php' => 'Beiträge',
        'profile.php' => 'MyBlogBreeze',
    ];
}

function renderHeader($activePage) {
    $pages = getPages();
    ?>
        <div class="cover-container d-flex w-100 h-25 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <div>
                    <h3 class="float-md-start mb-0">BlogBreeze</h3>
                    <nav class="nav nav-masthead justify-content-center float-md-end">
                        <?php foreach ($pages as $file => $title): ?>
                            <a class="nav-link fw-bold py-1 px-0<?= $activePage == $file ? ' active' : '' ?>" href="<?= htmlspecialchars($file, ENT_QUOTES, 'UTF-8') ?>"<?= $activePage == $file ? ' aria-current="page"' : '' ?>><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></a>
                        <?php endforeach; ?>
                    </nav>
                </div>
                </header>
        </div>
    <?php
}