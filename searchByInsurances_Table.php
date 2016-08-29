<?php
//SEARCH BY INSURANCES SELECTED


$username="root";
$password="usbw";
$database="mfspotter";
$output='';
$insurancesArray= implode(",",$_POST['insuarray']);


$connect = mysqli_connect("localhost", $username, $password, $database);  

$query = "SELECT f.facilityName AS Facility_Name, GROUP_CONCAT(i.insuranceName SEPARATOR ', ') As Insurances_Covered
					FROM facility f, insurances i, insurancesCovered ic
					WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID
					AND i.insurancesID IN ('$insurancesArray')
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


//SAMPLE
    /*$connect = mysqli_connect("localhost", $username, $password, $database);  
    $i = 1;
    $query = "SELECT f.facilityName AS Facility_Name, GROUP_CONCAT(i.insuranceName SEPARATOR ', ') As Insurances_Covered
              FROM facility f, insurances i, insurancesCovered ic
              WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID
              AND i.insurancesID IN (1,2,3)
              GROUP BY f.facilityName";

     $result = mysqli_query($connect, $query); 
     echo "<div class = 'row'>";
    if(mysqli_num_rows($result) > 0)  
     {  
        
          while($row = mysqli_fetch_array($result))
          { ?>
            <div class="col-md-3">
                         <div class="box box-widget widget-user ">
                            <div class="widget-user-header bg-green">
                              <h2 class="widget-user-username "><?php echo $row['Facility_Name'] ?></h2>
                              <h5 class="widget-user-desc "><?php echo $row['Insurances_Covered'] ?></h5>
                            </div>
                          <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                              
                              <li><a href="#">Overall Ratings:
                                <select class="rating-display-overall pull-right" data-current-rating=<?php echo $overallRating?>>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select></a>
                              </li>
                              <li><a href="#">Avegage Overall Rating: <span class="value"><?php echo $overallRating?></span></a></li>
                              <li><a href="#">View Map <i class="fa fa-map-marker" aria-hidden="true"></i> </a></li>
                              <li><a href="#">More details <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></li>
                            </ul>
                          </div>
                       </div>
              </div>
            
            <?php 
            if($i % 3 == 3) echo "</div> <div class = 'row'>";
            $i++;
          }
        

     }  
     else  
     {  
          echo 'Data Not Found';  
 }
*/

?>