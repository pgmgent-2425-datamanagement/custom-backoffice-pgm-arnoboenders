<div class="user-item">
    <img src="/path/to/user/avatar.jpg" alt="<?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?>" width="50" height="50">
    <div class="user-details">
        <div class="user-name"><?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?></div>
        <div class="user-email"><?= htmlspecialchars($user->email) ?></div>
    </div>
</div>