<h1>Projects</h1>
<p>Here is a list of projects:</p>
<a href="/projects/create" class="btn btn-primary">Create New Project</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Manager</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><a href="/projects/<?= $project->id ?>"><?= $project->id ?></a></td>
                <td><?= $project->name ?></td>
                <td><?= $project->description ?></td>
                <td><?= $project->manager->first_name . ' ' . $project->manager->last_name ?></td>
                <td><?= $project->status->name ?></td>
                <td>
                    <a href="/projects/edit/<?= $project->id ?>" class="btn btn-secondary">Edit</a>
                    <a href="/projects/delete/<?= $project->id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>