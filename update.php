
<?php
require("db.php");
session_start();

$utype=$_SESSION['usertype'];

$msg='';
$idss="";

if(isset($_GET['id']))
    {
        $idss=mysqli_real_escape_string($conn,$_GET['id']);
        $query="select id,fname,lname,gender,mobilenumber,emailid,dob,addr,role,sal,design from employees where id='".$_GET['id']."'";
        $result=mysqli_query($conn, $query);
        $emps=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
    }
if(isset($_POST['update']))
{
   
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $gender=$_POST['gender'];
    $mobile=$_POST['mobilenumber'];
    $email=$_POST['emailid'];
    $dob=$_POST['dob'];
    $addr=$_POST['addr'];

    if(filter_has_var(INPUT_POST,'update'))
    {
        if(!empty($first) && !empty($last) && !empty($mobile))
    {
        
        if(!preg_match("/^[a-zA-Z ]*$/",$first))
        {
            $msg= "First Name is NOT valid";
        }
    
        else if(!preg_match("/^[a-zA-Z ]*$/",$last))
        {
            $msg= "Last Name is NOT valid";
        }
    
        else if(filter_var($mobile,FILTER_VALIDATE_INT) === false && !preg_match("/^\d{10}$/",$mobile) && strlen($mobile)>10 || strlen($mobile)<10 )
        {
            $msg= "Mobile Number is NOT valid";
        }
        else if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false)
            {
                $msg="Please use a valid E-mail ID";
            }
        
        else{
            try{
            
            $query="update employees set fname='$first',lname='$last',gender='$gender',mobilenumber='$mobile',emailid='$email',dob='$dob',addr='$addr' where id='".$_GET['id']."'";

            $result=mysqli_query($conn, $query);

            if($result)
            {
            header("Location:edetails.php?id=".$_GET['id']);
            $msg="Updated account details";
            
            }
            else
            {
            $msg="Not updated";
            }

        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }}}}

    



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



?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Update Account Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vd.css">

</head>
    <body>
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home2"></a>
    <a href="viewemp.php"><input type="button" name="home" value="Employees List" class="home2"></a>
    <a href="edetails.php?id=<?php echo $_GET['id']?>"><input type="button" name="home" value="Employee Details" class="home2"></a>
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home2"></a>
<fieldset>
    <br>
<?php  if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
    <h1>Update Account Details</h1>
    <div>
        <?php 
  foreach($emps as $emp):
if($emp):
  
   ?>
    <form  method=post >
  <?php
  echo "First Name: <input type=text class=tb name='firstname' value=".$emp['fname']."><br>";
  echo "Last Name: <input type=text class=tb name='lastname' value='".$emp['lname']."'><br>";
  echo "Gender: <input type=text class=tb name='gender' value=".$emp['gender']."><br>";
  echo "Mobile Number: <input type=text class=tb name='mobilenumber' value=".$emp['mobilenumber']."><br>";
  echo "Email ID: <input type=text class=tb name='emailid' value=".$emp['emailid']."><br>";
  echo "Date of Birth: <input type=date class=tb name='dob' value=".$emp['dob']."><br>";
  echo "Address: <input type=text class=tb name='addr' value='".$emp['addr']."'><br><br>";
?>
<a href="edetails.php?id=<?php echo $emp['id']?>"><input type=submit class=update name=update value=Update></a>
    &nbsp&nbsp

<?php

endif;
endforeach;
echo "</form>";
?>
</div>
</fieldset>
</body>
</html>