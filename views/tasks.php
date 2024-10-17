<?php foreach ($tasks as $task): ?>
    <div class="task">
        <h2><?php echo htmlspecialchars($task->name); ?></h2>
        <p><?php echo htmlspecialchars($task->description); ?></p>
        <h3>Comments</h3>
        <?php if (!empty($task->comments)): ?>
            <ul class="comments">
                <?php displayComments($task->comments); ?>
            </ul>
        <?php else: ?>
            <p>No comments yet.</p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php
// Recursive function to display comments and their children
function displayComments($comments)
{
    foreach ($comments as $comment): ?>
        <li class="comment">
            <p><?php echo htmlspecialchars($comment->comment); ?></p>
            <span class="comment-author">- <?php echo htmlspecialchars($comment->user_first_name); ?></span>

            <?php if (!empty($comment->children)): ?>
                <ul class="children">
                    <?php displayComments($comment->children); ?>
                </ul>
            <?php endif; ?>
        </li>
<?php endforeach;
}
?>