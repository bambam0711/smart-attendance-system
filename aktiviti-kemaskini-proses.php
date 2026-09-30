<?php
# Start session function
session_start();

# Include kawalan-admin.php
include('kawalan-admin.php');

# Check if POST data exists
if(!empty($_POST))
{
    # Include connection.php
    include('connection.php');

    # SQL query to update activity information
    $sql_update         =   "update activity set
    activity_name       =   '".$_POST['activity_name']."',
    activity_date       =   '".$_POST['activity_date']."',
    start_time          =   '".$_POST['start_time']."'
    where
    activity_id         =   '".$_GET['activity_id']."' ";

    # Execute and check update process
    if(mysqli_query($condb,$sql_update))
    {
        # Update successful
        echo "<script>alert('Update Successful');
        window.location.href='senarai-aktiviti.php';</script>";
    }
    else
    {
        # Update failed
        echo "<script>alert('Update Failed');
        window.history.back();</script>";
    }
}
else
{
    # If GET data does not exist, return to activity list
    die("<script>alert ('Please Complete All Data');
    window.location.href='senarai-aktiviti.php';</script>");
}
?>
