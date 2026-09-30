<?php
# Start session function
session_start();

# Include header.php, connection.php and kawalan-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');

?>

<style>
    @media print {
        nav, .no-print { display: none !important; }
        body { background-color: white !important; }
        header { background-color: white !important; color: black !important; }
    }
</style>

<h3>Activity Report</h3>

<!-- Activity search form -->
<table align='center' width='100%' border='1'>
    <tr bgcolor='#00B8D2'>
        <td class='no-print'>
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text' name='activity_name' placeholder='Search Activity Name'
                       value='<?= !empty($_POST['activity_name']) ? htmlspecialchars($_POST['activity_name']) : "" ?>'>
                &nbsp;<input type='submit' value='Search'>
            </form>
        </td>
        <td align='right' class='no-print'>
            <a href='javascript:window.print()' style='background-color:#008394;'>&#128424; Print Report</a>
        </td>
    </tr>
    <tr bgcolor='yellow'>
        <td><strong>No.</strong></td>
        <td><strong>Activity Name</strong></td>
        <td><strong>Date</strong></td>
        <td><strong>Time</strong></td>
        <td><strong>Total Attendance</strong></td>
        <td><strong>Total Members</strong></td>
        <td><strong>Attendance Rate</strong></td>
    </tr>

<?php

# Additional condition for activity search query
$extra = "";
if (!empty($_POST['activity_name'])) {
    $act_search = mysqli_real_escape_string($condb, $_POST['activity_name']);
    $extra = "WHERE activity.activity_name LIKE '%$act_search%'";
}

# Get total members count (used for percentage calculation)
$sql_total_members   = "SELECT COUNT(*) AS total FROM member";
$exe_total_members   = mysqli_query($condb, $sql_total_members);
$row_total_members   = mysqli_fetch_array($exe_total_members);
$total_members       = $row_total_members['total'];

# Query activities with attendance count per activity
$sql_display = "
    SELECT activity.activity_id, activity.activity_name,
           activity.activity_date, activity.start_time,
           COUNT(attendance.ic_number) AS attended_count
    FROM activity
    LEFT JOIN attendance ON activity.activity_id = attendance.activity_id
    $extra
    GROUP BY activity.activity_id, activity.activity_name,
             activity.activity_date, activity.start_time
    ORDER BY activity.activity_date DESC
";

# Execute query
$execute = mysqli_query($condb, $sql_display);

$no              = 0;
$total_activities = 0;

# Fetch found data
while ($m = mysqli_fetch_array($execute)) {
    $no++;
    $total_activities++;

    $attended  = $m['attended_count'];
    $rate      = ($total_members > 0) ? number_format(($attended / $total_members * 100), 2) : '0.00';

    echo "<tr>
        <td>" . $no . "</td>
        <td>" . htmlspecialchars($m['activity_name']) . "</td>
        <td>" . $m['activity_date'] . "</td>
        <td>" . $m['start_time'] . "</td>
        <td align='center'>" . $attended . "</td>
        <td align='center'>" . $total_members . "</td>
        <td align='center'>" . $rate . " %</td>
    </tr>";
}
?>

    <!-- Summary row -->
    <tr bgcolor='#FFFDE7'>
        <td colspan='7' align='right'>
            <strong>Total Activities: <?= $total_activities ?> &nbsp;|&nbsp; Total Registered Members: <?= $total_members ?></strong>
        </td>
    </tr>

</table>

<?php include('footer.php'); ?>
