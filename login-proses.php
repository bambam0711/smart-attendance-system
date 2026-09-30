<?php
# Start session function
session_start();

# Check if POST data from login-borang.php exists
if(!empty($_POST['ic_number']) and !empty($_POST['password']))
{
    # Include connection.php
    include('connection.php');

    # Get POST data from form
    $ic_number  = $_POST['ic_number'];
    $password   = $_POST['password'];

    # SQL query to verify login credentials against database
    $query_login = "select * from member
    where
            ic_number   = '$ic_number'
    and     password    = '$password' LIMIT 1";

    # Execute the login query
    $execute_query = mysqli_query($condb,$query_login);

    # If one matching record found, login is successful
    if(mysqli_num_rows($execute_query)==1)
    {
        # Retrieve matched data
        $m  =   mysqli_fetch_array($execute_query);

        # Assign to session variables
        $_SESSION['ic_number']  =   $m['ic_number'];
        $_SESSION['role']       =   $m['role'];
        $_SESSION['name']       =   $m['name'];
        # Redirect to index.php
        echo "<script>window.location.href='index.php';</script>";
    }
    else
    {
        # Login failed. Return to login-borang.php
        die("<script>alert ('Login Failed');
        window.location.href='index.php';</script>");
    }
}
else
{
    # POST data from login-borang.php is empty
    die("<script>alert ('Please enter your IC number and password');
    window.location.href='index.php';</script>");
}
