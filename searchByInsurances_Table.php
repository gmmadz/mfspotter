<?php
//SEARCH BY INSURANCES SELECTED



$output='';
$insurancesArray= implode(",",$_POST['insuarray']);

/*
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
*/

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
//SAMPLE

    include('config.php');
    $i = 1;
    $query = "SELECT f.facilityName AS Facility_Name, GROUP_CONCAT(i.insuranceName SEPARATOR ', ') As Insurances_Covered, f.facilityID, f.longhitude, f.latitude FROM facility f, insurances i, insurancesCovered ic
              WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID
              AND i.insurancesID IN ($insurancesArray)
              GROUP BY f.facilityID";

     $result = mysqli_query($connect, $query); 
     echo "<link rel='stylesheet' href='plugins/rateit-scripts/rateit.css'> <div class = 'row'>";
    if(mysqli_num_rows($result) > 0)  
     {  
          header("Refresh:0");
          while($row = mysqli_fetch_array($result))
          { ?>
           
            <link rel="stylesheet" href="plugins/rateit-scripts/rateit.css">
            <div class="col-md-12">
                         <div class="box-body box-widget widget-user ">
                            <div class="widget-user-header bg-green">
                              <h2 class="widget-user-username "><?php echo $row['Facility_Name'] ?></h2>
                              <h5 class="widget-user-desc "><?php echo $row['Insurances_Covered'] ?></h5>
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


                              <li><a href ="insertView.php?id=<?php echo $row['facilityID'] ?>">More details <span class="pull-right badge bg-blue"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>  </span></a></li>
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