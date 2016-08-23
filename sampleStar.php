<html>


<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="dist/themes/fontawesome-stars.css">
	<link rel="stylesheet" href="dist/themes/fontawesome-stars-o.css">
</head>


<?php
    $mysqli = new mysqli('localhost', 'root', 'usbw', 'mfspotter');
    $mysqli->autocommit(false);


    if(isset($_POST['submitted']))
    {
       
        $facilityID = 1;
        $userID = 1;
        $qty_service = $_POST['qty-service-rating'];
        $qty_equipment = $_POST['qty-equip-rating'];
        $cred_staff = $_POST['credibility-staff-rating'];

        //INSERT INTO RATING QTY OF SERVICE
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '1', '$qty_service', now() )");

        //INSERT INTO RATING QTY OF EQUIPMENT
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '2', '$qty_equipment', now() )");

        //INSERT INTO RATING CREDIBILITY OF STAFF
        $mysqli->query("INSERT INTO rating(userID, facilityID, categoryID, rating, dateRated) VALUES ('$userID', '$facilityID', '3', '$cred_staff', now() )");

             $mysqli->commit();
              echo "
              <script>
               $('#overall-rating').barrating({
                  theme: 'fontawesome-stars-o',
                  showSelectedRating: false,
                  readonly: true,
                  initialRating: '".(($qty_service + $qty_equipment + $cred_staff)/3)."'
                  });
              </script>
              ";
    }


?>


<body>
<form name = "addFacility" enctype="multipart/form-data" role="form" method="post" data-toggle="validator">
	<div class="stars stars-example-fontawesome-o">
                <select id="overall-rating" name="overall-rating">
                  <option value=""></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <span class="title current-rating">
                  Overall Rating
                </span>
            
    </div>


    <div class="stars stars-example-fontawesome">
        <select class="qty-service-rating" name="qty-service-rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        <span class="title">Quality of Service</span>
    </div>


    <div class="stars stars-example-fontawesome">
        <select class="qty-equip-rating" name="qty-equip-rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        <span class="title">Quality of Equipment</span>
    </div>


    <div class="stars stars-example-fontawesome">
        <select class="credibility-staff-rating" name="credibility-staff-rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        <span class="title">Credibility of Staff</span>
    </div>
 		 <button type="submit" name="rateButton" id="rateButton" class="btn btn-block btn-lg btn-danger">Save Ratings</button>
          <input type="hidden" name="submitted" value="TRUE" />

 </form>
</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="jquery.barrating.js"></script>
<script type="text/javascript">




   $(function() {

      //***************************************************************BY CATEGORY RATING SCRIPTS
     var qty_service = 0;
     var qty_equipment = 0;
     var cred_staff = 0;
     var result = 0;

      $('.qty-service-rating').barrating('show', {
        theme: 'fontawesome-stars',
        initialRating: null,
         onSelect: function(value, text) {
         		qty_service = value;
         		result = ((Number(qty_service) + Number(qty_equipment) + Number(cred_staff))/3); //alert(result);
         		//$('#overall-rating').barrating('set', Number(result));
            }
      });

      $('.qty-equip-rating').barrating('show',{
        theme: 'fontawesome-stars',
        initialRating: null,
         onSelect: function(value, text) {
         		qty_equipment = value;
         		result = ((Number(qty_service) + Number(qty_equipment) + Number(cred_staff))/3); //alert(result);
         		//$('#overall-rating').barrating('set', Number(result)); 
         }
      });

      $('.credibility-staff-rating').barrating('show',{
        theme: 'fontawesome-stars',
        initialRating: null,
	        onSelect: function(value, text) {
	        		cred_staff = value;
	        		result = ((Number(qty_service) + Number(qty_equipment) + Number(cred_staff))/3);
	        		//alert(result);
	        		//$('#overall-rating').barrating('set', Number(result));
	         }
      });




      //***************************************************************FOR OVER ALL RATING SCRIPTS
      var currentRating = ((Number(qty_service) + Number(qty_equipment) + Number(cred_staff))/3);

        $('.stars-example-fontawesome-o .current-rating')
            .find('span')
            .html(currentRating);

        $('.stars-example-fontawesome-o .clear-rating').on('click', function(event) {
            event.preventDefault();

            $('#overall-rating')
                .barrating('clear');
        });

        $('#overall-rating').barrating({
            theme: 'fontawesome-stars-o',
            showSelectedRating: false,
            readonly: true,
            initialRating: currentRating,
            onSelect: function(value, text) {
                if (!value) {
                    $('#overall-rating')
                        .barrating('clear');
                } else {
                    $('.stars-example-fontawesome-o .current-rating')
                        .addClass('hidden');

                    $('.stars-example-fontawesome-o .your-rating')
                        .removeClass('hidden')
                        .find('span')
                        .html(result);
                }
            },
            onClear: function(value, text) {
                $('.stars-example-fontawesome-o')
                    .find('.current-rating')
                    .removeClass('hidden')
                    .end()
                    .find('.your-rating')
                    .addClass('hidden');
            }
        });
        //***************************************************************
   });
</script>

</html>