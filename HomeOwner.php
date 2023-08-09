
<?php

        session_start(); 
   

if ( !isset($_SESSION['email'])  || $_SESSION['role'] != "owner")
{ header("location:index.php"); }


require_once'app.php';

                ini_set('display_errors', 0); //// set these to 0 before submit
                ini_set('display_startup_errors', 0); //// only so we can see errors while developing
                error_reporting(0);//// delete these before submit

    $user = getOwnerByID($_SESSION['id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="SharedStyle_1.css"> 
        <link rel="stylesheet" href="HomeOwner.css"> 

        
        <title>Home Owner Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <header>
        <div>
           <img src="logo.png" height=168 width=180 alt="LOGO"> 
            <h1 style="font-style: italic;  font-size: 45px; font-family: Garamond, serif ;   text-shadow: 4px 5px black; 
          color:white; display:inline; position: relative; bottom: 70px; left: 30px;">
                HOUSE DEAL</h1>

        </div>
    </header>


    <body>
        <h1>Welcome <?php echo $user['name']?> </h1>
        <ul>
            <li>
                <label> Name:</label> <?php echo $user['name']?>
            </li>
            <li>
                <label> Phone Number:</label> <?php echo $user['phone_number']?>
            </li>
            <li>
                <label> Email Address:</label> <?php echo $user['email_address']?>
            </li>
        </ul>

        <button>
            <span> <a href="logout.php">LOG OUT</a></span>
        </button>


        <table style="width:95%">
            <caption>Rental Application</caption>

            <thead>
                <tr>
                    <th>property Name:</th>
                    <th>Location</th>
                    <th>Applicant</th>
                    <th>Status</th>


                </tr>
            </thead>

            <tbody>
                <?php
                    $apps = getApplications($user['id']);
                    if(count($apps) == 0) echo"<tr><td colspan=5>No Applications available!</td></tr>";
                    foreach($apps as $app){
                        echo "<tr>
                            <td><a href=\"PropertyDetails.php?propertyID={$app['property_id']}\">{$app['name']}</a></td>
                            <td>{$app['name']}</td>
                            <td><a href=\"ApplicantInfo.php?id={$app['seeker_id']}\">{$app['applicant']}</a></td>
                            <td>{$app['status']}</td>
                            <td>
                                <a href=\"app.php?updateApp={$app['app_id']}&state=2\">Accept</a> | 
                                <a href=\"app.php?updateApp={$app['app_id']}&state=3\">Decline</a>
                            </td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>

        <br><br>

        <h5><a href="AddNewProperty.php"> Add Property</a></h5>

        <table style="width:95%">
            <caption>Listed Properties</caption>

            <thead>
                <tr>
                    <th>property Name:</th>
                    <th>Category</th>
                    <th>Rent</th>
                    <th>Rooms</th>
                    <th>Location</th>
                </tr>
            </thead>


            <tbody>
                <?php
                    $props = getUnrented($user['id']);
                    if(count($props) == 0) echo"<tr><td colspan=5>No unoccupied properties found!</td></tr>";
                    foreach($props as $prop){
                        echo "<tr>
                          
                            <td><a href=\"propertyDetails.php?propertyID='{$prop['id']}'\">{$prop['name']}</a></td>
                            <td>{$prop['category']}</td>
                            <td>{$prop['rent_cost']}/month</td>
                            <td>{$prop['rooms']}</td>
                            <td>{$prop['location']}</td>
                            <td><a href='app.php?delProp={$prop['id']}'>Delete</a></td>
                        </tr>";
                    } 
                ?>
            </tbody>
        </table>

        <br><br><br>
        <br><br><br>
        
        <footer>
            <div class="copyright">
                <p> <i class="fa-regular fa-copyright"></i>2023 House deal-All Rights Reserved</p>
            </div>
        </footer>
        
    </body>
    <?php
            mysqli_close($connection); ?>
</html>