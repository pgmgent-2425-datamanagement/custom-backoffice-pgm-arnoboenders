<?php
// Recursive function to display comments and their children
function displayComments($comments)
{
    foreach ($comments as $comment): ?>
        <li class="comment">
            <span class="comment-author">- <?php echo htmlspecialchars($comment->user_first_name); ?></span>
            <p><?php echo htmlspecialchars($comment->comment); ?></p>
            <button>View Comment</button>

            <?php if (!empty($comment->children)): ?>
                <ul class="children">
                    <?php displayComments($comment->children); ?>
                </ul>
            <?php endif; ?>
        </li>
<?php endforeach;
}
?>