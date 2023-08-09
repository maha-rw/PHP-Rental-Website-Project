<?php

/////////last modification by lina.
require 'configuration.php';

session_start();
 
if (($_SESSION["role"] != "owner" && $_SESSION["role"] != "seeker") || !isset($_SESSION['id'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>property details</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="SharedStyle_1.css">
          <link rel="stylesheet" href="PropertyDetails.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
  integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
 crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital@1&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital@1&family=Playfair+Display:ital@1&family=Roboto:ital@1&display=swap" rel="stylesheet">
 

    </head>
    <body>
             <header> 
    <div>
        <?php
        if  ($_SESSION["role"] == "seeker")
       echo' <a href="HomeSeeker.php"><img src="logo.png" height=168 width=180 alt="LOGO"></a>';
        else if ( $_SESSION["role"] == "owner")
             echo' <a href="HomeOwner.php"><img src="logo.png" height=168 width=180 alt="LOGO"></a>';
                ?>
      <h1 style="font-style: italic;  font-size: 45px; font-family: Garamond, serif ;   text-shadow: 4px 5px black; 
          color:white; display:inline; position: relative; bottom: 70px; left: 30px;">
       HOUSE DEAL</h1>
    </div>
            
        </header>
        <main>
             <button id="log">
            <span> <a href="logout.php"> LOG OUT</a></span>
        </button>
        <div id="prop1">
       
      
        </div>
       
   
      
     <div class="pro info">
		<h2 class="cart-header">
			Property details 
		</h2>
            <table style=" margin-left: auto; margin-right: auto;width: 100%">
		<div class="cart-row">
                   <tr> 
                       <td><span class=" cart-header ">PROPERTY NAME</span> </td>
                       <td><span class=" cart-header "> CATEGORY</span> </td>
                       <td> <span class="cart-header "> ROOMS</span> </td>
                       <td> <span class="cart-header "> RENT COST</span> </td>
                       <td> <span class="cart-header "> LOCATION</span> </td>
                       <td> <span class="cart-header "> MAX TENANTS</span> </td>
                       
                       <td>           </td>
                   </tr>
     </div>
    <?php
       
       // echo $_GET['propertyID'];
           
           
         if( isset($_GET['msg'])){
           $msg =$_GET['msg'];
           echo "<script> alert('$msg');</script>";
          }
           error_reporting(E_ALL);
           
           if (isset($_GET['propertyID']))  
           $proID = $_GET['propertyID'];
           
        $proID = filter_var($proID, FILTER_SANITIZE_NUMBER_INT);
            settype($proID, "integer");
       
         $details = "SELECT * FROM Property WHERE id=".$proID."";
           $proDetails = mysqli_query($connection, $details);
             mysqli_store_result($connection);
             
            if(mysqli_num_rows($proDetails) > 0 ){
             
            $row = mysqli_fetch_row($proDetails);
            
             $category = "SELECT * FROM PropertyCategory WHERE id=".$row[2]."";
              $categoryName = mysqli_query($connection, $category);
               if(mysqli_num_rows($categoryName) > 0 ){  
                       
               $catname = mysqli_fetch_row($categoryName);
               }
              //property_id=".$proID."";
                $retrieve_query = "SELECT * FROM PropertyImage WHERE property_id=".$proID."";
                 $result = $connection->query($retrieve_query);
              // $image = "SELECT * FROM PropertyImage WHERE property_id=".$proID."";
              /* $path = mysqli_query($connection, $image);
               
               if(mysqli_num_rows($path) > 0 ){
                   $imagePath = mysqli_fetch_row($path);
               }*/
                 
               $proName = $row[3];
               $rooms=$row[4];
               $cost =$row[5];
               $location = $row[6];
               $maxTen =$row[7];
               $des=$row[8];
               $r3="hello";
               //$image = substr($imagePath[2], 1);
               
                 echo "<tr>
                    
                 <td>". $proName." </td> 
                      
                 <td>".$catname[1]."</td>
                   
                 <td>".$rooms."</td>
                     
                   <td>".$cost."</td>
                      <td>".$location."</td>
                         
                    
                   <td>".$maxTen."</td>
                 
            ";}
                 
                 
                   ?>
          
                  </table>
                </div>
        </div>
     
            
         
        
       
   <div class="pro info">
		<table style="width: 100%;">
			<tr>
				<th  class="cart-header">PROPERTY DESCRIPTION</th>
                                <th class="cart-header">PROPERTY IMAGE</th>
			</tr>
                        
                        
			 <tr>
			<?php  echo'<td  style="color:black;">'. $des.' </td> ';?>
			
      <?php 
                             
                                       
                                        
                                  echo '<td>';
                                         
                                         if ($result->num_rows > 0) {
                                             
                                       // Display the retrieved images
                                      while ($rowimg = $result->fetch_assoc()) {
                                          $p ='uploads//'.$rowimg["path"] ;
                                          if ($p != null)
                                    echo '<img src="uploads//' .$rowimg["path"] . '" alt="Image" height="100" width="100">  <br>';
                                   
                                          }
                                       

                                   
                                   }else {
                                   echo'<p> No photo uploaded </p>';}
                                   echo '</td> <td>';
                                   
                                    
                                    ?>
                        </tr> 
   
   
    
        
       </table>
        <?php if ($_SESSION["role"] == "seeker"){
        
        
         $owner = "SELECT * FROM Homeowner WHERE id=".$row[1]."";
           $ownerinfo = mysqli_query($connection, $owner);
             mysqli_store_result($connection);
             
            if(mysqli_num_rows($ownerinfo) > 0 ){
         $rowOwner = mysqli_fetch_row($ownerinfo);
      echo' <ul>
            <li>
                <lable> Owner name:</lable>"' .$rowOwner[1].'"
            </li>
            <li>
                <lable> Phone Number:</lable>"'. $rowOwner[2].'"
            </li>
            <li>
                <lable> Email Address:</lable>"'.  $rowOwner[3].'"
            </li>
        </ul>
        '; }
        
        $sqlAv = "SELECT property_id FROM rentalapplication WHERE home_seeker_id=".$_SESSION['id']."";
        
        $sqlAv2 = mysqli_query($connection, $sqlAv);
$apply = false;
          if( mysqli_num_rows($sqlAv2)>0){
         $arrayproId = mysqli_fetch_row($sqlAv2);  //array of propertys the seeker applied
        
              
              foreach ( $arrayproId as $rentPro){
                if ($rentPro ==  $proID) 
                   $apply=true; 
          } }
              if (!$apply)
            echo' <a href = "ApplyButton.php" > Apply </a>';
       
            
          }
        ?>
       
        
  
          <?php 
      
      if ($_SESSION["role"] == "owner"){ ?>
          <button class='btn-danger btn' style="width: 10%"><?php echo "<a href='EditProperty.php?propertyID=".$proID."'>Edit</a></button> "; ?>
        <?php }
          ?>
        </main>
        
        
        <footer>
             <div class="copyright">
          <p> <i class="fa-regular fa-copyright"></i>2023 House deal-All Rights Reserved</p>
        </div>
        </footer>
    </body>
    <?php
            mysqli_close($connection); ?>
</html>

