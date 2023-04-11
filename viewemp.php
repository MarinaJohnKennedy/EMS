<?php
session_start();
require("db.php");
$msg="";


?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> View Employees</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="ahome.css">

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
        <th class=name>First Name</th>
        <th>Last Name</th>
       
        <th>Mobile Number</th>
        <th class=emailid>Email ID</th>
       
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
        echo "<td class=id>".$row['id']."</td>"; 
        echo "<td class=name>".$row['fname']."</td>"; 
        echo "<td class=name>".$row['lname']."</td>"; 
        echo "<td class=emailid>".$row['mobilenumber']."</td>"; 
        echo "<td class=emailid>".$row['emailid']."</td>"; 
        echo "<td><a href=edetails.php><input type=button class=sub name=view value=View></a></td>";
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