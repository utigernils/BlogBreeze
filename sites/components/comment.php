<?php

function renderComment($comment) {
    $created = $comment['created_at'] ?? '';
    $formatted = '';
    if ($created) {
        try {
            $formatted = (new DateTime($created))->format('d.m.Y H:i:s');
        } catch (Exception $e) {
            $formatted = htmlspecialchars($created, ENT_QUOTES, 'UTF-8');
        }
    }
    ?>
    <div class="mb-2 p-3 border border-secondary rounded" style="background-color: #1a1d20;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <p class="fw-bold mb-0 text-light">
                <?= htmlspecialchars($comment["created_by"], ENT_QUOTES, 'UTF-8') ?>
            </p>
            <p class="mb-0 text-secondary small">
                <?= htmlspecialchars($formatted, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>
        <p class="mb-0 text-light" style="word-wrap: break-word;">
            <?= htmlspecialchars($comment["comment_text"], ENT_QUOTES, 'UTF-8') ?>
        </p>
    </div>
    <?php
}
