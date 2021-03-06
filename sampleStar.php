<html>


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MFSpotter </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


  <!--ANTENNA RATEIT-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="dist/themes/fontawesome-stars.css">
	<link rel="stylesheet" href="dist/themes/fontawesome-stars-o.css">

  <!--RATEIT-->
  <link rel="stylesheet" href="plugins/rateit-scripts/rateit.css">


<style>
html, body, #map-canvas  {
  margin: 0;
  padding: 0;
  height: 100%;
}

#map-canvas {
  width:500px;
  height:480px;
  overflow:visible;

}
 
</style>
</head>


<?php

function getAverageVotePerCategory($category){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT AVG(rating) as overall FROM `rating` WHERE categoryID = ".$category." GROUP BY categoryID";
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


function getOverallVotePerID($id){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT AVG(rating) as overall FROM rating, facility WHERE rating.facilityID = facility.facilityID AND facility.facilityID = ".$id." GROUP BY facility.facilityID";
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
    
function getTotalVotesPerCategory($category){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT count(categoryID) as total FROM `rating` WHERE categoryID = ".$category." GROUP BY categoryID";
  $result = mysqli_query($connect, $query);
  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result)) 
    {
      return $row['total'];
    }  
    
  }
  else
  {
    return 0;
  }
 
}


function getTotalVotes($rating, $category){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 
  $query = "SELECT count(categoryID) as totalVotes FROM `rating` WHERE categoryID = ".$category."  AND rating = ".$rating." GROUP BY categoryID";

  $result = mysqli_query($connect, $query);

  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result))
    {
      return $row['totalVotes']; 
    }
  }
  else
  {
    return 0;
  }
}

$processFive = (getTotalVotes(5,1)/getTotalVotesPerCategory(1))*100;
$processFour = (getTotalVotes(4,1)/getTotalVotesPerCategory(1))*100;
$processThree = (getTotalVotes(3,1)/getTotalVotesPerCategory(1))*100;
$processTwo = (getTotalVotes(2,1)/getTotalVotesPerCategory(1))*100;
$processOne = (getTotalVotes(1,1)/getTotalVotesPerCategory(1))*100;

$outcomeFive = (getTotalVotes(5,2)/getTotalVotesPerCategory(2))*100;
$outcomeFour = (getTotalVotes(4,2)/getTotalVotesPerCategory(2))*100;
$outcomeThree = (getTotalVotes(3,2)/getTotalVotesPerCategory(2))*100;
$outcomeTwo = (getTotalVotes(2,2)/getTotalVotesPerCategory(2))*100;
$outcomeOne = (getTotalVotes(1,2)/getTotalVotesPerCategory(2))*100;

$structureFive = (getTotalVotes(5,3)/getTotalVotesPerCategory(3))*100;
$structureFour = (getTotalVotes(4,3)/getTotalVotesPerCategory(3))*100;
$structureThree = (getTotalVotes(3,3)/getTotalVotesPerCategory(3))*100;
$structureTwo = (getTotalVotes(2,3)/getTotalVotesPerCategory(3))*100;
$structureOne = (getTotalVotes(1,3)/getTotalVotesPerCategory(3))*100;

$experienceFive = (getTotalVotes(5,4)/getTotalVotesPerCategory(4))*100;
$experienceFour = (getTotalVotes(4,4)/getTotalVotesPerCategory(4))*100;
$experienceThree = (getTotalVotes(3,4)/getTotalVotesPerCategory(4))*100;
$experienceTwo = (getTotalVotes(2,4)/getTotalVotesPerCategory(4))*100;
$experienceOne = (getTotalVotes(1,4)/getTotalVotesPerCategory(4))*100;


$overallRating =(getAverageVotePerCategory(1) + getAverageVotePerCategory(2) + getAverageVotePerCategory(3) + getAverageVotePerCategory(4))/4;


//FOR INSERTION
/*

  $mysqli = new mysqli('localhost', $username, $password, $database); 
  $mysqli->autocommit(false);
  
    if(isset($_POST['submitted']))
    {
       
        $facilityID = 3;
        $userID = 1;
        $process = $_POST['rating-process'];
        $outcomes = $_POST['rating-outcome'];
        $structure = $_POST['rating-structure'];
        $experience = $_POST['rating-experience'];

        //INSERT INTO RATING PROCESS
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '1', '$process', now() )");

        //INSERT INTO RATING OUTCOMES
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '2', '$outcomes', now() )");

        //INSERT INTO RATING STRUCTURE
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '3', '$structure', now() )");

        //INSERT INTO RATING EXPERIENCE
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '4', '$experience', now() )");

        $mysqli->commit();
           
    }
*/


