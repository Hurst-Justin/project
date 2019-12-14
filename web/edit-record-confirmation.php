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
    <h2>Record Updated Successfully</h2>
    
<?php
$EventID = $_POST['EventID'];
$dateOccurred = $_POST['dateOccurred'];
$dateReported = $_POST['dateReported'];
$shortDescription = $_POST['shortDescription'];
$shortDescription = htmlspecialchars($shortDescription);
$longDescription = $_POST['longDescription'];
$longDescription = htmlspecialchars($longDescription);
$siteID = $_POST['siteID'];
$departmentID = $_POST['departmentID'];
$severityID_Act = $_POST['severityID_Act'];
$severityID_Prob = $_POST['severityID_Prob'];
$temperature = $_POST['temperature'];
$tempUOMID = $_POST['tempUOMID'];
$weatherID = $_POST['weatherID'];
$lightingID = $_POST['lightingID'];
$operationID = $_POST['operationID'];
$activityID = $_POST['activityID'];
$enteredID = $_POST['enteredID'];
$reportedID = $_POST['reportedID'];
$qaqcID = $_POST['qaqcID'];
$equipmentID = $_POST['equipmentID'];
$boundaryID = $_POST['boundaryID'];
$consequenceID = $_POST['consequenceID'];


$sql = "UPDATE public.events SET 
        date_occurred='".$dateOccurred."',
        date_reported='".$dateReported."',
        description_short='".$shortDescription."',
        description_long='".$longDescription."',
        severity_actual_id=".$severityID_Act.",
        severity_probable_id=".$severityID_Prob.",
        reporting_boundary='".$boundaryID."',
        site_id=".$siteID.",
        department_id=".$departmentID.",
        temperature=".$temperature.",
        temperature_uom_id=".$tempUOMID.",
        weather_id=".$weatherID.",
        lighting_id=".$lightingID.",
        operation_type_id=".$operationID.",
        activity_type_id=".$activityID.",
        reported_by_id=".$reportedID.",
        qa_qc_by_id=".$qaqcID.",
        equipment_id=".$equipmentID.
        " WHERE event_id=". $EventID;
$stmt = $db->prepare($sql);
$stmt->execute();

$injuryID = $_POST['injuryID'];
$injuryDescription = $_POST['injuryDescription'];
$injuryDescription = htmlspecialchars($injuryDescription);
$medClassID = $_POST['medClassID'];
$workRelated = $_POST['workRelated'];
$personnelTypeID = $_POST['personnelTypeID'];
$injuryNatureID = $_POST['injuryNatureID'];
$injuryPrimaryBodyPartID = $_POST['injuryPrimaryBodyPartID'];
$companyNameID = $_POST['companyNameID'];
$injuryLostDays = $_POST['injuryLostDays'];
$injuryLostDaysStartDate = $_POST['injuryLostDaysStartDate'];
if ($injuryLostDays == null){$injuryLostDays=0;}
if ($injuryLostDaysStartDate == null){$injuryLostDaysStartDate="1/1/1900";}

// echo 'injuryID:  '.$injuryID.'<br/>';
// echo 'EventID:  '.$EventID.'<br/>';
// echo 'injuryDescription:  '.$injuryDescription.'<br/>';
// echo 'medClassID:  '.$medClassID.'<br/>';
// echo 'workRelated:  '.$workRelated.'<br/>';
// echo 'personnelTypeID:  '.$personnelTypeID.'<br/>';
// echo 'injuryNatureID:  '.$injuryNatureID.'<br/>';
// echo 'injuryPrimaryBodyPartID:  '.$injuryPrimaryBodyPartID.'<br/>';
// echo 'companyNameID:  '.$companyNameID.'<br/>';
// echo 'injuryLostDays:  '.$injuryLostDays.'<br/>';
// echo 'injuryLostDaysStartDate:  '.$injuryLostDaysStartDate.'<br/>';


$injsql = "UPDATE public.injuries SET 
            injury_description='".$injuryDescription."',
            medical_classification_id=".$medClassID.",
            work_related='".$workRelated."',
            injured_ill_personnel_type_id=".$personnelTypeID.",
            injury_nature_id=".$injuryNatureID.",
            injury_primary_body_part_id=".$injuryPrimaryBodyPartID.",
            injury_lost_days=".$injuryLostDays.",
            injury_lost_days_start_date='".$injuryLostDaysStartDate."',
            company_name_id=".$companyNameID.
            " WHERE injury_id=". $injuryID;
    $injstmt = $db->prepare($injsql);
    $injstmt->execute();

    echo 'Event ID: '.$EventID.' edited successfully';


?>

</body>
</html>