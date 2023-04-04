<?php
require("db.php");
session_start();
$utype=$_SESSION['usertype'];
if(isset($_POST['home']))
{
                     if($utype=="Admin")
                    {
                    header("Location:ahome.php");
                   
                    }
                    else if($utype=="Employee")
                    {
                        header("Location:ehome.php");
                    }
                }
$idss=$_SESSION['ids'];
$msg='';
$query="select * from employees where id='$idss'";
$result=mysqli_query($conn, $query);

$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if($count==1)
    {
        $_SESSION['usertype']=$row['ut'];
        $_SESSION['firstname']=$row['fname'];
        $_SESSION['lastname']=$row['lname'];
        $_SESSION['gender']=$row['gender'];
        $_SESSION['emailid']=$row['emailid'];
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
    <title> My Account Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vd.css">

</head>
    <body>
        
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home"></a>
    <a href="changepassword.php"><input type="button" name="changepassword" value="Change Password" class="home"></a>
    <a href="login.php"><input type="button" name="logout" value="Logout" class="home"></a>
    
    <fieldset>
    <h1>My Account Details</h1>
<div class="data">
    First Name: <?php echo $_SESSION['firstname']?>
    <br>
    Last Name: <?php echo $_SESSION['lastname']?>
    <br>
   Mobile Number: <?php echo $_SESSION['mobilenumber']?>
    <br>
    Email ID: <?php echo $_SESSION['emailid']?> 
    <br>
    Gender: <?php echo $_SESSION['gender']?> 
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
<a href="aedit.php"><input type="button" name="update" value="Update Account Details" class="update"></a>
</fieldset>


    
    </body>
</html>