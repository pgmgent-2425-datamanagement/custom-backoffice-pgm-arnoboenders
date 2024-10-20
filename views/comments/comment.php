<?php include_once "displayComments.php" ?>
<div class="comment">
    <p class="comment-author"><?= htmlspecialchars($comment->user_first_name . ' ' . $comment->user_last_name) ?></p>
    <h1 class="comment-content"><?= htmlspecialchars($comment->comment) ?></h1>
    <ul class="children">
        <?php displayComments($comment->comments); ?>
    </ul>
</div>