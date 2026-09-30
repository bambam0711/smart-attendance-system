<?php
# Start session function
session_start();

# Include header.php, connection.php and kawalan-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');

?>
<h3>Activity Attendance Report</h3>
<!-- Activity search form -->
<form action='' method='GET'>
    Activity <select name='activity_id'>
    <option selected disabled value>Please Select Activity</option>

    <?php
    # Display activity list in dropdown
    $sql_activities = "select* from activity";
    $execute_activities = mysqli_query($condb,$sql_activities);
    while($n = mysqli_fetch_array($execute_activities))
    {
        echo "<option value='".$n['activity_id']."'>
                ".$n['activity_id']." | ".$n['activity_name']."
                </option>";
    }
    ?>
    </select>
    <input type='submit' value='Search'>
</form>

<?php
$extra="";
if(!empty($_GET['activity_id']))
{
    # Get activity_id from URL
    $activity_id = $_GET['activity_id'];

    # Fetch activity details
    $sql_activity = "select* from activity where activity_id = '$activity_id'";
    $execute_activity = mysqli_query($condb,$sql_activity);
    $ma=mysqli_fetch_array($execute_activity);

    # Get attendance analysis (attended count & total members)
    $sql_analysis=" SELECT
    ( SELECT COUNT(*) FROM attendance
       where activity_id = '".$ma['activity_id']."' ) AS attended_count,
    ( SELECT COUNT(*) FROM member ) AS total_members ";
    $execute_analysis   =   mysqli_query($condb, $sql_analysis);
    $da                 =   mysqli_fetch_array($execute_analysis);
?>

<!-- Report header -->
<h3 >
    <?= $ma['activity_name'] ?><br>
    <?= $ma['activity_date'] ?> | <?= $ma['start_time'] ?><br>
    Attendance  : <?= $da['attended_count']." / ".$da['total_members'] ?> <br>
    Percentage  : <?php echo number_format(($da['attended_count']/$da['total_members']*100),2);
?> %
</h3>

<table align='center' width='100%' border='1' id='saiz'>
    <tr bgcolor='cyan'>
        <td colspan='3'>

<form action='kehadiran-laporan.php?activity_id=<?= $activity_id; ?>'
      method='POST' style="margin:0; padding:0;">

       <input type='text'      name='name'   placeholder='Search Member Name'>
       <input type='submit'    value='Search'>
</form>
       </td>
       <td colspan='3' align='right'>
           <?php include('butang-saiz.php'); ?>
        </td>
    </tr>
    <tr bgcolor='yellow'>
        <td>No.</td>
        <td>Name</td>
        <td>IC Number</td>
        <td>Class</td>
        <td>Attendance</td>
    </tr>

<?PHP

# Additional condition for member search
$extra="";
if(!empty($_POST['name']))
{
    $extra= " where member.name like '%".$_POST['name']."%'";
}

# Query to display attendance list
$sql_display="
SELECT *,  member.ic_number
 FROM member
 LEFT JOIN class
 ON member.class_id = class.class_id
 LEFT JOIN attendance
 ON member.ic_number = attendance.ic_number
 and activity_id = '$activity_id'
 $extra
 ORDER BY member.name ";

 # Execute the query
 $execute = mysqli_query($condb,$sql_display);
 $attended=$not_attended=$no=0;
 # Fetch found data
     while($m = mysqli_fetch_array($execute))
     {
        # Display each row in table
        echo"<tr>
        <td>".++$no."</td>
        <td>".$m['name']."</td>
        <td>".$m['ic_number']."</td>
        <td>".$m['form']." | ".$m['class_name']." </td>
        <td align='center'>";

        if(strlen($m['activity_id'])>=1) {
            echo "&#9989;";
        } else {
            echo "&#10060;";
        }

        echo"</td>


        </tr>";
    }
echo"</table>";
}
?>

<?php include ('footer.php'); ?>
