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
    <h2>Search</h2>
    
    <form>
        Search by Event ID: 
        <input type="number" name="eventID" value=1001>
        <input type="submit" value="Search Event ID" class="button">
    </form>
    <br>OR<br><br>
    <form>
        Search by Date Range: 

        Start Date:<input type="date" name="startDate" value="2019-01-01" required>

        End Date:<input type="date" name="endDate" value='2019-12-01' required>

        <input type="submit" value="Search Date Range" class="button">
    </form>

    
    <?php
    
    // Search Event ID from Events
    if (isset($_GET['eventID']))
    {
        $stmt = $db->prepare('select * from events WHERE event_id=:eventID ORDER BY date_occurred');
        $stmt->bindValue(':eventID', $_GET['eventID'], PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<table class="table1">';
            echo '<th>Event ID</th><th>Date Occurred</th><th>Short Description</th><th>Within Reporting Boundaries?</th>';
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
            echo '<tr><td><a href="event-details.php?event_id=' . $row['event_id'] . '">'. $row['event_id'].'</a></td><td>' . $dateOccurred->format('M d, Y').'</td><td>' . $row['description_short'].'</td><td>' . $reportingBoundary;'</td></tr>';
        }
        echo '</table>';
    }
    if (isset($_GET['startDate']))
    {
        $stmt = $db->prepare('select * from events WHERE date_occurred>=:startDate AND date_occurred<=:endDate ORDER BY date_occurred');
        $stmt->bindValue(':startDate', $_GET['startDate'], PDO::PARAM_INT);
        $stmt->bindValue(':endDate', $_GET['endDate'], PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<table class="table1">';
        echo '<th>Event ID</th><th>Date Occurred</th><th>Short Description</th><th>Within Reporting Boundaries?</th>';
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
            echo '<tr><td><a href="event-details.php?event_id=' . $row['event_id'] . '">'. $row['event_id'].'</a></td><td>' . $dateOccurred->format('M d, Y').'</td><td>' . $row['description_short'].'</td><td>' . $reportingBoundary;'</td></tr>';
        }
        echo '</table>';
    }

    ?>
    
    <br>
    </body>
</html>