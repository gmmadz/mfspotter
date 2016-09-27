<!DOCTYPE html>
<html>
<body>

<?php
$cars2 = array("2016","2017", "2018", "2019");
  

//echo $cars[1][0].": In stock: ".$cars[1][1].", sold: ".$cars[1][2].".<br>";
//echo $cars[2][0].": In stock: ".$cars[2][1].", sold: ".$cars[2][2].".<br>";
//echo $cars[3][0].": In stock: ".$cars[3][1].", sold: ".$cars[3][2].".<br>";


//for($i=0; $i < count($cars); $i++){
    $cars[0] = array(array("25","1", "01:06PM"), array("25A","1A", "01:06PMA"));
    $cars[1] = array(array("28","fdf", "05:44PM"));
    $cars[2][] = array("33","sadsa", "03:14PM");
    $cars[2][] = array("33A","sadsaA", "03:14PMA");



    //array_push($cars[2], array("33A","sadsaA", "03:14PMA"));
    //array_push($cars[3], array("s","sa", "sad"));
    //echo $cars[0][0][0].": In stock: ".$cars[0][0][1].", sold: ".$cars[0][0][2].".<br>";
    //echo $cars[0][1][0].": In stock: ".$cars[0][1][1].", sold: ".$cars[0][1][2].".<br>";
    //echo $cars[1][0][0].": In stock: ".$cars[1][0][1].", sold: ".$cars[1][0][2].".<br>";
    echo $cars[2][0][0].": In stock: ".$cars[2][0][1].", sold: ".$cars[2][0][2].".<br>";
     echo $cars[2][1][0].": In stock: ".$cars[2][1][1].", sold: ".$cars[2][1][2].".<br>";
   
//}
?>

</body>
</html>