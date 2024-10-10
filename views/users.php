<h1>Users</h1>
<p>Here is a list of users:</p>
<ul>
    <?php foreach ($users as $user): ?>
        <li><?= $user->first_name . ' ' . $user->last_name . ': ' . $user->email?></li>
    <?php endforeach; ?>