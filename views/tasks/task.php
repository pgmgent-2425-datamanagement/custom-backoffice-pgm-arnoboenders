<?php
include_once __DIR__ . "/../comments/displayComments.php" ?>

<h1><?= $task->name ?></h1>
<p><strong>Description:</strong><?= $task->description ?></p>
<p><strong>Due Date:</strong> <?= $task->due ?></p>
<p><strong>User:</strong> <a href="/users/<?= $task->user_id ?>"><?= $task->user ?></a></p>
<p><strong>Project:</strong> <a href="/projects/<?= $task->project_id ?>"><?= $task->project_name ?></a></p>
<p><strong>Status:</strong> <?= $task->status ?></p>
<p><strong>Priority:</strong> <?= $task->priority ?></p>

<h3>Comments</h3>
<?php if (!empty($task->comments)): ?>
    <ul class="comments">
        <?php displayComments($task->comments); ?>
    </ul>
<?php else: ?>
    <p>No comments yet.</p>
<?php endif; ?>