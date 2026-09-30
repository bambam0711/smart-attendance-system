<?php
# Include connection.php
include('connection.php');

# Delete old attendance records so new ones can be inserted
$delete_old = mysqli_query($condb,"delete from attendance where
activity_id='".$_GET['activity_id']."'");

$time=date("H:i:s");
foreach ($_POST['attendance'] as $ic_number)
{
    # Save new attendance records
    $save_data=mysqli_query($condb,"insert into attendance
    (ic_number, activity_id, attendance_time) values
    ('$ic_number','".$_GET['activity_id']."','$time') ");
}

echo "<script>alert('Attendance Update Complete');
window.location.href='kehadiran-borang.php?activity_id=".$_GET['activity_id']."';
</script>";

?>
