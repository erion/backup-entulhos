<?php

  include "ezsql/ezsql.php";
  $dbuser='root'; 
  $dbpassword=''; 
  $dbname='festaRosas'; 
  $dbhost='localhost';
  $database = new ezSQL_mysql($dbuser, $dbpassword, $dbname, $dbhost);
  
?>