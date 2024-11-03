<div class="item">
    <img src="/images/<?= $user->image ?>" alt="<?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?>" width="50" height="50">
    <div class="details">
        <div class="name"><?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?></div>
        <div class="email"><?= htmlspecialchars($user->email) ?></div>
    </div>
    <div class="actions">
        <a href="/users/edit/<?= urlencode($user->id) ?>" class="btn btn-secondary">Edit</a>
        <a href="/users/delete/<?= urlencode($user->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Remove</a>
    </div>
</div>