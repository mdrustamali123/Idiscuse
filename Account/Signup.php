<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     include "../db.php";

     $fname = $_POST["fname"];
     $lname = $_POST["lname"];
     $username = $_POST["username"];
     $email = $_POST["email"];
     $password = $_POST["password"];
     $cpassword = $_POST["cpassword"];
     $phone = $_POST["phone"];
     $address = $_POST["address"];
     $city = $_POST["city"];

     //Validation
     $name = "/^[a-zA-Z ]+$/";
     $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
     $number = "/^[0-9]+$/";

     if (empty($fname) || empty($lname) || empty($username) || empty($email) || empty($password) || empty($cpassword) || empty($phone) || empty($address) || empty($city)) {
          echo "Please fill the filed";
          exit();
     } else {
          if (!preg_match($name, $fname)) {
               echo "this $fname is not valid ..!";
               exit();
          }
          if (!preg_match($name, $lname)) {
               echo "this $lname is not valid ..!";
               exit();
          }
          if (strlen($username) < 7) {
               echo "your username less than 7 is not valid .!";
               exit();
          }
          if (!preg_match($emailValidation, $email)) {
               echo "This $email is not valid";
               exit();
          }
          if (strlen($password) < 7) {
               echo "this $password is not valid please fill the greater than 8 ..!";
               exit();
          }
          if ($password != $cpassword) {
               echo "your password is not match to Conform password ..!";
               exit();
          }
          $hash = password_hash($password, PASSWORD_DEFAULT);
          if (!preg_match($number, $phone)) {
               echo "This $phone is not valid..!";
               exit();
          }
          if (!(strlen($phone) == 10)) {
               echo "Mobile Number much to be 10 Digit..!";
               exit();
          }
          //cheak email exist
          else {
               $sql = "SELECT * FROM `userinfo` WHERE email = '$email'";
               $result = mysqli_query($conn, $sql);
               $num = mysqli_num_rows($result);
               if ($num == 1) {
                    echo "your $email all ready taken";
                    exit();
               } else {
                    $sql = "SELECT * FROM `userinfo` WHERE phone = '$phone'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    if ($num == 1) {
                         echo "your $phone all ready taken";
                         exit();
                    } else {
                         $sql = "SELECT * FROM `userinfo` WHERE username = '$username'";
                         $result = mysqli_query($conn, $sql);
                         $num = mysqli_num_rows($result);
                         if ($num == 1) {
                              echo "This $username is All ready taken ..!";
                              exit();
                         } else {
                              $sqli = "INSERT INTO `userinfo`(`fname`, `lname`, `username`, `email`, `password`, `phone`, `address`, `city`) VALUES ('$fname', '$lname', '$username', '$email', '$hash', '$phone', '$address', '$city')";
                              $result = mysqli_query($conn, $sqli);
                              if ($result) {
                                   echo "Inserted Successful";

                                   header('location: login.php');
                              } else {
                                   echo "Your data has been not inserted";
                              }
                         }
                    }

               }
          }

     }
}


?>
<!DOCTYPE html>
<html>
<head>
     <meta http-equiv="content-type" content="text/html; charset=utf-8" />
     <meta name="viewport" content="width=device-width,  initial-scale=1.0">
     <title>Lonin and Registration Pages</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>
<body>
     <header>
          <div class="logo">
               <a href="#">IDISCUSE</a>
          </div>
          <nav class="nav">
               <ul>
                    <li><a href="/idiscuse/index.php">Home</a></li>
                    <li class="menushow"><a>Catries<i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                         <ul class="l">
                              <li><a href="/index.php#catries">Catries</a></li>
                              <li><a href="/catries/addcatries.php">Add Catries</a></li>
                         </ul>
                    </li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About Us</a></li>
                    <li class="showprofile"><a>Account<i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                         <ul class="pm">
                              <li><a href="/idiscuse/account/profile.php">Profile</a></li>
                              <li><a href="/idiscuse/account/login.php">Login</a></li>
                              <li><a href="/idiscuse/account/Signup.php">Register</a></li>
                              <li><a href="/idiscuse/account/logout.php">logout</a></li>
                         </ul>
                    </li>
                    <!--  <a class="profile" href="account/profile.php"><img src="image/icon/user.png" alt="" /></a>-->
               </ul>
               <div class="searchBx">
                    <form action="" method="get" accept-charset="utf-8">
                         <input type="search" placeholder="Search Box">
                         <input class="sbtn" type="submit" name="submit" value="Submit">
                    </form>
               </div>
          </nav>
          <div id="menu">
               <div class="line1"></div>
               <div class="line2"></div>
               <div class="line3"></div>
          </div>
     </header>
     <div class="main">
          <div class="card">
               <h3> Creat a Account</h3>
               <div class="registration">
                    <form action="#" method="POST" accept-charset="utf-8">
                         <div class="input-filed">
                              <i class="fa fa-handshake-o" aria-hidden="true"></i>
                              <input type="text" name="fname" id="" maxlength="7" value="" placeholder="First Name" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-handshake-o" aria-hidden="true"></i>
                              <input type="text" name="lname" maxlength="7" id="" value="" placeholder="Last Name" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-user" aria-hidden="true"></i>
                              <input type="text" name="username" id="" value="" placeholder="Username" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                              <input type="email" name="email" id="" value="" placeholder="Email" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-lock" aria-hidden="true"></i>
                              <input type="password" name="password" id="" value="" placeholder="Password" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-lock" aria-hidden="true"></i>
                              <input type="password" name="cpassword" id="" value="" placeholder="Conform Password" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-phone" aria-hidden="true"></i>
                              <input type="number" name="phone" id="" maxlength="10" value="" placeholder="Phone" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-address-card" aria-hidden="true"></i>
                              <input type="text" name="address" id="" value="" placeholder="Address" />
                         </div>
                         <div class="input-filed">
                              <i class="fa fa-address-card" aria-hidden="true"></i>
                              <input type="text" name="city" id="" value="" placeholder="City" />
                         </div>
                         <div class="btn">
                              <input type="submit" value="Register" />
                         </div>
                         <div class="paire">
                              <p>
                                   Social Media Icon and tap to <a href="login.php">Login</a> Go to Login page
                              </p>
                         </div>
                         <div class="social-icon">
                              <i class="fa fa-facebook" aria-hidden="true"></i>
                              <i class="fa fa-google" aria-hidden="true"></i>
                              <i class="fa fa-twitter" aria-hidden="true"></i>
                              <i class="fa fa-linkedin" aria-hidden="true"></i>
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <script type="text/javascript" charset="utf-8">
          const header = () => {
               const menu = document.querySelector('#menu');
               const nav = document.querySelector('.nav');
               const list = document.querySelector('.nav li a');

               menu.addEventListener('click', () => {
                    nav.classList.toggle('active');

                    //menu style animations
                    menu.classList.toggle('close');
               });
          }

          header();
     </script>
</body>
</html>
