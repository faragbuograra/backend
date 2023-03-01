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
  ///
  <?php

include 'inc/header_dasbord.php';

Session::CheckSession();

if( Session::get("roleid") == '1'){


if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}


 ?>
 <body>
 <style>
 .container{
    background-color :#DCDCDC;
    padding-bottom:22px;
}
 </style>
<div class="container ">
<div class="card ">
      <div class="card-header ">
       <h3>Dasbord</h3>
       
        </div>
       
        </div>

         

<style>

@media only screen and (min-width: 600px) {
p5 {
    overflow: hidden;
    width: 1px;
    height: 1px;
}
.a{

}
}
</style>
 <BR>
    <p class="lead "></p>

    <div class="row a">
        <div  class="panel panel-primary filterable">
      
          <div id= "exportToTable1"  style=" background-color :#FFFF; width:100%;">
            <table   class="table table-bordered table-hover table-responsive mt-1" style=" background-color :#FFFF; width:100%;">
                <thead>
                   
                      <tr style ="background-color:#393d46;"class="text-center text-light filters" >
                      <th   style="  width:100px;" class="text-center">ID</th>
                      <th   style="  width:110px;" class="text-center">Name</th>
                      <th   style="  width:200px;" class="text-center">Username</th>
                      <th  class="text-center">Email address</th>
                      <th  class="text-center">Mobile</th>
                      <th  class="text-center">Status</th>
                      <th  class="text-center">Created</th>
                      <th   class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allUser = $users->selectAllUserData();

                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if (Session::get("id") == $value->id) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->username; ?> <br>
                          <?php if ($value->roleid  == '1'){
                          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                        } elseif ($value->roleid == '2') {
                          echo "<span class='badge badge-lg badge-primary text-white'>Store</span>";
                        }elseif ($value->roleid == '3') {
                            echo "<span class='badge badge-lg badge-dark text-white'>Delivery benghazi</span>";
                       
                      }elseif ($value->roleid == '4') {
                        echo "<span class='badge badge-lg badge-success text-white'>Manager Delivery benghazi </span>";
                         }elseif ($value->roleid == '5') {
                        echo "<span class='badge badge-lg badge-warning text-white'>TUR Warehouse </span>";
                         }elseif ($value->roleid == '6') {
                            echo "<span class='badge badge-lg badge-dark text-white'>Delivery  Tripoli</span>";
                       
                      }elseif ($value->roleid == '7') {
                        echo "<span class='badge badge-lg badge-success text-white'>Manager Delivery Tripoli </span>";
                        
                    } ?></td>
                        <td><?php echo $value->email; ?></td>

                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
                        <td>
                          <?php if ($value->isActive == '0') { ?>
                          <span class="badge badge-lg badge-info text-white">Active</span>
                        <?php }else{ ?>
                    <span class="badge badge-lg badge-danger text-white">Deactive</span>
                        <?php } ?>

                        </td>
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at);  ?></span></td>

                        <td>
                          <?php if ( Session::get("roleid") == '1') {?>
                            <a class="btn btn-success btn-sm
                            m-1" href="profile.php?id=<?php echo $value->id;?>">View</a>
                            <a class="btn btn-info btn-sm m-1" href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                            <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger m-1
                    <?php if (Session::get("id") == $value->id) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>

                             <?php if ($value->isActive == '0') {  ?>
                               <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning m-1
                       <?php if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                             <?php } elseif($value->isActive == '1'){?>
                               <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary m-1
                       <?php if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } ?>
                                btn-sm m-1" href="?active=<?php echo $value->id;?>">Active</a>
                             <?php } ?>




                        <?php  }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '2'){ ?>
                          <a class="btn btn-success btn-sm m-1 " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm m-1" href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                        <?php  }elseif( Session::get("roleid") == '2'){ ?>
                          <a class="btn btn-success btn-sm m-1
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                        <?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
                          <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                        <?php }else{ ?>
                          <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>

                        <?php } ?>

                        </td>
                      </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td>No user availabe now !</td>
                    </tr>
                    <?php } ?>

                  </tbody>

              </table>









        </div>
      </div>



  <?php
  include 'inc/footer.php';
                    }
  ?>