?>


<body>
   <!-RATING->
        <form name = "addRating" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">
          <div class="box box-primary box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Rate the Facility</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/process.png" alt="user image">
                        <span class="username">
                          <a href="#">Process</a>                        
                        </span>
                          <span class="username">
                              <div class="stars stars-example-fontawesome">
                                <select class="rating-process" name="rating-process">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                              </div>
                          </span>
                    <span class="description">Process measures assess whether a patient received what is known to be good care.
                    </span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->

                 <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/medical-result.png" alt="user image">
                        <span class="username">
                          <a href="#">Outcomes</a>
                        </span>
                        <span class="username">
                          <div class="stars stars-example-fontawesome">
                                <select class="rating-process" name="rating-outcome">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </span>
                    <span class="description">How do you fare as a result of the care?</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->

                 <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/flask.png" alt="user image">
                        <span class="username">
                          <a href="#">Structure</a>
                        </span>
                        <span class="username">
                         <div class="stars stars-example-fontawesome">
                              <select class="rating-process" name="rating-structure">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                          </div>
                        </span>
                    <span class="description">How well-equipped care setting is to deliver care?</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->

                  <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../mfspotter/dist/img/nurse.png" alt="user image">
                        <span class="username">
                          <a href="#">Patient Experience</a>
                        </span>
                        <span class="username">
                         <div class="stars stars-example-fontawesome">
                              <select class="rating-process" name="rating-experience">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                          </div>
                        </span>
                    <span class="description">How do you evaluate the care you received?</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->




                <!-OVERALL RATING->
                <div class="post">
                  <div class="user-block">
                    <span class="username">
                          <a href="#">OVERALL RATINGS for Facility 1</a>
                    </span>
                    <span class="description">
                              <select class="rating-display-overall" data-current-rating=<?php echo $overallRating?>>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                              <span class="title current-rating">
                                Avegage Overall Rating: <span class="value"><?php echo $overallRating?></span>
                              </span>
                    </span>

                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->

                <!-OVERALL RATING PROCESS->
                <div class="post">
                  <div class="user-block">
                    <span class="username">
                          <a href="#" data-toggle="modal" data-target="#processDetailModal">Overall Process Ratings</a>
                    </span>
                    <span class="description">
                              <select class="rating-display-process-overall" data-current-rating=<?php echo getAverageVotePerCategory(1);?>>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                              <span class="title current-rating">
                                Avegage Overall Rating: <span class="value"><?php echo getAverageVotePerCategory(1);?></span>
                              </span>
                    </span>

                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->


                <!-OVERALL RATING OUTCOMES->
                <div class="post">
                  <div class="user-block">
                    <span class="username">
                          <a href="#" data-toggle="modal" data-target="#outcomeDetailModal">Overall Outcomes Ratings</a>
                    </span>
                    <span class="description">
                              <select class="rating-display-outcomes-overall" data-current-rating=<?php echo getAverageVotePerCategory(2);?>>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                              <span class="title current-rating">
                                Avegage Overall Rating: <span class="value"><?php echo getAverageVotePerCategory(2);?></span>
                              </span>
                    </span>

                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->

                <!-OVERALL RATING STRUCTURE->
                <div class="post">
                  <div class="user-block">
                    <span class="username">
                          <a href="#" data-toggle="modal" data-target="#structureDetailModal">Overall Structure Ratings</a>
                    </span>
                    <span class="description">
                              <select class="rating-display-structure-overall" data-current-rating=<?php echo getAverageVotePerCategory(3);?>>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                              <span class="title current-rating">
                                Avegage Overall Rating: <span class="value"><?php echo getAverageVotePerCategory(3);?></span>
                              </span>
                    </span>

                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->

                <!-OVERALL EXPERIENCE STRUCTURE->
                <div class="post">
                  <div class="user-block">
                    <span class="username">
                          <a href="#" data-toggle="modal" data-target="#experienceDetailModal">Overall Experience Ratings</a>
                    </span>
                    <span class="description" >
                              <select class="rating-display-experience-overall" data-current-rating=<?php echo getAverageVotePerCategory(4);?>>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                              </select>
                              <span class="title current-rating">
                                Avegage Overall Rating: <span class="value"><?php echo getAverageVotePerCategory(4);?></span>
                              </span>
                    </span>

                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>
                <!-- /.post -->



