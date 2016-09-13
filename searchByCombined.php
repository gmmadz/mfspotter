<?php
//SEARCH BY INSURANCES SELECTED


$username="root";
$password="usbw";
$database="mfspotter";
$output='';

$daysOfWeek = '0,1,2';
$openingTime = '1:00';
$closingTime = '24:00';
$insurancesIDs = '1,3';
$specializationIDs = '1';
$latitude = 7.0702295954887475;
$longhitude = 125.68084716796875;
$radius = 25;

$connect = mysqli_connect("localhost", $username, $password, $database);  
$query = "SELECT f.facilityName AS Facility_Name, DATE_FORMAT(op.timeOpened, '%h:%i %p') AS Opening_Time, DATE_FORMAT(op.timeClosed, '%h:%i %p') AS Closing_Time, f.facilityID, f.latitude, f.longhitude
	        FROM facility f, operatingperiod op 
	        WHERE f.facilityID = op.facilityID
	        AND op.dayofweek IN($daysOfWeek)
	        AND op.timeOpened >= '$openingTime'
	        AND op.timeClosed <= '$closingTime'
	        AND f.facilityID IN(   
                SELECT DISTINCT f.facilityID 
                FROM facility f, insurances i, insurancesCovered ic, specialization s, hasspecialization hs
                WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID AND s.specializationID = hs.specializationID 
                AND hs.facilityID = f.facilityID
                AND i.insurancesID IN ($insurancesIDs) AND s.specializationID IN ($specializationIDs) 
                AND f.facilityID IN 
                        (SELECT facilityID 
                        	FROM facility 
                        	WHERE (6371 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians($longhitude) ) + sin( radians($latitude) ) * sin( radians( latitude ) ) ) ) < $radius))
        	";




//******************************************************FIND THE DIFFERENCES
/*$query = "SELECT f.facilityName AS Facility_Name, DATE_FORMAT(op.timeOpened, '%h:%i %p') AS Opening_Time, DATE_FORMAT(op.timeClosed, '%h:%i %p') AS Closing_Time, f.facilityID, f.latitude, f.longhitude
        FROM facility f, operatingperiod op 
        WHERE f.facilityID = op.facilityID
        AND op.dayofweek IN(0,1,2)
        AND op.timeOpened >= '1:00'
        AND op.timeClosed <= '24:00'
        AND f.facilityID IN(   
                SELECT DISTINCT f.facilityID 
                FROM facility f, insurances i, insurancesCovered ic, specialization s, hasspecialization hs
                WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID AND s.specializationID = hs.specializationID 
                AND hs.facilityID = f.facilityID
                AND i.insurancesID IN (1,3) AND s.specializationID IN (1)
                AND f.facilityID IN 
                        (SELECT facilityID FROM facility WHERE (6371 * acos( cos( radians(7.0702295954887475) ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians(125.68084716796875) ) + sin( radians(7.0702295954887475) ) * sin( radians( latitude ) ) ) ) < 25))";
*/
/*$query = "SELECT f.facilityName AS Facility_Name, GROUP_CONCAT(s.specialization SEPARATOR ', ') As Has_Specialization, f.facilityID, f.longhitude, f.latitude FROM facility f, specialization s, hasspecialization hs
              WHERE f.facilityID = hs.facilityID AND s.specializationID = hs.specializationID
              AND s.specializationID IN ($insurancesIDs)
              GROUP BY f.facilityID";*/
 $result = mysqli_query($connect, $query); 
$n = 0;
if(mysqli_num_rows($result) > 0)  
 {  
     
      $output .= '<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Facility Name</th>
                  </tr>
                </thead>';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tbody>
                      <td>'.$row['Facility_Name'].'</td>
                </tbody>  
           ';  
           $n++;
      }  
      echo $output . $n;  
 }  
 else  
 {  
      echo 'Data Not Found';  
 }  

/*
function getOverallVotePerID($id){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT AVG(rating) as overall FROM rating, facility WHERE rating.facilityID = facility.facilityID AND facility.facilityID = ".$id." AND dateRated >= DATE_SUB(NOW(),INTERVAL 1 YEAR) GROUP BY facility.facilityID";
  $result = mysqli_query($connect, $query);
 
  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      return number_format($row['overall'],2);
    }  
    
  }
  else
  {
    return 0;
  }
}
//SAMPLE

    $connect = mysqli_connect("localhost", $username, $password, $database);  
    $i = 1;
    $query = "SELECT f.facilityName AS Facility_Name, GROUP_CONCAT(s.specialization SEPARATOR ', ') As Has_Specialization, f.facilityID, f.longhitude, f.latitude FROM facility f, specialization s, hasspecialization hs
              WHERE f.facilityID = hs.facilityID AND s.specializationID = hs.specializationID
              AND s.specializationID IN ($insurancesArray)
              GROUP BY f.facilityID";

     $result = mysqli_query($connect, $query); 
     echo "<link rel='stylesheet' href='plugins/rateit-scripts/rateit.css'> <div class = 'row'>";
    if(mysqli_num_rows($result) > 0)  
     {  
          header("Refresh:0");
          while($row = mysqli_fetch_array($result))
          { ?>
           
            <link rel="stylesheet" href="plugins/rateit-scripts/rateit.css">
            <div class="col-md-4">
                         <div class="box box-widget widget-user ">
                            <div class="widget-user-header bg-green">
                              <h2 class="widget-user-username "><?php echo $row['Facility_Name'] ?></h2>
                              <h5 class="widget-user-desc "><?php echo $row['Has_Specialization'] ?></h5>
                            </div>
                          <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                              
                              <li>
                                <a href="#">
                                  <div class="row">
                                    
                                    <div class="col-xs-5">
                                      Overall Ratings: 
                                    </div>
                                
                                    <div class="col-xs-7 pull-right">
                                      <div class="rateit bigstars pull-right" data-rateit-value="<?php echo getOverallVotePerID($row['facilityID'])?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                    </div>

                                </div>

                                </a>

                         
                              </li>


                              <li><a href="#">Average: <span class="pull-right badge bg-aqua"><?php echo getOverallVotePerID($row['facilityID'])?></span></a></li>

                              <li><a href="#" data-lat="<?php echo $row['latitutde'] . ", " . $row['longhitude']?>" data-toggle="modal" data-target="#myMapModal-each">View Map <span class="pull-right badge bg-red"><i class="fa fa-map-marker" aria-hidden="true"></i>  </span> </a></li>

                              <li><a href ="facilityProfile.php?id=<?php echo $row['facilityID'] ?>">More details <span class="pull-right badge bg-blue"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>  </span></a></li>
                            </ul>
                          </div>

                       </div>
              </div>
              <script type="text/javascript" src="plugins/rateit-scripts/jquery.rateit.min.js"></script>
            
            <?php 
            if($i % 4 == 4) echo "</div> <div class = 'row'>";
            $i++;
          }
        

     }  
     else  
     {  
          echo 'Data Not Found';  
    }

*/
?>