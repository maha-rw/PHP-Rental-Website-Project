 <?php
/* *NOTE: if you want to login to accounts stored in database, these are the passwords since they are hashed in the database:

-- Seekers:
 *email: fahad123@gmail.com
 * password: fahad2020
 
 * email: itsLama@gmail.com
 * password: lama2020saud
 
 * email:alotaibi.asma@outlook.com
 * password: asmaabdulaziz
 
 * 
 --Owners:
 * email: abdulaziz11@gmail.com
 * password: aziz123pass
 
 * email:munira_i@gmail.com
 * password: mneera12may
 
 * email:moh_ali@gmail.com
 * password:itsmoh123
 


  Maha*/
                 
 session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title> LogIn </title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="SharedStyle_1.css">
    <link rel="stylesheet" href="login.css">
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
function seekerOrowner(){
if(document.getElementById("Login").selectedIndex == 0)

location.href= "HomeSeeker.html";

if(document.getElementById("Login").selectedIndex == 1)

location.href= "Homeowner_1.html";

}
</script>

  </head>
  
  <body>

  <header>
    
   
    <div>
        <a href="index.php"><img src="logo.png" height=168 width=180 alt="LOGO"></a>
      <h1 style="font-style: italic;  font-size: 45px; font-family: Garamond, serif ;   text-shadow: 4px 5px black; 
          color:white; display:inline; position: relative; bottom: 70px; left: 30px;">
       HOUSE DEAL</h1>
    </div>
            
        

 <!-- ADD NAV AND BREADCRUMBS-->

  </header>
  
  
  <main style="height: 80%">
  <br><br>
  <fieldset>
<div class="container">
    <form method="POST" action="login.php"  >
 <div class="row">
    <div class="col-25">
    <label for="email">Email:</label>
    </div>
    <div class="col-75">
  <input type="email"  name="email" placeholder=" Your email..">
    </div>
	</div>
 <div class="row">
    <div class="col-25">
    <label for="pass">Password:</label>
    </div>
    <div class="col-75">
<input type="password"  name="pass" placeholder=" Your password..">
    </div>
	</div>
  <div class="row">
    <div class="col-25">
      <label for="loging" >Type of Log-in:</label>
    <div class="col-75">

      <select name='type' id="Login">
        <option  value="seeker">home seeker</option>
       <option   value="owner">home owner</option>
      </select>
	  </div>
	  </div>
    </div>
 
  <br>
  <div class="row" id="submit">
      <input name='loginbtn' type="submit" value="Submit">
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
        <?php //m

               
                
 require 'configuration.php';
  
               
               
 $role = filter_input(INPUT_POST, 'type');
 $uemail =filter_input(INPUT_POST, 'email');
 $upass = filter_input(INPUT_POST, 'pass');
 
                   
 if($role == 'owner')
 {                   
$query =" SELECT `email_address`, `password` FROM `Homeowner` WHERE email_address = '$uemail' ";
$sql = mysqli_query($connection, $query); 
$hashedpass = mysqli_fetch_column($sql, 1);

      if( mysqli_num_rows($sql)  > 0) //email exists in database
      {
         if(password_verify($upass, $hashedpass)) // check that entered password belong to the entered email (method used to comapre entered password with the hashed one)
         {
             if ( ( !isset($_SESSION['email'] ))) {
            $_SESSION['email'] = $uemail;
            $_SESSION['pass'] = $upass;
            $_SESSION['role']= 'owner';
           // $_SESSION['userIn'] = true; // for security(not implemented yet)
            
            $query2 =" SELECT `id` FROM `Homeowner` WHERE email_address = '$uemail' ";//already checked for password
            $sql2 = mysqli_query($connection, $query2); 
            $uID = mysqli_fetch_column($sql2, 0);
            $_SESSION['id']= $uID;
            
            /////////redirect here
             header("location:Homeowner.php");    }
             
         else{  header("location:Homeowner.php");  } 
         
         
         }// password not found
                 else{ echo '<script>alert("Sorry Invalid email and Password, please Enter Correct Credentials")</script>';}
      }// email not found (user didn't sign up)
    else { echo '<script>alert("Sorry Invalid email and Password, please Enter Correct Credentials")</script>';}

   
 }//owner done
 
 else{ 
     if($role == 'seeker')
 {                   
      $query =" SELECT `email_address`, `password` FROM `HomeSeeker` WHERE email_address = '$uemail' ";
      $sql = mysqli_query($connection, $query); 
      $hashedpass = mysqli_fetch_column($sql, 1);

      if( mysqli_num_rows($sql)  > 0) 
      {
         if(password_verify($upass, $hashedpass))
         {
             if ( ( !isset($_SESSION['email'] ))) {
            $_SESSION['email'] = $uemail;
            $_SESSION['pass'] = $upass;
            $_SESSION['role']='seeker';
          //  $_SESSION['loggedin'] = true;
            
            $query2 =" SELECT `id` FROM `HomeSeeker` WHERE email_address = '$uemail' ";//already checked for password
            $sql2 = mysqli_query($connection, $query2); 
            $uID = mysqli_fetch_column($sql2, 0);
            $_SESSION['id']= $uID;
            /////////redirect here
             header("location:HomeSeeker.php");  }
           else{  header("location:HomeSeeker.php");  }  //////check here 
        
       
         } 
         else{ echo '<script>alert("Sorry Invalid email and Password, please Enter Correct Credentials")</script>';}

    }
    
    else { 
        echo '<script>alert("Sorry Invalid email and Password, please Enter Correct Credentials")</script>';
 }}
 
    }

               
            mysqli_close($connection); ?>
               
