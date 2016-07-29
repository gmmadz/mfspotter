<?php
$output ='';
$lati = $_POST['lati'];
$longi = $_POST['longi'];
$radius = $_POST['radi'];

$username="root";
$password="usbw";
$database="mfspotter";


$connect = mysqli_connect("localhost", $username, $password, $database);  

$query = sprintf("SELECT address, facilityName, latitude, longhitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM facility HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($lati),
  mysql_real_escape_string($longi),
  mysql_real_escape_string($lati),
  mysql_real_escape_string($radius));

 $result = mysqli_query($connect, $query); 

if(mysqli_num_rows($result) > 0)  
 {  
     
      $output .= '<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Facility Name</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Address</th>
                    <th>Distance</th>
                  </tr>
                </thead>';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tbody>
                      <td>'.$row['facilityName'].'</td>
                      <td>'.$row['latitude'].'</td>
                      <td>'.$row['longhitude'].'</td>
                      <td>'.$row['address'].'</td>
                      <td>'.$row['distance'].'</td>
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