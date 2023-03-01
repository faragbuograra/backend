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
