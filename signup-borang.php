<?php
# Start SESSION function
session_start();

# Include header.php & connection.php
include('header.php');
include('connection.php');
?>

<!-- Page title -->
<h3> New Member Registration </h3>

<!-- New Member Registration Form -->
<form action = 'signup-proses.php' method = 'POST'>

  Member Name     <input type ='text'      name ='name' placeholder='Please enter your name'         required> <br>
  IC Number       <input type ='text'      name ='ic_number' placeholder='Please enter your IC number' required> <br>
  Class           <select name='class_id'><br>
                  <option selected disabled value>Please Select Class</option>
                  <?php
                  # Display list of classes in dropdown
                  $sql_select_class       =   "select* from class";
                  $execute_select_class   =   mysqli_query($condb,$sql_select_class);
                  while($m=mysqli_fetch_array($execute_select_class))
                  {
                     echo "<option value='".$m['class_id']."'>
                     ".$m['form']." ".$m['class_name']."
                     </option>";
                   }
                   ?>
                    </select> <br>
  Role            <select name='role' required><br>
                  <option selected disabled value>Please Select Role</option>
                  <option value='Admin'>Admin</option>
                  <option value='Student'>Student</option>
                  </select> <br>
  Password        <input type ='password'   name ='password' placeholder='Please enter your password' required> <br>
                  <input type ='submit'     value='Register'>
</form>
<?php include ('footer.php');?>
