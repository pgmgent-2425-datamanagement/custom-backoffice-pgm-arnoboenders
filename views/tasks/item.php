<div class="task">
    <h2><?php echo htmlspecialchars($task->name); ?></h2>
    <p><?php echo htmlspecialchars($task->description); ?></p>
    <p>Comments: <?= $task->comment_count ?></p>
    <a href="tasks/<?php echo urlencode($task->id); ?>" class="btn btn-primary">View Task</a>
</div>