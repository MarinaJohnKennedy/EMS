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
    $company=$_POST['company'];
    $role=$_POST['role'];

   $institution=$_POST['institution'];
    $exam=$_POST['exam'];
    $percent=$_POST['percent'];
$relationship=$_POST['relationship'];
    $fname=$_POST['fname'];
    $age=$_POST['age'];
    
     
       foreach ($_POST['company'] as $key => $value) 
       {
        if($_POST['company'][$key]!=""&&$_POST['role'][$key]!=""&&$_POST['cstart'][$key]!=""&&$_POST['cend'][$key]!="")
        {
        $query1 = "INSERT INTO previous_experience(eid,company,role,start,end)VALUES ('" . $idss . "','" . $_POST['company'][$key] . "','" . $_POST['role'][$key] . "','" . $_POST['cstart'][$key] . "','" . $_POST['cend'][$key] . "')";

        if(mysqli_query($conn, $query1))
        {
          $msg="Updated details successfully";
        }
        else
        {
        $msg="Not updated";
        }
    }
    
    }
    
    foreach ($_POST['institution'] as $key => $value) {
        if($_POST['institution'][$key]!=""&&$_POST['exam'][$key]!=""&&$_POST['start'][$key]!=""&&$_POST['end'][$key]!=""&&$_POST['percent'][$key]!="")
        {
      $query2 = "INSERT INTO education_qualifications(eid,institution,exam,start,end,percent)VALUES ('" . $idss . "','" . $_POST['institution'][$key] . "','" . $_POST['exam'][$key] . "','" . $_POST['start'][$key] . "','" . $_POST['end'][$key] . "','" . $_POST['percent'][$key] . "')";
      if(mysqli_query($conn, $query2))
            {
                $msg="Updated details successfully";
            }
            else
            {
            $msg="Not updated";
            }

  } }
  foreach ($_POST['fname'] as $key => $value) {
    if($_POST['fname'][$key]!=""&&$_POST['relationship'][$key]!=""&&$_POST['age'][$key]!="")
    {
    $query3 = "INSERT INTO family_members(eid,name,relationship,age)VALUES ('" . $idss . "','" . $_POST['fname'][$key] . "','" . $_POST['relationship'][$key] . "','" . $_POST['age'][$key] . "')";
    if(mysqli_query($conn, $query3))
    {
        $msg="Updated details successfully";
    }
    else
    {
    $msg="Not updated";
    }
} }
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
    <h1>Update Details</h1>
    
    
    <?php if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >

<h2>Job Experience</h2>
<br>
<div id="dynamic_field">

<div class="form-row" >

  <input type=text placeholder="Company" name="company[]" class=tb>
  <input type=text placeholder="Role" name="role[]" class=tb>
  Start Date <input type=date placeholder="Start Date" name="cstart[]" class=tb>
  End Date <input type=date  placeholder="End Date" name="cend[]" class=tb>
  <button type=button id="add" class="sub">Add</button>
</div>
</div>
<br>
<div id="dynamic_field2">

<h2>Education Qualifications</h2>
<div class="form-row" >
   <input type=text placeholder="Institution" name="institution[]" class=tb>
     <input type=text name="exam[]" class=tb placeholder="Exam Passed">
     Start Date <input type=date placeholder="Start Date" name="start[]" class=tb>
  End Date <input type=date  placeholder="End Date" name="end[]" class=tb>
 <input type=text name="percent[]" class=tb placeholder="Percent">
  <button type=button id="add2" class="sub">Add</button>
    </div>
    </div>
    <br>
  <div id="dynamic_field3">
<h2>Add a Family Member</h2>
<div class="form-row" >
  <input type=text placeholder="Name" name="fname[]" class=tb>
  &nbsp;&nbsp;
  Relationship: <select name="relationship[]">
    <option value=0>Father</option>
    <option value=1>Mother</option>
    <option value=2>Brother</option>
    <option value=3>Sister</option>
    </select>
    &nbsp;&nbsp;
 <input type=text name="age[]" class=tb placeholder="Age">
  <button type=button id=add3  name="addafammem" class="sub">Add</button>
  </div>
    </div> <br>
<br>


   
<input type="submit" class="sub" name="submit" value="Submit">
</form>
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