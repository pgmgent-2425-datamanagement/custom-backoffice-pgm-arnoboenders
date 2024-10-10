<h1>Projects</h1>
<p>Here is a list of projects:</p>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Manager</th>
            <th>Status</th>
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
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>