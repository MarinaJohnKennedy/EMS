<?php
require("db.php");

$msg='';
if(isset($_POST['submit']))
{
    $first=$_POST['first'];
    $last=$_POST['last'];
    $gender=$_POST['gender'];
    $mobilenumber=$_POST['mobilenumber'];
    $emailid=$_POST['emailid'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $dob=$_POST['dob'];
    $addr=$_POST['addr'];
    $role=$_POST['role'];
    $sal=$_POST['sal'];
    $design=$_POST['design'];
if(filter_has_var(INPUT_POST,'submit'))
{
    
    if(!empty($first) && !empty($last) && !empty($gender) && !empty($mobilenumber) && !empty($emailid) && !empty($pass)&& !empty($cpass) && !empty($dob) && !empty($addr) &&  !empty($role) && !empty($sal) && !empty($design))
    { 
        if(!preg_match("/^[a-zA-Z ]*$/",$first))
        {
            $msg= "First Name is NOT valid";
        }
    
        else if(!preg_match("/^[a-zA-Z ]*$/",$last))
        {
            $msg= "Last Name is NOT valid";
        }
    
        else if(filter_var($mobilenumber,FILTER_VALIDATE_INT) === false && !preg_match("/^\d{10}$/",$mobilenumber) && strlen($mobilenumber)>10 || strlen($mobilenumber)<10 )
        {
            $msg= "Mobile Number is NOT valid";
        }
         else if(filter_var($emailid, FILTER_VALIDATE_EMAIL)=== false)
        {
            $msg="Please use a valid E-mail ID";
        }
        else if($pass != $cpass)
        {
            $msg="Passwords don't match";
        }
        else 
        {
            try{
            $query="insert into employees(fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design,ut) values('$first','$last','$gender','$mobilenumber','$emailid','$pass','$dob','$addr','$role','$sal','$design','Employee')";
    
            if(mysqli_query($conn, $query))
            {
                $msg=" Employee created successfully";
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
    } 
    
    
}
else
            {
                $msg="Please fill in all the fields";

            }
}}
?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="addemp.css">

</head>
<body>
<a href="ahome.php"><input type="button" name="home" value="Home" class="home1"></a>
    
    <a href="login.php"><input type="button" name="logout" value="Logout" class="home1"></a>


    

 <fieldset>
    <h1>Create Employee</h1>
    
    
    <?php if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
<div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div>

<div class="split left">
First Name:<input type="text" placeholder="" name="first" class="tb">
<br>
Last Name:<input type="text" placeholder="" name="last" class="tb">
<br>
Gender:<input type="text" placeholder="" name="gender" class="tb">
<br>
Mobile Number:<input type="text" placeholder="" name="mobilenumber" class="tb">
<br>
Email ID:<input type="text" placeholder="" name="emailid" class="tb">
<br>
Password:<input type="password" placeholder="" name="pass" class="tb">
<br>
    </div>
<div class="split right">
Confirm Password:<input type="password" placeholder="" name="cpass" class="tb">
<br>
Date of Birth: <input type="date" class="tb" name="dob" class="tb">
<br>
Address:<input type="text" placeholder="" name="addr" class="tb">
<br>
Role:<input type="text" placeholder="" name="role" class="tb">
<br>
Salary:<input type="text" placeholder="" name="sal" class="tb">
<br>
Designation:<input type="text" placeholder="" name="design" class="tb">
<br>
    </div>
<input type="submit" class="sub" name="submit" value="Submit">

</fieldset>
   

</form>
</div>
</div>
</body>
</html>