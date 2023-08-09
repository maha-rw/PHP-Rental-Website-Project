<?php
 define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'HouseDeal');
 $connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
 $error = mysqli_connect_error();
               if ($error != null)
               {
                   $output=  "<p> Can't Connect to Database </p>".$error;
                   exit($output);
               }
?>
 

