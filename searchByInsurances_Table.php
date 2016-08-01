<?php
//SEARCH BY INSURANCES SELECTED


$username="root";
$password="usbw";
$database="mfspotter";
$output ='';
$insurancesArray= implode(",",$_POST['insuarray']);


$connect = mysqli_connect("localhost", $username, $password, $database);  

$query = "SELECT f.facilityName AS Facility_Name, GROUP_CONCAT(i.insuranceName SEPARATOR ', ') As Insurances_Covered
					FROM facility f, insurances i, insurancesCovered ic
					WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID
					AND i.insurancesID IN ('".$insurancesArray."')
					GROUP BY f.facilityName";

 $result = mysqli_query($connect, $query); 

if(mysqli_num_rows($result) > 0)  
 {  
     
      $output .= '<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Facility Name</th>
                    <th>Insurances Covered</th>
                  </tr>
                </thead>';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tbody>
                      <td>'.$row['Facility_Name'].'</td>
                      <td>'.$row['Insurances_Covered'].'</td>
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