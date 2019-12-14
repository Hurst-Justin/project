<?php
    require "dbConnect.php";
    $db = get_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Incident Management System</title>
        <link rel="stylesheet" type="text/css" href="mystyles.css">
    </head>

    <body>
    <h1>Incident Management System</h1>
    <?php
    require "navigation.php";
    ?>
    <h2>Home</h2>
    Welcome to the Incident Management System.  Please use the menu at the top to navigate.
    </body>
</html>