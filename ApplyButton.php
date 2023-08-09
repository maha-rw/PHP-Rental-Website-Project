<?php

//include the configriation
 require 'configuration.php';
 session_start(); 
   
//take the info and make a insert query with satus as under considiration
 
 /////NUMBER IN SQL WITH OR WITHOUT QOUTATION
 $underConsideration= 1;
  $sql1= "SELECT id From rentalapplication ORDER BY id DESC LIMIT 1" ;
 $result = mysqli_query($connection, $sql1);
 $row = mysqli_fetch_array($result);
 echo"<p>".$row['id']."</p>";
$idofrental = $row['id']+1;
         //$row['id']+1;
 
 $idofprop = $_SESSION['idOfprop'];
 $idofseeker = $_SESSION['idOfseeker'];
 
 $sql= "INSERT INTO rentalapplication (id, property_id, home_seeker_id, application_status_id) VALUES ('$idofrental', '$idofprop', '$idofseeker', '$underConsideration')";
 

$result= mysqli_query($connection, $sql);



//go back to home seeker page
header('location:HomeSeeker.php');
//move the property to table above


            mysqli_close($connection); ?>

