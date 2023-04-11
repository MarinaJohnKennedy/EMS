<?php
require_once __DIR__ .'/vendor/autoload.php';

if(isset($_POST['epdf']))
{
    
    $idss=$_POST['id'];
    $query="select id,fname,lname,gender,mobilenumber,emailid,password,dob,addr,role,sal,design from employees where id='$idss'";
    $result=mysqli_query($conn, $query);
    if($result-> num_rows>0)
    {
        $test=" <table>
  <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Gender</th>
      <th>Mobile Number</th>
      <th>Email ID</th>
      <th>Password</th>
      <th>Date of Birth</th>
      <th>Address</th>
      <th>Role</th>
      <th>Salary</th>
      <th>Designation</th>
  </tr> ";

        while($row=mysqli_fetch_assoc($result))
        {
        $test.="
        <tr>
        <td>.'$row[id].'</td>
        <td>.'$row[fname].'</td>
        <td>.'$row[lname].'</td>
        <td>.'$row[gender].'</td>
        <td>.'$row[mobilenumber].'</td>
        <td>.'$row[emailid].'</td>
        <td>.'$row[password].'</td>
        <td>.'$row[dob].'</td>
        <td>.'$row[addr].'</td>
        <td>.'$row[role].'</td>
        <td>.'$row[sal].'</td>
        <td>.'$row[design].'</td>
        </tr>
        </table>";
        }
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($test);
$file='downloads/'.time().'pdf';
$mpdf->Output($file);

}}

?>