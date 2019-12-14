<?php
require "dbConnect.php";
$db = get_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Incident Management System</title>
        <link rel="stylesheet" type="text/css" href="mystyles.css">
        <script type="text/javascript" src="scripts.js"></script> 
    </head>

    <body>
    <h1>Incident Management System</h1>
    <?php
    require "navigation.php";
    ?>
    <h2>Record Deletion Confirmation</h2>
    <?php
        $EventID = $_POST['EventID'];
        $InjuryID = $_POST['InjuryID'];
        //echo $EventID.'<br>';
        //echo $InjuryID.'<br>';

        $sql = "DELETE FROM injuries WHERE injury_id=".$InjuryID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $sql = "DELETE FROM events WHERE event_id=".$EventID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo 'Event Record '.$EventID.' deleted successfully.<br>';
    
    ?>
</body>
</html>