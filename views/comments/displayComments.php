<?php
// Recursive function to display comments and their children
function displayComments($comments)
{
    foreach ($comments as $comment): ?>
        <li class="comment">
            <span class="comment-author">- <?php echo htmlspecialchars($comment->user_first_name . ' ' . $comment->user_last_name); ?></span>
            <p class="comment-content"><?php echo htmlspecialchars($comment->comment); ?></p>
            <a href="/comments/<?= $comment->id ?>">View comment</a>
            <?php if (!empty($comment->children)): ?>
                <ul class="children">
                    <?php displayComments($comment->children); ?>
                </ul>
            <?php endif; ?>
        </li>
<?php endforeach;
}
?>