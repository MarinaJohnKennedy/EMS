<?php
require("db.php");
session_start();
$idss=$_SESSION['ids'];
$msg='';

if(isset($_POST['submit'])){
    
    $op=$_POST['opassword'];
    $np=$_POST['npassword'];
    $cnp=$_POST['cnpassword'];
    
   }

if(filter_has_var(INPUT_POST,'submit'))
{
    $op=$_POST['opassword'];
    $np=$_POST['npassword'];
    $cnp=$_POST['cnpassword'];
   $pass=$_SESSION['password'];

    if(!empty($op) && !empty($np) && !empty($cnp)  )
    {
         if($op==$pass )
        {
            if($np==$cnp)
            {
            $query="update employees set password='$cnp' where id='$idss'";
            $result=mysqli_query($conn, $query);
          
            
    if($result)
        {
            $msg="Password Changed";
        }
            else
        {
                $msg="Passwords don't match";
        
        }
        }
        else
        {
        $msg="Old Password is not correct";
        }}
    }
    else
    {
        $msg="Please fill in all the fields";
 
    }
}
?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="login.css">

</head>
<body>
<a href="ahome.php"><input type="button" name="home" value="Home" class="home1"></a>
    <a href="viewdetails.php"><input type="button" name="home" value="My Account Details" class="home1"></a>
    <a href="login.php"><input type="button" name="logout" value="Logout" class="home1"></a>


    

 <fieldset>
    <h1>Change Password</h1>
    
    
    <?php if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
<div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div>

<input type="password" placeholder="Enter Old Password" name="opassword" class="tb">
<br>

<input type="password" placeholder="Enter New Password" name="npassword" class="tb">
<br>
<input type="password" placeholder="Confirm New Password" name="cnpassword" class="tb">
<br>

<br>
<input type="submit" class="sub" name="submit" value="Submit">

</fieldset>
   

</form>
</div>
</div>
</body>
</html>