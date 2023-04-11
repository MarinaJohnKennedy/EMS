<?php

use Fpdf\Fpdf;

require("db.php");
$msg="";

if(isset($_POST['update']))
{
    $idss=$_POST['id'];
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $gender=$_POST['gender'];
    $mobile=$_POST['mobilenumber'];
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
    $dob=$_POST['dob'];
    $addr=$_POST['addr'];
    $role=$_POST['role'];
    $sal=$_POST['sal'];
    $design=$_POST['design'];
   


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
            $query="update employees set fname='$first',lname='$last',gender='$gender',mobilenumber='$mobile',emailid='$email',dob='$dob',addr='$addr',role='$role',sal='$sal',design='$design' where id='$idss'";

            $result=mysqli_query($conn, $query);

            

        }
       
    }}
    if($result)
    {
    $msg="Updated account details";
    
    }
    else
    {
    $msg="Not updated";
    }}


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
    <title> View Employees</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="viewemp.css">

</head>
    <body>

    <div>
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home1"></a>
    <a href="addemp.php"><input type="button" name="addemp" value="Add Employee" class="home1"></a>
    <a href="import.php"><input type="button" name="importne" value="Import New Employees" class="home1"></a>
    <a href="export.php"><input type="button" name="eee" value="Export Existing Employees" class="home1"></a>
    
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>
  </div>
<fieldset>
<br>
<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
<h1>Employees List</h1>

<table>
    <tr>
        <th class=id>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Mobile Number</th>
        <th class=emailid>Email ID</th>
        <th>Password</th>
        <th>Date of Birth</th>
        <th>Address</th>
        <th>Role</th>
        <th>Salary</th>
        <th>Designation</th>
    </tr>
    <?php
   
$query="select id,fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design from employees where ut='Employee'";
$result=mysqli_query($conn, $query);
if($result-> num_rows>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        
        echo "<form action=viewemp.php method=post>";
        echo "<tr>";
 echo "<td><input type=text name=id class=id value=".$row['id']."></td>"; 
 echo "<td><input type=text name=firstname class=tb value=".$row['fname']."></td>"; 
 echo "<td><input type=text name=lastname class=tb value=".$row['lname']."></td>"; 
 echo "<td><input type=text name=gender class=tb value=".$row['gender']."></td>"; 
 echo "<td><input type=text name=mobilenumber class=tb value=".$row['mobilenumber']."></td>"; 
 echo "<td><input type=text name=emailid class=emailid value=".$row['emailid']."></td>"; 
 echo "<td><input type=text name=password class=tb value=".$row['password']."></td>"; 
 echo "<td><input type=text name=dob class=tb value=".$row['dob']."></td>"; 
 echo "<td><input type=text name=addr class=addr value='".$row['addr']."'></td>"; 
 echo "<td><input type=text name=role class=tb value=".$row['role']."></td>"; 
 echo "<td><input type=text name=sal class=tb value=".$row['sal']."></td>"; 
 echo "<td><input type=text name=design class=tb value=".$row['design']."></td>"; 

 
        echo "<td><input type=submit class=sub name=update value=Update></td>";
    echo "<td><input type=submit class=sub name=delete value=Delete></td>";
    echo "<td><input type=submit name=exportbio value='Export Biodata' class=sub></td>";
        echo "</tr>";
        echo "</form>";
    }
   
echo "</table>";

}
else{
    $msg="No Employees";
}
    ?>
    

</fieldset>
</body>
</html>