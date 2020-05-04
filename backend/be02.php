<?php
// https://www.w3schools.com/php/php_superglobals.asp
//  echo 'given number was -> ' . $_GET['number'] ;
  $in=$_GET['actorid'];
  $servertype = "mysql";
  $servername = "localhost";
  $username   = "ds2019";
  $password   = "TopSecret";
  $dbname     = "ds2019";

  try {
      $conn = new PDO("$servertype:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn = $conn->prepare("SELECT ID, firstname, familyname, ismarried FROM `customer` WHERE ID=".$in); 
      $conn->execute();

      // set the resulting array to associative
      $result = $conn->setFetchMode(PDO::FETCH_ASSOC);

      foreach ($conn->fetchAll() as $k=>$v){
        $booleanIsMarried = (1 == $v['ismarried']) ? 'true' : 'false' ;
        $output= '{"firstname":"'.$v['firstname'].'","familyname":"'.$v['familyname'].'","ismarried":"'. $booleanIsMarried .'"}';
      }
  }
  catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
header('Content-Type: application/json');  //json backend header
echo $output;
?>