<?php
session_start();
require("db.php");
$msg="";
$query="select id,fname,lname,mobilenumber,emailid from employees where ut='Employee'";

$result=mysqli_query($conn, $query);
$emps=mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);



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
    <?php foreach($emps as $emp): ?>

        <form action=viewemp.php method=GET>
        <tr>
        <td class=id> <?php echo $emp['id']?> </td>
        <td class=name><?php echo $emp['fname']?></td>
        <td class=name><?php echo $emp['lname']?></td>
        <td class=emailid><?php echo $emp['mobilenumber']?></td>
        <td class=emailid><?php echo $emp['emailid']?></td>
       
        <td><a href="edetails.php?id=<?php echo $emp['id']?>"><input type=button class=sub name=view value=View></a></td>
        </tr>
        
        </form>
        <?php endforeach;?>
    </table>
    </fieldset>
</body>
</html>