<!--  게시글을 삭제하는 php 입니다.
	title , post_id ,dept_name 을 받아옵니다.

-->

<?php
  require_once("MYDB.php");
  $db = db_connect();
  $title = $_REQUEST["title"];
  $post_id = $_REQUEST["post_id"];
  $dept_name = $_REQUEST["dept_name"];
  try{ 
    $db -> beginTransaction();
    $sql =  "delete from post where post_id = $post_id && title = '$title' && dept_name = '$dept_name' "; 
    $stmh = $db -> query($sql);
    $db -> commit();
    } catch(PDOException $Exception) {
      $db -> rollBack();
      print ("오류:" .$Exception -> getMessage());
    }
    echo ("<meta http-equiv='Refresh' content='0; URL=mainboard.php'>");
  ?>
