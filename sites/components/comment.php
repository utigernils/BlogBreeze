<?php

function renderComment($comment) {
    ?>
    <div class="mb-3 p-3 border rounded">
        <p class="fw-bold fs-6 mb-0 text-white-50 bg-dark">
            Kommentiert von
            <?= $comment["created_by"] ?> am
            <?= $comment["created_at"] ?>
        </p>
        <p class="fw-bold fs-6 mb-0 text-white bg-dark">
            <?= $comment["comment_text"] ?>
        </p>
    </div>
    <?php
}
