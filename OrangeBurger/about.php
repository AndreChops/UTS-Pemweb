<?php
    session_start();

    $log_namemail_err = $log_password_err = $log_captcha_err = $log_err_msg = "";
    if(isset($_GET['log_err']) || isset($_GET['log1_err']) || isset($_GET['log2_err']) || isset($_GET['log3_err'])){

        //Username/Email error
        if(isset($_GET['log1_err']) && $_GET['log1_err'] == 1) {
            $log_namemail_err = "*Username/email tidak boleh kosong.";
        }

        //Password error
        if(isset($_GET['log2_err']) && $_GET['log2_err'] == 1) {
            $log_password_err = "*Password tidak boleh kosong.";
        }

        //Captcha error
        if(isset($_GET['log3_err'])) {
            if($_GET['log3_err'] == 1) {
                $log_captcha_err = "*Captcha tidak boleh kosong.";
            }
            else if($_GET['log3_err'] == 2) {
                $log_captcha_err = "*Captcha tidak cocok.";
            }
            else if($_GET['log3_err'] == 3) {
                $log_captcha_err = "*Captcha error.";
            }
        }

        //Account login error
        if(isset($_GET['log_err'])) {
            if($_GET['log_err'] == 1) {
                $log_err_msg = "*Username/email belum terdaftar atau password Anda salah.";
            }
            else if($_GET['log_err'] == 2) {
                $log_err_msg = "*Terjadi kesalahan. Silahkan coba lagi.";
            }
        }
    }

    $reg_fname_err = $reg_lname_err = $reg_username_err = $reg_email_err = $reg_password_err = $reg_bdate_err = $reg_gender_err = $reg_err_msg = "";
    if(isset($_GET['reg_err']) || isset($_GET['reg1_err']) || isset($_GET['reg2_err']) || isset($_GET['reg3_err']) || isset($_GET['reg4_err']) || isset($_GET['reg5_err'])){

        //First Name error
        if(isset($_GET['reg1_err']) && $_GET['reg1_err'] == 1) {
            $reg_fname_err = "*First name tidak boleh kosong.";
        }
        
        //Last Name error
        if(isset($_GET['reg2_err']) && $_GET['reg2_err'] == 1) {
            $reg_lname_err = "*Last name tidak boleh kosong.";
        }
        
        //Username error
        if(isset($_GET['reg3_err']) && $_GET['reg3_err'] == 1) {
            $reg_username_err = "*Username tidak boleh kosong.";
        }

        //Email error
        if(isset($_GET['reg4_err'])) {
            if($_GET['reg4_err'] == 1) {
                $reg_email_err = "*Email tidak boleh kosong.";
            }
            else if($_GET['reg4_err'] == 2) {
                $reg_email_err = "*Format Email yang Anda masukkan tidak valid.";
            }
        }

        //Password error
        if(isset($_GET['reg5_err'])) {
            if($_GET['reg5_err'] == 1) {
                $reg_password_err = "*Password tidak boleh kosong.";
            }
            else if($_GET['reg5_err'] == 2) {
                $reg_password_err = "*Password harus memiliki minimal 4 karakter.";
            }
        }

        //Account register error
        if(isset($_GET['reg_err'])) {
            if($_GET['reg_err'] == 1) {
                $reg_err_msg = ''.
                '<div class="alert" style="background:#eee; padding:7px">'.
                    '<span style="color:red; font-size:0.9rem">*Akun dengan username/email tersebut telah digunakan.</span>'.
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'.
                '</div>';
            }
            else if($_GET['reg_err'] == 2) {
                $reg_err_msg = ''.
                '<div class="alert" style="background:#eee; padding:7px">'.
                    '<span style="color:red; font-size:0.9rem">*Terjadi kesalahan. Silahkan coba lagi.</span>'.
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'.
                '</div>';
            }
            else if($_GET['reg_err'] == 0) {
                $log_err_msg = ''.
                    '<div class="alert alert-info alert-block" style="background:#eee;">'.
                        '<span style="color:green; font-size:0.9rem">*Pendaftaran akun berhasil.</span>'.
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'.
                    '</div>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Website : Restoran UTS IF430 - Orange Burger</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

  </head>
    
  <body>
    <!-- ***** Login Start ***** -->
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="login.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Sign In</h4>
                        <button type="button" class="close" style="padding-top: 20px; padding-right: 18px" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <?php echo $log_err_msg; ?>
                            <div class="form-group <?php echo (!empty($log_namemail_err)) ? 'has-error' : ''; ?>">
                                <label>Username/email</label>
                                <input type="text" id="namemail" name="namemail" class="form-control" placeholder="Enter username/email">
                                <span class="help-block" style="color:red"><?php echo $log_namemail_err; ?></span>
                            </div> 
                            <div class="form-group <?php echo (!empty($log_password_err)) ? 'has-error' : ''; ?>">
                                <label>Password:</label>
                                <input type="password" id="log_password" name="log_password" class="form-control" pattern=".{4,}" placeholder="Enter password">
                                <span class="help-block" style="color:red"><?php echo $log_password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($log_captcha_err)) ? 'has-error' : ''; ?>">
                                <label>Captcha:</label>
                                <div class="container row">
                                    <input type="text" id="captcha" name="captcha" class="form-control col-5" pattern=".{6}" placeholder="Enter Captcha">
                                    <div class="col-7 row" style="margin-left:auto">
                                        <img src="captcha.php" alt="CAPTCHA" class="captcha-image col-10" style="height:38px; width:200px">
                                        <div class="refreshCaptcha" style="border:0.5px solid #ced4da; border-radius:5px; height:90%; width:15%; padding:6px 9px 10px 9px; cursor:pointer">
                                            <img src="assets/images/refresh.png" style="height:12px; width:12px">
                                        </div>
                                    </div>
                                </div>
                                <span class="help-block" style="color:red"><?php echo $log_captcha_err; ?></span>
                            </div>
                            <script>
                                var refreshCaptcha = document.querySelector(".refreshCaptcha");
                                refreshCaptcha.onclick = function() {
                                    document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
                                }
                            </script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p style="margin-right: auto">Don't have an account? <a data-toggle="modal" data-dismiss="modal" data-target="#registerModal" style="color:#ed563b">Register here.</a></p>
                        <button type="submit" class="btn btn-primary" name="submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ***** Login End ***** -->
    
    <!-- ***** Register Start ***** -->
    <div class="modal fade" id="registerModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="register.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Sign Up</h4>
                        <button type="button" class="close" style="padding-top: 20px; padding-right: 18px" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container row">
                            <div class="form-group col-6 <?php echo (!empty($reg_fname_err)) ? 'has-error' : ''; ?>">
                                <label>First Name</label>
                                <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter first name">
                                <span class="help-block" style="color:red"><?php echo $reg_fname_err; ?></span>
                            </div>
                            <div class="form-group col-6 <?php echo (!empty($reg_lname_err)) ? 'has-error' : ''; ?>">
                                <label>Last Name</label>
                                <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter last name">
                                <span class="help-block" style="color:red"><?php echo $reg_lname_err; ?></span>
                            </div>
                            <div class="form-group col-6 <?php echo (!empty($reg_username_err)) ? 'has-error' : ''; ?>">
                                <label>Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username">
                                <span class="help-block" style="color:red"><?php echo $reg_username_err; ?></span>
                            </div>
                            <div class="form-group col-6 <?php echo (!empty($reg_email_err)) ? 'has-error' : ''; ?>">
                                <label>Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                                <span class="help-block" style="color:red"><?php echo $reg_email_err; ?></span>
                            </div>
                            <div class="form-group col-6 <?php echo (!empty($reg_password_err)) ? 'has-error' : ''; ?>">
                                <label>Password</label>
                                <input type="password" id="reg_password" name="reg_password" class="form-control" placeholder="Enter password">
                                <span class="help-block" style="color:red"><?php echo $reg_password_err; ?></span>
                            </div>
                            <div class="form-group col-6 <?php echo (!empty($reg_bdate_err)) ? 'has-error' : ''; ?>">
                                <label>Birth Date</label>
                                <input type="date" id="bdate" name="bdate" class="form-control" placeholder="Enter birth date">
                                <span class="help-block" style="color:red"><?php echo $reg_bdate_err; ?></span>
                            </div>
                            <div class="form-group col-6 <?php echo (!empty($reg_gender_err)) ? 'has-error' : ''; ?>">
                                <label>Gender</label>
                                <select class="form-select form-control" aria-label="Gender selection">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="O">Other</option>
                                    <option value="U">Rather not say</option>
                                </select>
                                <span class="help-block" style="color:red"><?php echo $reg_gender_err; ?></span>
                            </div>
                            <div class="form-group col-6">
                                <span class="help-block" style="color:red; padding-top:26px"><?php echo $reg_err_msg; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p style="margin-right: auto">Already have an account? <a data-toggle="modal" data-dismiss="modal" data-target="#loginModal" style="color:#ed563b">Login here.</a></p>
                        <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ***** Register End ***** -->

    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">Orange <em> Burger</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="menu.php">Menu</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item active" href="about.php">About Us</a>
                                    <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                                </div>
                            </li>
                            <li><a href="contact.php">Contact</a></li> 
                            <?php
                                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                    echo ''.
                                    '<li class="dropdown">'.
                                        '<a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">'.$_SESSION["name"].'</a>'.
                                        '<div class="dropdown-menu">'.
                                            '<a class="dropdown-item" href="logout.php">Sign Out</a>'.
                                        '</div>'.
                                    '</li>';
                                }
                                else {
                                    echo '<li><a href="" data-toggle="modal" data-target="#loginModal">Sign In</a></li>';
                                }
                            ?>
                            <li><a href="shoppingcart.php"><i class="fa fa-shopping-cart" style="font-size:20px"></i></a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Learn more <em>About Us</em></h2>
                        <p>Ut consectetur, metus sit amet aliquet placerat, enim est ultricies ligula</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <br>
            <br>
            <br>
            <div class="row" id="tabs">
              <div class="col-lg-4">
                <ul>
                  <li><a href='#tabs-1'><i class="fa fa-soccer-ball-o"></i> Our Goals</a></li>
                  <li><a href='#tabs-2'><i class="fa fa-briefcase"></i> Our Work</a></a></li>
                  <li><a href='#tabs-3'><i class="fa fa-heart"></i> Our Passion</a></a></li>
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                  <article id='tabs-1'>
                    <img src="assets/images/about-image-1-940x460.jpg" alt="">
                    <h4>Our Goals</h4>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel aspernatur natus dignissimos eos quod, odio.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad cupiditate ullam exercitationem molestiae illum? Nam magni, saepe sint maiores vitae!</p>

                    <p>Phasellus convallis mauris sed elementum vulputate. Donec posuere leo sed dui eleifend hendrerit. Sed suscipit suscipit erat, sed vehicula ligula. Aliquam ut sem fermentum sem tincidunt lacinia gravida aliquam nunc. Morbi quis erat imperdiet, molestie nunc ut, accumsan diam.</p>
                   
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi suscipit commodi impedit unde accusantium nam incidunt tenetur, libero maiores enim! Nisi ex odit, totam nihil doloribus. Nemo ut, eos consequatur libero aut quas dolorum ipsa, quidem, totam dicta id possimus dolores distinctio laboriosam doloribus voluptates tenetur consectetur inventore aliquid dolorem?</p>
                  </article>
                  <article id='tabs-2'>
                    <img src="assets/images/about-image-2-940x460.jpg" alt="">
                    <h4>Our Work</h4>
                    <p>Integer dapibus, est vel dapibus mattis, sem mauris luctus leo, ac pulvinar quam tortor a velit. Praesent ultrices erat ante, in ultricies augue ultricies faucibus. Nam tellus nibh, ullamcorper at mattis non, rhoncus sed massa. Cras quis pulvinar eros. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque ut accusantium cum! Ad quisquam, aut praesentium magni pariatur ipsa! Soluta deserunt accusantium repellendus ratione quam hic facere, cupiditate iste obcaecati a, officiis ipsum aspernatur in?</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla a necessitatibus eos vitae quibusdam quo sunt officiis rerum voluptatibus non natus eius placeat officia vel quaerat, reprehenderit obcaecati, eaque? Repudiandae ad facere culpa accusamus aliquam ab assumenda reiciendis corrupti cum nemo, cumque molestiae corporis deserunt!</p>
                  </article>
                  <article id='tabs-3'>
                    <img src="assets/images/about-image-3-940x460.jpg" alt="">
                    <h4>Our Passion</h4>
                    <p>Fusce laoreet malesuada rhoncus. Donec ultricies diam tortor, id auctor neque posuere sit amet. Aliquam pharetra, augue vel cursus porta, nisi tortor vulputate sapien, id scelerisque felis magna id felis. Proin neque metus, pellentesque pharetra semper vel, accumsan a neque.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro aut beatae commodi repudiandae distinctio, magnam blanditiis reiciendis vitae velit voluptatum natus, fugit quis eos dolores!</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic adipisci reiciendis quaerat qui earum aut, atque esse quisquam quis exercitationem sapiente, dolorum consequatur consequuntur voluptatibus ipsam, fuga magnam beatae optio nam. Recusandae ut aliquid, eligendi.</p>
                  </article>
                </section>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Send us a <em>message</em></h2>
                        <p>Ut consectetur, metus sit amet aliquet placerat, enim est ultricies ligula, sit amet dapibus odio augue eget libero. Morbi tempus mauris a nisi luctus imperdiet.</p>
                        <div class="main-button">
                            <a href="contact.html">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2020 Company Name
                        - Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

  </body>
</html>