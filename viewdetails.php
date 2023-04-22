<?php
require("db.php");
session_start();
$idss=$_SESSION['ids'];
$msg='';

?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="udetails.css">
    
</head>
<body>

<a href="eedit.php"><input type="button" name="home" value="Home" class="home1"></a>
    
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>

 <fieldset>
    <h1>View Details</h1>
    
    
    <?php if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    <h2>Job Experience</h2>

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

<h2>Education Qualifications</h2>
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


<h2>Add a Family Member</h2>
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
    ?>
<br>

   
<a href="editdetails.php"><input type="submit" class="sub" name="submit" value="Edit Details"></a>
<br><br>
</form>
</fieldset>
</body>
</html>