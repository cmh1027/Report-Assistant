<?php  // 데이터베이스를 담당하는 php 입니다. dbname 에 해당 테이블명을 지정해주면 이용이 가능합니다.


function db_connect(){
  try {
    $db = new PDO("mysql:dbname=webapp;host=localhost","webapp","webapp");
    $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $Exception){
        die("오류:" . $Exception ->getMessage());
      }
      return $db;
    }
?>
