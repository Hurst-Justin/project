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
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a class="active" href="new.php">Create New Event</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>Search</h2>
    <form>
        Search by Event ID: <input type="number" name="eventID" value=1001 >
        OR
        Search by Date Range: <input type="date" name="startDate"><input type="date" name="endDate">
        <input type="submit" value="Search Event ID" class="button">
    </form>
    
    <?php
    
    // Search Event ID from Events
    if (isset($_GET['eventID']))
    {
        $stmt = $db->prepare('select * from events WHERE event_id=:eventID');
        $stmt->bindValue(':eventID', $_GET['eventID'], PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row)
        {
            $dateOccurred = new DateTime($row['date_occurred']);
            $reportingBoundary = $row['reporting_boundary'];
            if ($reportingBoundary == 1)
            {
                $reportingBoundary = "Yes";
            }
            else
            {
                $reportingBoundary = "No";
            }
            
            echo '<p>';
            echo '<b>EventID:</b>  ';
            echo '<a href="event-details.php?event_id=' . $row['event_id'] . '">'. $row['event_id'].'</a><br>';
            echo '<b>Date Occurred:</b>  ' . $dateOccurred->format('M d, Y').'<br>';
            echo '<b>Short Description:</b>  ' . $row['description_short'].'<br>';
            echo '<b>Within Reporting Boundaries?:</b>  ' . $reportingBoundary;'<br>';
            echo '</p>';
        }
    }
    ?>
    <br>
    </body>
</html>