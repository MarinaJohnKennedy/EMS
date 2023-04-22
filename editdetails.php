<?php
require("db.php");
session_start();
$idss=$_SESSION['ids'];
$msg='';
if(isset($_POST['submit']))
{
    $relationship = $_POST['relationship'];
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
    foreach ($_POST['company'] as $key => $value) 
       {
        if($_POST['company'][$key]!=""&&$_POST['role'][$key]!=""&&$_POST['cstart'][$key]!=""&&$_POST['cend'][$key]!="")
        {
              
                $query1 = "update previous_experience set company='" . $_POST['company'][$key] . "',role='" . $_POST['role'][$key] . "',start='" . $_POST['cstart'][$key] . "',end='" . $_POST['cend'][$key] . "' where id='".$_POST['hidden'][$key]."'";

            
        if(mysqli_query($conn, $query1))
        {
          $msg="Updated details successfully";
        }
        else
        {
        $msg="Not updated";
        }
    }
    else
{
    $msg="Please fill in all the fields";

}
    }
    foreach ($_POST['institution'] as $key => $value) 
    {
     if($_POST['institution'][$key]!=""&&$_POST['exam'][$key]!=""&&$_POST['start'][$key]!=""&&$_POST['end'][$key]!=""&&$_POST['percent'][$key]!="")
     {
     $query2 = "update education_qualifications set institution='" . $_POST['institution'][$key] . "',exam='" . $_POST['exam'][$key] . "',start='" . $_POST['start'][$key] . "',end='" . $_POST['end'][$key] . "', percent='" . $_POST['percent'][$key] . "' where id='".$_POST['hidden1'][$key]."'";

     if(mysqli_query($conn, $query2))
     {
       $msg="Updated details successfully";
     }
     else
     {
     $msg="Not updated";
     }
 }
 else
{
 $msg="Please fill in all the fields";

}
 }
 foreach ($_POST['fname'] as $key => $value) 
 {
  if($_POST['fname'][$key]!=""&&$_POST['relationship'][$key]!=""&&$_POST['age'][$key]!="")
  {
  $query3 = "update family_members set name='" . $_POST['fname'][$key] . "',relationship='" . $_POST['relationship'][$key] . "',age='" . $_POST['age'][$key] . "' where id='".$_POST['hidden2'][$key]."'";

  if(mysqli_query($conn, $query3))
  {
    $msg="Updated details successfully";
  }
  else
  {
  $msg="Not updated";
  }
}
else
{
$msg="Please fill in all the fields";

}
}
}


if(isset($_POST['delete'])) 

    
{
  
$delete=$_POST['delete'];


     
   
        $query4="delete from previous_experience where id='$delete'";

        $result=mysqli_query($conn, $query4);
        if($result)
                        {
                        
                       
                        $msg="Deleted record Successfully ";
                        }
                        else
                        {
                        $msg="Not Deleted";
                        }
}

if(isset($_POST['delete1'])) 

    
{
  $delete1=$_POST['delete1'];

            $query5="delete from education_qualifications where id='$delete1'";

            $result=mysqli_query($conn, $query5);
            if($result)
                            {
                            
                           
                            $msg="Deleted record Successfully ";
                            }
                            else
                            {
                            $msg="Not Deleted";
                            }
    }

if(isset($_POST['delete2'])) 

    
{
  $delete2=$_POST['delete2'];
   
            $query6="delete from family_members where id='$delete2'";

            $result=mysqli_query($conn, $query6);
            if($result)
                            {
                            
                            
                            $msg="Deleted record Successfully ";
                            }
                            else
                            {
                            $msg="Not Deleted";
                            }
    }


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
<a href="viewdetails.php"><input type="button" name="logout" value="View Details" class="home1"></a>
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>


    

 <fieldset>
    <h1>Edit Existing Details</h1>
    
    
    <?php if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >

<h2>Job Experience</h2>

<div id="dynamic_field">

<br>
<?php

$query="select id,company,role,start,end from previous_experience where eid='$idss'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Previous Experience";
}

  foreach( $rows as $row ):
  
   $hidden=$row['id'];
    $company=$row['company'];
    $role=$row['role'];
    $cstart=$row['start'];
    $cend=$row['end'];
    
    echo "<input type=hidden name=hidden[] value='$hidden'>";
    echo "Company: <input type=text  name=company[] class=tb value='$company'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Role: <input type=text  name=role[] class=tb value='$role'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Start Date: <input type=date  name=cstart[] class=tb value='$cstart'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "End Date: <input type=date  name=cend[] class=tb value='$cend'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<button type=submit name=delete id=".$hidden." class='sub remove' value='$hidden'>Delete</button><br>";
    
endforeach;
      ?>
</div>

<br>

<div id="dynamic_field2">
<h2>Education Qualifications</h2>

<br>
<?php

$query="select id,institution,exam,start,end,percent from education_qualifications where eid='$idss'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Education Qualifications";
}

  foreach( $rows as $row ):
  
    $hidden1=$row['id'];
    $institution=$row['institution'];
    $exam=$row['exam'];
    $start=$row['start'];
    $end=$row['end'];
    $percent=$row['percent'];
    echo "<input type=hidden name=hidden1[] value='$hidden1'>";
    echo "Institution: <input type=text  name=institution[] class=tb value='$institution'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Exam Passed: <input type=text  name=exam[] class=tb value='$exam'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Start Date: <input type=date  name=start[] class=tb value='$start'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "End Date: <input type=date  name=end[] class=tb value='$end'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Percent: <input type=text  name=percent[] class=tb value='$percent'>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<button type=submit name=delete1 id=".$hidden1." class='sub remove' value='$hidden1'>Delete</button><br>";
  endforeach;
      ?>

</div>
<div id="dynamic_field3">
<h2>Add a Family Member</h2>  
<br>

<?php

$query="select id,name,relationship,age from family_members where eid='$idss'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

if($count==0)
{
    $msg="No Family Members";
}

  foreach( $rows as $row ):
  
    $hidden2=$row['id'];
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
      
    echo "<input type=hidden name=hidden2[] value='$hidden2'>";
    echo "Name: <input type=text  name=fname[] class=tb value='$fname'>&nbsp;&nbsp;&nbsp;&nbsp;";
  echo "<select name=relationship[]>";
  $relationships=array('Father', 'Mother', 'Brother', 'Sister');
  foreach($relationships as $relation){
  if($relationship==$relation){
    echo "<option selected='selected' value='$relation'>$relation</option>";
  }
  else{
    echo "<option value='$relation'>$relation</option>";
  }
}

 echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;";
 
    echo "Age: <input type=text  name=age[] class=tb value='$age'>&nbsp;&nbsp;&nbsp;&nbsp;";

    echo "<button type=submit name=delete2 id=".$hidden2." class='sub remove' value='$hidden2'>Delete</button><br>";
    
endforeach;
      ?>

</div>
<br>



   
<input type="submit" class="sub" name="submit" value="Submit">
</form>
</fieldset>
      

        
</body>
</html>