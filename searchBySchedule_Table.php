<?php
//SEARCH BY INSURANCES SELECTED


$username="root";
$password="usbw";
$database="mfspotter";
$output='';
$schedArray= implode(",",$_POST['schedule']);
$opening = $_POST['op'];
$closing = $_POST['cl'];


$connect = mysqli_connect("localhost", $username, $password, $database);  

$query = "SELECT f.facilityName AS Facility_Name, op.timeOpened AS Opening_Time, op.timeClosed AS Closing_Time
        FROM facility f, operatingperiod op 
        WHERE f.facilityID = op.facilityID
        AND op.dayofweek IN('$schedArray')
        AND op.timeOpened >= '$opening'
        AND op.timeClosed <= '$closing'
        GROUP BY f.facilityID";

 $result = mysqli_query($connect, $query); 

if(mysqli_num_rows($result) > 0)  
 {  
     
      $output .= '<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Facility Name</th>
                    <th>Opening Time</th>
                    <th>Closing Time</th>
                  </tr>
                </thead>';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tbody>
                      <td>'.$row['Facility_Name'].'</td>
                      <td>'.$row['Opening_Time'].'</td>
                      <td>'.$row['Closing_Time'].'</td>
                </tbody>  
           ';  
      }  
      echo $output;  
 }  
 else  
 {  
      echo 'Data Not Found';  
 }  



?>