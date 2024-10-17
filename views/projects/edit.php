<form method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $project->name ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"><?= $project->description ?></textarea>
    </div>
    <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $project->start_date ?>">
    </div>
    <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $project->end_date ?>">
    </div>
    <div class="form-group">
        <label for="manager">Manager</label>
        <select class="form-control" id="manager" name="manager">
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id ?>" <?= $project->manager_id == $user->id ? 'selected' : '' ?>><?= $user->first_name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <?php foreach ($statuses as $status): ?>
                <option value="<?= $status->id ?>" <?= $project->status_id == $status->id ? 'selected' : '' ?>><?= $status->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>