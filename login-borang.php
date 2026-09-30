<?php
# Start session function
session_start();

# Include header.php
include('header.php');
?>

<!-- Login page title -->
<h3>Member Login</h3>

<!-- Login form -->
<form action='login-proses.php' method='POST'>

    IC Number   <input type='text'      name='ic_number' placeholder='Please enter your IC number'><br>
    Password    <input type='password'  name='password' placeholder='Please enter your password'><br>
                <input type='submit'    value='Login'>
</form>
<?php include ('footer.php'); ?>
