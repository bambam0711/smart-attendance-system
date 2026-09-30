<?php
# Start session function
session_start();

# Include external files and declare variables
include('header.php');
include('kawalan-admin.php');
include('connection.php');
$time=date("H:i:s");
$status=""; # Used to display attendance status
$color="";  # Used for status background color

# Check if POST ic_number exists
if(!empty($_POST['ic_number'])){
    # Check if the entered IC number exists in the database
    $sql_check          =   "select* from member where ic_number = '".$_POST['ic_number']."' ";
    $execute_check      =   mysqli_query($condb,$sql_check);
    if(mysqli_num_rows($execute_check)!=1)
    {
        # IC number not found in system
        $status ="The IC number entered/scanned is not in the system";
        $color="red";
    } else {
        # Check if the IC number has already recorded attendance
        $sql_check_att      =   "select* from attendance where ic_number='".$_POST['ic_number']."'
                                and activity_id ='".$_GET['activity_id']."' limit 1";

        $execute_check_att  =   mysqli_query($condb,$sql_check_att);
        if(mysqli_num_rows($execute_check_att)==1)
        {
            $status ="You have already confirmed your attendance previously.";
            $color="red";

        } else {
            # Save attendance record
            $save_data=mysqli_query($condb,"insert into attendance
            (ic_number, activity_id, attendance_time) values
            ('".$_POST['ic_number']."','".$_GET['activity_id']."','$time') ");

            # Check if save was successful
            if($save_data)
            {
                $status ="Attendance Confirmed";
                $color="green";
            }
            else
            {
                $status="Attendance Failed to Record";
                $color="red";
            }
        }
    }
}
# Check if GET activity_id exists
if(!empty($_GET['activity_id']))
{
# Fetch activity data
$sql_activity = "select* from activity where activity_id = '".$_GET['activity_id']."'";
$execute_activity = mysqli_query($condb,$sql_activity);
$ma=mysqli_fetch_array($execute_activity);
}
?>

<h1 align='center'>Attendance Counter Page</h1>
<h3 align='center'>
<!-- Activity search form -->
<form action='' method='GET'>
    Activity <select name='activity_id'>
    <option selected disabled value>Please Select Activity</option>

    <?php
      # Display list of activities in dropdown
      $sql_activities         =   "select* from activity";
      $execute_activities     =   mysqli_query($condb,$sql_activities);
      while($n=mysqli_fetch_array($execute_activities))
      {
        echo "<option value='".$n['activity_id']."'>
                ".$n['activity_id']." | ".$n['activity_name']."
                </option>";
      }
    ?>
    </select>

    <input type='submit' value='Search'>
</form>

<?php if(!empty($_GET['activity_id'])) { ?>
<!-- Activity info header -->
    <?= $ma['activity_name'] ?><br>
    <?= $ma['activity_date'] ?> | <?= $ma['start_time'] ?><br>
</h3>

<form align='center' action='' method='POST'>

       <label>Enter / Scan your IC Number / CODE here</label><br>
       <input type='text' name='ic_number' autofocus autocomplete="off" required
       onblur="this.focus()" ><br>

       <input type='submit' value='Record Attendance'>
</form>

<table width='50%' border='1' align='center'>
    <caption style="background-color :<?= $color ?>"><h3><?= $status; ?></h3></caption>
    <tr bgcolor='#00BED7'>
        <td>#</td>
        <td>Name</td>
        <td>IC Number</td>
        <td>Class</td>
        <td>Attendance Time</td>
    </tr>

<?php
    $no=0;

    # Display attendance records in table
    $sql_display = "select* from member, activity, attendance, class
    where
        member.ic_number            =   attendance.ic_number
    and member.class_id             =   class.class_id
    and activity.activity_id        =   attendance.activity_id
    and attendance.activity_id      =   '".$_GET['activity_id']."'
    order by attendance.attendance_time DESC";

    $execute_display = mysqli_query($condb,$sql_display);

    while($m  =   mysqli_fetch_array($execute_display))
    {
        echo " <tr>
                   <td>".++$no."</td>
                   <td>".$m['name']."</td>
                   <td>".$m['ic_number']."</td>
                   <td>".$m['form']." ".$m['class_name']."</td>
                   <td>".$m['attendance_time']."</td>
               </tr>" ;
    }
?>
</table>
<?php } ?>
<?PHP include('footer.php'); ?>
