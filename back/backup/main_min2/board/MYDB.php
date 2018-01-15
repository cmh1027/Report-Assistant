<?php
function db_connect(){
  try {
    $db = new PDO("mysql:dbname=webapp;host=localhost","webapp","webapp");
    $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    print "데이터베이스에 접속하였습니다.";
    //print DB_success
  }catch(PDOException $Exception){
        die("오류:" . $Exception ->getMessage());
      }
      return $db;
    }
?>
