
<?php
require("db.php");
session_start();

$utype=$_SESSION['usertype'];

$msg='';
$idss="";

if(isset($_GET['id']))
    {
        $idss=mysqli_real_escape_string($conn,$_GET['id']);
        $query="select id,fname,lname,gender,mobilenumber,emailid,dob,addr,role,sal,design from employees where id='".$_GET['id']."'";
        $result=mysqli_query($conn, $query);
        $emps=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
    }
if(isset($_POST['update']))
{
   
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $gender=$_POST['gender'];
    $mobile=$_POST['mobilenumber'];
    $email=$_POST['emailid'];
    $dob=$_POST['dob'];
    $addr=$_POST['addr'];
    

    if(filter_has_var(INPUT_POST,'update'))
    {
        if(!empty($first) && !empty($last) && !empty($mobile))
    {
        
        if(!preg_match("/^[a-zA-Z ]*$/",$first))
        {
            $msg= "First Name is NOT valid";
        }
    
        else if(!preg_match("/^[a-zA-Z ]*$/",$last))
        {
            $msg= "Last Name is NOT valid";
        }
    
        else if(filter_var($mobile,FILTER_VALIDATE_INT) === false && !preg_match("/^\d{10}$/",$mobile) && strlen($mobile)>10 || strlen($mobile)<10 )
        {
            $msg= "Mobile Number is NOT valid";
        }
        else if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false)
            {
                $msg="Please use a valid E-mail ID";
            }
        
        else{
            try{
            
            $query="update employees set fname='$first',lname='$last',gender='$gender',mobilenumber='$mobile',emailid='$email',dob='$dob',addr='$addr' where id='".$_GET['id']."'";

            $result=mysqli_query($conn, $query);

            if($result)
            {
            header("Location:edetails.php?id=".$_GET['id']);
            $msg="Updated account details";
            
            

            }
            else
            {
            $msg="Not updated";
            }
        

        }
        
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    }}}
    if(isset($_POST['update']))
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
    <title> Update Account Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vd.css">

</head>
    <body>
    <a href="ahome.php"><input type="button" name="home" value="Home" class="home2"></a>
    <a href="viewemp.php"><input type="button" name="home" value="Employees List" class="home2"></a>
    <a href="edetails.php?id=<?php echo $_GET['id']?>"><input type="button" name="home" value="Employee Details" class="home2"></a>
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home2"></a>
<fieldset>
    <br>
<?php  if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
    <h1>Update Account Details</h1>
    <div>
    <form  method=post >
        <?php 
  foreach($emps as $emp):
if($emp):
  
   ?>
    
  <?php
  echo "First Name: <input type=text class=tb name='firstname' value=".$emp['fname']."><br>";
  echo "Last Name: <input type=text class=tb name='lastname' value='".$emp['lname']."'><br>";?>
  Gender:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<?php  if($emp['gender']== 'Male') { ?>

<input type="radio" name="gender" value="Male" checked> Male
<input type="radio" name="gender" value="Female" unchecked> Female
<?php  }
else if($emp['gender']== 'Female')  { ?>
    <input type="radio" name="gender" value="Male" unchecked> Male
 <input type="radio" name="gender" value="Female" checked> Female

<?php } 
 
  echo "<br>Mobile Number: <input type=text class=tb name='mobilenumber' value=".$emp['mobilenumber']."><br>";
  echo "Email ID: <input type=text class=tb name='emailid' value=".$emp['emailid']."><br>";
  echo "Date of Birth: <input type=date class=tb name='dob' value=".$emp['dob']."><br>";
  echo "Address: <input type=text class=tb name='addr' value='".$emp['addr']."'><br><br>";
?>

    

<?php

endif;
endforeach;


?>

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
<a href="edetails.php?id=<?php echo $emp['id']?>"><input type=submit class=update name=update value=Update></a>

</form>


</div>
</fieldset>
      
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                var i = 1;
                $('#add').click(function () {
                    i++;
                    $('#dynamic_field').append('<div class="form-row" id="row' + i + '"> <input type="text" class="tb" name="company[]" placeholder="Company">  <input type="text" class="tb" name="role[]" placeholder="Role">  Start Date <input type="date" class="tb" name="cstart[]"> End Date <input type="date" class="tb" name="cend[]">  <button type="button" name="remove" class="sub remove" id="' + i + '">Delete</button> </div>');
                });
                $(document).on('click', '.remove', function () {
                    var button_id = $(this).attr("id");

                    $('#row' + button_id + '').remove();
                });



                $('#add2').click(function () {
                    i++;
                    $('#dynamic_field2').append('<div class="form-row" id="row' + i + '"> <input type="text" class="tb" name="institution[]" placeholder="Institution">  <input type="text" class="tb" name="exam[]" placeholder="Exam Passed">  Start Date <input type="date" class="tb" name="start[]"> End Date <input type="date" class="tb" name="end[]"> <input type="text" class="tb" name="percent[]" placeholder="Percent">  <button type="button" name="remove" class="sub remove" id="' + i + '">Delete</button> </div>');
                });
                $(document).on('click', '.btn_remove2', function () {
                    var button_id = $(this).attr("id");

                    $('#row2' + button_id + '').remove();
                });


                $('#add3').click(function () {
                    i++;
                    $('#dynamic_field3').append('<div class="form-row" id="row' + i + '"> <input type="text" class="tb" name="fname[]" placeholder="Name">  &nbsp;&nbsp; Relationship: <select name=relationship[]> <option value=0>Father</option><option value=1>Mother</option><option value=2>Brother</option><option value=3>Sister</option></select> &nbsp;&nbsp; <input type="text" class="tb" name="age[]" placeholder="Age">  <button type="button" name="remove" class="sub remove" id="' + i + '">Delete</button> </div>');
                });
                $(document).on('click', '.btn_remove3', function () {
                    var button_id = $(this).attr("id");

                    $('#row3' + button_id + '').remove();
                });



            });
        </script>

       


</body>
</html>