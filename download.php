<?php
if(isset($_POST['dt']))
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
  </tr> </table>";

header('content-type:application.xls');
header('content-disposition:attachment;filename=report.xls');
echo $test;
}
?>