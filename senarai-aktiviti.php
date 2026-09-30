<?php
# Start session function
session_start();

# Include header.php, connection.php and kawalan-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');

?>
<h3 align='center'>Activity List</h3>

<!-- Table header for activity list -->
<table  align='center' width='100%' border='1' id='saiz'>
    <tr bgcolor='#00B8D2'>
        <td >
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text'      name='activity_name'   placeholder='Search Activity'>
                <input type='submit'    value='Search'>
            </form>
        </td>
        <td colspan='2' align='right'>
            | <a href='aktiviti-daftar-borang.php'>Register New Activity / Meeting</a> |
            <?php include('butang-saiz.php'); ?>
        </td>
    </tr>
    <tr bgcolor='#00BED7' align='center'>
        <td>Activity Name</td>
        <td>Date | Time</td>
        <td>Action</td>
    </tr>

<?php

# Additional condition for activity search query
$extra="";
if(!empty($_POST['activity_name']))
{
    $extra= "where activity_name like '%".$_POST['activity_name']."%'";
}
# Query to search activity list
$sql_display="select* from activity $extra ";

# Execute query
$execute = mysqli_query($condb,$sql_display);

# Fetch found data
    while($m = mysqli_fetch_array($execute))
    {
        # Display activity list in table
        echo"<tr>
        <td>".$m['activity_name']."</td>
        <td>".$m['activity_date']." | ".$m['start_time']." </td> ";

        # Display navigation links for update, delete and attendance
        echo"<td align='right'>
        | <a href='aktiviti-kemaskini-borang.php?activity_id=".$m['activity_id']."'>
        Update</a>

        | <a href='aktiviti-padam-proses.php?activity_id=".$m['activity_id']."'
        onClick=\"return confirm('Are you sure you want to delete this record?')\">
        Delete</a>

        | <a href='kehadiran-borang.php?activity_id=".$m['activity_id']."'>
        Attendance Confirmation</a> |

        </td>
        </tr>";
    }

?>
</table>
<?php include ('footer.php'); ?>