//HI




            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box on Rating -->
        </div>
        <!-- /.col -->
      </form>


                <div class="post">
                  <div class="user-block">
               
                    <span class="description"></span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                  </p>
          
                </div>

                <!-MODALS FOR PROCESS DETAILS->
                <div class="modal fade modal-default" id="processDetailModal">
                  <div class="modal-dialog">
                   
                    <div class="modal-content">
                      
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        
                        <h4 class="modal-title">Process Ratings Details</h4>
                      </div>
                      
                      <div class="modal-body">
                      
                        <div class="col-md-12">
                          
                          <!-PROCESS CATEGORY DETAILS->
                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-five">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(5,1); ?></b>/ <?php echo getTotalVotesPerCategory(1); ?> votes</span>

                              <div class="progress md">
                                 <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processFive."%"?>"> <?php echo $processFive."%"?> </div> 
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-four">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(4,1); ?></b>/ <?php echo getTotalVotesPerCategory(1); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processFour."%"?>"><?php echo $processFour."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-three">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(3,1); ?></b>/ <?php echo getTotalVotesPerCategory(1); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processThree."%"?>"><?php echo $processThree."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-two">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(2,1); ?></b>/ <?php echo getTotalVotesPerCategory(1); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processTwo."%"?>"><?php echo $processTwo."%"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-one">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(1,1); ?></b>/ <?php echo getTotalVotesPerCategory(1); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $processOne."%"?>"><?php echo $processOne."%"?></div>
                              </div>
                            </div>
                        

                        </div>
                        
                        </br>
                        
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                      
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-MODALS FOR OUTCOME DETAILS->
                <div class="modal fade modal-default" id="outcomeDetailModal">
                  <div class="modal-dialog">
                   
                    <div class="modal-content">
                      
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        
                        <h4 class="modal-title">Outcome Ratings Details</h4>
                      </div>
                      
                      <div class="modal-body">
                      
                        <div class="col-md-12">
                          
                          <!-PROCESS CATEGORY DETAILS->
                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-five">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(5,2); ?></b>/ <?php echo getTotalVotesPerCategory(2); ?> votes</span>

                              <div class="progress md">
                                 <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeFive."%"?>"> <?php echo $outcomeFive."%"?> </div> 
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-four">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(4,2); ?></b>/ <?php echo getTotalVotesPerCategory(2); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeFour."%"?>"><?php echo $outcomeFour."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-three">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(3,2); ?></b>/ <?php echo getTotalVotesPerCategory(2); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeThree."%"?>"><?php echo $outcomeThree."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-two">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(2,2); ?></b>/ <?php echo getTotalVotesPerCategory(2); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeTwo."%"?>"><?php echo $outcomeTwo."%"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-one">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(1,2); ?></b>/ <?php echo getTotalVotesPerCategory(2); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $outcomeOne."%"?>"><?php echo $outcomeOne."%"?></div>
                              </div>
                            </div>
                        

                        </div>
                        
                        </br>
                        
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                      
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-MODALS FOR STRUCTURE DETAILS->
                <div class="modal fade modal-default" id="structureDetailModal">
                  <div class="modal-dialog">
                   
                    <div class="modal-content">
                      
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        
                        <h4 class="modal-title">Structure Ratings Details</h4>
                      </div>
                      
                      <div class="modal-body">
                      
                        <div class="col-md-12">
                          
                          <!-STRUCTURE CATEGORY DETAILS->
                            

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-five">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(5,3); ?></b>/ <?php echo getTotalVotesPerCategory(3); ?> votes</span>

                              <div class="progress md">
                                 <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureFive."%"?>"> <?php echo $structureFive."%"?> </div> 
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-four">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(4,3); ?></b>/ <?php echo getTotalVotesPerCategory(3); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureFour."%"?>"><?php echo $structureFour."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-three">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(3,3); ?></b>/ <?php echo getTotalVotesPerCategory(3); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureThree."%"?>"><?php echo $structureThree."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-two">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(2,3); ?></b>/ <?php echo getTotalVotesPerCategory(3); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureTwo."%"?>"><?php echo $structureTwo."%"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-one">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(1,3); ?></b>/ <?php echo getTotalVotesPerCategory(3); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $structureOne."%"?>"><?php echo $structureOne."%"?></div>
                              </div>
                            </div>
                        

                        </div>
                        
                        </br>
                        
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                      
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-MODALS FOR EXPERIENCE DETAILS->
                <div class="modal fade modal-default" id="experienceDetailModal">
                  <div class="modal-dialog">
                   
                    <div class="modal-content">
                      
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        
                        <h4 class="modal-title">Experience Ratings Details</h4>
                      </div>
                      
                      <div class="modal-body">
                      
                        <div class="col-md-12">
                          
                            <!-STRUCTURE CATEGORY DETAILS->
                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-five">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(5,4); ?></b>/ <?php echo getTotalVotesPerCategory(4); ?> votes</span>

                              <div class="progress md">
                                 <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceFive."%"?>"> <?php echo $experienceFive."%"?> </div> 
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-four">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(4,4); ?></b>/ <?php echo getTotalVotesPerCategory(4); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceFour."%"?>"><?php echo $experienceFour."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-three">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(3,4); ?></b>/ <?php echo getTotalVotesPerCategory(4); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceThree."%"?>"><?php echo $experienceThree."%"?></div>
                              </div>
                            </div>


                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-two">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(2,4); ?></b>/ <?php echo getTotalVotesPerCategory(4); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceTwo."%"?>"><?php echo $experienceTwo."%"?></div>
                              </div>
                            </div>

                            <div class="progress-group">
                              <span class="progress-text"> 
                                        <select class="rating-display-one">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                              </span>
                              <span class="progress-number"><b><?php echo getTotalVotes(1,4); ?></b>/ <?php echo getTotalVotesPerCategory(4); ?> votes</span>

                              <div class="progress md">
                                <div class="progress-bar progress-bar-green progress-bar-striped" style="width:<?php echo $experienceOne."%"?>"><?php echo $experienceOne."%"?></div>
                              </div>
                            </div>
                        

                        </div>
                        
                        </br>
                        
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                      
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->





