
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
$html.=" <br><b>Designation: </b>".$design."<br>";

$query1="select eid,company,role,start,end from previous_experience where eid='".$_GET['id']."'";
$result=mysqli_query($conn, $query1);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Previous Experience";
}
$html.="<h1><center>Job Experience</center></h1>";
  foreach( $rows as $row ):
  
    
    $company=$row['company'];
    $role=$row['role'];
    $cstart=date("d-m-Y",strtotime($row['start']));
    $cend=date("d-m-Y",strtotime($row['end']));
   
    $html.="<b>Company: </b>".$company."&nbsp;&nbsp;&nbsp;&nbsp;";
    $html.="<b>Role: </b>".$role."&nbsp;&nbsp;&nbsp;&nbsp;";
    $html.= "<b>Start Date: </b>".$cstart."&nbsp;&nbsp;&nbsp;&nbsp;";
    $html.= "<b>End Date: </b>".$cend."<br>";

endforeach;
      

$query2="select eid,institution,exam,start,end,percent from education_qualifications where eid='".$_GET['id']."'";
$result=mysqli_query($conn, $query2);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Education Qualifications";
}
$html.="<h1><center>Educational Qualifications</center></h1>";
  foreach( $rows as $row ):
  
    
    $institution=$row['institution'];
    $exam=$row['exam'];
    $start=date("d-m-Y",strtotime($row['start']));
    $end=date("d-m-Y",strtotime($row['start']));
    $percent=$row['percent'];
   
    $html.= "<b>Institution: </b>".$institution."&nbsp;&nbsp;&nbsp;&nbsp;";
    $html.= "<b>Exam: </b>".$exam."&nbsp;&nbsp;&nbsp;&nbsp;";
    $html.="<b>Start Date: </b>".$start."&nbsp;&nbsp;&nbsp;&nbsp;";
    $html.="<b>End Date: </b>".$end."&nbsp;&nbsp;&nbsp;&nbsp;";
    $html.= "<b>Percent: </b>".$percent."<br>";

endforeach;
      
$query3="select eid,name,relationship,age from family_members where eid='".$_GET['id']."'";
$result=mysqli_query($conn, $query3);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Family Members";
}
$html.="<h1><center> Family Members</center></h1>";
  foreach( $rows as $row ):
  
    
    $name=$row['name'];
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
      
       $html.= "<b>Name: </b>".$name."&nbsp;&nbsp;&nbsp;&nbsp;";
       $html.= "<b>Relationship: </b>".$relationship."&nbsp;&nbsp;&nbsp;&nbsp;";
       $html.= "<b>Age: </b>".$age."<br>";

endforeach;
$dompdf = new Dompdf;

$dompdf->loadHtml($html);
$dompdf->render();

$dompdf->stream("Biodata_".$fname.".pdf");

?>
