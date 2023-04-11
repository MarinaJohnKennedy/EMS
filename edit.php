<?php
require("db.php");
session_start();
$idss=$_SESSION['ids'];
$utype=$_SESSION['usertype'];
$email=$_SESSION['emailid'];
$msg='';

                
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

            $query="update employees set fname='$first',lname='$last',gender='$gender',mobilenumber='$mobile',emailid='$email',dob='$dob',addr='$addr' where id='$idss'";

            $result=mysqli_query($conn, $query);

            if($result)
            {
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
    <link rel="stylesheet" type="text/css" media="screen" href="login.css">

</head>
    <body>
    <a href="changepassword.php"><input type="button" name="home" value="Change Password" class="home1"></a>
 
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>
<fieldset class=fd>
    <br>
<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
    <h1>Update Account Details</h1>
    <div>
    <?php

$query="select fname,lname,gender,mobilenumber,emailid,dob,addr,role,sal,design from employees where id='$idss'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if($count==1)
{
echo "<form action=edit.php method=post>";


echo "First Name: <input type=text class=tb name=firstname value=".$row['fname']."><br>";
echo "Last Name: <input type=text class=tb name=lastname value='".$row['lname']."'><br>";
echo "Gender: <input type=text class=tb name=gender value=".$row['gender']."><br>";
echo "Mobile Number:<input type=text class=tb name=mobilenumber value=".$row['mobilenumber']."><br>";
echo "Email ID:<input type=text class=tb name=emailid value=".$row['emailid']."><br>";
echo "Date of Birth: <input type=date class=tb name=dob value=".$row['dob']."><br>";
echo "Address: <input type=text class=tb name=addr value='".$row['addr']."'><br>";

echo "<div class=data>Role:".$row['role']."<br>";
echo "Salary:".$row['sal']."<br>";
echo "Designation:".$row['design']."</div><br>";

echo "<input type=submit class=sub name=update value=Update>";

echo "</form>";
}?>
</div>
</fieldset>
</body>
</html>