<h1>Projects</h1>
<p>Here is a list of projects:</p>
<a href="/projects/create" class="btn btn-primary">Create New Project</a>
<div class="project-list">
    <?php foreach ($projects as $project):
        include "item.php";
    endforeach; ?>
</div>