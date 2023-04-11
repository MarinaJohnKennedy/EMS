
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Import Employees</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="ahome.css">

</head>
    <body>
    <?php
require("db.php");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$msg="";



if(isset($_POST['import']))
{
  $file=$_FILES["excel"]["name"];
  $extension= pathinfo($_FILES["excel"]["name"],PATHINFO_EXTENSION);
   if($extension=='xls' || $extension=='xlsx' || $extension=='csv' )
   {
    $obj=PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $data=$obj->getActiveSheet()->toArray();
    $count=0;
   foreach($data as $row)
{
  $count++;
    $fname=$row[1];
  $lname=$row[2];
  $gender=$row[3];
  $mobilenumber=$row[4];
  $emailid=$row[5];
  $password=$row[6];
  $dob=$row[7];
  $addr=$row[8];
  $role=$row[9];
  $sal=$row[10];
  $design=$row[11];
  $ndob=date("Y-m-d",strtotime($dob));
  if($count==1) continue;

  $query="insert into employees(fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design,ut) values('$fname','$lname','$gender','$mobilenumber','$emailid','$password','$ndob','$addr','$role','$sal','$design','Employee')";
  $result=mysqli_query($conn, $query);

if($result)
{
   $msg="Imported Successfully";
}
  else
  {
$msg="Imported Failed";
}}}
  else{
    $msg="Invalid File";
  }
}

?>
    <div>
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home"></a>
    <a href="index.php"><input type="button" name="logout" value="Logout" class="logout"></a>
  </div>
<fieldset>
<h1>
Import Employees from Excel</h1>
<?php 
if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; 
    
    
?>
    <br>
    <form action="download.php" method="post" enctype="multipart/form-data" >
    <input type="submit" name="dt" value="Download Template" class="sub">
</form>
<form action="" method="post" enctype="multipart/form-data" >

<input type="file" name="excel"  class="excel" >
  <input type="submit" name="import" value="Import" class="import">
</form>


</fieldset>

</body>
</html>
