<?php
# Check the value of session variable 'role'
if(!empty($_SESSION['role'])){
    if($_SESSION['role'] != "Admin")
    {
        # If value is not Admin, stop execution
        die("script>alert('Please login');
        window.location.href='logout.php';</script>");
    }
}else{
    # If session value is empty
    die("<script>alert('Please login');
    window.location.href='logout.php';</script>");
}
?>
