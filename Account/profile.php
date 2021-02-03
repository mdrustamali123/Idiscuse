<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     echo "go to Login page ";
     header('location: login.php');
     exit();
}else {
     include "../db.php";
     $id = $_SESSION['user_id'];
     $sql = "SELECT * FROM `userinfo` WHERE id = '$id'";
     $result = mysqli_query($conn, $sql);
     while($row = mysqli_fetch_assoc($result)){
          $fname = $row['fname'];
          $lname = $row['lname'];
          $username = $row['username'];
          $email = $row['email'];
          $phone = $row['phone'];
          $address = $row['address'];
          $city = $row['city'];
          
     }
     $sqlimg = "SELECT * FROM `userimage` WHERE user_id = '$id'";
     $resultimg = mysqli_query($conn, $sqlimg);
     while($row = mysqli_fetch_assoc($resultimg))
     $image = $row['image'];
}

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="assets/css/styles.css">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <title>Portfolio responsive complete</title>
        <style>
             .about__img .file::before{
               content: '\f030';
               font-family: fontAwesome;
               font-size: 50px;
               color: #fff;
          }
        </style>
    </head>
    <body>
        <!--===== HEADER =====-->
        <header class="l-header">
            <nav class="nav bd-grid">
                <div>
                    <a href="#" class="nav__logo">IDISCUSE</a>
                </div>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="../index.php" class="nav__link active">Home</a></li>
                        <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
                        <li class="nav__item"><a href="#skills" class="nav__link">Skills</a></li>
                        <li class="nav__item"><a href="#portfolio" class="nav__link">Portfolio</a></li>
                     <!--   <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>-->
                        <li class="nav__item"><a href="logout.php" class="nav__link">Logout</a></li>
                    </ul>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>

        <main class="l-main">
            <!--===== HOME =====-->
            <section class="home" id="home">
                <div class="home__container bd-grid">
                    <h1 class="home__title"><span><?php echo $fname; ?></span><br><?php echo $lname; ?>.</h1>

                    <div class="home__scroll">
                        <a href="#about" class="home__scroll-link"><i class='bx bx-up-arrow-alt' ></i>Scroll down</a>
                    </div>

                    <img src="assets/img/perfil.png" alt="" class="home__img">
                </div>
            </section>
            
            <!--===== ABOUT =====-->
            <section class="about section" id="about">
                <h2 class="section-title">About</h2>

                <div class="about__container bd-grid">
                    <div class="about__img">
                        <img src="<?php echo $image; ?>" alt="">
                         <form action="#" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                              <input type="file" name="file" value="" class="file"/>
                              <input type="submit" name="submit" id="submit" value="Upload" class="upload" />
                         </form>
                    </div>
                    
                         <?php
                         include "../db.php";
                         
                         if (isset($_POST['submit'])) {
                              $files = $_FILES['file'];
                              
                              $filename = $files['name'];
                              $fileerror = $files['error'];
                              $filetmp = $files['tmp_name'];
                              
                              $fileext = explode('.',$filename);
                              $filecheck = strtolower(end($fileext));
                              
                              $fileextstrong = array ('png', 'jpg', 'jpeg');
                              
                              if (in_array($filecheck,$fileextstrong)) {
                                   $dentanision = 'upload/'.$filename;
                                   move_uploaded_file($filetmp,$dentanision);
                                   
                                   $q = "INSERT INTO `userimage`(`user_id`, `username`, `image`, `email`) VALUES ('$id', '$username' , '$dentanision' ,'$email')";
                                   $query = mysqli_query($conn, $q);
                                   if ($query) {
                                        header('location: ../index.php');
                                   }else {
                                        echo "nooooo";
                                   }
                              }
                              
                         }
                         
                         
                         ?>

                    <div>
                        <h2 class="about__subtitle">I'am <?php echo $_SESSION['username']; ?></h2>
                        <span class="about__profession">Web designer</span>
                        <p class="about__text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci consectetur, architecto quas fugiat, iste inventore facere repellendus delectus id, vitae blanditiis.</p>

                        <div class="about__social">
                            <a href="#" class="about__social-icon"><i class='bx bxl-linkedin' ></i></a>
                            <a href="#" class="about__social-icon"><i class='bx bxl-github' ></i></a>
                            <a href="#" class="about__social-icon"><i class='bx bxl-dribbble' ></i></a>
                        </div>
                    </div>
                </div>
            </section>

            <!--===== SKILLS =====-->
            <section class="skills section" id="skills">
                <h2 class="section-title">Skills</h2>

                <div class="skills__container bd-grid">
                    <div class="skills__box">
                        <h3 class="skills__subtitle">Development</h3>
                        <span class="skills__name">Html</span>
                        <span class="skills__name">Css</span>
                        <span class="skills__name">Javascript</span>
                        <span class="skills__name">Scss</span>
                        <span class="skills__name">React</span>
                        <span class="skills__name">Vue</span>
                        
                        <h3 class="skills__subtitle">Design</h3>
                        <span class="skills__name">Figma</span>
                        <span class="skills__name">Adobe XD</span>
                        <span class="skills__name">Photoshop</span>
                    </div>

                    <div class="skills__img">
                        <img src="assets/img/skill.jpg" alt="">
                    </div>
                </div>
            </section>

            <!--===== PORTFOLIO =====-->
            <section class="portfolio section" id="portfolio">
                <h2 class="section-title">Portfolio</h2>

                <div class="portfolio__container bd-grid">
                    <div class="portfolio__img">
                        <img src="assets/img/work1.jpg" alt="">

                        <div class="portfolio__link">
                            <a href="#" class="portfolio__link-name">View details</a>
                        </div>
                    </div>
                    <div class="portfolio__img">
                        <img src="assets/img/work2.jpg" alt="">

                        <div class="portfolio__link">
                            <a href="#" class="portfolio__link-name">View details</a>
                        </div>
                    </div>
                    <div class="portfolio__img">
                        <img src="assets/img/work3.jpg" alt="">

                        <div class="portfolio__link">
                            <a href="#" class="portfolio__link-name">View details</a>
                        </div>
                    </div>
                    <div class="portfolio__img">
                        <img src="assets/img/work4.jpg" alt="">

                        <div class="portfolio__link">
                            <a href="#" class="portfolio__link-name">View details</a>
                        </div>
                    </div>
                    <div class="portfolio__img">
                        <img src="assets/img/work5.jpg" alt="">

                        <div class="portfolio__link">
                            <a href="#" class="portfolio__link-name">View details</a>
                        </div>
                    </div>
                    <div class="portfolio__img">
                        <img src="assets/img/work6.jpg" alt="">

                        <div class="portfolio__link">
                            <a href="#" class="portfolio__link-name">View details</a>
                        </div>
                    </div>
                </div>
            </section>

            <!--===== CONTACT =====-->
            <section class="contact section" id="contact">
                <h2 class="section-title">Personal Information</h2>

                <div class="contact__container bd-grid">
                    <div class="contact__info">
                        <h3 class="contact__subtitle">Name</h3>
                        <span class="contact__text"><?php echo $fname; ?>&nbsp;<?php echo $lname; ?></span>
                        <h3 class="contact__subtitle">EMAIL</h3>
                        <span class="contact__text"><?php echo $email; ?></span>

                        <h3 class="contact__subtitle">PHONE</h3>
                        <span class="contact__text">+91<?php echo $phone; ?></span>

                        <h3 class="contact__subtitle">ADRESS</h3>
                        <span class="contact__text"><?php echo $address; ?></span>
                        <h3 class="contact__subtitle">City</h3>
                        <span class="contact__text"><?php echo $city; ?></span>
                    </div>
