<h1>Tasks</h1>
<a href="index.php?controller=tasks&action=create" class="btn btn-primary">Create Task</a>

<?php foreach ($tasks as $task):
    include "item.php";
endforeach; ?>