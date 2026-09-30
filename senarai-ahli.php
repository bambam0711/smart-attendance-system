<?php
# Start session function
session_start();

# Include header.php, connection.php and kawalan-admin.php
include('header.php');
include('connection.php');
include('kawalan-admin.php');

?>
<!-- Header for member list table -->
<h3 align='center'>Member List</h3>

<table  align='center'width='100%'border='1'id='saiz'>
    <tr bgcolor='#00B8D2'>
        <td colspan='3'>
            <form action='' method='POST' style="margin:0; padding:0;">
                <input type='text'      name='name'   placeholder='Search Member Name'>
                <input type='submit'    value='Search'>
            </form>
        </td>
        <td colspan='3' align='right'>
            | <a href='upload.php'>Upload Members</a> |
            <?php include('butang-saiz.php'); ?>
        </td>
    </tr>
    <tr bgcolor='#00BED7'>
        <td witdh='35%'>Name</td>
        <td witdh='15%'>IC Number</td>
        <td witdh='10%'>Class</td>
        <td witdh='10%'>Password</td>
        <td witdh='10%'>Role</td>
        <td witdh='20%'>Action</td>
    </tr>

<?php

# Additional condition for member search query
$extra="";
if(!empty($_POST['name']))
{
    $extra= "and member.name like '%".$_POST['name']."%'";
}
# Query to search member list
$sql_display="select* from member, class
where member.class_id = class.class_id
$extra ";

# Execute member search query
$execute = mysqli_query($condb,$sql_display);

# Fetch found data
    while($m = mysqli_fetch_array($execute))
    {
        # Assign data to array for member update
        $data_get=array(
            'name'          => $m['name'],
            'ic_number'     => $m['ic_number'],
            'password'      => $m['password'],
            'role'          => $m['role'],
            'class_id'      => $m['class_id'],
            'form'          => $m['form'],
            'class_name'    => $m['class_name'],
        );

        # Display member list in table
        echo"<tr>
        <td>".$m['name']."</td>
        <td>".$m['ic_number']."</td>
        <td>".$m['form']." ".$m['class_name']."</td>
        <td>".$m['password']."</td>
        <td>".$m['role']."</td> ";

        # Display navigation links for update and delete
        echo"<td>
        |<a href='ahli-kemaskini-borang.php?".http_build_query($data_get)."'>
         Update</a>|

        |<a href='ahli-padam-proses.php?ic_number=".$m['ic_number']."'
        onClick=\"return confirm('Are you sure you want to delete this record?')\">
        Delete</a>|

        </td>
        </tr>";
    }

?>
</table>
<?php include ('footer.php'); ?>