<?php
//***************************MAKE THIS AS A FUNCTION WITH PARAMETERS (QUERY) ADD IFS FOR EACH DESCRIPTION
    $username="root";
    $password="usbw";
    $database="mfspotter";
    $output='';


    $connect = mysqli_connect("localhost", $username, $password, $database);  
    $i = 1;
    $query = "SELECT f.facilityName AS Facility_Name, GROUP_CONCAT(DISTINCT i.insuranceName SEPARATOR ', ') As Insurances_Covered, f.facilityID
              FROM facility f, insurances i, insurancesCovered ic
              WHERE f.facilityID = ic.facilityID AND i.insurancesID = ic.insuranceID
              AND i.insurancesID IN (1,2,3)
              GROUP BY f.facilityID";

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


                              <li><a href="#">Average Overall Ratings: <span class="pull-right badge bg-aqua"><?php echo getOverallVotePerID($row['facilityID'])?></span></a></li>
                              <li><a href="#" data-lat="23, 18.33" data-toggle="modal" data-target="#myMapModal">View Map <span class="pull-right badge bg-red"><i class="fa fa-map-marker" aria-hidden="true"></i>  </span> </a></li>
                              <li><a href="#">More details <span class="pull-right badge bg-blue"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>  </span></a></li>
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
 } ?>

<?php

function getRatingID($id, $facid, $catid){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 

  $query = "SELECT categoryID, ratingID, rating FROM rating WHERE userID = ".$id." AND facilityID = ".$facid." AND categoryID = ".$catid." ";
  $result = mysqli_query($connect, $query);
 
  if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_array($result))
    {
      return $row['ratingID']; 
    }
  }
  else 
    return false;

}

