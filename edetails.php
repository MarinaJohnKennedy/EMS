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
    Designation: <?php echo $emp['design']?>


<?php 
endif;
endforeach;?>
<br><br>
<b>Job Experience</b>
<br>
    <?php

$query="select company,role,start,end from previous_experience where eid='$idss'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Previous Experience";
}

  foreach( $rows as $row ):
  
    
    $company=$row['company'];
    $role=$row['role'];
    $cstart=date("d-m-Y",strtotime($row['start']));
    $cend=date("d-m-Y",strtotime($row['end']));
    
    echo "<b>Company: </b>".$company."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Role: </b>".$role."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Start Date: </b>".$cstart."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>End Date: </b>".$cend."<br>";

endforeach;
      ?>
<br>
<b>Education Qualifications</b>
<br>
<?php

$query1="select institution,exam,start,end,percent from education_qualifications where eid='$idss'";
$result=mysqli_query($conn, $query1);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Education Qualifications";
}

  foreach( $rows as $row ):
  
    
    $institution=$row['institution'];
    $exam=$row['exam'];
    $start=date("d-m-Y",strtotime($row['start']));
    $end=date("d-m-Y",strtotime($row['start']));
    $percent=$row['percent'];

    echo "<b>Institution: </b>".$institution."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Exam: </b>".$exam."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Start Date: </b>".$start."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>End Date: </b>".$end."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Percent: </b>".$percent."<br>";

endforeach;
    ?>

<br>
<b>Family Members</b>
<br>
<?php

$query2="select name,relationship,age from family_members where eid='$idss'";
$result=mysqli_query($conn, $query2);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Family Members";
}

  foreach( $rows as $row ):
  
    
    $fname=$row['name'];
    $relationship=$row['relationship'];
    $age=$row['age'];
    
 
    switch ($relationship) {
        case 0:
        $relationship="Father";
                   break;
        case 1:
            $relationship="Mother";
            break;
        case 2:
            $relationship="Brother";
            break;
       case 3:
       $relationship="Sister";
       break;
       }
    echo "<b>Name: </b>".$fname."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Relationship: </b>".$relationship."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<b>Age: </b>".$age."<br>";

endforeach;
    ?>
    <br>
    <a href="aupdatedetails.php?id=<?php echo $emp['id']?>"><input type=button name=update value='Add Employee Details' class=update></a>&nbsp&nbsp
<a href="update.php?id=<?php echo $emp['id']?>"><input type=button name=update value='Update Employee Details' class=update></a>&nbsp&nbsp
<input type=submit name=delete value='Delete Employee' class=update>
</form>
</div>
</fieldset>
</body>
</html>