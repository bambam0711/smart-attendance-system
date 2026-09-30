<?php
# Start session function
session_start();

# Include header.php and connection.php
include('header.php');
include('connection.php');

# Check if session 'ic_number' exists
if(empty($_SESSION['ic_number'])){

    # If session ic_number is empty, stop execution
    die("<script>alert('Please login');
        window.location.href='logout.php';</script>");
}
?>

<table width='100%' bgcolor='#afeeee' border='1'>
    <tr>
        <td width='70%'  align='center' valign='top' >
            <h3 >Attendance Record</h3>

            <!-- Table header for activity list -->
            <table align='center' width='100%' border='1' id='saiz' bgcolor='white'>
                <caption>
                    Self-confirmation can only be done on the date the activity takes place
                </caption>
                <tr align='center' bgcolor='00BED7' >
                    <td>Activity Name</td>
                    <td>Date | Time</td>
                    <td>Attendance</td>
                </tr>
                <?php

                # Query to fetch activity list
                $sql_select_activities="select* from activity";

                # Execute query
                $execute_activities = mysqli_query($condb,$sql_select_activities);

                # Fetch found data
                    while($m = mysqli_fetch_array($execute_activities)){
                        # Display each activity row
                        echo"<tr >
                        <td>".$m['activity_name']."</td>
                        <td>".$m['activity_date']." | ".$m['start_time']." </td>
                        <td align='center'>";

# Query to get member's attendance for each activity
$sql_attendance = "select * from attendance where
ic_number ='".$_SESSION['ic_number']."' and activity_id ='".$m['activity_id']."' ";

# Execute the attendance query
$execute_attendance=mysqli_query($condb, $sql_attendance);

if(mysqli_num_rows($execute_attendance)==1) {
    echo "&#9989;";
} else {
    echo "&#10060; <br>";

    if(date("Y-m-d") == $m['activity_date']){
    # Self attendance confirmation link
    echo "<a href='profil-sahkendiri.php?activity_id=".$m['activity_id']."'>
    [ SELF CONFIRMATION ] </a>";
    }
}
echo"</td></tr>";
} ?>
</table>

        </td>
        <td align='center' valign='top'>
            <h3>SCAN CODE TO CONFIRM ATTENDANCE</h3>
            <p>
               Name : <?= $_SESSION['name'] ?><br>
               IC Number : <?= $_SESSION['ic_number'] ?><br>
            </p>
            <?PHP

            # Get data to generate QR code
            $data = $_SESSION['ic_number'];
            $size = "200x200";

            # Set QR code API URL
            $qr_api = "https://api.qrserver.com/v1/create-qr-code/?size=$size&data=$data";
            echo "<div align='center'><img width='50%' src='".$qr_api."'></div>";
            ?>
            <br>
        </td>
    </tr>
</table>
<?php include ('footer.php'); ?>
