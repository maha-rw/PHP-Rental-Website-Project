<?php  //FINAL VERSION
    session_start();
$id= $_SESSION['id'];
$_SESSION['idOfseeker']=$id;

if ( !isset($_SESSION['email'])  || $_SESSION['role'] != "seeker")
{ header("location:index.php"); }
    require 'configuration.php';

?>

    
<!DOCTYPE html>

<html>
    <head>
        <title>Home seeker</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="SharedStyle_1.css"> 
        <link rel="stylesheet" href="homeSeeker.css"> 
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
  integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
 crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital@1&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital@1&family=Playfair+Display:ital@1&family=Roboto:ital@1&display=swap" rel="stylesheet">




<script>
function updateTable() {
    // Get the selected option from the drop-down menu
    var selectedOption = document.getElementById("category").value;

    // Get all the rows in the table
    var rows = document.getElementById("myTable").getElementsByTagName("tr");

    // Loop through the rows and hide/show based on the category
    for (var i = 1; i < rows.length; i++) {
        var category = rows[i].getElementsByTagName("td")[1].innerHTML;
        if (category == selectedOption) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
</script>
    </head>
    <body>
         <header> 
    <div>
       <img src="logo.png" height=168 width=180 alt="LOGO">
      <h1 style="font-style: italic;  font-size: 45px; font-family: Garamond, serif ;   text-shadow: 4px 5px black; 
          color:white; display:inline; position: relative; bottom: 70px; left: 30px;">
       HOUSE DEAL</h1>
    </div>
            
        </header>    

         <button>
            <span> <a href="logout.php">LOG OUT</a></span>
        </button>
       
        <main>
                    <?php
               $sql = " SELECT * FROM HomeSeeker WHERE id = $id";
               $result= mysqli_query($connection, $sql);
               $resultValue= mysqli_num_rows($result);
               
               if($resultValue>0){ //A ROW EXIST
                   $row= mysqli_fetch_row($result); //BRING THIS ROW
               }
                   
                echo "<h1> Welcome ".$row[1]."<h1>";
                
                echo"<ul>";
		echo"<li>your name:".$row[1]." ".$row[2]."</li>";
		echo"<li>number of family members:".$row[4]."</li>";
		echo "<li>phone number:".$row[7]."</li>";
		echo"<li>email address:".$row[8]."</li>";
               echo"</ul>";//}
               
               
               
               
               ?> 
            
                
         
      
        
        <table style="width:95%">
            <caption>Requested Homes</caption>
             <thead>
                <tr>
                    <th> Property Name</th>
                    <th> Category</th>
                    <th>Rent</th><!-- comment -->
                    <th> Status </th>
                </tr>
                </thead>
            <?php
            //////PART B
           echo"<tbody>";
           $sql="SELECT p.name, p.rent_cost, pc.category, a_s.status,p.id FROM property p "
                   . "JOIN propertycategory pc ON p.property_category_id = pc.id JOIN "
                   . "rentalapplication r_a ON p.id = r_a.property_id JOIN applicationstatus a_s "
                   . "ON r_a.application_status_id = a_s.id";
            $result= mysqli_query($connection, $sql);
           while($row = mysqli_fetch_assoc($result)){
               echo"<tr>";
             echo"<td> <a href=\"propertyDetails.php?propertyID=". $row['id']."\" >". $row['name']."</a> </td>"; ///THE LINK propertyID
             echo "<td>".$row['category']."</td>";
             echo"<td>".$row['rent_cost'] ."/month </td>";
             echo"<td>".$row['status']."</td>";
             echo"</tr>" ; 
           }
           echo"</tbody>";
            ?>
        </table>
        <br>
        <br>
        <form method="POST"><label id="searchByCategory" for="category"> Search by Category </label>
        <select name="category" id="category" onchange="updateTable() ">
       
            <?php 
            $sql= "SELECT property.id, propertycategory.category
        FROM property
        INNER JOIN propertycategory ON propertycategory.id = property.property_category_id
        WHERE property.id NOT IN (
          SELECT property_id FROM rentalapplication WHERE home_seeker_id = $id
        )";
    $result= mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $categorybefore=$row['category'];
    echo"<option>".$row['category']."</option>";
     while($row = mysqli_fetch_assoc($result)){
         if($row['category']!=$categorybefore){
         echo"<option>".$row['category']."</option>";}
         else
            continue;
     }
                    ?>
            
        </select>

            </form>
         
          
        <table style="width:95%" id="myTable">
            <caption>Homes for Rent</caption>
            <thead>
                <tr>
                    <th> Property Name</th>
                    <th> Category</th>
                    <th>Rent</th>
                    <th> Number of Rooms </th>
                    <th> Location </th>                    
                </tr>
            </thead>
            
            <?php
            echo"<tbody>";
            $sql = "SELECT property.id, property.name, propertycategory.category, property.rent_cost, property.rooms, property.location
        FROM property
        INNER JOIN propertycategory ON propertycategory.id = property.property_category_id
        WHERE property.id NOT IN (
          SELECT property_id FROM rentalapplication WHERE home_seeker_id = $id
        )";
         $result= mysqli_query($connection, $sql);

          
          $_SESSION['idOfprop']=0;

           while($row = mysqli_fetch_assoc($result)){
           $_SESSION['idOfprop']=$row['id']; ////so you can send it in apply button
            
               echo"<tr>";
             echo"<td> <a href=\"propertyDetails.php?propertyID=". $row['id']."\" >". $row['name']."</a> </td>"; ///THE LINK propertyID
             echo "<td>".$row['category']."</td>";
             echo"<td>".$row['rent_cost'] ."/month </td>";
             echo"<td>".$row['rooms']."</td>";
             echo"<td>".$row['location']."</td>";
             echo "<td> <a href=\"ApplyButton.php\" > Apply </a> </td>";
             
             echo"</tr>" ; 
           }
           echo"</tbody>";
            ?>
            </table>
        

        
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
