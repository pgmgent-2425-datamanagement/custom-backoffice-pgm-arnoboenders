<h1>Users</h1>
<p>Here is a list of users:</p>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><a href="/users/<?= $user->id ?>"><?= $user->id ?></a></td>
                <td><?= $user->first_name . ' ' . $user->last_name ?></td>
                <td><?= $user->email ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>