
    <?php
require("db.php");
require __DIR__ . "/vendor/autoload.php";
use Dompdf\Dompdf;


 
$query="select id,fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design from employees where id='".$_GET['id']."'";
$result=mysqli_query($conn, $query);
   
    if($result-> num_rows>0)
    {
        while($row=mysqli_fetch_array($result))
    {
    $ID=$row['id'];
    $fname=$row['fname'];
    $lname= $row['lname'];
    $gender=$row['gender'];
    $mobilenumber= $row['mobilenumber'];
    $emailid= $row['emailid'];
    $dob=$row['dob'];
    $addr=$row['addr'];
    $role=$row['role'];
    $sal=$row['sal'];
    $design=$row['design'];
    }
    }
$html="<h1><center>Employee Biodata</center></h1>";

$html.=" <br><b>Employee ID: </b>".$ID;
$html.=" <br><b>First Name: </b>".$fname;
$html.=" <br><b>Last Name: </b>".$lname;
$html.=" <br><b>Gender: </b>".$gender;
$html.=" <br><b>Mobile Number: </b>".$mobilenumber;
$html.=" <br><b>Email ID: </b>".$emailid;
$html.=" <br><b>Date of Birth: </b>".$dob;
$html.=" <br><b>Address: </b>".$addr;
$html.=" <br><b>Role: </b>".$role;
$html.=" <br><b>Salary: </b>".$sal;
$html.=" <br><b>Desuignation: </b>".$design;


$dompdf = new Dompdf;

$dompdf->loadHtml($html);
$dompdf->render();


$dompdf->stream("Biodata_".$fname.".pdf");

?>
