<h1>Edit User</h1>
<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST" enctype="multipart/form-data">
    <div>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user->first_name ?? ''); ?>" required>
    </div>
    <div>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user->last_name ?? ''); ?>" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user->email ?? ''); ?>" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <small>Leave blank to keep current password</small>
    </div>
    <div>
        <label for="role_id">Role:</label>
        <select id="role_id" name="role_id" required>
            <?php
            foreach ($roles as $role) {
                $selected = (isset($user->role_id) && $user->role_id == $role->id) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($role->id) . '" ' . $selected . '>' . htmlspecialchars($role->name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*">
    </div>
    <div>
        <button type="submit">Update User</button>
    </div>
</form>