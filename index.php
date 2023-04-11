

<?php
require("db.php");
session_start();


if(isset($_POST['submit'])){
    
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
    $_SESSION['emailid'] = $email;
    $_SESSION['password'] = $pass;

}
$msg='';
if(filter_has_var(INPUT_POST,'submit'))
{
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
   

    if(!empty($email) && !empty($pass) )
    {
         if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false)
        {
            $msg="Please use a valid E-mail ID";
        }
        
        else 
        {
            
        $query="select * from employees where emailid='$email' and password='$pass'";
        $result=mysqli_query($conn, $query);
        
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($count==1)
            {                
                $_SESSION['usertype']=$row['ut'];
                $utype=$_SESSION['usertype'];
                $_SESSION['ids']=$row['id'];
                $idss=$_SESSION['ids'];
                
                if($utype=="Admin")
                {
                
                header("Location:ahome.php");
           
                }
                else if($utype=="Employee")
                {
                    
                    header("Location:eedit.php");
                }
                
            }
            else
            {
                $msg="Invalid Email ID or Password";
        
            }
        }
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
    


    

 <fieldset>
    <h1>Login</h1>
    
    
    <?php if($msg!=''): ?>
    <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
<div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div>

<input type="text" placeholder="Email ID" name="emailid" class="tb">
<br>

<input type="password" placeholder="Password" name="password" class="tb">
<br>

<br>
<input type="submit" class="sub" name="submit" value="Submit">

</fieldset>
   

</form>
</div>
</div>
</body>
</html>