<?php
# Start session function
session_start();

# Include kawalan-admin.php
include('kawalan-admin.php');

# Check if GET ic_number exists
if(!empty($_GET))
{
    # Include connection.php
    include('connection.php');

    # SQL query to delete member by ic_number
    $sql_delete     =   "delete from member where ic_number='".$_GET['ic_number']."'";

    # Execute delete and check result
    if(mysqli_query($condb,$sql_delete))
    {
        # Data deleted successfully
        echo "<script>alert('Record Deleted Successfully');
        window.location.href='senarai-ahli.php';</script>";
    }
    else
    {
        # Data delete failed
        echo "<script>alert('Delete Record Failed');
        window.location.href='senarai-ahli.php';</script>";
    }
}
else
{
    # If GET data does not exist
    die("<script>alert ('Error! Direct access not allowed');
    window.location.href='senarai-ahli.php';</script>");
}
?>
