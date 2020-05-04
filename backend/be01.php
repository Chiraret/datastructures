<?php
// https://alexwebdevelop.com/php-json-backend/
 function soslow(int $nmbrin) {
  // https://www.php.net/manual/en/function.microtime.php
  $start = microtime(true);
  $sum=0;
  for ($i=0;$i<=$nmbrin;$i++){
    $sum += $i;
  };
  $time_elapsed_secs = microtime(true) - $start;
  $time=sprintf("%f",$time_elapsed_secs);
  return ('{"sum":"'.$sum.'","time":"' . $time . '"}');
  }

  function faster(int $tocount) {
    $start = microtime(true);
    $sum=0;
    $hesu = ($tocount+1) ;
// PHP integer division intdiv()-> https://secure.php.net/manual/en/function.intdiv.php
    $sum=((intdiv($tocount,2))*$hesu) + (($tocount%2)*(intdiv($hesu,2)));
    $time_elapsed_secs = microtime(true) - $start;
    $time=sprintf("%f",$time_elapsed_secs);
    return ('{"sum":"'.$sum.'","time":"' . $time . '"}');
  }

// https://www.w3schools.com/php/php_superglobals.asp
//  echo 'given number was -> ' . $_GET['number'] ;
  $in=$_GET['number'];


  $jsonStr  = '{"testing":{"input":"' . $in . '","output":[';
  $jsonStr .= soslow($in);
  $jsonStr .= ',';
  $jsonStr .= faster($in);
  $jsonStr .= ']}}' ;

  header('Content-Type: application/json');  //json backend header
  echo $jsonStr;
?>