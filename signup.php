<?php
    session_start();
    ?>
<!DOCTYPE html> <!-- FINAL VERSION -->
<html>
<head>
  <title> SignUp </title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="SharedStyle_1.css">
    <link rel="stylesheet" href="signUpStyle.css">
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
        <a href="index.php"><img src="logo.png" height=168 width=180 alt="LOGO"></a>
      <h1 style="font-style: italic;  font-size: 45px; font-family: Garamond, serif ;  color:white; display:inline; position: relative; bottom: 70px; left: 30px;"> HOUSE DEAL</h2>
    </div>
            
        

 <!-- ADD NAV AND BREADCRUMBS-->

  </header>
  
  
  <main>
  <br><br>
	<fieldset> <legend><h2>HomeSeeker sign up</h2></legend>
            <form method="post" action="signup.php" >
	 <div class="container">
  
  <div class="row">
    <div class="col-25">
      <label for="fname">First Name:</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="firstname" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname" >Last Name:</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="lastname" placeholder="Your last name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="age" >Age:</label>
    </div>
    <div class="col-75">
      <input type="number" name="age" placeholder=" Your Age..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="num">Number of family members: </label>
    </div>
    <div class="col-75">
<input type="number" name="familynum" placeholder=" number of members..">    </div>
  </div>
   <div class="row">
    <div class="col-25">
      <label for="income">Income:</label>
    </div>
    <div class="col-75">
      <input type="text" id="Income" name="income" name="income" placeholder="Your  income..">
    </div>
	</div>
	 <div class="row">
    <div class="col-25">
      <label for="job">Job:</label>
    </div>
    <div class="col-75">
     <input type="text" id="Job" name="job" placeholder=" Your job..">
    </div>
	</div>
	
	 <div class="row">
    <div class="col-25">
    <label for="phone">Phone number:</label>
    </div>
    <div class="col-75">
        <input type="tel"  name="phone" placeholder="055-723-3312" pattern="[0-9]{10}" title="   Phone number must be 10 digits, Don't use country code   " required>
    </div>
	</div>
	
	 <div class="row">
    <div class="col-25">
    <label for="email">Email:</label>
    </div>
    <div class="col-75">
  <input type="email"  name="email" placeholder=" Your email.." >
    </div>
	</div>
	
	 <div class="row">
    <div class="col-25">
    <label for="pass">Password:</label>
    </div>
    <div class="col-75">
<input type="password"  name="pass" placeholder=" 8 characters/digits password.." pattern="[a-zA-Z0-9]{8}" title="   Password must be at least 8 characters/digits long   " required >
    </div>
	</div>
	
 
  <div class="row">
      <input type="submit" value="Submit" name ="submitbtn"> <!-- onclick="goSignup(); return false; -->
  </div>
  </form>
            
</div>
	</fieldset>
  
  
  
 
</main>
<footer>
             <div class="copyright">
          <p> <i class="fa-regular fa-copyright"></i>2023 House deal-All Rights Reserved</p>
        </div>
           
        </footer> 

</body>

</html>

    <?php

 require 'configuration.php';
 
               

if(filter_input(INPUT_POST, 'submitbtn')!=null ){

$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$age = filter_input(INPUT_POST, "age");
$familyNum = filter_input(INPUT_POST, "familynum");
$income = filter_input(INPUT_POST,"income" );
$job = filter_input(INPUT_POST, "job");
$phone = filter_input(INPUT_POST, "phone");
$email = filter_input(INPUT_POST, "email");
$pass = filter_input(INPUT_POST, "pass");       
$hashedpass = password_hash($pass, PASSWORD_DEFAULT);


if ( $firstname==null || $lastname==null || $age==null || $familyNum == null || $income == null || $job==null ||$phone== null || $pass== null )
{echo '<script>alert("Please enter all fields")</script>';   }
 else {
      
$query =" SELECT `email_address` FROM `HomeSeeker` WHERE email_address = '$email'";
$sql = mysqli_query($connection, $query); 
$num = mysqli_num_rows($sql);
 if($num > 0)  {
             echo '<script>alert("email address already exists! \nPlease Enter Correct Credentials")</script>';   }
		
else{
	
$query = mysqli_query($connection, "INSERT INTO HomeSeeker ( first_name, last_name, age, family_members, income, job, phone_number, email_address, password) VALUES('$firstname', '$lastname', $age, $familyNum,$income, '$job','$phone','$email','$hashedpass')");
 if ( ( !isset($_SESSION['email'] ))) {
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            $_SESSION['role']= 'seeker';
            $id = mysqli_insert_id($connection);
            $_SESSION['id']=$id;
            header('location:HomeSeeker.php');

 }
}
 }       
} 
            mysqli_close($connection); //last modified by Maha ?>