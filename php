<?php

include 'lib/Database.php';
include_once 'lib/Session.php';



class Users{


  // Db Property
  private $db;
  
  
  // Db __construct Method
  public function __construct(){
    $this->db = new Database();
  }

  // Date formate Method
   public function formatDate($date){
     date_default_timezone_set('Africa/Tripoli');
      $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
   }


     
    
    public function image5($itemid, $data){
     
    

    }

  // Check Exist Email Address Method
  public function checkExistEmail($email){
    $sql = "SELECT email from  tbl_users WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }

public function additem($data){
 
       $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
   
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $SHIPNG = '0';
  $SIP_ARIS_NO ='0';
  $CODE =   $data['CODE'];
  $TESTLIMAT =  '0';
  $SIZE =   $data['SIZE'];
  $COLOER =   $data['COLOER'];
  $CASE1 = $data['CASE1'];
  $facebook =   $data['facebook'];
  $Addrees =   $data['Addrees'];
  $name =   $data['name'];
  $phone =   '+218'.$data['phone'];
  $description =   $data['description'];
  $dcost =   $data['dcost'];
   $total =   $data['total'];
$dtz = new DateTimeZone("Africa/Tripoli");
$dt = new DateTime("now", $dtz);
     $order_date=$dt->format("Y-M-d") . " " . $dt->format("H:i:s");
  $note =   $data['note'];
  $withdelivery  =  (int) $total+ (int) $dcost ;
  $PPP  = $data['PPP'];
  $shipplice  = $data['shipplice'];
  $a4 ='0';
 
  $sId = Session::get('roleid');

   if ($sId == 1  ) {
  
  $a4  = $data['a4'];
  $username = $data['username'];
 

}else{
    $username = Session::get('username');
}



  $price = $data['price'];
   
  if ($a4 ==1){
  $a1=0;
  $a3=1;
  $a4=1;
  } else{
   
  $a1=1;
  $a3=0;
   
  }
  
  function getRandomStr($n) { 
    // Store all possible letters in a string.
    $str = '0123456789'; 
    $randomStr = ''; 
  
    // Generate a random index from 0 to the length of the string -1.
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($str) - 1); 
        $randomStr .= $str[$index]; 
    } 
    $username1 = Session::get('username');
    return $username1[0].'-'. $randomStr; 
} 

$n=9; 
$a= getRandomStr( $n); 


  $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];    
          $folder = "image/".$a.'.PNG';
  try {

 
  
  if (move_uploaded_file($tempname, $folder))  {
    $msg = "Image uploaded successfully";
  }else{
    $msg = "Failed to upload image";
  }

   $sql = "INSERT INTO items_list(LINK1,SHIPNG, SIP_ARIS_NO, CODE, TESTLIMAT, SIZE, COLOER, CASE1, Facebook, Addrees, name, phone,description, dcost,  total,  note, withdelivery, a1, a3, a4, username, shipplice, price, filename,order_date) VALUES(:PPP, :SHIPNG, :SIP_ARIS_NO, :CODE, :TESTLIMAT, :SIZE, :COLOER, :CASE1, :facebook, :Addrees, :name, :phone, :description,  :dcost,  :total,  :note, :withdelivery, :a1, :a3, :a4, :username, :shipplice, :price, '$a.PNG',:order_date)";
  // use exec() because no results are returned
   $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':PPP', $PPP);
             $stmt->bindValue(':SHIPNG', $SHIPNG);
          $stmt->bindValue(':SIP_ARIS_NO', $SIP_ARIS_NO);
          $stmt->bindValue(':CODE', $CODE);
          $stmt->bindValue(':TESTLIMAT', $TESTLIMAT);
          $stmt->bindValue(':SIZE', $SIZE);
          $stmt->bindValue(':COLOER', $COLOER);
          $stmt->bindValue(':CASE1', $CASE1);
          $stmt->bindValue(':facebook', $facebook);
          $stmt->bindValue(':Addrees', $Addrees);
          
          $stmt->bindValue(':name', $name);
  
          $stmt->bindValue(':phone', $phone);
            $stmt->bindValue(':description', $description);
          $stmt->bindValue(':dcost', $dcost);
          $stmt->bindValue(':total', $total);
          $stmt->bindValue(':note', $note);
          $stmt->bindValue(':withdelivery', $withdelivery);
          $stmt->bindValue(':a1', $a1);
          $stmt->bindValue(':a3', $a3);
          $stmt->bindValue(':a4', $a4);
          $stmt->bindValue(':username', $username);
          $stmt->bindValue(':shipplice', $shipplice);
          $stmt->bindValue(':price', $price);
                  $stmt->bindValue(':order_date', $order_date);
         $result = $stmt->execute();
 $sql1= "INSERT INTO item(code,ppp, username) VALUES( :CODE,' add item ', :username)";
  // use exec() because no results are returned
   $stmt= $this->db->pdo->prepare($sql1);
          $stmt->bindValue(':username', $username);
          
          $stmt->bindValue(':CODE', $CODE);
      
      
         $result = $stmt->execute();

header("LOCATION: https://lbylogistics.com/list.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//require_once ('vendor/autoload.php'); // if you use Composer
require('whatapp/ultramsg.class.php'); // if you download ultramsg.class.php

$ultramsg_token="rajoxqpf5e0v2j7c"; // Ultramsg.com token
$instance_id="13086"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

$to=$phone;
$body = "شركة LBY للشحن تعلمكم بأنه تم التأكيد لنا من قبل متجر $username  على طلبكم ✅📦
". PHP_EOL .
"————————-". PHP_EOL .
          "يمكنكم ايضا معرفة تفاصيل الطلبية عن طريق هذا رابط" . PHP_EOL . 
          "https://lbylogistics.com/index2.php?active=$CODE" . PHP_EOL .
"🔸سنواصل إفادتكم بكل ما يتعلق بالطلبية 🔸" ;

$api=$client->sendChatMessage($to,$body);

  
  } catch(PDOException $e) {
  echo $e->getMessage();
  echo '<div class="alert alert-danger alert-dismissible my-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> يوجد خطأ في بيانات!</div><bR>
  <bR>
  <bR>';
  
  }
  
  $conn = null;
  }

