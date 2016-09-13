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
/* $result = mysqli_query($connect, $query); 

  if(mysqli_num_rows($result) > 0)  
   {  
       
        $output .= '<table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Facility Name</th>
                      <th>Opening Time</th>
                      <th>Closing Time</th>
                      <th>'.$schedArray.'</th>
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

*/
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
      return $row['overall'];
    }  
    
  }
  else
  {
    return 0;
  }
}
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
                              <h5 class="widget-user-desc ">Opening Time: <?php echo $row['Opening_Time'] ?></h5>
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

?>