<?php
# Start session function
session_start();

# Include header, kawalan-admin.php and connection
include('header.php');
include('kawalan-admin.php');
include('connection.php');

# Check if GET data exists. If empty, redirect to member list
if(empty($_GET)) {
    die("<script>window.location.href='senarai-ahli.php';</script>");
}
?>

<h3>Update Member</h3>
<form action='ahli-kemaskini-proses.php?ic_number_old=<?= $_GET['ic_number'] ?>' method='POST'>
Name
<input  type='text' name='name' value='<?= $_GET['name'] ?>' required><br>

IC Number
<input  type='text' name='ic_number' value='<?= $_GET['ic_number'] ?>' required><br>

Password
<input  type='text' name='password' value='<?= $_GET['password'] ?>' required><br>

Role
<select name='role'><br>
<option value='<?= $_GET['role'] ?>'> <?= $_GET['role'] ?> </option>
<?php
    # Display role dropdown list
    $sql_roles          =   "select role from member group by role order by role";
    $execute_roles      =   mysqli_query($condb,$sql_roles);
    while($n=mysqli_fetch_array($execute_roles))
    {
        if($n['role'] != $_GET['role']){
            echo "<option value='".$n['role']."'>
                ".$n['role']."
                </option>";
        }
    }
?>
</select> <br>

Class
<select name='class_id'><br>
<option value='<?= $_GET['class_id'] ?>'>
<?= $_GET['form']." ".$_GET['class_name'] ?>
</option>
<?php
    # Display class dropdown list
    $sql_classes        =   "select* from class";
    $execute_classes    =   mysqli_query($condb,$sql_classes);
    while($m=mysqli_fetch_array($execute_classes))
    {
        if($m['class_id'] != $_GET['class_id']){
            echo "<option value='".$m['class_id']."'>
                ".$m['form']." ".$m['class_name']."
                </option>";
        }
    }
?>
</select> <br>

<input type='submit' value='Update'>

</form>
<?php include ('footer.php'); ?>
