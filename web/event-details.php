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
    <h2>Full Event Information</h2>
    <a href="search.php" class="button">Back</a>
    <h3>Event Details:</h3>
<?php
    $sql = "select * from events WHERE event_id=:event_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row)
    {
        $dateOccurred = new DateTime($row['date_occurred']);
        $dateReported = new DateTime($row['date_reported']);
        $dateEntered = new DateTime($row['date_entered']); 
        $eventID = $row['event_id'];
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
        echo '<b>Event ID:</b>  '. $row['event_id'].'<br>';
        echo '<b>Date Event Occurred:</b>  ' . $dateOccurred->format('M d, Y').'<br>';
        echo '<b>Date Event Reported:</b>  ' . $dateReported->format('M d, Y').'<br>';
        echo '<b>Date Event Entered:</b>  ' . $dateEntered->format('M d, Y').'<br>';
        echo '<b>Short Description:</b>  ' . $row['description_short'].'<br>';
        echo '<b>Detailed Description:</b>  ' . $row['description_long'].'<br>';

        //actual severity
        $sql = "select severity_label from severities join events on severities.severity_id = events.severity_actual_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $actualSeverities = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($actualSeverities as $actualSeverity)
        {
            echo '<b>Actual Severity:</b>  ' . $actualSeverity['severity_label'] .'<br>';
        }
        //probable severity
        $sql = "select severity_label from severities join events on severities.severity_id = events.severity_probable_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $probableSeverities = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($probableSeverities as $probableSeverity)
        {
            echo '<b>Probable Severity:</b>  ' . $probableSeverity['severity_label'] .'<br>';
        }
        //Equipment Type
        $sql = "select equipment_label from equipments join events on equipments.equipment_id = events.equipment_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $equipment_labels = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($equipment_labels as $equipment_label)
        {
            echo '<b>Equipment Type:</b>  ' . $equipment_label['equipment_label'] .'<br>';
        }
        //Reporting Boundary
        echo '<b>Within Reporting Boundary?:</b>  ' . $reportingBoundary . '<br>';
        echo '<br>';
        //Organizational Details
        echo '<h3>Organization Details:</h3>'; 
        //site
        $sql = "select site_label from sites join events on sites.site_id = events.site_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $sites = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($sites as $site)
        {
            echo '<b>Site:</b>  ' . $site['site_label'] .'<br>';
        }
        //department
        $sql = "select department_label from departments join events on departments.department_id = events.department_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($departments as $department)
        {
            echo '<b>Department:</b>  ' . $department['department_label'] .'<br>';
        }
        echo '<br>';
        //Weather/Lighting Details
        echo '<h3>Weather/Lighting Details:</h3>'; 
        //Temperature
        echo '<b>Temperature:</b>  ' . $row['temperature'].'<br>';
        //Temperature UOM
        $sql = "select temperature_uom_label from temperature_uoms join events on temperature_uoms.temperature_uom_id = events.temperature_uom_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $temperatureUOMs = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($temperatureUOMs as $temperatureUOM)
        {
            echo '<b>Temperature Unit of Measure:</b>  ' . $temperatureUOM['temperature_uom_label'] .'<br>';
        }
        //weather
        $sql = "select weather_label from weathers join events on weathers.weather_id = events.weather_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $weathers = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($weathers as $weather)
        {
            echo '<b>Weather Conditions:</b>  ' . $weather['weather_label'] .'<br>';
        }
        //lighting
        $sql = "select lighting_label from lightings join events on lightings.lighting_id = events.lighting_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $lightings = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($lightings as $lighting)
        {
            echo '<b>Lighting:</b>  ' . $lighting['lighting_label'] .'<br>';
        }
        echo '<br>';
        //Operation/Activity Type Details
        echo '<h3>Operation/Activity Type Details:</h3>'; 
        //Operation Type
        $sql = "select operation_type_label from operation_types join events on operation_types.operation_type_id = events.operation_type_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $operationtypes = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($operationtypes as $operationtype)
        {
            echo '<b>Type of Operation At Time of Event:</b>  ' . $operationtype['operation_type_label'] .'<br>';
        }
        //Activity Type
        $sql = "select activity_type_label from activity_types join events on activity_types.activity_type_id = events.activity_type_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $activityTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($activityTypes as $activityType)
        {
            echo '<b>Type of Activity At Time of Event:</b>  ' . $activityType['activity_type_label'] .'<br>';
        }
        echo '<br>';
        //Responsibility Details
        echo '<h3>Responsibility Details:</h3>'; 
        //Entered By
        $sql = "select user_name, user_name_first, user_name_last from users join events on users.user_id = events.entered_by_id  WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $enteredBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($enteredBys as $enteredBy)
        {
            echo '<b>Entered By:</b>  ' . $enteredBy['user_name_first'] . ' ' . $enteredBy['user_name_last'] . ' (' . $enteredBy['user_name'] .')<br>';
        }
        //Reported By
        $sql = "select user_name, user_name_first, user_name_last from users join events on users.user_id = events.reported_by_id  WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $reportedBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($reportedBys as $reportedBy)
        {
            echo '<b>Reported By:</b>  ' . $reportedBy['user_name_first'] . ' ' . $reportedBy['user_name_last'] . ' (' . $reportedBy['user_name'] .')<br>';
        }
        //QA QC'd By
        $sql = "select user_name, user_name_first, user_name_last from users join events on users.user_id = events.qa_qc_by_id  WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $qa_qcBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($qa_qcBys as $qa_qcBy)
        {
            echo '<b>QA/QC By:</b>  ' . $qa_qcBy['user_name_first'] . ' ' . $qa_qcBy['user_name_last'] . ' (' . $qa_qcBy['user_name'] .')<br>';
        }
              
        echo '<br>';
        //Injury Details
        echo '<h3>Injury Details:</h3>';
        //Injuries
        $sql = "select * from injuries join events on injuries.event_id = events.event_id WHERE events.event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $injuries = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($injuries as $injury)
        {
            $injuryID = $injury['injury_id'];
            $workRelated = $injury['work_related'];
            if ($workRelated == 1)
            {
                $workRelated = "Yes";
            }
            else
            {
                $workRelated = "No";
            }
            //echo '<b>Injury ID:</b>  ' . $injury['injury_id'] .'<br>';
            echo '<b>Injury Description:</b>  ' . $injury['injury_description'] .'<br>';
            
            //Medical Classifications
            $sql = "select medical_classification_label from medical_classifications join injuries on medical_classifications.medical_classification_id = injuries.medical_classification_id WHERE injuries.injury_id=". $injury['injury_id'];
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $medical_classifications = $stmt->fetchAll(PDO::FETCH_ASSOC);    
            foreach ($medical_classifications as $medical_classification)
            {
                echo '<b>Medical Classification:</b>  ' . $medical_classification['medical_classification_label'] .'<br>';
            }
            //Work Related
            echo '<b>Work Related?:</b>  ' . $workRelated . '<br>';  
            //Personnel Type
            $sql = "select personnel_type_label from personnel_types join injuries on personnel_types.personnel_type_id = injuries.injured_ill_personnel_type_id   WHERE injuries.injury_id=". $injury['injury_id'];
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $personnel_types = $stmt->fetchAll(PDO::FETCH_ASSOC);    
            foreach ($personnel_types as $personnel_type)
            {
                echo '<b>Injured/Ill Personnel Type:</b>  ' . $personnel_type['personnel_type_label'] .'<br>';
            }
            //Nature of Injury
            $sql = "select injury_nature_label from injury_natures join injuries on injury_natures.injury_nature_id = injuries.injury_nature_id WHERE injuries.injury_id=". $injury['injury_id'];
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $injury_natures = $stmt->fetchAll(PDO::FETCH_ASSOC);    
            foreach ($injury_natures as $injury_nature)
            {
                echo '<b>Nature of Injury:</b>  ' . $injury_nature['injury_nature_label'] .'<br>';
            }
            //Primary Body Part
            $sql = "select injury_primary_body_part_label from injury_primary_body_parts join injuries on injury_primary_body_parts.injury_primary_body_part_id = injuries.injury_primary_body_part_id WHERE injuries.injury_id=". $injury['injury_id'];
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $injury_primary_body_parts = $stmt->fetchAll(PDO::FETCH_ASSOC);    
            foreach ($injury_primary_body_parts as $injury_primary_body_part)
            {
                echo '<b>Primary Body Part Injured:</b>  ' . $injury_primary_body_part['injury_primary_body_part_label'] .'<br>';
            }
            //Company Name
            $sql = "select company_name_label from company_names join injuries on company_names.company_name_id = injuries.company_name_id WHERE injuries.injury_id=". $injury['injury_id'];
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $company_names = $stmt->fetchAll(PDO::FETCH_ASSOC);    
            foreach ($company_names as $company_name)
            {
                echo '<b>Company Name:</b>  ' . $company_name['company_name_label'] .'<br>';
            }
            echo '<br>';
            //Lost Days
            $dateLostStart = new DateTime($injury['injury_lost_days_start_date']);
            echo '<b>Lost Days:</b>  ' . $injury['injury_lost_days'] .'<br>';
            echo '<b>Lost Days Start Date:</b>  ' . $injury['injury_lost_days_start_date'] .'<br>';
        }
        echo '</p>';
    }

?>
<form method="post" action="edit-record.php">
    <input type="hidden" name="EventID" value=<?php echo $eventID; ?>>
    <input type="submit" value="Edit Record" class="button">
</form>
<form method="post" action="delete-record.php" width="100px">
    <input type="hidden" name="EventID" value=<?php echo $eventID; ?>>
    <input type="hidden" name="InjuryID" value=<?php echo $injuryID; ?>>
    <input type="submit" value="Delete Record" class="button">
</form>
 </body>
</html>