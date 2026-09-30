<?php
# Start session function
session_start();

# Include header.php, connection.php and kawalan-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');

# Fetch activity data from database
$sql_activity           =   "select * from activity where activity_id
='".$_GET['activity_id']."' ";
$execute_activity       =   mysqli_query($condb,$sql_activity);
$n  =   mysqli_fetch_array($execute_activity);

?>

<h3>Member Attendance Confirmation</h3>

Activity Name : <?= $n['activity_name'] ?> <br>
Date | Time : <?= $n['activity_date']." | ".$n['start_time'] ?><br>
<br><br>

<?php include('butang-saiz.php'); ?>
<form action='kehadiran-proses.php?activity_id=<?= $_GET['activity_id'] ?>'
method='POST'>
<table border='1' id='saiz' width='100%'>
    <tr>
        <td>No.</td>
        <td>Name</td>
        <td>IC Number</td>
        <td>Class</td>
        <td>Attendance</td>
    </tr>

<?php

# Query to get attendance data for each member
$sql_attendance = "SELECT
member.ic_number, member.name,
class.form, class.class_name,
attendance.activity_id
FROM member
LEFT JOIN class
ON member.class_id      =      class.class_id
LEFT JOIN attendance
ON member.ic_number     =      attendance.ic_number
AND attendance.activity_id='".$_GET['activity_id']."'
ORDER BY member.name";

# Execute query
$execute_attendance     =      mysqli_query($condb,$sql_attendance);
$no=0;

# Fetch and display all attendance data
while($m=mysqli_fetch_array($execute_attendance)){  ?>
    <tr>
        <td><?= ++$no; ?></td>
        <td><?= $m['name'] ?></td>
        <td><?= $m['ic_number'] ?></td>
        <td><?= $m['form']." ".$m['class_name'] ?> </td>
        <td><?php

        if($m['activity_id'] != null)
        {
            $check='checked';
        } else
        $check="";
        ?>

        <input <?= $check ?> type='checkbox' name='attendance[]'
        value='<?= $m['ic_number'] ?> ' style='width:30px; height:30px;'>
        </td>
    </tr>
    <?PHP
}
?>
<tr>
    <td colspan='4'></td>
    <td><input type='submit' value='Save'></td>
</tr>
</table>
</form>
<?php include ('footer.php'); ?>
