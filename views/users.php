<h1>Users</h1>
<p>Here is a list of users:</p>
<div class="user-list">
    <?php foreach ($users as $user):
        include 'users/Item.php';
    endforeach; ?>
</div>