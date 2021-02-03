<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
     <meta http-equiv="content-type" content="text/html; charset=utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>IDISCUSE FORMS</title>
     <link rel="stylesheet" href="style.css" type="text/css" media="all" />
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
     <div class="bgc"></div>
     <header>
          <div class="logo">
               <a href="#">IDISCUSE</a>
          </div>
          <nav class="nav">
               <ul>
                    <li><a href="#">Home</a></li>
                    <li class="menushow"><a>Catries<i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                         <ul class="l">
                              <li><a href="#catries">Catries</a></li>
                              <li><a href="catries/addcatries.php">Add Catries</a></li>
                         </ul>
                    </li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About Us</a></li>
                    <li class="showprofile"><a>Account<i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                         <ul class="pm">
                              <li><a href="account/profile.php">Profile</a></li>
                              <li><a href="account/login.php">Login</a></li>
                              <li><a href="account/Signup.php">Register</a></li>
                              <li><a href="account/logout.php">logout</a></li>
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
     <section>
          <div class="main">
               <h2>Welcome to Mr <?php 
               if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                    echo "User";
               }else {
                    echo $_SESSION['username'];
               }
               ?></h2>
          </div>
     </section>
     <section id="catries" class="catries">
          <div class="textbox">
               <h2><span>C</span>atries</h2>
          </div>
          <div class="catriesbox">
                    <?php    
                    include "db.php";
                    $sql = "SELECT * FROM `catries`";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                         $cat_id = $row['cat_id'];
                         $title = $row['title'];
                         $paira = $row['paira'];
                         $user = $row['username'];
                         ?>
               <div class="box">
                    <h2><?php echo $title ?><?php echo $cat_id; ?></h2>
                         <img src="https://source.unsplash.com/1600x900?/<?php echo $title; ?>, computer program>" alt="" />
                    <p><?php echo $paira ?></p>
                    <a href="catries/display/catrieslist.php?catid=<?php echo $cat_id ?>">View</a>
               </div>
               <?php
                    }
               ?>
          </div>
     </section>

          
         

     <script src="Js/Nav.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>