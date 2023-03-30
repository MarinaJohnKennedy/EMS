<?php define('HOST','127.0.0.1');
define('USERNAME', 'root');
define('PASSWORD','');
define('DB','ems');

$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DB);

if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL".mysqli_connect();
}
?>