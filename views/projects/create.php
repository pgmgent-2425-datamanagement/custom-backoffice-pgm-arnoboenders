<h1>Create New Project</h1>
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
        <label for="name">Project Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($description ?? ''); ?></textarea>
    </div>
    <div>
        <label for="manager_id">Manager:</label>
        <select id="manager_id" name="manager_id" required>
            <?php
            foreach ($users as $user) {
                $selected = (isset($manager_id) && $manager_id == $user->id) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($user->id) . '" ' . $selected . '>' . htmlspecialchars($user->first_name) . ' ' . htmlspecialchars($user->last_name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <label for="status_id">Status:</label>
        <select id="status_id" name="status_id" required>
            <?php
            foreach ($statuses as $stat) {
                $selected = (isset($status_id) && $status_id == $stat->id) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($stat->id) . '" ' . $selected . '>' . htmlspecialchars($stat->name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date ?? ''); ?>" required>
    </div>
    <div>
        <button type="submit">Create Project</button>
    </div>
</form>