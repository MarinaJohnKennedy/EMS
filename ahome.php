<?php
require("db.php");
session_start();
$email=$_SESSION['emailid'];
$pass=$_SESSION['password'];
$msg='';
$query="select * from employees where emailid='$email' and password='$pass'";
$result=mysqli_query($conn, $query);

$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if($count==1)
    {
       
        $_SESSION['firstname']=$row['fname'];
        $_SESSION['lastname']=$row['lname'];
        $_SESSION['mobilenumber']=$row['mobilenumber'];
        $_SESSION['dob']=$row['dob'];
        $_SESSION['addr']=$row['addr'];
        $_SESSION['role']=$row['role'];
        $_SESSION['sal']=$row['sal'];
        $_SESSION['design']=$row['design'];
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="ahome.css">

</head>
    <body>

    <div class="salutation" >Hi <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']?>
    <a href="login.php"><input type="button" name="logout" value="Logout" class="home"></a>
  </div>
<fieldset>
<h1>
<ul>
  <li><a href="viewdetails.php">My Account</a></li><br>
  <li><a href="addemp.php">Create Employee</a></li><br>
  <li><a href="editemp.php">Edit Employee</a></li><br>
  <li><a href="delemp.php">Delete Employee</a></li><br>
  <li><a href="import.php">Import New Employees</a></li><br>
  <li><a href="export.php">Export Existing Employees</a></li><br>
  <li><a href="exportbio.php">Export Biodata</a></li>
</ul>
</h1>
</fieldset>
</body>
</html>
