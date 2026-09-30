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

    # Validate IC number
    if(strlen($_POST['ic_number']) != 12 or !is_numeric($_POST['ic_number']))
    {
        die("<script>alert('Error: Invalid IC Number');
        window.history.back();</script>");
    }

    # SQL query to update member information
    $sql_update         =   "update member set
    name                =   '".$_POST['name']."',
    ic_number           =   '".$_POST['ic_number']."',
    password            =   '".$_POST['password']."',
    class_id            =   '".$_POST['class_id']."',
    role                =   '".$_POST['role']."'
    where
    ic_number           =   '".$_GET['ic_number_old']."' ";

    # Execute and check update process
    if(mysqli_query($condb,$sql_update))
    {
        # Update successful
        echo "<script>alert('Update Successful');
        window.location.href='senarai-ahli.php';</script>";
    }
    else
    {
        # Update failed
        echo"<script>alert('Update Failed');
        window.history.back();</script>";
    }
}
else
{
    # If GET data does not exist, return to member list
    die("<script>alert ('Please complete all data');
    window.location.href='senarai-ahli.php';</script>");
}
?>