function getRatingValue($id, $facid, $catid){
  $username="root";
  $password="usbw";
  $database="mfspotter";
  $connect = mysqli_connect("localhost", $username, $password, $database); 

  $query = "SELECT categoryID, ratingID, rating FROM rating WHERE userID = ".$id." AND facilityID = ".$facid." AND categoryID = ".$catid." ";
  $result = mysqli_query($connect, $query);
 
  if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_array($result))
    {
      return $row['rating']; 
    }
  }
  else 
    return false;

}

?>
<?php
echo '
<label id="process-id" for="<?php echo '.getRatingID(1, 25, 1).'; ?>"></label>
<label id="process-before-id" for="<?php echo getRatingValue(1,25,1); ?>"></label>
<select id="process-value">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
<div class="rateit" data-rateit-backingfld="#process-value" data-rateit-value="<?php echo '.getRatingID(1, 25, 1).'; ?>"></div>


';

?>

<label id="outcome-id" for="<?php echo getRatingID(1, 25, 2); ?>"></label>
<label id="outcome-before-id" for="<?php echo getRatingValue(1,25,2); ?>"></label>
<select id="outcome-value">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
<div class="rateit" data-rateit-backingfld="#outcome-value" data-rateit-value="<?php echo getRatingValue(1,25,2); ?>"></div>


<label id="structure-id" for="<?php echo getRatingID(1, 25, 3); ?>"></label>
<label id="structure-before-id" for="<?php echo getRatingValue(1,25,3); ?>"></label>
<select id="structure-value">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
<div class="rateit" data-rateit-backingfld="#structure-value" data-rateit-value="<?php echo getRatingValue(1,25,3); ?>"></div>

<label id="experience-id" for="<?php echo getRatingID(1, 25, 4); ?>"></label>
<label id="experience-before-id" for="<?php echo getRatingValue(1,25,4); ?>"></label>
<select id="experience-value">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
<div class="rateit" data-rateit-backingfld="#experience-value" data-rateit-value="<?php echo getRatingValue(1,25,4); ?>"></div>






<button onclick="updateRating()">Get value</button>

<script>
function updateRating(){


  var process_id = document.getElementById("process-id").htmlFor;
  var outcome_id = document.getElementById("outcome-id").htmlFor;
  var structure_id = document.getElementById("structure-id").htmlFor;
  var experience_id = document.getElementById("experience-id").htmlFor;

  var process_value, outcome_value, structure_value, experience_value;

  var p = document.getElementById("process-value");
  var o = document.getElementById("outcome-value");
  var s = document.getElementById("structure-value");
  var e = document.getElementById("experience-value");

  //********SELECTED VALUE FROM SELECT TAG
  var selectedProcessValue = p.options[p.selectedIndex].value;
  var selectedOutcomeValue = o.options[o.selectedIndex].value;
  var selectedStructureValue = s.options[s.selectedIndex].value;
  var selectedExperienceValue = e.options[e.selectedIndex].value;

  //********PROCESS
  if(selectedProcessValue == 0 && selectedProcessValue != document.getElementById('process-before-id').htmlFor){
    process_value = document.getElementById('process-before-id').htmlFor;
  }
  else{
    process_value = selectedProcessValue;
  }

  //********OUTCOME
  if(selectedOutcomeValue == 0 && selectedOutcomeValue != document.getElementById('outcome-before-id').htmlFor){
    outcome_value = document.getElementById('outcome-before-id').htmlFor;
  }
  else{
    outcome_value = selectedOutcomeValue;
  }

  //********STRUCTURE
  if(selectedStructureValue == 0 && selectedStructureValue != document.getElementById('structure-before-id').htmlFor){
    structure_value = document.getElementById('structure-before-id').htmlFor;
  }
  else{
    structure_value = selectedStructureValue;
  }

  //********EXPERIENCE
  if(selectedExperienceValue == 0 && selectedExperienceValue != document.getElementById('experience-before-id').htmlFor){
    experience_value = document.getElementById('experience-before-id').htmlFor;
  }
  else{
    experience_value = selectedExperienceValue;
  }





  alert("id: " + process_id + " value: " + process_value);
  alert("id: " + outcome_id + " value: " + outcome_value);
  alert("id: " + structure_id + " value: " + structure_value);
  alert("id: " + experience_id + " value: " + experience_value);


  $.ajax({  
          url:"updateRatings.php",  
          method:"post",  
          data:{
            pid: process_id, pval: process_value,
            oid: outcome_id, oval: outcome_value,
            sid: structure_id, sval: structure_value,
            eid: experience_id, eval: experience_value,
            usid: 1, faid: 25
            },  
          dataType:"text",  
          success:function(data)  
          {  
            alert("UPDATED!"); 
          }  
        });  


 
}
</script>