public function addBlock($data){
 
       $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
   
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 
   $UserName=   $data['UserName'];
   $phone=   $data['Phone'];
   $Note=   $data['Note'];
$dtz = new DateTimeZone("Africa/Tripoli");
$dt = new DateTime("now", $dtz);
     $order_date=$dt->format("Y-m-d") . " " . $dt->format("H:i:s");
 $a= time();
       $Store= Session::get('username');


  $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];    
          $folder = "image/".$a.'.PNG';
  try {

 
  
  if (move_uploaded_file($tempname, $folder))  {
    $msg = "Image uploaded successfully";
  }else{
    $msg = "Failed to upload image";
  }

   $sql = "INSERT INTO Block(Store,UserName,phone,Image,Note,Time) VALUES(:Store, :UserName, :phone, '$a.PNG' , :Note, :order_date)";
  // use exec() because no results are returned
   $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':Store', $Store);
             $stmt->bindValue(':UserName', $UserName);
          $stmt->bindValue(':phone', $phone);
          $stmt->bindValue(':Note', $Note);
          $stmt->bindValue(':order_date', $order_date);
        
         $result = $stmt->execute();
 
header("LOCATION: https://lbylogistics.com");

  
  } catch(PDOException $e) {
  echo $e->getMessage();
  echo '<div class="alert alert-danger alert-dismissible my-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> يوجد خطأ في بيانات!</div><bR>
  <bR>
  <bR>';
  
  }
  
  $conn = null;
  }






   
  // User Registration Method
  public function userRegistration($data){
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];
    $password = $data['password'];

    $checkEmail = $this->checkExistEmail($email);

    if ($name == "" || $username == "" || $email == "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
        return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    }elseif (filter_var($mobile,FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
        return $msg;

    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Password at least 6 Characters !</div>';
        return $msg;
    }elseif(!preg_match("#[0-9]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
        return $msg;
    }elseif(!preg_match("#[a-z]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
        return $msg;
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
        return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
        return $msg;
    }else{

      $sql = "INSERT INTO tbl_users(name, username, email, password, mobile, roleid) VALUES(:name, :username, :email, :password, :mobile, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> Wow, you have Registered Successfully !</div>';
          return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong !</div>';
          return $msg;
      }



    }





  }
  // Add New User By Admin
  public function addNewUserByAdmin($data){
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];
    $password = $data['password'];

    $checkEmail = $this->checkExistEmail($email);

    if ($name == "" || $username == "" || $email == "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Input fields must not be Empty !</div>';
        return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    }elseif (filter_var($mobile,FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
        return $msg;

    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Password at least 6 Characters !</div>';
        return $msg;
   
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
        return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
        return $msg;
    }else{

      $sql = "INSERT INTO tbl_users(name, username, email, password, mobile, roleid) VALUES(:name, :username, :email, :password, :mobile, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="/dasbord.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> Wow, you have Registered Successfully !</div>';
          return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong !</div>';
          return $msg;
      }



    }





  }

 public function addmoney($data){

$dtz = new DateTimeZone("Africa/Tripoli");
$dt = new DateTime("now", $dtz);
     $order_date=$dt->format("Y-m-d") . " " . $dt->format("H:i:s");
      $username1 =  $data['username1'] ;
   if ($username1  == "null" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <strong>Error !</strong> Please,  field must not be Empty !</div>';
        return $msg;
   }
    $moneyly = $data['moneyly'] ;
$moneytr =  $data['moneytr'];
$moneyus =  $data['moneyus'];
 $moneyly2 = $data['moneyly2'] ;
$moneytr2 =  $data['moneytr2'];
$moneyus2 =  $data['moneyus2'];
$note =  $data['note'];
if ($moneyly == ""){
   $moneyly = 0; 
}
if ($moneyly2 == ""){
   $moneyly2 =0;
}
    
    if ($moneytr == ""){
   $moneytr =0; 
}
    
    if ($moneytr2 == ""){
   $moneytr2 =0;
}
    
    if ($moneyus == ""){
   $moneyus =0; 
}
    
    if ($moneyus2 == ""){
   $moneyus2 =0; 
}
    
      $sql = "INSERT INTO shopmonay(shopname,monayly,monayus,monaytr,moneyly2,moneyus2,moneytr2,note,created_at) VALUES(:username1, :moneyly, :moneyus, :moneytr, :moneyly2, :moneyus2, :moneytr2, :note ,:created_at)";

      $stmt = $this->db->pdo->prepare($sql);
   $stmt->bindValue(':username1', $username1);
      $stmt->bindValue(':moneyly', $moneyly);
      $stmt->bindValue(':moneytr', $moneytr);
      $stmt->bindValue(':moneyus', $moneyus);
      $stmt->bindValue(':moneyly2', $moneyly2);
      $stmt->bindValue(':moneytr2', $moneytr2);
      $stmt->bindValue(':moneyus2', $moneyus2);
        $stmt->bindValue(':note', $note);
 $stmt->bindValue(':created_at', $order_date);
      $result = $stmt->execute();
       echo 'farag';
      if ($result) {
     $host='waleedziou50305.domaincommysql.com';
  $user ='waleedziou50305';
  $dbname = 'test';
  $password= 'Lbyziou218+';
  date_default_timezone_set('Africa/Tripoli');

  $con = mysqli_connect($host, $user, $password,$dbname);
  // Check connection
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
    $username1 = $_POST['username1'];
  $moneyly = $_POST['moneyly'] ;
$moneytr =  $_POST['moneytr'];
$moneyus =  $_POST['moneyus'];
 $moneyly2 = $_POST['moneyly2'] ;
$moneytr2 =  $_POST['moneytr2'];
$moneyus2 =  $_POST['moneyus2'];
$note =  $_POST['note'];

  $query = mysqli_query($con, "SELECT * from tbl_users where username ='$username1'");
  
  $result = mysqli_fetch_assoc($query);
  
  
$moneyly =  (int) $_POST['moneyly'] + (int) $result['moneyly'];
$moneytr = (int) $_POST['moneytr']+ (int) $result['moneytr'];
$moneyus =  (int) $_POST['moneyus']+ (int) $result['moneyus'];
$moneyly2 =  (int) $_POST['moneyly2'] + (int) $result['moneyly2'];
$moneytr2 = (int) $_POST['moneytr2']+ (int) $result['moneytr2'];
$moneyus2 =  (int) $_POST['moneyus2']+ (int) $result['moneyus2'];

  $query1 = mysqli_query($con, "UPDATE tbl_users SET moneyly= '$moneyly', moneytr= '$moneytr' ,moneyus='$moneyus',moneyly2= '$moneyly2', moneytr2= '$moneytr2' ,moneyus2='$moneyus2'  WHERE username = '$username1'");
    $result1 = mysqli_fetch_assoc($query1);

  $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="/WalletTransacitons.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> </div>';
          return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong !</div>';
          return $msg;
      }



    





  }


  // Select All User Method
  public function selectAllUserData(){
    $sql = "SELECT * FROM tbl_users ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Select All mark Method
  public function selectAllUserData2(){
    $sql = "SELECT * FROM tbl_users  ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectAllmarkdata(){
    $sql = "SELECT * FROM mark_accounting  ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

   public function selectAllshop(){
    $sql = "SELECT * FROM shopmonay  ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   public function list1(){
    $sql = "SELECT * FROM item  ORDER BY id DESC  LIMIT 400 ";
    $stmt = $this->db->pdo->prepare($sql); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllshop1($username){
          $username1 = Session::get('username');
    $sql = "SELECT * FROM shopmonay  where shopname = '$username1' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   // Select All user Method
   public function selectAllUserData3(){
    $sql = "SELECT * FROM tbl_users  where roleid='3' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Select All item Method table 1
  public function selectAllitemData() {
    $sql = "SELECT * FROM items_list where a1='1' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllitemData1($username) {
    $sql = "SELECT * FROM items_list where a1='1'and username= '$username' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAlliship($shipplice) {
    $sql = "SELECT * FROM items_list where a3 = '1' and shipplice ='$shipplice'  GROUP BY SHIPNG ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
 
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAlliship1($SHIPNG) {
    $sql = "SELECT * FROM items_list GROUP BY SHIPNG having a3 = '1'and  SHIPNG= $SHIPNG ORDER BY id DESC ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
 
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Select All item Method table 4 in adrres
  public function selectAlliship0() {
    $sql = "SELECT * FROM items_list GROUP BY shipplice ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
 
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Select All item Method table 2
  public function selectAllitemData2($username) {
    $sql = "SELECT * FROM items_list where a2='1' and username='$username' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllitemData200() {
    $sql = "SELECT * FROM items_list where a2='1'  ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   // Select All item Method table wait
  public function selectAllitemwait($shipplice) {
    $sql = "SELECT * FROM items_list where a2='2' and shipplice ='$shipplice'  ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   public function selectAllitemwait00($shipplice) {
        $username1 = Session::get('username');
    $sql = "SELECT * FROM items_list where a2='2' and shipplice ='$shipplice' and username= '$username1'   ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllitemwaitship() {
    $sql = "SELECT * FROM items_list GROUP BY shipplice having  (shipplice ='1' || shipplice ='2')  ORDER BY id DESC ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllitemwaitship5 () {
      $sql = "SELECT * FROM items_list GROUP BY shipplice having  (shipplice ='1' || shipplice ='2')   ORDER BY id DESC ";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllitemShop() {
      $sql = "SELECT COUNT(id) AS NumberOfOrders, username FROM items_list WHERE a2='1' GROUP BY username ORDER BY `items_list`.`id` ASC ";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllitemShopNEW() {
      $sql = "SELECT COUNT(id) AS NumberOfOrders, username FROM items_list WHERE a1='1' GROUP BY username ORDER BY `items_list`.`id` ASC";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllitemShopNEW5($shipplice) {
      $sql = "SELECT COUNT(id) AS NumberOfOrders ,username FROM items_list WHERE a4='1' and shipplice =$shipplice  GROUP BY username ORDER BY `items_list`.`id` ASC";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllitemShop1NEW5($shipplice) {
      $sql = "SELECT COUNT(id) AS NumberOfOrders , username FROM items_list WHERE a4='1' and shipplice =$shipplice ORDER BY `items_list`.`id` ASC";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllitemShopNEW6($shipplice) {
      $sql = "SELECT COUNT(id) AS NumberOfOrders ,username FROM items_list WHERE a3='1' and shipplice =$shipplice  GROUP BY username ORDER BY `items_list`.`id` ASC";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllitemShop1NEW6($shipplice) {
      $sql = "SELECT COUNT(id) AS NumberOfOrders , username FROM items_list WHERE a3='1' and shipplice =$shipplice ORDER BY `items_list`.`id` ASC";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   public function selectAllitemShop1() {
      $sql = "SELECT COUNT(id) AS NumberOfOrders  FROM items_list WHERE a2='1'   ORDER BY `items_list`.`id` ASC ";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   public function selectAllitemShop1New() {
      $sql = "SELECT COUNT(id) AS NumberOfOrders , username  FROM items_list WHERE a1='1'   ORDER BY id ASC ";
    $stmt = $this->db->pdo->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllitemData2o($username) {
    $sql = "SELECT * FROM items_list where a2='1' and username ='$username' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Select All item Method table 3
  public function selectAllitemData3() {
    $sql = "SELECT * FROM items_list where a3='1' and username ='$username' and a4='1' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllblock() {
    $sql = "SELECT * FROM Block ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  
   // Select All item Method table 4
  public function selectAllitemData4($shipplice) {
    $sql = "SELECT * FROM items_list where a4='1' and  shipplice = '$shipplice'    ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   public function selectAllitemData44($shipplice) {
    $sql = "SELECT * FROM items_list where a4='1' and  shipplice = '$shipplice'   ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllitemData4o($shipplice,$username) {
    $sql = "SELECT * FROM items_list where a4='1' and  shipplice = '$shipplice' and username ='$username' ORDER BY id DESC ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllitemData3o($shipplice,$username) {
    $sql = "SELECT * FROM items_list where a4='1' and  shipplice = '$shipplice' and user ='$username' ORDER BY id DESC ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   // Select All accounting Method
   public function selectAllaccounting($username1) {
      $username1 = Session::get('username');
    $sql = "SELECT * FROM user_accounting where username='$username1' and a1=0 ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllaccounting1() {
    $username1 = Session::get('username');
    $sql = "SELECT * FROM user_accounting ORDER BY id1 DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
 public function selectAllaccounting19() {
    $username1 = Session::get('username');
    $sql = "SELECT * FROM user_accounting where a1='1' ORDER BY id1 DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   public function selectAllaccounting01() {
    $username1 = Session::get('username');
    $sql = "SELECT * FROM user_accounting ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   public function selectAllaccounting11() {
    $username1 = Session::get('username');
    $sql = "SELECT * FROM user_accounting where markname='$username1' and a1='1' ORDER BY id1 DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllaccounting2() {
    $username1 = Session::get('username');
    $sql = "SELECT * FROM user_accounting where roleid ='6' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectAllaccounting3() {
    $username1 = Session::get('username');
    $sql = "SELECT * FROM user_accounting where roleid ='3'ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   // Select ship item Method admin
   public function selectSHIPNGData($a) {
    $sql = "SELECT * FROM items_list where a3='1' and shipplice = '$a' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
    public function selectSHIPNGData0($a) {
    $sql = "SELECT * FROM items_list where a3='1' and shipplice = '2' and a4='1' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
     public function selectSHIPNGData00($a) {
    $sql = "SELECT * FROM items_list where a3='1' and shipplice = '1'  and a4='1' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   // Select ship item Method mark
  public function selectSHIPNGData1($username,$a) {
    $sql = "SELECT * FROM items_list where  username ='$username' and a3='1' and shipplice = '$a' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
   // Select ship item Method user
   public function selectSHIPNGData2($username,$a) {
    $sql = "SELECT * FROM items_list where  user ='$username' and a3='1' and shipplice = '$a' and a4='1'  ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // User login Autho Method
  public function userLoginAutho($email, $password){
    $password = SHA1($password);
    $sql = "SELECT * FROM tbl_users WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  // Check User Account Satatus
  public function CheckActiveUser($email){
    $sql = "SELECT * FROM tbl_users WHERE email = :email and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }




    // User Login Authotication Method
    public function userLoginAuthotication($data){
      $email = $data['email'];
      $password = $data['password'];


      $checkEmail = $this->checkExistEmail($email);

      if ($email == "" || $password == "" ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Email or Password not be Empty !</div>';
          return $msg;

      }elseif ($checkEmail == FALSE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Email did not Found, use Register email or password please !</div>';
          return $msg;
      }else{


        $logResult = $this->userLoginAutho($email, $password);
        $chkActive = $this->CheckActiveUser($email);

        if ($chkActive == TRUE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Sorry, Your account is Diactivated, Contact with Admin !</div>';
            return $msg;
        }elseif ($logResult) {

          Session::init();
          Session::set('login', TRUE);
          Session::set('id', $logResult->id);
          Session::set('roleid', $logResult->roleid);
          Session::set('name', $logResult->name);
          Session::set('email', $logResult->email);
          Session::set('username', $logResult->username);
          Session::set('logMsg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> You are Logged In Successfully !</div>');
          echo "<script>location.href='index.php';</script>";

        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Email or Password did not Matched !</div>';
            return $msg;
        }

      }


    }



    // Get Single User Information By Id Method
    public function getUserInfoById($userid){
      $sql = "SELECT * FROM tbl_users WHERE id = :id LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $userid);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }


    }



  //
  //   Get Single User Information By Id Method
    public function updateUserByIdInfo($userid, $data){
      $name = $data['name'];
      $username = $data['username'];
      $email = $data['email'];
      $mobile = $data['mobile'];
      $roleid = $data['roleid'];



      if ($name == "" || $username == ""|| $email == "" || $mobile == ""  ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Input Fields must not be Empty !</div>';
          return $msg;
        }elseif (strlen($username) < 3) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
            return $msg;
        }elseif (filter_var($mobile,FILTER_SANITIZE_NUMBER_INT) == FALSE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Enter only Number Characters for Mobile number field !</div>';
            return $msg;


      }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Invalid email address !</div>';
          return $msg;
      }else{

        $sql = "UPDATE tbl_users SET
          name = :name,
          username = :username,
          email = :email,
          mobile = :mobile,
          roleid = :roleid
          WHERE id = :id";
          $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':name', $name);
          $stmt->bindValue(':username', $username);
          $stmt->bindValue(':email', $email);
          $stmt->bindValue(':mobile', $mobile);
          $stmt->bindValue(':roleid', $roleid);
          $stmt->bindValue(':id', $userid);
        $result =   $stmt->execute();

        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');



        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted !</div>');


        }


      }


    }
     //   Get Single item Information By Id Method
     public function getitemInfoById($itemid){
      $sql = "SELECT * FROM items_list WHERE id = :id LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $itemid);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }}
       public function getitemInfoBycode($itemid){
      $sql = "SELECT * FROM items_list WHERE CODE = :CODE LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':CODE', $itemid);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }}
     
    
    //   Get Single item Information By Id Method
    public function updateitemByIdInfo($itemid, $data){
        $LINK1 = $data['LINK1'];
        $description= $data['description'];
  
        $SIP_ARIS_NO = $data['SIP_ARIS_NO'];
       $shipplice= $data['shipplice'];
        $CODE  = $data['CODE'];  
        $TESTLIMAT  = $data['TESTLIMAT'];
        $SIZE = $data['SIZE'];
        $coloer = $data['coloer'];
        $case1 = $data['CASE1'];
  $SHIPNG= $data['SHIPNG'];
  
        $Facebook  = $data['facebook'];
        $Addrees  = $data['Addrees'];
        $name = $data['name'];
        $phone  = $data['phone'];
      $dtz = new DateTimeZone("Africa/Tripoli");
  $dt = new DateTime("now", $dtz);
       $order_date=$dt->format("Y-m-d") . " " . $dt->format("H:i:s");
      
         $dcost  = $data['dcost'];
        
        $total = $data['total'];
        
          $price = $data['price'];
  
           $withdelivery  = (int) $total +(int) $dcost;
  
  
  
    
  
   
  
        if ($SIZE == "" ||  $CODE== "" || $total == ""  ) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Input Fields must not be Empty !</div>';
            return $msg;
         
        }else{
  
          $sql = "UPDATE items_list SET
          LINK1 = :LINK1,
      SHIPNG= :SHIPNG,
  
          SIP_ARIS_NO = :SIP_ARIS_NO,
            CODE  = :CODE ,
            TESTLIMAT  = :TESTLIMAT ,
            SIZE = :SIZE,
            coloer = :coloer,
            case1 = :case1,
            Facebook = :Facebook,
            Addrees  = :Addrees ,
             name = :name,
            phone = :phone,
  description = :description,
   
            dcost = :dcost,
     total = :total,
   withdelivery = :withdelivery,
   shipplice = :shipplice,
     price = '$price' ,
  
            order_date =:order_date
            WHERE id = $itemid";
            $stmt= $this->db->pdo->prepare($sql);
            $stmt->bindValue(':LINK1', $LINK1);
    $stmt->bindValue(':SHIPNG', $SHIPNG);
  
            $stmt->bindValue(':SIP_ARIS_NO', $SIP_ARIS_NO);
           
            $stmt->bindValue(':CODE', $CODE);
            $stmt->bindValue(':TESTLIMAT', $TESTLIMAT);
            $stmt->bindValue(':SIZE', $SIZE);
            $stmt->bindValue(':coloer', $coloer);
            $stmt->bindValue(':case1', $case1);
            $stmt->bindValue(':Facebook', $Facebook);
            $stmt->bindValue(':Addrees', $Addrees);
            
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':phone', $phone);
     $stmt->bindValue(':description', $description);
            $stmt->bindValue(':dcost', $dcost);
     
            $stmt->bindValue(':total', $total);
  
            $stmt->bindValue(':withdelivery', $withdelivery);
     $stmt->bindValue(':shipplice', $shipplice);
     $stmt->bindValue(':order_date', $order_date);
    $username = Session::get('username');
          $result = $stmt->execute();
  $sql1= "INSERT INTO item(code,ppp, username) VALUES( :CODE,' edit item ', :username)";
    // use exec() because no results are returned
     $stmt= $this->db->pdo->prepare($sql1);
            $stmt->bindValue(':username', $username);
            
            $stmt->bindValue(':CODE', $CODE);
        
        
           $result = $stmt->execute();
          if ($result) {
            echo'<script>
    window.history.go(-2);
  </script>
  ';
  
  
  
          }else{
            echo  '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Data not inserted !</div>';
  
          }
  
  
  
   
  if( !empty( $_FILES[ "uploadfile" ]["name"] ) ){
  
  function getRandomStr($n) { 
      // Store all possible letters in a string.
      $str = '0123456789'; 
      $randomStr = ''; 
    
      // Generate a random index from 0 to the length of the string -1.
      for ($i = 0; $i < $n; $i++) { 
          $index = rand(0, strlen($str) - 1); 
          $randomStr .= $str[$index]; 
      } 
      $username1 = Session::get('username');
      return $username1[0].'-'. $randomStr; 
  } 
  
  $n=8; 
  $a= getRandomStr( $n); 
   
      
  $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];    
            $folder = "image/".$a.'.PNG';
  $img=$a.'.PNG';
    if (move_uploaded_file($tempname, $folder))  {
    echo "Upload image";
    };
   $sql = "UPDATE items_list SET
    
          filename=:filename
            WHERE id = $itemid";
            $stmt= $this->db->pdo->prepare($sql);   
           
       $stmt->bindValue(':filename', $img);
  
          $result = $stmt->execute();
  
        
  
  }
        }
  
  
      }
      //
      public function updateitemByIdInfo0($itemid, $data){
        $LINK1 = $data['LINK1'];
        $description= $data['description'];
  
        $SIP_ARIS_NO = $data['SIP_ARIS_NO'];
       $shipplice= $data['shipplice'];
        $CODE  = $data['CODE'];  
        $TESTLIMAT  = $data['TESTLIMAT'];
        $SIZE = $data['SIZE'];
        $coloer = $data['coloer'];
        $case1 = $data['CASE1'];
  $SHIPNG= $data['SHIPNG'];
  
        $Facebook  = $data['facebook'];
        $Addrees  = $data['Addrees'];
        $name = $data['name'];
        $phone  = $data['phone'];
      $dtz = new DateTimeZone("Africa/Tripoli");
  $dt = new DateTime("now", $dtz);
       $order_date=$dt->format("Y-m-d") . " " . $dt->format("H:i:s");
      
         $dcost  = $data['dcost'];
        
        $total = $data['total'];
        
       
  
           $withdelivery  = (int) $total +(int) $dcost;
  
  
  
    
  
   
  
        if ($SIZE == "" ||  $CODE== "" || $total == ""  ) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Input Fields must not be Empty !</div>';
            return $msg;
         
        }else{
  
          $sql = "UPDATE items_list SET
          LINK1 = :LINK1,
      SHIPNG= :SHIPNG,
  
          SIP_ARIS_NO = :SIP_ARIS_NO,
            CODE  = :CODE ,
            TESTLIMAT  = :TESTLIMAT ,
            SIZE = :SIZE,
            coloer = :coloer,
            case1 = :case1,
            Facebook = :Facebook,
            Addrees  = :Addrees ,
             name = :name,
            phone = :phone,
  description = :description,
   
            dcost = :dcost,
     total = :total,
   withdelivery = :withdelivery,
   shipplice = :shipplice,
  
            order_date =:order_date
            WHERE id = $itemid";
            $stmt= $this->db->pdo->prepare($sql);
            $stmt->bindValue(':LINK1', $LINK1);
    $stmt->bindValue(':SHIPNG', $SHIPNG);
  
            $stmt->bindValue(':SIP_ARIS_NO', $SIP_ARIS_NO);
           
            $stmt->bindValue(':CODE', $CODE);
            $stmt->bindValue(':TESTLIMAT', $TESTLIMAT);
            $stmt->bindValue(':SIZE', $SIZE);
            $stmt->bindValue(':coloer', $coloer);
            $stmt->bindValue(':case1', $case1);
            $stmt->bindValue(':Facebook', $Facebook);
            $stmt->bindValue(':Addrees', $Addrees);
            
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':phone', $phone);
     $stmt->bindValue(':description', $description);
            $stmt->bindValue(':dcost', $dcost);
     
            $stmt->bindValue(':total', $total);
  
            $stmt->bindValue(':withdelivery', $withdelivery);
     $stmt->bindValue(':shipplice', $shipplice);
     $stmt->bindValue(':order_date', $order_date);
    $username = Session::get('username');
          $result = $stmt->execute();
  $sql1= "INSERT INTO item(code,ppp, username) VALUES( :CODE,' edit item ', :username)";
    // use exec() because no results are returned
     $stmt= $this->db->pdo->prepare($sql1);
            $stmt->bindValue(':username', $username);
            
            $stmt->bindValue(':CODE', $CODE);
        
        
           $result = $stmt->execute();
          if ($result) {
            echo'<script>
    window.history.go(-2);
  </script>
  ';
  
  
  
          }else{
            echo  '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Data not inserted !</div>';
  
          }
  
  
  
   
  if( !empty( $_FILES[ "uploadfile" ]["name"] ) ){
  
  function getRandomStr($n) { 
      // Store all possible letters in a string.
      $str = '0123456789'; 
      $randomStr = ''; 
    
      // Generate a random index from 0 to the length of the string -1.
      for ($i = 0; $i < $n; $i++) { 
          $index = rand(0, strlen($str) - 1); 
          $randomStr .= $str[$index]; 
      } 
      $username1 = Session::get('username');
      return $username1[0].'-'. $randomStr; 
  } 
  
  $n=8; 
  $a= getRandomStr( $n); 
   
      
  $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];    
            $folder = "image/".$a.'.PNG';
  $img=$a.'.PNG';
    if (move_uploaded_file($tempname, $folder))  {
    echo "Upload image";
    };
   $sql = "UPDATE items_list SET
    
          filename=:filename
            WHERE id = $itemid";
            $stmt= $this->db->pdo->prepare($sql);   
           
       $stmt->bindValue(':filename', $img);
  
          $result = $stmt->execute();
  
        
  
  }
        }
  
  
      }
      //
// select user
    public function updateitemByIdInfo2($itemid, $data){
    
      $note  = $data['note']; 
      $user  = $data['user']; 
      $sql = "UPDATE items_list SET
        note = :note,
        user = :user
        WHERE id = $itemid ";
         $stmt= $this->db->pdo->prepare($sql);
        $stmt->bindValue(':note', $note);
        $stmt->bindValue(':user', $user);
      $result = $stmt->execute();

      if ($result) {
        echo '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Wow, Your Information updated Successfully !</div>';
        echo "<script>location.href='#';</script>";


      }else{
        echo '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Data not inserted !</div>';


      }


    }

    public function updateitemByIdInfo1($itemid, $data){
    
        $note  = $data['note']; 
        
        $sql = "UPDATE items_list SET
          note = :note
          WHERE id = $itemid";
           $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':note', $note);
           $username = Session::get('username');
        $result = $stmt->execute();

        if ($result) {
          echo  '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, Your Information updated Successfully !</div>';



        }else{
          echo'<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted !</div>';


        }


      }

    



    // Delete User by Id Method
    public function deleteUserById($remove){
      $sql = "DELETE FROM tbl_users WHERE id = :id ";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> User account Deleted Successfully !</div>';
            return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not Deleted !</div>';
            return $msg;
        }
    }
    public function deletemarkById($remove){
      $sql = "DELETE FROM mark_accounting WHERE id = :id ";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> User account Deleted Successfully !</div>';
            return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not Deleted !</div>';
            return $msg;
        }
    }

    // User Deactivated By Admin
    public function userDeactiveByAdmin($deactive){
      $sql = "UPDATE tbl_users SET

       isActive=:isActive
       WHERE id = :id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isActive', 1);
       $stmt->bindValue(':id', $deactive);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href='dasbord.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> User account Diactivated Successfully !</div>');

        }else{
          echo "<script>location.href='dasbord.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not Diactivated !</div>');

            return $msg;
        }
    }


    // User Deactivated By Admin
    public function userActiveByAdmin($active){
      $sql = "UPDATE tbl_users SET
       isActive=:isActive
       WHERE id = :id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isActive', 0);
       $stmt->bindValue(':id', $active);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href=#';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> User account activated Successfully !</div>');
        }else{
          echo "<script>location.href='#';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not activated !</div>');
        }
    }




    // Check Old password method
    public function CheckOldPassword($userid, $old_pass){
      $old_pass = SHA1($old_pass);
      $sql = "SELECT password FROM tbl_users WHERE password = :password AND id =:id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $old_pass);
      $stmt->bindValue(':id', $userid);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
    }



    // Change User pass By Id
    public  function changePasswordBysingelUserId($userid, $data){

      $old_pass = $data['old_password'];
      $new_pass = $data['new_password'];


      if ($old_pass == "" || $new_pass == "" ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Password field must not be Empty !</div>';
          return $msg;
      }elseif (strlen($new_pass) < 6) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> New password must be at least 6 character !</div>';
          return $msg;
       }

         $oldPass = $this->CheckOldPassword($userid, $old_pass);
         if ($oldPass == FALSE) {
           $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Error !</strong> Old password did not Matched !</div>';
             return $msg;
         }else{
           $new_pass = SHA1($new_pass);
           $sql = "UPDATE tbl_users SET

            password=:password
            WHERE id = :id";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':password', $new_pass);
            $stmt->bindValue(':id', $userid);
            $result =   $stmt->execute();

          if ($result) {
            echo "<script>location.href='#';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Great news, Password Changed successfully !</div>');

          }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Password did not changed !</div>';
              return $msg;
          }

         }



    }
     // sent to table2
    public function sent1($active){
      $servername = "waleedziou50305.domaincommysql.com";
    $username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
  $usernameid = Session::get('username');
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $con = mysqli_connect($servername, $username, $password,$dbname);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE items_list SET a2='1',a1='0',CASE1='done' WHERE id= $active";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
$query = mysqli_query($con, "SELECT  CODE,total,Addrees,name,username,phone from items_list  WHERE id= $active");
  
  $result = mysqli_fetch_assoc($query);
   $a=$result['CODE'];
$CODE=$result['CODE'];
   $total=$result['total'];
   $Addrees=$result['Addrees'];
   $name=$result['name'];
   $username=$result['username'];
   $phone=$result['phone'];
     $sql1= "INSERT INTO item(code,ppp, username) VALUES( :CODE,' Sent to turwarehouse ', :usernameid)";
  // use exec() because no results are returned
   $stmt= $this->db->pdo->prepare($sql1);
          $stmt->bindValue(':usernameid', $usernameid);
          
          $stmt->bindValue(':CODE', $a);
      
      
         $result = $stmt->execute();


require('whatapp/ultramsg.class.php'); // if you download ultramsg.class.php

$ultramsg_token="rajoxqpf5e0v2j7c"; // Ultramsg.com token
$instance_id="13086"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);
$to= $phone; 
$body = "شركة LBY للشحن تعلمكم بوصول طلبكم الي مخازن الشركة في تركيا 🇹🇷 
وسيتم شحن الطلبية الي ليبيا 🇱🇾 خلال ثلاث ايام كحد اقصي". PHP_EOL .
"————————-". PHP_EOL .
          "يمكنكم ايضا معرفة تفاصيل الطلبية عن طريق هذا رابط" . PHP_EOL . 
          "https://lbylogistics.com/index2.php?active=$a" . PHP_EOL .

"🔸سنواصل إفادتكم بكل ما يتعلق بالطلبية 🔸" ;

$api=$client->sendChatMessage($to,$body);

echo "<script>location.href='list.php?username="+ $username +"';</script>";
  
    
     
    }
    // sent to table wait
    public function sent2($active){
       $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
  $usernameid = Session::get('username');
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $con = mysqli_connect($servername, $username, $password,$dbname);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE items_list SET a2='2' WHERE id= $active";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
$query = mysqli_query($con, "SELECT  CODE from items_list  WHERE id= $active");
  
  $result = mysqli_fetch_assoc($query);
   $a=$result['CODE'];
     echo  $a; 

     $sql1= "INSERT INTO item(code,ppp, username) VALUES( :CODE,' Sent to Shipping', :usernameid)";
  // use exec() because no results are returned
   $stmt= $this->db->pdo->prepare($sql1);
          $stmt->bindValue(':usernameid', $usernameid);
          
          $stmt->bindValue(':CODE', $a);
      
      
         $result = $stmt->execute();

          echo "<script>location.href='#.php';</script>";
    
     
    }
    // sent to table 3
    public function sent3($active){
    $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
      
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE items_list SET a3='1',a2='0', a4='1' WHERE id= $active";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
    
   
      $con = mysqli_connect($servername, $username, $password,$dbname);
        // Check connection
        if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
        }
         
      $query = mysqli_query($con, "SELECT * from items_list where id ='$active'");
        
        $result = mysqli_fetch_assoc($query);
         $a=$result['shipplice'];
         if($a=='2'){
 echo "<script>location.href='wait.php?shipplice= 2';</script>";
         }
          if($a=='1'){
 echo "<script>location.href='wait.php?shipplice= 1';</script>";
         }
     
          
    }

    public function dn($active){
      Session::CheckSession();
if( !empty( $active) )
{
      $usernameid = Session::get('username');
      if (isset($_GET['id'])) {
        $itemid = preg_replace('/[^a-zA-Z0-9-]/', ' ', (int)$_GET['id']);
       
       
      }
     $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";

         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $con = mysqli_connect($servername, $username, $password,$dbname);
        // Check connection
        if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $query = mysqli_query($con, "SELECT * from user_accounting where id ='$active'");
        
        $result = mysqli_fetch_assoc($query);
         $a=$result['markname'];
         $b=$result['username'];
         $c=$result['itemcode'];
 $ic=$result['a1'];
if($ic==0){

         $query0 = mysqli_query($con, "SELECT * from items_list where  CODE ='$c'");
        $result0 = mysqli_fetch_assoc($query0);
    if($result0['shipplice'] == '1' ||$result0['shipplice'] == '4') {
        $query1 = mysqli_query($con, "SELECT * from tbl_users where  username ='$usernameid'");
        $result1 = mysqli_fetch_assoc($query1);
      
        $moneyly = (int) $result1['moneyly']+ (int) $result['price'];
     
      
      $query2 = mysqli_query($con, "UPDATE tbl_users SET moneyly= '$moneyly'  WHERE username = '$usernameid'");
        $query3 = mysqli_query($con, "SELECT * from tbl_users where username = '$a'");
        $result3 = mysqli_fetch_assoc($query3);
        $moneyly = (int) $result3['moneyly']+ (int) $result['price'];
        $query4 = mysqli_query($con, "UPDATE tbl_users SET moneyly= '$moneyly'  WHERE username = '$a'");
         $query10 = mysqli_query($con, "SELECT max(id1) from user_accounting where  markname ='$a'");
        $result10 = mysqli_fetch_assoc($query10);
        $oo= (int) $result10['max(id1)']+ (int) '1';
          $query44 = mysqli_query($con, "UPDATE user_accounting SET moneylya= '$moneyly',id1='$oo'  WHERE itemcode = '$c'");
        $query5 = mysqli_query($con, "SELECT * from tbl_users where username = '$b'");
        $result5 = mysqli_fetch_assoc($query5);
        $moneyly = $result5['moneyly'] -(int) $result['price'];
      $query6 = mysqli_query($con, "UPDATE tbl_users SET moneyly= '$moneyly'  WHERE username = '$b'");
          $query9 = mysqli_query($con, "UPDATE items_list SET  a4='2',case2='done' where CODE = '$c'");
       
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE user_accounting SET a1='1' WHERE id= $active";
    }
        if($result0['shipplice'] == '2' ||$result0['shipplice'] == '3') {
   
        $query1 = mysqli_query($con, "SELECT * from tbl_users where  username ='$usernameid'");
        $result1 = mysqli_fetch_assoc($query1);
      
        $moneyly2 = (int) $result1['moneyly2']+ (int) $result['price'];
     
      
      $query2 = mysqli_query($con, "UPDATE tbl_users SET moneyly2= '$moneyly2'  WHERE username = '$usernameid'");
        $query3 = mysqli_query($con, "SELECT * from tbl_users where username = '$a'");
        $result3 = mysqli_fetch_assoc($query3);
        $moneyly2 = (int) $result3['moneyly2']+ (int) $result['price'];
        $query4 = mysqli_query($con, "UPDATE tbl_users SET moneyly2= '$moneyly2'  WHERE username = '$a'");
          $query10 = mysqli_query($con, "SELECT max(id1) from user_accounting where  markname ='$a'");
        $result10 = mysqli_fetch_assoc($query10);
        $oo= (int) $result10['max(id1)']+ (int) '1';
           $query44 = mysqli_query($con, "UPDATE user_accounting SET moneyly2a= '$moneyly2', id1='$oo'  WHERE itemcode = '$c'");
        $query5 = mysqli_query($con, "SELECT * from tbl_users where username = '$b'");
        $result5 = mysqli_fetch_assoc($query5);
        $moneyly2 = $result5['moneyly2'] -(int) $result['price'];
      $query6 = mysqli_query($con, "UPDATE tbl_users SET moneyly2= '$moneyly2'  WHERE username = '$b'");
       $query9 = mysqli_query($con, "UPDATE items_list SET  a4='2',case2='done' where CODE = '$c'");
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE user_accounting SET a1='1' WHERE id= $active";
      }
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();

      echo "<script>location.href='/Accounting.php'</script>";
    }
}
 }   
    public function delete1($delete){
if( !empty($delete ) )
{
     $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
$con = mysqli_connect($servername, $username, $password,$dbname);
  // Check connection
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $query = mysqli_query($con, "SELECT * from user_accounting where id ='$delete'");
  
  $result = mysqli_fetch_assoc($query);

   $a=$result['markname'];
   $b=$result['username'];
       $c=$result['itemcode'];
         $query0 = mysqli_query($con, "SELECT * from items_list where  CODE ='$c'");
        $result0 = mysqli_fetch_assoc($query0);
$query5 = mysqli_query($con, "UPDATE items_list SET  case2='working' WHERE CODE = '$c'");
    if($result0['shipplice'] == '1' || $result0['shipplice'] == '4') {
   $query1 = mysqli_query($con, "SELECT * from tbl_users where  username ='$b'");
  $result1 = mysqli_fetch_assoc($query1);
   $moneyly = (int) $result1['moneyly'] - (int) $result['price'];
   $query4 = mysqli_query($con, "UPDATE tbl_users SET moneyly= '$moneyly'  WHERE username = '$b'");
   $query5 = mysqli_query($con, "UPDATE items_list SET  case2='working' WHERE CODE = '$c'");


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM user_accounting
WHERE  id = $delete";
$stmt = $conn->prepare($sql);

// execute the query
$stmt->execute();
    }
     if($result0['shipplice'] == '2' || $result0['shipplice'] == '3') {
   $query1 = mysqli_query($con, "SELECT * from tbl_users where  username ='$b'");
  $result1 = mysqli_fetch_assoc($query1);
   $moneyly2 = (int) $result1['moneyly2'] - (int) $result['price'];
   $query4 = mysqli_query($con, "UPDATE tbl_users SET moneyly2= '$moneyly2'  WHERE username = '$b'");
   $query5 = mysqli_query($con, "UPDATE items_list SET case2='working'  WHERE CODE = '$c'");


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM user_accounting
WHERE  id = $delete";
$stmt = $conn->prepare($sql);

// execute the query
$stmt->execute();
    }
  $username = Session::get('username');
$sql1= "INSERT INTO item(code,ppp, username) VALUES( :CODE,' delete item from acc ', :username)";
  // use exec() because no results are returned
   $stmt= $this->db->pdo->prepare($sql1);
          $stmt->bindValue(':username', $username);
          
          $stmt->bindValue(':CODE', $$c);
      
      
         $result = $stmt->execute();
// Prepare statement
  echo "<script>location.href='/Accounting.php'</script>";
    
     }
    }
    public function delete2($delete){
      Session::CheckSession();

      $usernameid = Session::get('username');
    
      $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
$con = mysqli_connect($servername, $username, $password,$dbname);
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $query = mysqli_query($con, "SELECT  CODE,shipplice,a2 from items_list  WHERE id= $delete");
  
  $result = mysqli_fetch_assoc($query);
   $a=$result['CODE'];
   $a2=$result['a2'];
   $shipplice=$result['shipplice'];
     echo  $a; 
      $sql = "delete FROM items_list  WHERE id= $delete";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
  $username = Session::get('username');
$sql1= "INSERT INTO item(code,ppp, username) VALUES( :CODE,' delete item ', :username)";
  // use exec() because no results are returned
   $stmt= $this->db->pdo->prepare($sql1);
          $stmt->bindValue(':username', $username);
          
          $stmt->bindValue(':CODE', $a);
      
      
         $result = $stmt->execute();
         if($shipplice=='1' && $a2==2){
            echo "<script>location.href='/wait.php?shipplice=%201'</script>"; 
         }
         if($shipplice=='2' && $a2==2){
            echo "<script>location.href='/wait.php?shipplice=%202'</script>"; 
         }
         echo "<script>location.href=#</script>"; 
  }

 public function be($active){
    $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
      
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE items_list SET shipplice='4' WHERE id= $active";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
    
    
 echo "<script>location.href='shippeditem.php?shipplice= 1';</script>";
       
    
     
          
    }
public function tp($active){
    $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
       $con = mysqli_connect($servername, $username, $password,$dbname);
        // Check connection
        if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
        }
         
      $query = mysqli_query($con, "SELECT * from items_list where id ='$active'");
        
        $result = mysqli_fetch_assoc($query);
         $a=$result['shipplice'];
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE items_list SET shipplice='3' WHERE id= $active";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
    
         
         if($a=='4'){
 echo "<script>location.href='shippeditem.php?shipplice= 4';</script>";
         }
          if($a=='3'){
 echo "<script>location.href='shippeditem.php?shipplice= 3';</script>";}
     
           
    
     
          
   
  
          
    }
    public function tp1($active){
$servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";

      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE items_list SET shipplice='2' ,user='0',Facebook='/',Addrees='/',name='/',phone='0',total='0',dcost='0',note='/' WHERE id= $active";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
    
          
     echo "<script>location.href='shippeditem.php?shipplice= 3';</script>";
          
    }
     public function tp2($active,$shipplice){
    $servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
      $con = mysqli_connect($servername, $username, $password,$dbname);
        // Check connection
        if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
        }
         
      $query = mysqli_query($con, "SELECT * from items_list where id ='$active'");
        
        $result = mysqli_fetch_assoc($query);
         $a=$result['shipplice'];
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE items_list SET shipplice='1',user='0',Facebook='/',Addrees='/',name='/',phone='0',total='0',dcost='0',note='/' WHERE id= $active";
      
      // Prepare statement
      $stmt = $conn->prepare($sql);
      
      // execute the query
      $stmt->execute();
    
     
         if($a=='4'){
 echo "<script>location.href='shippeditem.php?shipplice= 4';</script>";
         }
          if($a=='2'){
 echo "<script>location.href='shippeditem.php?shipplice= 2';</script>";}
     
           
    
     
          
    }
   
        

}
////
<?php


define('DB_HOST', 'waleedziou50305.domaincommysql.com');
define('DB_NAME', 'test');
define('DB_USER', 'waleedziou50305');
define('DB_PASS', 'Lbyziou218+');
$servername = "waleedziou50305.domaincommysql.com";
$username = "waleedziou50305";
$password = "Lbyziou218+";
$dbname = "test";
//<?php

include "config/config.php";


// Class Databse

class  Database{

  public $pdo;


  // Construct Class
  public function __construct(){

    if (!isset($this->pdo)) {
      try {
        
        $link = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASS);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->exec("SET CHARACTER SET utf8");
        $this->pdo  =  $link;
      } catch (PDOException $e) {
        die("Connection error...".$e->getMessage());
      }

    }


  }








}
<?php

// Class Name: Session

class Session{


  // Session Start Method
  public static function init(){

    if (version_compare(phpversion(), '5.4.0', '<')) {
      if (session_id() == '') {
     session_start([
    'cookie_lifetime' => 86400,
]);
      }
    }else{
      if (session_status() == PHP_SESSION_NONE) {
        session_start([
    'cookie_lifetime' => 86400,
]);
      }
    }



  }


  // Session Set Method
  public static function set($key, $val){
    $_SESSION[$key] = $val;
  }



  // Session Get Method
  public static function get($key){
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }else{
      return false;
    }
  }

  // User logout Method
  public static function destroy(){
    session_destroy();
    session_unset();
    header('Location:login.php');
  }


  // Check Session Method
  public static function CheckSession(){
    if (self::get('login') == FALSE) {
      session_destroy();
      header('Location:login.php');
    }
  }


  // Check Login Method
  public static function CheckLogin(){
    if (self::get("login") == TRUE) {
      header('Location:index.php');
    }
  }







}

