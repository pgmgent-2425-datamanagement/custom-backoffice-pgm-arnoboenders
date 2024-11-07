<h1>Update <?= htmlspecialchars($team->name) ?></h1>
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
        <label for="name">Team Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($team->name) ?>" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($team->description) ?></textarea>
    </div>
    <div>
        <label for="users">Users</label>
        <div class="dropdown">
            <button id="users-dropdown-btn" type="button" class="dropdown-btn" onclick="toggleDropdown('users-dropdown-menu')">Select users</button>
            <div id="users-dropdown-menu" class="dropdown-content">
                <?php foreach ($users as $user): ?>
                    <label class="dropdown-item">
                        <input type="checkbox" name="user_ids[]" value="<?= $user->id ?>"
                            <?= in_array($user->id, $selectedUsers) ? 'checked' : '' ?>>
                        <?= htmlspecialchars($user->first_name) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div>
        <label for="projects">Projects</label>
        <div class="dropdown">
            <button id="projects-dropdown-btn" type="button" class="dropdown-btn" onclick="toggleDropdown('projects-dropdown-menu')">Select projects</button>
            <div id="projects-dropdown-menu" class="dropdown-content">
                <?php foreach ($projects as $project): ?>
                    <label class="dropdown-item">
                        <input type="checkbox" name="project_ids[]" value="<?= $project->id ?>"
                            <?= in_array($project->id, $selectedProjects) ? 'checked' : '' ?>>
                        <?= htmlspecialchars($project->name) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div>
        <button type="submit">Update Team</button>
    </div>
</form>