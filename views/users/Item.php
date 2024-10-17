<div class="user-item">
    <a href="/users/<?= $user->id ?>">
        <p><strong>ID:</strong> <?= $user->id ?></p>
        <p><strong>Name:</strong> <?= $user->first_name . ' ' . $user->last_name ?></p>
        <p><strong>Email:</strong> <?= $user->email ?></p>
    </a>
</div>