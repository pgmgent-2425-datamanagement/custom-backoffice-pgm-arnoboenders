<div class="item">
    <a href="teams/<?= $team->id ?>" class="details">
        <div class="name"><?= htmlspecialchars($team->name) ?></div>
        <div class="description"><?= htmlspecialchars($team->description) ?></div>
    </a>
    <div class="actions">
        <a href="/teams/edit/<?= urlencode($team->id) ?>" class="btn btn-secondary">Edit</a>
        <a href="/teams/delete/<?= urlencode($team->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this team?');">Remove</a>
    </div>
</div>