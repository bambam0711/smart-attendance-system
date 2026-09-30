<?php
session_start();
# Include connection file
include('connection.php');

$time=date("H:i:s");

# Check if GET activity_id and session ic_number exist
if(!empty($_GET['activity_id']) and !empty($_SESSION['ic_number']))
{
    # SQL to save attendance data
    $sql = "insert into attendance (activity_id, ic_number, attendance_time)
    values ('".$_GET['activity_id']."', '".$_SESSION['ic_number']."','$time')";

    # Execute save command
    $save_data=mysqli_query($condb,$sql);

    # Check if save was successful
    if($save_data){
        echo "<script>
            alert('Attendance Confirmed');
            window.location.href='profil.php';
        </script>";
    }
    else {
        echo "<script>
            alert('Attendance Confirmation Failed. Please Visit the Secretary Desk');
            window.location.href='profil.php';
        </script>";
    }
}
else
{
    echo "<script>
        alert('Direct access not allowed')
        window.location.href='logout.php';
    </script>";
}
?>
