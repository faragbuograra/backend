<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Session.php";
Session::init();



spl_autoload_register(function($classes){

  include 'classes/'.$classes.".php";
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  // Session::set('logout', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  // <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  // <strong>Success !</strong> You are Logged Out Successfully !</div>');
  Session::destroy();
}

});


$users = new Users();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LBY</title>

  

   
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
   <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <!-- Favicons <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
<link rel="stylesheet" href="assets/bootstrap.min.css">
  <link rel="stylesheet" href="assets/style.css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="filter.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
 
   <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> 

  
 <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">

  
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
 Vendor CSS Files -->
 <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
 <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="assets/css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- =======================================================
  * Template Name: MyResume - v4.7.0
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<i class="bi bi-list mobile-nav-toggle d-xl-none " ></i>
  <!-- ======= Mobile nav toggle button ======= -->
  <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->
  <header id="header" class="d-flex flex-column justify-content-center">

    <nav id="navbar" class="navbar nav-menu">
      <ul>
 <?php if (Session::get('id') != TRUE) { ?>
       <li >            
<a class="nav-link" href="login.php"><i class="bx bx-home "></i><span> Login</span></a>
</li> 
<?php  } ?>
      <?php if (Session::get('id') == TRUE) { ?>
       <li >            
<a class="nav-link" href="index.php"><i class="bx bx-home "></i><span> home </span></a>
</li> 
 <?php if (Session::get('roleid') == '3'  ||Session::get('roleid') == '6' || Session::get('roleid') == '1' ){ ?>
   <li >            
<a class="nav-link" href="Received_item.php"><span class="iconify" data-icon="icon-park-outline:delivery"></span><span> receive item </span></a>
</li> 
 <?php } ?>
            <?php if (Session::get('roleid') == '2') { ?>

             
  <li >            
<a class="nav-link" href="additem.php"><i class="bx bx-file-blank "> </i><span>Add item </span></a>
</li> 
   <?php  }?>
<?php if (Session::get('roleid') == '1') { ?>
              <li >
 
                  <a class="nav-link nav-link scrollto" href="dasbord.php"><i class="bx bx-user"></i><span>Dasbord </span></a>
                 
              </li>
                <li >
             
                  <a class="nav-link nav-link scrollto" href="addmoney.php"> <i class="bx bx-money"></i><span>Deposit WhitDraw </span></a>
       
 
                
               </li>
                <li >
            

<a class="nav-link" href="mark.php"><i><span class="iconify" data-icon="bxs:ship"></span></i><span>Shipments weight </span></a>

 </li>
              <li class="nav-item">

<a class="nav-link" href="additem.php"><i class="bx bx-file-blank "></i><span>Add item </span></a>

</li>
              <li class="nav-item"

              <?php

                          $path = $_SERVER['SCRIPT_FILENAME'];
                          $current = basename($path, '.php');
                          if ($current == 'addUser') {
                            echo " active ";
                          }

                         ?>">

                <a class="nav-link" href="QR.php"><i class="bx bx-code plus mr-2"></i><span>  QR </span></a>
               
              </li>
            <?php  } ?>

            <li class="nav-item
            <?php

      				$path = $_SERVER['SCRIPT_FILENAME'];
      				$current = basename($path, '.php');
      				if ($current == 'profile') {
      					echo "active ";
      				}

      			 ?>

            ">

           

                    		
            <a class="nav-link" href="?action=logout"><i class="bx bx-log-out mr-2 "></i><span>Logout</a>
            </li>
          <?php }else{ ?>

              <li class="nav-item

              <?php

                          $path = $_SERVER['SCRIPT_FILENAME'];
                          $current = basename($path, '.php');
                          if ($current == 'register') {
                            echo " active ";
                          }

                         ?>">
          <?php } ?>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->
  </section><!-- End Hero -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
  <script src="filter.js" defer></script>
