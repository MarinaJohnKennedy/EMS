

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> View Employees</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="ahome.css">

</head>
    <body>
    <?php
require("db.php");
require("vendor\autoload.php");
$msg='';
$html='';

if(isset($_POST['export']))
{ 
    $ids=$_POST['id'];
    $query="select id,fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design from employees where id='$ids'";
    $result=mysqli_query($conn, $query);
   
    if($result-> num_rows>0)
    {
        $html='<table>
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
        </tr>';
        while($row=mysqli_fetch_array($result))
        {
            $html.='<tr><td>'.$row['id'].'</td>
            <td>'.$row['fname'].'</td>
             <td>'.$row['lname'].'</td>
             <td>'.$row['gender'].'</td>
            <td>'.$row['mobilenumber'].'</td>
            <td>'.$row['emailid'].'</td>
          <td>'.$row['password'].'</td>
            <td>'.$row['dob'].'</td>
            <td>'.$row['addr'].'</td>
            <td>'.$row['role'].'</td>
            <td>'.$row['sal'].'</td>
            <td>'.$row['design'].'</td>
            </tr>';
           
        }  
        $html.='</table';
        
        
    }

    else
    {
     $msg="data not found";
    }
        $mpdf=new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $file=time().'.pdf';
        $mpdf-> output($file,'D');
        $msg="Exported successfully";
    }
    



?>

    <div>
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home1"></a>
    <a href="login.php"><input type="button" name="logout" value="Logout" class="home1"></a>
  </div>
<fieldset>
<h1>Export Employee Biodata in PDF Fromat</h1>
<?php 
if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    <br>
<form action="" method="post">

Enter the Employee ID:<input type="text" name="id" class="tb" >
<input type="submit" name="export" class="import" value="Export">
</form>
 

</fieldset>
</body>
</html>