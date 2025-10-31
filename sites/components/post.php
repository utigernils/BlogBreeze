<?php
require_once("comment.php");

function renderPost($post, $pdo) {
    $commentsData = getCommentsForPost($pdo, $post['id']);
    $commentsData = array_reverse($commentsData);
    ?>
    <div class="bg-dark text-light mb-5 p-3 rounded" style="overflow-wrap: break-word">
        <h3>
            <?= $post["post_title"] ?>
        </h3>
        <p class="fs-5">
            <?= $post["post_text"] ?>
        </p>
        <?php if (!empty($post["picture_url"])): ?>
            <img class="img-fluid rounded" style="max-width: 25%;" src="<?= $post["picture_url"] ?>"
                alt="Post Bild">
        <?php endif; ?>

        <div class="d-flex flex-row justify-content-between mb-3 align-items-center">
            <p class="fw-bold fs-6 mb-0 text-white-50 bg-dark">
                Gepostet von
                <?= $post["created_by"] ?> am
                <?= $post["created_at"] ?>
            </p>
        </div>

        <div class="accordion" data-bs-theme="dark" id="accordion">
            <div class="accordion-item ">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?php echo $post['id']; ?>" aria-expanded="true"
                        aria-controls="collapse">
                        Mitreden bei
                        <?php echo count($commentsData); ?> Kommentaren
                    </button>
                </h2>
                <div id="collapse<?php echo $post['id']; ?>" class="accordion-collapse collapse"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php foreach ($commentsData as $comment): ?>
                            <?php renderComment($comment); ?>
                        <?php endforeach; ?>

                        <div class="d-flex flex-row justify-content-between mb-3 ">
                            <form class="w-50" data-bs-theme="light" action='../php/makeComment.php'
                                method='post'>
                                <div class="d-flex flex-row mb-3">
                                    <input type="text" class="form-control" id="comment" name="comment"
                                        required>
                                    <input type="hidden" class="form-control" id="post_id" name="post_id"
                                        value="<?php echo $post['id']; ?>" required>
                                    <button name="push" type="submit"
                                        class="btn btn-dark fw-bold">Kommentieren</button>
                                </div>
                            </form>
                            <form method='post'>
                                <div class="d-flex flex-row mb-3">
                                    <input type="hidden" class="form-control" id="post_id" name="post_id"
                                        value="<?php echo $post['id']; ?>" required>
                                    <button name="like" id="like" type="submit" class="btn btn-<?php if (getLikeState($post['id']) == true) {
                                        echo 'light';
                                    } else {
                                        echo 'dark';
                                    } ?>">Liken
                                        (
                                        <?php echo $post['post_likes']; ?>)
                                    </button>
                                    <button name="dislike" id="dislike" type="submit" class="btn btn-<?php if (getDislikeState($post['id']) == true) {
                                        echo 'light';
                                    } else {
                                        echo 'dark';
                                    } ?>">Disliken
                                        (
                                        <?php echo $post['post_dislikes']; ?>)
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
