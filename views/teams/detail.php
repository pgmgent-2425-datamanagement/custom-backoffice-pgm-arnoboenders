<h1><?= $team->name ?></h1>
<p><?= $team->description ?></p>
<?php if (count($projects) > 0): ?>
    <p><strong>Projects: </strong></p>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <strong><?= $project['name'] ?></strong>
                <ul>
                    <li>Status: <?= $project['status'] ?></li>
                    <li>Manager: <?= $project['manager_name'] ?></li>
                </ul>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>