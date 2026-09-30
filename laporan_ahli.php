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

<h3>Member Report</h3>

<!-- Member search form -->
<table align='center' width='100%' border='1'>
    <tr bgcolor='#00B8D2'>
        <td class='no-print'>
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text' name='name' placeholder='Search Member Name'
                       value='<?= !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : "" ?>'>
                &nbsp;<input type='submit' value='Search'>
            </form>
        </td>
        <td align='right' class='no-print'>
            <a href='javascript:window.print()' style='background-color:#008394;'>&#128424; Print Report</a>
        </td>
    </tr>
    <tr bgcolor='yellow'>
        <td><strong>No.</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>IC Number</strong></td>
        <td><strong>Class</strong></td>
        <td><strong>Role</strong></td>
    </tr>

<?php

# Additional condition for member search query
$extra = "";
if (!empty($_POST['name'])) {
    $name_search = mysqli_real_escape_string($condb, $_POST['name']);
    $extra = "AND member.name LIKE '%$name_search%'";
}

# Query to get member list with class info
$sql_display = "
    SELECT member.name, member.ic_number, member.role,
           class.form, class.class_name
    FROM member
    LEFT JOIN class ON member.class_id = class.class_id
    WHERE 1=1 $extra
    ORDER BY class.form, class.class_name, member.name
";

# Execute query
$execute = mysqli_query($condb, $sql_display);

$no           = 0;
$total_members = 0;

# Fetch found data
while ($m = mysqli_fetch_array($execute)) {
    $no++;
    $total_members++;

    echo "<tr>
        <td>" . $no . "</td>
        <td>" . htmlspecialchars($m['name']) . "</td>
        <td>" . $m['ic_number'] . "</td>
        <td>" . $m['form'] . " | " . htmlspecialchars($m['class_name']) . "</td>
        <td>" . htmlspecialchars($m['role']) . "</td>
    </tr>";
}
?>

    <!-- Summary row -->
    <tr bgcolor='#FFFDE7'>
        <td colspan='5' align='right'>
            <strong>Total Members: <?= $total_members ?></strong>
        </td>
    </tr>

</table>

<?php include('footer.php'); ?>
