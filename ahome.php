<?php
require("db.php");
session_start();
   
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="ahome.css">

</head>
    <body>
<fieldset>
<ul>
  <li><a href="viewdetails.php">My Account</a></li><br>
  <li><a href="addemp.php">Create Employee</a></li><br>
  <li><a href="editemp.php">Edit Employee</a></li><br>
  <li><a href="delemp.php">Delete Employee</a></li><br>
  <li><a href="import.php">Import New Employees</a></li><br>
  <li><a href="export.php">Export Existing Employees</a></li><br>
  <li><a href="exportbio.php">Export Biodata</a></li><br>
  <li><a href="login.php">Logout</a></li><br>
</ul>
</fieldset>


    
    </body>
</html>
