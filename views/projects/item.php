<div class="item">
    <div class="details">
        <div class="name"><?= htmlspecialchars($project->name) ?></div>
        <div class="description">Description: <?= htmlspecialchars($project->description) ?></div>
        <div class="manager">Manager: <?= htmlspecialchars($project->manager->first_name . ' ' . $project->manager->last_name) ?></div>
        <div class="status">Status: <?= htmlspecialchars($project->status->name) ?></div>
    </div>
    <div class="actions">
        <a href="/projects/edit/<?= urlencode($project->id) ?>" class="btn btn-secondary">Edit</a>
        <a href="/projects/delete/<?= urlencode($project->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?');">Remove</a>
    </div>
</div>