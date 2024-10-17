<h1>Create New User</h1>
<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST">
    <div>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>" required>
    </div>
    <div>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="role_id">Role:</label>
        <select id="role_id" name="role_id" required>
            <?php
            foreach ($roles as $role) {
                $selected = (isset($role_id) && $role_id == $role->id) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($role->id) . '" ' . $selected . '>' . htmlspecialchars($role->name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <button type="submit">Create User</button>
    </div>
</form>
