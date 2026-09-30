<?php
# Start session function
session_start();

# Include header.php and kawalan-admin.php
include('header.php');
include('kawalan-admin.php');
?>

<h3>Register New Activity</h3>
<!-- Form to receive data from user -->
<form action='aktiviti-daftar-proses.php' method='POST'>

Activity Name
<input  type='text' name='activity_name' required><br>

Activity Date
<input  type='date' name='activity_date' min='<?= date("Y-m-d") ?>' required><br>

Start Time
<input  type='text' name='start_time' required><br>

<input  type='submit' value='Register'>

</form>
<?php include ('footer.php'); ?>
