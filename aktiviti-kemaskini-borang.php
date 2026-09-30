<?php
# Start session function
session_start();

# Include header, kawalan-admin.php and connection
include('header.php');
include('kawalan-admin.php');
include('connection.php');

# Check if GET data exists. If empty, redirect to activity list
if(!empty($_GET)) {
    die("<script>window.location.href='senarai-aktiviti.php';</script>");
}

# Fetch activity data from database
$sql_select         =   "select * from activity where activity_id
='".$_GET['activity_id']."' ";
$execute_select     =   mysqli_query($condb,$sql_select);
$m  =   mysqli_fetch_array($execute_select);

?>

<h3>Update Activity</h3>

<form action='aktiviti-kemaskini-proses.php?activity_id=<?= $m['activity_id'] ?>'
method='POST'>

Activity Name
<input  type='text' name='activity_name' value='<?= $m['activity_name'] ?>'
required><br>

Activity Date
<input  type='date' name='activity_date' min='<?= date("Y-m-d") ?>' value='<?=
$m['activity_date'] ?>' required><br>

Start Time
<input  type='text' name='start_time' value='<?= $m['start_time'] ?>' required><br>

<input type='submit' value='Update'>

</form>
<?php include ('footer.php'); ?>
