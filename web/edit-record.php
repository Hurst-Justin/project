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
    <h2>Record Edit</h2>

    <?php
        $EventID = $_POST['EventID'];
        //echo $EventID.'<br>';
        $sql = "SELECT * FROM events WHERE event_id=". $EventID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($rows as $row)
        {  
        $temperature = $row['temperature'];
        echo '<form method="post" action="edit-record-confirmation.php">';
        echo '<h3>Event Details:</h3>';
        echo '<b>Event ID: </b> <br/>'.$row['event_id'].'<br>';
        echo '<input type="hidden" name="EventID" value='.$row['event_id'].'>';
        echo '<b>Date Event Occurred: </b> <br/><input required type="date" name="dateOccurred" style="width:200px" value='.$row['date_occurred'].'><br>';
        echo '<b>Date Event Reported: </b> <br/><input required type="date" name="dateReported" style="width:200px" value='.$row['date_reported'].'><br>';
        echo '<b>Short Description: </b> <br/><textarea required name="shortDescription" rows="1" cols="70">'.$row['description_short'].'</textarea><br>';
        echo '<b>Detailed Description: </b> <br/><textarea required name="longDescription" rows="2" cols="70">'.$row['description_long'].'</textarea><br>';

        echo '<b>Actual Severity of Event: </b> <br/>';
        echo '<SELECT required name="severityID_Act" style="width:200px">';                    
                    $stmt = $db->prepare('SELECT * FROM severities WHERE severity_id='.$row['severity_actual_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['severity_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM severities');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['severity_label'];
                        $itemID = $subrow['severity_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Probable Severity of Event: </b> <br/>';
        echo '<SELECT required name="severityID_Prob" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM severities WHERE severity_id='.$row['severity_probable_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['severity_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM severities');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['severity_label'];
                        $itemID = $subrow['severity_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Equipment Type: </b> <br/>';
        echo '<SELECT required name="equipmentID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM equipments WHERE equipment_id='.$row['equipment_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['equipment_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM equipments');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['equipment_label'];
                        $itemID = $subrow['equipment_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Within Reporting Boundary?: </b> <br/>';
        echo '<SELECT required name="boundaryID" style="width:200px">';
                $stmt = $db->prepare('SELECT * FROM events WHERE event_id='.$row['event_id']);
                $stmt->execute();
                $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subrows as $subrow)
                {
                    $result = $subrow['reporting_boundary'];                        
                }
                $stmt = $db->prepare('SELECT distinct reporting_boundary FROM events');
                $stmt->execute();
                $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subrows as $subrow)
                {                        
                    $item = $subrow['reporting_boundary'];
                    if ($item == 1)
                    {
                        $item = "Yes";
                    }
                    else
                    {
                        $item = "No";
        }
                    $itemID = $subrow['reporting_boundary'];
                    if ($itemID !=1){$itemID=0;}
                    if ($itemID == $result)
                    {
                        echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                    }
                    else
                    {
                        echo '<option value="'.$itemID.'">'.$item.'</option>';
                    }
                } 

        echo '</SELECT>';
        echo '<br>';

    echo '<h3>Organization Details:</h3>';
        echo '<b>Site: </b> <br/>';
        echo '<SELECT required name="siteID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM sites WHERE site_id='.$row['site_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['site_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM sites');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['site_label'];
                        $itemID = $subrow['site_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Department: </b> <br/>';
        echo '<SELECT required name="departmentID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM departments WHERE department_id='.$row['department_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['department_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM departments');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['department_label'];
                        $itemID = $subrow['department_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';
       

    echo '<h3>Weather/Lighting Details:</h3>';
        echo '<b>Temperature: </b> <br/><input required type="number" name="temperature" style="width:200px" value='.$temperature.'><br>';

        echo '<b>Unit of Measure: </b> <br/>';
        echo '<SELECT required name="tempUOMID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM temperature_uoms WHERE temperature_uom_id='.$row['temperature_uom_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['temperature_uom_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM temperature_uoms');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['temperature_uom_label'];
                        $itemID = $subrow['temperature_uom_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Weather Conditions: </b> <br/>';
        echo '<SELECT required name="weatherID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM weathers WHERE weather_id='.$row['weather_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['weather_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM weathers');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['weather_label'];
                        $itemID = $subrow['weather_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Lighting Conditions: </b> <br/>';
        echo '<SELECT required name="lightingID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM lightings WHERE lighting_id='.$row['lighting_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['lighting_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM lightings');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['lighting_label'];
                        $itemID = $subrow['lighting_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

    echo '<h3>Operation/Activity Type Details:</h3>';
        echo '<b>Type of Operation At Time of Event: </b> <br/>';
        echo '<SELECT required name="operationID" style="width:300px">';
                    $stmt = $db->prepare('SELECT * FROM operation_types WHERE operation_type_id='.$row['operation_type_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['operation_type_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM operation_types');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['operation_type_label'];
                        $itemID = $subrow['operation_type_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        
        echo '<b>Type of Activity At Time of Event: </b> <br/>';
        echo '<SELECT required name="activityID" style="width:300px">';
                    $stmt = $db->prepare('SELECT * FROM activity_types WHERE activity_type_id='.$row['activity_type_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['activity_type_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM activity_types');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['activity_type_label'];
                        $itemID = $subrow['activity_type_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';
        
    echo '<h3>Responsibility Details:</h3>';
        echo '<b>Reported By: </b> <br/>';
        echo '<SELECT required name="reportedID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM users WHERE user_id='.$row['reported_by_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['user_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM users');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['user_name_last'].', '. $subrow['user_name_first'];
                        $itemID = $subrow['user_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>QA/QC By: </b> <br/>';
        echo '<SELECT required name="qaqcID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM users WHERE user_id='.$row['qa_qc_by_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['user_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM users');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['user_name_last'].', '. $subrow['user_name_first'];
                        $itemID = $subrow['user_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

    echo '<h3>Injury Details:</h3>';
                    
        $sql = "select * from injuries join events on injuries.event_id = events.event_id WHERE events.event_id=".$EventID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $injuries = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($injuries as $injury)
        {
        $injuryID = $injury['injury_id'];
        echo '<b>Injury ID: </b> <br/>'.$injury['injury_id'].'<br>';
        echo '<input type="hidden" name="injuryID" value='.$injury['injury_id'].'>';
        echo '<b>Injury Description: </b> <br/><textarea required name="injuryDescription" rows="2" cols="70">'.$injury['injury_description'].'</textarea><br>';  
        
        echo '<b>Medical Classification: </b> <br/>';
        echo '<SELECT required name="medClassID" style="width:200px">';
                    $sql = "SELECT * from medical_classifications join injuries on medical_classifications.medical_classification_id = injuries.medical_classification_id WHERE injuries.injury_id=". $injuryID;
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['medical_classification_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM medical_classifications');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['medical_classification_label'];
                        $itemID = $subrow['medical_classification_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Work Related?: </b> <br/>';
        echo '<SELECT required name="workRelated" style="width:200px">';
                $stmt = $db->prepare("SELECT * FROM injuries WHERE injury_id=".$injuryID);
                $stmt->execute();
                $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subrows as $subrow)
                {
                    $result = $subrow['work_related'];                        
                }
                $stmt = $db->prepare('SELECT distinct work_related FROM injuries');
                $stmt->execute();
                $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subrows as $subrow)
                {                        
                    $item = $subrow['work_related'];
                    if ($item == 1)
                    {
                        $item = "Yes";
                    }
                    else
                    {
                        $item = "No";
                    }   
                    $itemID = $subrow['work_related'];
                    if ($itemID !=1){$itemID=0;}
                    if ($itemID == $result)
                    {
                        echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                    }
                    else
                    {
                        echo '<option value="'.$itemID.'">'.$item.'</option>';
                    }
                } 
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Personnel Type: </b> <br/>';
        echo '<SELECT required name="personnelTypeID" style="width:200px">';
                    $sql = "SELECT * from personnel_types join injuries on personnel_types.personnel_type_id = injuries.injured_ill_personnel_type_id   WHERE injuries.injury_id=". $injuryID;
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['personnel_type_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM personnel_types');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['personnel_type_label'];
                        $itemID = $subrow['personnel_type_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Nature of Injury: </b> <br/>';
        echo '<SELECT required name="injuryNatureID" style="width:200px">';
                    $sql = "SELECT * from injury_natures join injuries on injury_natures.injury_nature_id = injuries.injury_nature_id WHERE injuries.injury_id=". $injuryID;
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['injury_nature_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM injury_natures');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['injury_nature_label'];
                        $itemID = $subrow['injury_nature_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Primary Body Part Injured: </b> <br/>';
        echo '<SELECT required name="injuryPrimaryBodyPartID" style="width:200px">';
                    $sql = "SELECT * from injury_primary_body_parts join injuries on injury_primary_body_parts.injury_primary_body_part_id = injuries.injury_primary_body_part_id WHERE injuries.injury_id=". $injuryID;
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['injury_primary_body_part_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM injury_primary_body_parts');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['injury_primary_body_part_label'];
                        $itemID = $subrow['injury_primary_body_part_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Company Name of Injured Party: </b> <br/>';
        echo '<SELECT required name="companyNameID" style="width:200px">';
                    $sql = "SELECT * from company_names join injuries on company_names.company_name_id = injuries.company_name_id WHERE injuries.injury_id=". $injuryID;
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['company_name_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM company_names');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['company_name_label'];
                        $itemID = $subrow['company_name_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Number of Lost Days (Restricted Duty/DAFW Cases Only): </b> <br/><input type="number" name="injuryLostDays" style="width:200px" value='.$injury['injury_lost_days'].'><br>';
        echo '<b>Lost Days Start Date: </b> <br/><input type="date" name="injuryLostDaysStartDate" style="width:200px" value='.$injury['injury_lost_days_start_date'].'><br>';
        }
        echo '<input type="submit" value="Submit Edits" class="button">';
        echo '</form>';
        }

    ?>


</body>
</html>