<?php
# Start SESSION function
session_start();

# Check if POST data exists
if(!empty($_POST))
{
    include ('connection.php');

    # SQL query to save new activity data
    $sql_insert = "insert into activity
    ( activity_name, activity_date, start_time)
    values
    ('".$_POST['activity_name']."', '".$_POST['activity_date']."',
    '".$_POST['start_time']."') ";

    # Execute SQL to save new activity
    $execute_insert = mysqli_query($condb,$sql_insert);

    # Check if save was successful
    if($execute_insert)
    {
        # Data saved. Show popup and redirect to activity list
        echo "<script>alert('Activity Registration Successful.');
        window.location.href='senarai-aktiviti.php'; </script>";
    }
    else
    {
        # Data save failed. Show popup and return to registration form
        echo "<script>alert('Registration Failed');
        window.location.href='aktiviti-daftar-borang.php'; </script>";
    }
}
else
{
    # User opened this file without submitting data.
    echo "<script>alert('Please complete all information');
    window.location.href='aktiviti-daftar-borang.php'; </script>";
}
?>
