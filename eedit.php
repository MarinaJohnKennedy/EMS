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
    <link rel="stylesheet" type="text/css" media="screen" href="vd.css">

</head>
    <body>
   
    <a href="changepassword.php"><input type="button" name="password" value="Change Password" class="home1"></a>
   
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>
<fieldset class=fda>
    <br>
<?php  if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
    <h1>My Account Details</h1>
    <div class=data>
    <?php

$query="select id,fname,lname,gender,mobilenumber,emailid,dob,addr,role,sal,design from employees where id='$idss'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if($count==1)
{
    echo "<form>";
    $ndob=date("d-m-Y",strtotime($row['dob']));
echo "Employee ID: ".$row['id']."<br>";
echo "First Name: ".$row['fname']."<br>";
echo "Last Name: ".$row['lname']."<br>";
echo "Gender: ".$row['gender']."<br>";
echo "Mobile Number: ".$row['mobilenumber']."<br>";
echo "Email ID: ".$row['emailid']."<br>";
echo "Date of Birth: ".$ndob."<br>";
echo "Address: ".$row['addr']."<br>";
echo "Role: ".$row['role']."<br>";
echo "Salary: ".$row['sal']."<br>";
echo "Designation: ".$row['design'];?>
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
   
echo "<br><a href=eupdate.php><input type=button name=update value='Update Account Details' class=update></a>";

echo "</form>";
}?>
</div>
</fieldset>
</body>
</html>