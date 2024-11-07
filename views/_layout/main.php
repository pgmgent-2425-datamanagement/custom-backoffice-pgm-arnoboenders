<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($title ?? '') . ' ' . $_ENV['SITE_NAME'] ?></title>
    <link rel="stylesheet" href="/css/main.css?v=<?php if ($_ENV['DEV_MODE'] == "true") {
                                                        echo time();
                                                    }; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav>
        <a href="/">Home</a>
        <a href="/users">Users</a>
        <a href="/projects">Projects</a>
        <a href="/teams">Teams</a>
        <a href="/tasks">Tasks</a>
        <a href="/files">Files</a>
    </nav>
    <main>
        <?= $content; ?>
    </main>
    <footer>
        &copy; <?= date('Y'); ?> - Project Management
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
    <script src="/js/dropdown.js"></script> <!-- Include the dropdown.js file -->
</body>

</html>