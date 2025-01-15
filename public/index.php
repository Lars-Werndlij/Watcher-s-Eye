<?php

session_start();

require_once '../config.php';
require_once '../lib/helper.php';
//enter seeder code here for sample data
dbconnect();
?> 

<!DOCTYPE html>
<html lang="<?= $_ENV['LANGUAGE'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watcher's Eye</title>
    <link rel="shortcut icon" href="../images/watchers-eye.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/app.css">
</head>
<body>
    <?php require_once '../resources/views/components/navbar.view.php' ?>
    <?php require_once getPage(); ?>
    <?php require_once '../resources/views/components/footer.view.php' ?>
</body>
</html>