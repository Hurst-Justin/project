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
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a class="active" href="new.php">Create New Event</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>New Event Record</h2>
    <form method="post" action="new-record.php">
    <h3>Event Details:</h3>

    <b>Date Event Occurred: </b> <br/>
    <input required type="date" name="dateOccurred" style="width:200px"><br/>    

    <b>Date Event Reported: </b> <br/>
    <input required type="date" name="dateReported" style="width:200px"><br/>
    
    <b>Short Description: </b> <br/>
    ​<textarea required name="shortDescription" rows="1" cols="70"></textarea><br/>

    <b>Detailed Description: </b> <br/>
    <textarea required name="longDescription" rows="2" cols="70"></textarea><br/>


    <b>Actual Severity of Event: </b> <br/>
        <select required name="severityID_Act" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from severities');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $severity = $row['severity_label'];
                $severityID = $row['severity_id'];
                echo '<option value="'.$severityID.'">'.$severity.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Probable Severity of Event: </b> <br/>
        <select required name="severityID_Prob" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from severities');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $severity = $row['severity_label'];
                $severityID = $row['severity_id'];
                echo '<option value="'.$severityID.'">'.$severity.'</option>';
            }
        ?>
        </select>
        <br/>

    <b>Equipment Type: </b> <br/>
        <select required name="equipmentID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from equipments');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $equipment = $row['equipment_label'];
                $equipmentID = $row['equipment_id'];
                echo '<option value="'.$equipmentID.'">'.$equipment.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Within Reporting Boundary?: </b> <br/>
        <select required name="boundaryID" style="width:200px">
        <option value="1" selected>Yes</option>
        <option value="0">No</option>
        </select>
        <br/>


    
    <h3>Organization Details:</h3>
    
    <b>Site: </b> <br/>
        <select required name="siteID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from sites');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $site = $row['site_label'];
                $siteID = $row['site_id'];
                echo '<option value="'.$siteID.'">'.$site.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Department: </b> <br/>
        <select required name="departmentID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from departments');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $department = $row['department_label'];
                $departmentID = $row['department_id'];
                echo '<option value="'.$departmentID.'">'.$department.'</option>';
            }
        ?>
        </select>
        <br/>
    


    <h3>Weather/Lighting Details:</h3>
    
    <b>Temperature: </b> <br/>
    <input required type="number" name="temperature" style="width:200px"><br/>
    
    <b>Unit of Measure: </b> <br/>
        <select required name="tempUOMID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from temperature_uoms');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $temperature = $row['temperature_uom_label'];
                $temperatureID = $row['temperature_uom_id'];
                echo '<option value="'.$temperatureID.'">'.$temperature.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Weather Conditions: </b> <br/>
        <select required name="weatherID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from weathers');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $weather = $row['weather_label'];
                $weatherID = $row['weather_id'];
                echo '<option value="'.$weatherID.'">'.$weather.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Lighting Conditions: </b> <br/>
        <select required name="lightingID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from lightings');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $lighting = $row['lighting_label'];
                $lightingID = $row['lighting_id'];
                echo '<option value="'.$lightingID.'">'.$lighting.'</option>';
            }
        ?>
        </select>
        <br/>
    


    <h3>Operation/Activity Type Details:</h3>
    
    <b>Type of Operation At Time of Event: </b> <br/>
        <select required name="operationID" style="width:300px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from operation_types');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $operation = $row['operation_type_label'];
                $operationID = $row['operation_type_id'];
                echo '<option value="'.$operationID.'">'.$operation.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Type of Activity At Time of Event: </b> <br/>
        <select required name="activityID" style="width:300px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from activity_types');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $activity = $row['activity_type_label'];
                $activityID = $row['activity_type_id'];
                echo '<option value="'.$activityID.'">'.$activity.'</option>';
            }
        ?>
        </select>
        <br/>

    
    <h3>Responsibility Details:</h3>
    
        <!--Entered By Hidden, may enable login functionality, but defaulted to ID 1 for now-->
        <input type="hidden" name="enteredID" value="1">
    <b>Reported By: </b> <br/>
        <select required name="reportedID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from users');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $user = $row['user_name_last'].', '. $row['user_name_first'];
                $userID = $row['user_id'];
                echo '<option value="'.$userID.'">'.$user.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>QA/QC By: </b> <br/>
        <select required name="qaqcID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from users');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $user = $row['user_name_last'].', '. $row['user_name_first'];
                $userID = $row['user_id'];
                echo '<option value="'.$userID.'">'.$user.'</option>';
            }
        ?>
        </select>
        <br/>
        
    <h3>Injury Details:</h3>
    <input type="hidden" name="consequenceID" value="1">
    <b>Injury Description: </b> <br/>
        <textarea required name="injuryDescription" rows="2" cols="70"></textarea><br/>
        <br/>
    <b>Medical Classification: </b> <br/>
        <select required name="medClassID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from medical_classifications');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $item = $row['medical_classification_label'];
                $itemID = $row['medical_classification_id'];
                echo '<option value="'.$itemID.'">'.$item.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Work Related?: </b> <br/>
        <select required name="workRelated" style="width:200px">
        <option value="1" selected>Yes</option>
        <option value="0">No</option>
        </select>
        <br/>
    <b>Personnel Type: </b> <br/>
        <select required name="personnelTypeID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from personnel_types');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $item = $row['personnel_type_label'];
                $itemID = $row['personnel_type_id'];
                echo '<option value="'.$itemID.'">'.$item.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Nature of Injury: </b> <br/>
        <select required name="injuryNatureID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from injury_natures');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $item = $row['injury_nature_label'];
                $itemID = $row['injury_nature_id'];
                echo '<option value="'.$itemID.'">'.$item.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Primary Body Part Injured: </b> <br/>
        <select required name="injuryPrimaryBodyPartID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from injury_primary_body_parts');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $item = $row['injury_primary_body_part_label'];
                $itemID = $row['injury_primary_body_part_id'];
                echo '<option value="'.$itemID.'">'.$item.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Company Name of Injured Party: </b> <br/>
        <select required name="companyNameID" style="width:200px">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from company_names');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $item = $row['company_name_label'];
                $itemID = $row['company_name_id'];
                echo '<option value="'.$itemID.'">'.$item.'</option>';
            }
        ?>
        </select>
        <br/>
    <b>Number of Lost Days (Restricted Duty/DAFW Cases Only): </b> <br/>
    <input type="number" name="injuryLostDays" style="width:200px"><br/>
    <b>Date Lost Days Began: (Restricted Duty/DAFW Cases Only)</b> <br/>
    <input type="date" name="injuryLostDaysStartDate" style="width:200px"><br/>   
    
    

    <input type="submit" value="Submit New Event" class="button">
    </form>
    </body>
</html>