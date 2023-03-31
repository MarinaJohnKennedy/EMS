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
        $_SESSION['usertype']=$row['ut'];
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
    <title> My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vd.css">

</head>
    <body>
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home"></a>
    
    <a href="login.php"><input type="button" name="logout" value="Logout" class="home"></a>
<fieldset>
    <h1>My Account Details</h1>
<div class="data">
    
   
   
   Mobile Number: <?php echo $_SESSION['mobilenumber']?>
    <br>
    Email ID: <?php echo $_SESSION['emailid']?> 
    <br>
    DOB: <?php echo $_SESSION['dob']?> 
    <br>
    Address: <?php echo $_SESSION['addr']?> 
    <br>
    Role: <?php echo $_SESSION['role']?> 
    <br>
    Salary: <?php echo $_SESSION['sal']?> 
    <br>
    Designation: <?php echo $_SESSION['design']?> <br>
    
</div>
<br>
<a href="edit.php"><input type="button" name="update" value="Update " class="update"></a>
</fieldset>


    
    </body>
</html>