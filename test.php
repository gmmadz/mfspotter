<!DOCTYPE html>
<html>
<body>

<?php

$cars2 = array("2016","2017", "2018", "2019");
rsort($cars2); 

for($u=0;$u < 4; $u++){
    echo $cars2[$u];
}


 
?>

</body>
</html>