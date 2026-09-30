<?php
# Start session function
session_start();

# Include kawalan-admin.php
include('kawalan-admin.php');

# Check if GET activity_id exists
if(!empty($_GET))
{
    # Include connection.php
    include('connection.php');

    # SQL query to delete activity by activity_id
    $sql_delete     =   "delete from activity where
                    activity_id     =       '".$_GET['activity_id']."'";

    # Execute delete and check result
    if(mysqli_query($condb,$sql_delete))
    {
        # Data deleted successfully
        echo "<script>alert('Record Deleted Successfully');
        window.location.href='senarai-aktiviti.php';</script>";
    }
    else
    {
        # Data delete failed
        echo "<script>alert('Delete Record Failed');
        window.location.href='senarai-aktiviti.php';</script>";
    }
}
else
{
    # If GET data does not exist
    die("<script>alert ('Error! Direct access not allowed');
    window.location.href='senarai-aktiviti.php';</script>");
}
?>
