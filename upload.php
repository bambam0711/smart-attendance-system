<?php
# Start session function
session_start();

# Include header and kawalan-admin
include('header.php');
include('kawalan-admin.php');
?>

<!-- Page title -->
<h3>Upload Member Data (*.txt)</h3>

<!-- Form to upload file -->
<form action='' method='POST' enctype='multipart/form-data'>

   <h3><b>Please Select the txt file you want to upload</b></h3>
   <input       type='file'     name='member_data'>
   <button      type='submit'   name='btn-upload'>Upload</button>

</form>
<?php include ('footer.php'); ?>

<!-- Section for processing uploaded data -->
<?PHP
# Data validation: check if form data exists
if (isset($_POST['btn-upload']))
{
    # Include connection file
    include ('connection.php');

    # Get temporary file name
    $temp_file_name=$_FILES["member_data"]["tmp_name"];

    # Get original file name
    $file_name=$_FILES['member_data']['name'];

    # Get file extension
    $file_type=pathinfo($file_name,PATHINFO_EXTENSION);

# Validate file type and size
    if($_FILES["member_data"]["size"]>0 AND $file_type=="txt")
    {
        # Open the uploaded file
        $data_file=fopen($temp_file_name,"r");

        # Read file line by line
        while  (!feof($data_file))
        {
            # Get one line at a time
            $line_data = fgets($data_file);

            # Split line by pipe character
            $split_line = explode("|",$line_data);

            # Assign split values to variables
            list($ic_number,$name,$class_id,$password,$role) = $split_line;

            # SQL to save data
            $sql_insert="insert into member
            (ic_number, name, class_id, password, role) values
            ('$ic_number','$name','$class_id','$password','$role')";

            # Insert data into member table
            $execute_insert=mysqli_query($condb, $sql_insert);
            echo"<script>alert('Data File Import Complete');
            window.location.href='senarai-ahli.php';
            </script>";
        }
    # Close the opened txt file
    fclose($data_file);
    }
    else
    {
        # If uploaded file is empty or wrong format
        echo "<script>alert('Only txt format files are allowed');</script>";
    }
}
?>
