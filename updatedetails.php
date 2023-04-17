<?php
require("db.php");

$msg='';
if(isset($_POST['submit']))
{ 


    $relationship = $_POST['relationship'];
    switch ($relationship) {
        case 0:
        $role="Father";
                   break;
        case 1:
            $role="Mother";
            break;
        case 2:
            $role="Brother";
            break;
       case 3:
       $role="Sister";
       break;
       }
    
  

}
?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="addemp.css">
    <script>
  function text(x)
  {
    if(x==0)
    document.getElementById("addafammem").style.display='block';
  }
       
        

   
   </script>
</head>
<body>

<a href="eedit.php"><input type="button" name="home" value="Home" class="home1"></a>
    
    <a href="index.php"><input type="button" name="logout" value="Logout" class="home1"></a>


    

 <fieldset>
    <h1>Create Employee</h1>
    
    
    <?php if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >



<h2>Job Experience </h2><button id="addjobexp" class="sub">Add</button>
<br>



 Company Name:<input type=text  name=company class=tb>
  <br>
  Role<input type=text name=role class=tb>
  <br>
  Number of years of service:<input type=text name=years class=tb>
  <br>




<br>
<h2>Education Qualifications</h2><button id="addeduexp" class="sub">Add</button>

<br>


  Institution Name:<input type=text  name=company class=tb>
  <br><br>
  Degree: <select name=role>
  <option value=0>10th</option>
  <option value=1>12th</option>
  <option value=2>Under Graduate</option>
  <option value=3>Post Graduate</option>
  </select><br>
  <br>
  Course:<select name=role>
  <option value=0>10th</option>
  <option value=1>12th</option>
  <option value=2>Under Graduate</option>
  <option value=3>Post Graduate</option>
  </select><br>
  Percentage:<input type=text name=percent class=tb>
  <br>


<h2>Add a Family Member</h2><button id=addafammem onclick="text(0)" name="addafammem" class="sub">Add</button>
<br>

<p id=hidden>
  Name:<input type=text  name=relationship class=tb>
  <br><br>
  Relationship: <select name=role>
    <option value=0>Father</option>
    <option value=1>Mother</option>
    <option value=2>Brother</option>
    <option value=3>Sister</option>
    </select>
    <br>
  Age:<input type=text name=years class=tb>
  <br>
  </p>


    

<br>

   
<input type="submit" class="sub" name="submit" value="Submit">

</fieldset>
   

</form>


</body>
</html>