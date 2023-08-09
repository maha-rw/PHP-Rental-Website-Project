<?php

/////last modified by LINA

require 'configuration.php';
session_start();
if (($_SESSION["role"] != "owner") || !isset($_SESSION['id'])) {
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
        <title>Applicant's information</title>
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
            
  <table style=" margin-left: auto; margin-right: auto;width: 100%">
		<div class="cart-row">
                   <tr> 
                       <td><span class=" cart-header ">APPLICANT NAME</span> </td>
                       <td><span class=" cart-header "> AGE</span> </td>
                       <td> <span class="cart-header "> FAMILY</span> </td>
                       <td> <span class="cart-header "> INCOME</span> </td>
                       <td> <span class="cart-header "> JOB</span> </td>
                       <td> <span class="cart-header "> PHONE NUMBER</span> </td>
                        <td> <span class="cart-header "> EMAIL</span> </td>
                       
                       <td>           </td>
                   </tr>
                   </div>
                   <?php
if (isset($_GET['id'])) 
            $seekerId= $_GET['id'];
        
       //echo $seekerId;
         $seekerRow = "SELECT * FROM HomeSeeker WHERE id=".$seekerId."";
           $seekerInfo = mysqli_query($connection, $seekerRow);
             mysqli_store_result($connection);
             
            if(mysqli_num_rows($seekerInfo) > 0 ){
            $row = mysqli_fetch_row($seekerInfo);
            $fname =$row[1];
            $lname=$row[2];
            $age =$row[3];
            $family=$row[4];
            $income=$row[5];
            $job =$row[6];
            $phone =$row[7];
            $email =$row[8];
            
            
            

     echo "<tr>
                    
                 <td>". $fname." ".$lname."</td> 
                      
               
                   
                 <td>".$age."</td>
                     
                   <td>".$family."</td>
                      <td>".$income."</td>
                         
                    
                   <td>".$job."</td>
                  <td>".$phone."</td>
                       <td>".$email."</td>
                           
          </tr> ";
       } 
                ?>
                  </table>
                </div>
            </table>  
            
</main>
    </body>
    <?php
            mysqli_close($connection); ?>
</html>