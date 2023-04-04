<?php
require("db.php");
session_start();
$msg="";
$idss="";
$ffirst= "";
$flast= "";
$fgender= "";
$fmobno= "";
$femail= "";
$fpass= "";
$fdob= "";
$faddr= "";
$frole= "";
$fsal= "";
$fdesign= "";
if(isset($_POST['search']))
{
    $idss=$_POST['id'];
$query="select fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design,ut from employees where id='$idss'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if($count==1)
{
    if($row['ut']=='Employee')
    {
   $ffirst= $row['fname'];
   $flast= $row['lname'];
   $fgender= $row['gender'];
   $fmobno= $row['mobilenumber'];
   $femail= $row['emailid'];
   $fpass= $row['password'];
   $fdob= $row['dob'];
   $faddr= $row['addr'];
   $frole= $row['role'];
   $fsal= $row['sal'];
   $fdesign= $row['design'];
    }
    else
    {
        $msg="ID provided is not a Employee";
        $ffirst= "";
        $flast= "";
        $fgender= "";
        $fmobno= "";
        $femail= "";
        $fpass= "";
        $fdob= "";
        $faddr= "";
        $frole= "";
        $fsal= "";
        $fdesign= "";
    }

}
else
{
    $msg="ID provided does not exist";
}
}





if(isset($_POST['delete']))
{
    $idss=$_POST['id'];
    if(filter_has_var(INPUT_POST,'delete'))
    {
       
            $query="delete from employees where id='$idss'";

            $result=mysqli_query($conn, $query);

            if($result)
            {
            $msg="Deleted Employee Successfully ";
            $idss="";
            }
            else
            {
            $msg="Not Deleted";
            }

    
    }
}



?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> My Account Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="editemp.css">

</head>
    <body >
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home1"></a>
    <a href="login.php"><input type="button" name="logout" value="Logout" class="home1"></a>
<fieldset >

    
    <h1>Delete Employee</h1>
    <?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    <div>
    <br>
<form action=delemp.php method=post>

Employee ID<input type="text" placeholder="" name="id" class="tb" value="<?php echo "$idss"; ?>"> 
<input type="submit" class="update" name="search" value="Search"><br>
First Name: <input type="text" class="tb" name="firstname" value="<?php echo "$ffirst"; ?>"><br>
Last Name: <input type="text" class="tb" name="lastname" value="<?php echo $flast; ?>"><br>
Gender: <input type="text" class="tb" name="gender" value="<?php echo $fgender; ?>"><br>
Mobile Number:<input type="text" class="tb" name="mobilenumber" value="<?php echo $fmobno; ?>"><br>
Email ID:<input type="text" class="tb" name="emailid" value="<?php echo $femail; ?>"><br>
Password:<input type="text" class="tb" name="password" value="<?php echo $fpass; ?>"><br>
Date of Birth: <input type="date" class=tb name="dob" value="<?php echo $fdob; ?>"><br>
Address: <input type="text" class="tb" name="addr" value="<?php echo $faddr; ?>"><br>
Role:<input type="text" name=role class="tb" value="<?php echo $frole; ?>"><br>
Salary:<input type="text" name=sal class="tb" value="<?php echo $fsal; ?>"><br>
Designation:<input type="text" name="design" class="tb" value="<?php echo $fdesign;?>"><br><br>
<input type="submit" class="update" name="delete" value="Delete">

</form>
  
</div>
</fieldset>
</body>
</html>