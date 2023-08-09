<?php
////////////last modified by LINA
require 'configuration.php';
session_start();
if (($_SESSION["role"] != "owner") || !isset($_SESSION['id'])) {
    header("Location: index.php");
}
 ?>
<!DOCTYPE html>

<html>
    <head>
        <title>Edit Property</title>
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
      
             <?php
           $proId = $_GET['propertyID'];

    
                  $sql = "SELECT * FROM Property WHERE id=" .$proId."";
                  $result = mysqli_query($connection, $sql);
                   mysqli_store_result($connection);
                
                  if(mysqli_num_rows($result) > 0 ){
                 $prorow = mysqli_fetch_row($result);
              
                 
                  $sql2 = "SELECT * FROM PropertyCategory WHERE id=".$prorow[2]."";
                  $result2 = mysqli_query($connection, $sql2);
                 
                       if (mysqli_num_rows($result2) > 0) {
                  $catrow = mysqli_fetch_row($result2);
                  
                $retrieve_query = "SELECT * FROM PropertyImage WHERE property_id=".$proId."";
                 $result = $connection->query($retrieve_query);
                 
              
                   

                        echo' 
                            <div >
   <form name="editPro" action="edit.php" id="formEdit" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id2" value="' . $proId . '" />
           <fieldset>  
    <legend> Edit property details </legend>
    <input type="hidden" name="id2" value="' . $proId . '" />
    <label> Property name: <br>
    <input id="name" type="text" name="name" value= '.$prorow[3] .'> </label><br>
    <label> Category: <br>
    
                           
     <select name="category">';
      
       
                 
                  
        $sqlc = "SELECT c.*
        FROM PropertyCategory c
       
       ";
       $resultc = mysqli_query($connection, $sqlc);
    //$result2= mysqli_query($databaseCon, $sql2);
    echo '<option value="' . $catrow[0]. '">' . $catrow[1] . '</option>';
    $n =0;
              while ($n<3) {
                  $rowc =mysqli_fetch_row($resultc);
        if ($rowc[0]!=$catrow[0] && $rowc[1]!=$catrow[1])
               echo '<option value="' . $rowc[0]. '">' . $rowc[1] . '</option>';
        $n++;
                     }
                            
          
 
                 
                    echo'
            
      

       
         </select>
         </label>
    <br> 
          
    <label> Number of rooms: <br>
    <input id="numRooms" type="text" name="numRooms" value='.$prorow[4].'> </label><br> 
    <label> Rent: <br>
    <input id="rent" type="text" name="rent" value='.$prorow[5].'> </label><br>  
    <label> Location: <br>
    <input id="location" type="text" name="location" value='.$prorow[6].'> </label><br>  
    <label> Max number of tenants: <br>
    <input id="maxNum" type="text" name="maxNum" value='.$prorow[7].'> </label><br> 
        
 <label for="Description" >Property description:</label> <br>
  <input name="description" type="textarea" value="'.$prorow[8] .'" rows="10" cols="20" size="80"> 
   <br>
  
		<br>
  
    <label> Photos of the property: <br>';
   
                         
             if ($result->num_rows > 0) {
                                             
             // Display the retrieved images
          while ($rowimg = $result->fetch_assoc()) {
              $imgp = 'uploads//' . $rowimg["path"] . '';
              
                 if (!$imgp == null){
                     
          echo '<img src="uploads//' . $rowimg["path"] . '" alt="Image" height="100" width="100">  ';
                echo 'Delete<input type="submit"  name="delete" value="'. $rowimg["path"] .'"><br>' ; 
       

          }}
                                       

                                   
                }else {
           echo '<input type="textarea" placeholder="No photo uploaded" rows="8" cols="30" size="70">';}
                               
      
            ?>   
       <?php

           echo' </label> 
           <br> <label> Add photo 
                <br>  <input   type="file" name="images2[]" accept="image/*" multiple > <br></label>
         <input type="submit"  name="editPro" > 
             </fieldset>
        <br>'; ?>
    <?php
       }}
                    else 
                        echo 'No available property';
echo'
                        
         
            <br>
       </form>
        </main>
    <br><br>
         <footer>
            <div class="copyright">
          <p> <i class="fa-regular fa-copyright"></i>2023 House deal-All Rights Reserved</p>
        </div>
        </footer>
</body>
</html> ';  

 mysqli_close($connection); ?>
