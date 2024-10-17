<h1>Users</h1>
<p>Here is a list of users:</p>
<a href="/users/create" class="btn btn-primary">Create User</a>
<div class="user-list">
    <?php foreach ($users as $user):
        include 'users/item.php';
    endforeach; ?>
</div>