<?php
# Start SESSION function
session_start();

# Check if POST data exists
if(!empty($_POST))
{
    # Include connection.php
    include ('connection.php');

    # Get data sent from signup-borang.php
    $name       = $_POST['name'];
    $ic_number  = $_POST['ic_number'];
    $class_id   = $_POST['class_id'];
    $role       = $_POST['role'];
    $password   = $_POST['password'];

    # Data validation: IC number must be exactly 12 digits and numeric only
    if(strlen($ic_number) != 12 or !is_numeric($ic_number))
    {
        die ("<script>alert ('Error: Invalid IC Number');
        window.location.href='signup-borang.php'; </script>");
    }

    # Check if IC number already exists in the database
    $sql_check          =   "select* from member where ic_number='$ic_number' limit 1";
    $execute_check      =   mysqli_query($condb,$sql_check);
    if(mysqli_num_rows($execute_check)==1)
    {
        # If IC number already exists, stop execution
        die ("<script>alert ('Error: IC Number already in use');
        window.location.href='signup-borang.php'; </script>");
    }

    # SQL query to save new member data
    $sql_insert = "insert into member
    (ic_number, name, class_id, role, password)
    values
    ('$ic_number', '$name', '$class_id', '$role', '$password') ";

    # Execute SQL to save new member data
    $execute_insert = mysqli_query($condb,$sql_insert);

    # Check if save was successful
    if($execute_insert)
    {
        # Data saved successfully. Show popup and open login page
        echo"<script>alert('Registration Successful. Please Login');
        window.location.href='login-borang.php'; </script>";
    }
    else
    {
       # Data save failed. Show popup and return to signup page
       echo"<script>alert('Registration Failed');
       window.location.href='signup-borang.php'; </script>";
    }
}
else
{
    # User opened this file without submitting data.
    # Show popup and return to signup-borang.php
    echo"<script>alert('Please complete all information');
    window.location.href='signup-borang.php'; </script>";
}
?>