<div class="modal fade" id="myMapModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title">View Map</h4>

            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                    
                        <div id="map-canvas" class=""></div>
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->






































<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="plugins/rateit-scripts/jquery.rateit.min.js"></script>

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiAxt9bglMA2DTxUsQAz-MbdN1lCZwhpk" type="text/javascript"></script>
<script src="jquery.barrating.js"></script>


                  
</body>



<script type="text/javascript">

    function eachBar(details){

    var overalldetails = details;

      $('.rating-display-detail .current-rating')
            .find('span')
            .html(overallRating);

      $('.rating-display-detail').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overalldetails,
        readonly: true
      });
    }

   $(function() {
      $('.rating-process').barrating({
        theme: 'fontawesome-stars',
        initialRating: null
      });


      
      var overallProcessRating = $('.rating-display-process-overall').data('current-rating');
      var overallOutcomeRating = $('.rating-display-outcomes-overall').data('current-rating');
      var overallStructureRating = $('.rating-display-structure-overall').data('current-rating');
      var overallExperienceRating = $('.rating-display-experience-overall').data('current-rating');
      var overallRating = $('.rating-display-overall').data('current-rating');
      var overalldetails = $('.rating-display-detail').data('current-rating');

      $('.rating-display-overall .current-rating')
            .find('span')
            .html(overallRating);

      $('.rating-display-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallRating,
        readonly: true
      });

     $('.rating-display-detail .current-rating')
            .find('span')
            .html(overallRating);

      $('.rating-display-detail').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overalldetails,
        readonly: true
      });

      $('.rating-display-process-overall .current-rating')
            .find('span')
            .html(overallProcessRating);

      $('.rating-display-process-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallProcessRating,
        readonly: true
      });

      $('.rating-display-outcomes-overall .current-rating')
            .find('span')
            .html(overallOutcomeRating);

      $('.rating-display-outcomes-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallOutcomeRating,
        readonly: true
      });

      $('.rating-display-structure-overall .current-rating')
            .find('span')
            .html(overallStructureRating);

      $('.rating-display-structure-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallStructureRating,
        readonly: true
      });

      $('.rating-display-experience-overall .current-rating')
            .find('span')
            .html(overallExperienceRating);

      $('.rating-display-experience-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallExperienceRating,
        readonly: true
      });







      //BREAKDOWN
      $('.rating-display-five').barrating({
        theme: 'fontawesome-stars',
        initialRating: 5,
        readonly: true
      });

      $('.rating-display-four').barrating({
        theme: 'fontawesome-stars',
        initialRating: 4,
        readonly: true
      });

      $('.rating-display-three').barrating({
        theme: 'fontawesome-stars',
        initialRating: 3,
        readonly: true
      });

      $('.rating-display-two').barrating({
        theme: 'fontawesome-stars',
        initialRating: 2,
        readonly: true
      });

      $('.rating-display-one').barrating({
        theme: 'fontawesome-stars',
        initialRating: 1,
        readonly: true
      });

   });



</script>


<script type='text/javascript'>
    var map;        
    var myCenter = new google.maps.LatLng(7.057964, 125.585403);
    var marker = new google.maps.Marker({
        position:myCenter
    });

    function initialize() {
      var mapProp = {
          center:myCenter,
          zoom: 10,
          mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      
      map=new google.maps.Map(document.getElementById("map-canvas"),mapProp);
      marker.setMap(map);
        
      google.maps.event.addListener(marker, 'click', function() {
          
        infowindow.setContent(contentString);
        infowindow.open(map, marker);
        
      }); 
    };
    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, "resize", resizeMap());

    $('#myMapModal').on('shown.bs.modal', function() {
       resizeMap();
    });


    function resizeMap() {
       if(typeof map =="undefined") return;
       var center = map.getCenter();
       google.maps.event.trigger(map, "resize");
       map.setCenter(center); 
    };
</script>




</html>