<!--
                    <form action="" class="contact__form">
                        <div class="contact__inputs">
                            <input type="text" placeholder="Name" class="contact__input">
                            <input type="mail" placeholder="Email" class="contact__input">
                        </div>

                        <textarea name="" id="" cols="0" rows="10" class="contact__input"></textarea>

                        <input type="submit" value="Enviar" class="contact__button">
                    </form>-->
                </div>
            </section>
        </main>

        <!--===== FOOTER =====-->
        <footer class="footer section">
            <div class="footer__container bd-grid">
                <div class="footer__data">
                    <h2 class="footer__title">JHON DOE</h2>
                    <p class="footer__text">I'm Jhon Doe and this is my personal website</p>
                </div>

                <div class="footer__data">
                    <h2 class="footer__title">EXPLORE</h2>
                    <ul>
                        <li><a href="#home" class="footer__link">Home</a></li>
                        <li><a href="#about" class="footer__link">About</a></li>
                        <li><a href="#skills" class="footer__link">Skills</a></li>
                        <li><a href="#portfolio" class="footer__link">Portfolio</a></li>
                        <li><a href="#Contact" class="footer__link">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer__data">
                    <h2 class="footer__title">FOLLOW</h2>
                    <a href="#" class="footer__social"><i class='bx bxl-facebook' ></i></a>
                    <a href="#" class="footer__social"><i class='bx bxl-instagram' ></i></a>
                    <a href="#" class="footer__social"><i class='bx bxl-twitter' ></i></a>
                </div>


            </div>
        </footer>

        <!--===== SCROLL REVEAL =====-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
    </body>
</html>