<?php //////last modified by lina
 require 'configuration.php';
 session_start();
if (($_SESSION["role"] != "owner") || !isset($_SESSION['id'])) {
    header("Location: index.php");
}
if(isset($_POST['id2'])){
    $propertyID =$_POST['id2'];
    //echo $propertyID;
   $homeowner_id = $_SESSION["id"];
   $property_category_id=$_POST['category'];
   $propertyName = $_POST['name'];
   $rooms =$_POST['numRooms'];
   $rent_cost =$_POST['rent'];
    $location =$_POST['location'];
    $max_tenants=$_POST['maxNum'];
    $description= $_POST['description'];
    $sql = 'UPDATE `Property` SET `property_category_id`="'.$property_category_id.'" ,`name`="'.$propertyName.'" ,'
            . '`rooms`="'.$rooms.'",`rent_cost`="'. $rent_cost.'",`location`="'. $location.'",'
            . '`max_tenants`="'. $max_tenants.'",`description`="'.$description.'" WHERE id='.$propertyID.' ';
    $result= mysqli_query($connection, $sql);
    $msg="Property information updated successfully!";
}
    if (isset($_POST['delete'])){
        $path1=$_POST['delete'];
unlink("uploads//$path1");
 $sqlD = 'DELETE FROM PropertyImage WHERE property_id="'.$propertyID.'"AND path = "'.$path1.'"';
  $resultD= mysqli_query($connection, $sqlD);
    }
     if (isset($_FILES['images2']))  { 
        
                            
    $images =$_FILES['images2'];
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
      
}
  

   

    header('Location:PropertyDetails.php?msg='.$msg.'&&propertyID='.$propertyID);
            mysqli_close($connection); 
     ?>
