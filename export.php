<?php
require("db.php");
$query="select fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design from employees where ut='Employee'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>
  </div>
<fieldset>

<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Mobile Number</th>
        <th>Email ID</th>
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
    while($row=mysqli_fetch_array($result))
    {
    

        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['fname']."</td>";
        echo "<td>".$row['lname']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['mobilenumber']."</td>";
        echo "<td>".$row['emailid']."</td>";
        echo "<td>".$row['password']."</td>";
        echo "<td>".$row['dob']."</td>";
        echo "<td>".$row['addr']."</td>";
        echo "<td>".$row['role']."</td>";
        echo "<td>".$row['sal']."</td>";
        echo "<td>".$row['design']."</td>";
        echo "</tr>";
    }

echo "</table>";
header('content-type:application.xls');
header('content-disposition:attachment;filename=report.xls');
}
else{
    $msg="No Employees";
}
    ?>
    

</fieldset>
</body>
</html>