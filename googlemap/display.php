<?php

require("phpsqlsearch_dbinfo.php");

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);



  function fetch_area() {
    global $dom, $node, $parnode;
    $query = $this->link->query("SELECT * FROM markers WHERE 1");  
    $query->setFetchMode(PDO::FETCH_ASSOC);

    header("Content-type: text/xml");

        while($row = $query->fetch()) {  
          $node = $dom->createElement("marker");  
          $newnode = $parnode->appendChild($node);   
          $newnode->setAttribute("name",$row['name']);
          $newnode->setAttribute("adress", $row['adress']);  
          $newnode->setAttribute("lat", $row['lat']);  
          $newnode->setAttribute("lng", $row['lng']);  
          $newnode->setAttribute("type", $row['type']);
        } 
   }
  }
$area = new Areas();
$area_info = $area->fetch_area(); 
echo $dom->saveXML();

?>