
<?php
//////////////last modified lina 

require'configuration.php';
session_start();

if($_SESSION["role"]!= "owner" || ( !isset($_SESSION['id']) )){
        header("Location: index.php");
}
//echo "<script> alert('hi');</script>";
if (isset($_POST['addProperty'])) {

   $homeowner_id = $_SESSION["id"];
   $property_category_id=$_POST['category'];
   $propertyName = $_POST['name'];
   $rooms =$_POST['numRooms'];
   $rent_cost =$_POST['rent'];
    $location =$_POST['location'];
    $max_tenants=$_POST['maxNum'];
    $description= $_POST['description'];
    
      $sql = "INSERT INTO Property(homeowner_id,property_category_id,name,rooms,rent_cost,location, max_tenants, description)VALUES
           ('$homeowner_id','$property_category_id','$propertyName','$rooms','$rent_cost','$location','$max_tenants','$description')";
    $result= mysqli_query($connection, $sql);
     $propertyID = mysqli_insert_id($connection); 
   
    
    
    $images = $_FILES['images'];
      foreach ($images['tmp_name'] as $key => $tmp_name) {
            $image_name = $images['name'][$key];
            $image_tmp = $images['tmp_name'][$key];

                // Move the image to a directory
                $target_dir = "uploads//";
                $target_file = $target_dir . basename($image_name);

                if (move_uploaded_file($image_tmp, $target_file)) {
                    // Insert image path into the database
                    $sql = "INSERT INTO PropertyImage (property_id,path) VALUES ('$propertyID','$image_name')";
                   // $conn->query($sql);
                     $sql2 = mysqli_query($connection, $sql);
                    $imageID = mysqli_insert_id($connection);
                }
            }
    
    
    // Now let's move the uploaded image into the folder: image
   
    
     
     echo "<script> alert('hi');</script>";
   
     header("Location:PropertyDetails.php?propertyID=" .$propertyID);
}

?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Add new property</title>
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
            
        <form name="addProperty" action="AddNewProperty.php" id="formAdd" method="POST" enctype="multipart/form-data">
            <fieldset>
    <legend> New property details </legend>
    
    <label> Property name: <br>
    <input id="name" type="text" name="name"> </label><br>
    <label> Category: <br>
    <select name="category" id="category" >
        <option value='1'> Villa</option>
        <option value='2'> Apartment </option>
        <option value='3'> duplex </option>
    </select>
            </label><br> 
    <label> Number of rooms: <br>
    <input id="numRooms" type="text" name="numRooms"> </label><br> 
    <label> Rent: <br>
    <input id="rent" type="text" name="rent"> </label><br>  
    <label> Location: <br>
    <input id="location" type="text" name="location"> </label><br>  
    <label> Max number of tenants: <br>
    <input id="maxNum" type="text" name="maxNum"> </label><br> 
   
    <label> Pictures of the property: <br>
        
     
      <input  id="pictures" type="file" name="images[]" accept="image/*" multiple> </label><br> 
      
    <textarea name='description' placeholder='Property Description...' rows='6' cols='30'></textarea> <br>
    <input type="submit" name="addProperty" >
   
       
          </fieldset>  
        </form>
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