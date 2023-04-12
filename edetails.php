<?php
require("db.php");
session_start();
$msg='';
$idss="";


if(isset($_GET['id']))
    {
        $idss=mysqli_real_escape_string($conn,$_GET['id']);
        $query="select id,fname,lname,gender,mobilenumber,emailid,dob,addr,role,sal,design from employees where id='$idss'";
        $result=mysqli_query($conn, $query);
        $emps=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        
        
            
    }               
    if(isset($_POST['delete']))
                {
                    

                    if(filter_has_var(INPUT_POST,'delete'))
                    {
                       
                            $query="delete from employees where id='".$_GET['id']."'";
                
                            $result=mysqli_query($conn, $query);
                
                            if($result)
                            {
                            
                            header("Location:viewemp.php");
                            $msg="Deleted Employee Successfully ";
                            }
                            else
                            {
                            $msg="Not Deleted";
                            }
                
                    
                    }
                } 
            if(isset($_GET['home']))
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
   
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home1"></a>
    <a href="viewemp.php"><input type="button" name="home" value="Employees List" class="home1"></a>
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>
<fieldset>
    <br>
<?php  if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
    <h1>Employee Account Details</h1>
    <div class=data>
    <?php  
    
   foreach($emps as $emp): ?>
    <?php if($emp):?>

    <form method=post >
    <?php $ndob=date("d-m-Y",strtotime($emp['dob']));?>
    Employee ID: <?php echo $emp['id']?><br>
    First Name: <?php echo $emp['fname']?><br>
    Last Name: <?php echo $emp['lname']?><br>
    Gender: <?php echo $emp['gender']?><br>
    Mobile Number:<?php echo $emp['mobilenumber']?><br>
    Email ID: <?php echo $emp['emailid']?><br>
    Date of Birth: <?php echo $ndob?><br>
    Address: <?php echo $emp['addr']?><br>
    Role: <?php echo $emp['role']?><br>
    Salary: <?php echo $emp['sal']?><br>
    Designation: <?php echo $emp['design']?><br><br>

<a href="update.php?id=<?php echo $emp['id']?>"><input type=button name=update value='Update Employee Details' class=update></a>&nbsp&nbsp
<input type=submit name=delete value='Delete Employee' class=update>
<?php 
endif;
endforeach;?>
</form>


</div>
</fieldset>
</body>
</html>