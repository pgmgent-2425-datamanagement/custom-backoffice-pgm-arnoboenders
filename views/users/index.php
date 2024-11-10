<h1>Users</h1>
<p>Here is a list of users:</p>
<form action="/users/search" method="get">
    <input type="text" name="query" value="<?= htmlspecialchars($query ?? '') ?>" placeholder="Search users...">
    <button type="submit" class="btn btn-primary">Search</button>
</form>
<a href="/users/create" class="btn btn-primary">Create User</a>
<div class="user-list">
    <?php foreach ($users as $user):
        include 'item.php';
    endforeach; ?>
</div>