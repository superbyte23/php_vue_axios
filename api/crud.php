<?php
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname = "vuedb"; 
$id = '';

$con = mysqli_connect($host, $user, $password,$dbname);
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET') {
  if (isset($_GET['ID'])) {  // get single data
      $sql = "select * from contacts where id =".$_GET['ID'];
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) { 
          echo json_encode(mysqli_fetch_object($result));  
      }
  }elseif (isset($_GET['destroy'])) {  // get single data
      $sql = "DELETE FROM `contacts` WHERE `id` =".$_GET['destroy'];
      $result = mysqli_query($con, $sql);
      if ($result) { 
          echo json_encode(['msg'=> 'Data deleted successfully']); 
      }
  }else{  // get all data
    $sql = "select * from contacts";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo "[";
      for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
          echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
        }
      echo "]";
    }
  }
}elseif($method == 'POST'){ // insert data
  if (isset($_POST)) {
    foreach ($_POST as $key => $value) {
      if (!$value || $value == "") {
        echo json_encode(['msg'=> 'Please fill in required inputs']); 
        die(mysqli_error($con));
      }
    }
    $name = $_POST["name"];
    $email = $_POST["email"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $job = $_POST["job"]; 
    $sql = "insert into contacts (name, email, city, country, job) values ('$name', '$email', '$city', '$country', '$job')";
    $result = mysqli_query($con,$sql); 
    // die if SQL statement failed
    if (!$result) {
      http_response_code(404);
      die(mysqli_error($con));
    }else{
      echo json_encode(['msg'=> 'Success']); 
    }
  }
}

$con->close();