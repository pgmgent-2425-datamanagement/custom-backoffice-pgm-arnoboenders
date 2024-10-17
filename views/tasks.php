<h1>Tasks</h1>
<a href="index.php?controller=tasks&action=create">Create Task</a>

<?php foreach ($tasks as $task):
    include "tasks/item.php";    
endforeach; ?>