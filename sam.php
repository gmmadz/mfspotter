
<html>
 
 <select class="form-control" name="mondayOpening">
 	<?php 
 		for($n = strtotime("00:00"), $e = strtotime("24:00"); $n <= $e; $n += 1800) 
 		{
    		echo '<option value="'.date("H:i",$n).'">'.date("H:i",$n).'</option>';
    	}
    ?>
 </select>

</html>
