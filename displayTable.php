<?php
$output ='';
$lati = $_POST['lati'];
$longi = $_POST['longi'];
$radius = $_POST['radi'];

$username="root";
$password="usbw";
$database="mfspotter";

/*
$connect = mysqli_connect("localhost", $username, $password, $database);  

$query = sprintf("SELECT facilityID, address, facilityName, latitude, longhitude, ( 6371 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM facility HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
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
                    <th>Address</th>
                    <th>Distance</th>
                  </tr>
                </thead>';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tbody>
                      <td><a href ="facilityProfile.php?id='. $row['facilityID'] .'">'.$row['facilityName'].'</a></td>
                      <td>'.$row['address'].'</td>
                      <td>'.$row['distance'].' km</td>
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
//(SELECT AVG(rating) as last FROM rating WHERE dateRated <= DATE_SUB(NOW(),INTERVAL 1 YEAR))/2


function getOverallVotePerID($id){
  include('config.php');
 // $query = "SELECT AVG(rating) as overall FROM rating, facility WHERE rating.facilityID = facility.facilityID AND facility.facilityID = ".$id." AND dateRated >= DATE_SUB(NOW(),INTERVAL 1 YEAR) GROUP BY facility.facilityID";
  $query = "SELECT AVG(rating) as overall, (SELECT AVG(rating) as last FROM rating WHERE dateRated <= DATE_SUB(NOW(),INTERVAL 1 YEAR) AND rating.facilityID = ".$id.")/2 as oneYearBefore
  FROM rating, facility 
  WHERE rating.facilityID = facility.facilityID AND facility.facilityID = ".$id."
            AND dateRated >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
            GROUP BY facility.facilityID";
  $result = mysqli_query($connect, $query);
 
  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      if($row['oneYearBefore'] == null)
      {
        return number_format($row['overall'],2);
      }
      else
      {
        return number_format(($row['overall'] + $row['oneYearBefore'])/2 ,2);
      }
      
    }  
    
  }
  else
  {
    return 0;
  }
}



    
    include('config.php'); 
    $i = 1;
    $query = sprintf("SELECT facilityID, address, facilityName, latitude, longhitude, ( 6371 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longhitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM facility HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($lati),
  mysql_real_escape_string($longi),
  mysql_real_escape_string($lati),
  mysql_real_escape_string($radius));

     $result = mysqli_query($connect, $query); 
     echo "<link rel='stylesheet' href='plugins/rateit-scripts/rateit.css'> <div class = 'row'>";
    if(mysqli_num_rows($result) > 0)  
     {  
          header("Refresh:0");
          while($row = mysqli_fetch_array($result))
          { ?>
           
            <link rel="stylesheet" href="plugins/rateit-scripts/rateit.css">
            <div class="col-md-12">
                         <div class="box box-widget widget-user ">
                            <div class="widget-user-header bg-green">
                              <h3 class="widget-user-username "><?php echo $row['facilityName'] ?></h3>
                              <h5 class="widget-user-desc "><u>Distance:</u> <?php echo number_format($row['distance'],2) ?> km</h5>
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


                              <li><a href ="facilityProfile.php?id=<?php echo $row['facilityID'] ?>">More details <span class="pull-right badge bg-blue"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>  </span></a></li>
                            </ul>
                          </div>

                       </div>
              </div>
              <script type="text/javascript" src="plugins/rateit-scripts/jquery.rateit.min.js"></script>
            
            <?php 
            if($i % 1 == 1) echo "</div> <div class = 'row'>";
            $i++;
          }
        

     }  
     else  
     {  
          echo 'Data Not Found';  
    }
?>