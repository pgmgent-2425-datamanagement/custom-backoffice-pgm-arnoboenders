<h1><?= $project->name ?></h1>
<p><?= $project->description ?></p>
<p>Start Date: <?= $project->start_date ?></p>
<p>End Date: <?= $project->end_date ?></p>
<p>Status: <?= $status->name ?></p>
<p>Manager: <?= $manager->first_name . ' ' . $manager->last_name ?></p>