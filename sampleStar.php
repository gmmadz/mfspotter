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



	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="dist/themes/fontawesome-stars.css">
	<link rel="stylesheet" href="dist/themes/fontawesome-stars-o.css">
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
                          <a href="#">OVERALL RATINGS</a>
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
                          <a href="#">Overall Process Ratings</a>
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
                          <a href="#">Overall Outcomes Ratings</a>
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
                          <a href="#">Overall Structure Ratings</a>
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
                          <a href="#">Overall Experience Ratings</a>
                    </span>
                    <span class="description">
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

                    <div class="progress sm">
                       <div class="progress-bar progress-bar-green" style="width:<?php echo $processFive."%"?>"></div>
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

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width:<?php echo $processFour."%"?>"></div>
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

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width:<?php echo $processThree."%"?>"></div>
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

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width:<?php echo $processTwo."%"?>"></div>
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

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width:<?php echo $processOne."%"?>"></div>
                    </div>
                  </div>
</body>


<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script src="jquery.barrating.js"></script>
<script type="text/javascript">
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

      $('.rating-display-overall .current-rating')
            .find('span')
            .html(overallRating);

      $('.rating-display-overall').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: overallRating,
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

</html>