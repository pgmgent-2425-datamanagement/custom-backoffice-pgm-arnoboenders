<h1>Teams</h1>
<p>Here is a list of the teams:</p>
<a href="/teams/create" class="btn btn-primary">Create New Team</a>
<div class="project-list">
    <?php foreach ($teams as $team):
        include "teams/item.php";
    endforeach; ?>
</div>