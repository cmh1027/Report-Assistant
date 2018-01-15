<?php
  require_once("MYDB.php");
  $db = db_connect();
  $title = $_REQUEST["title"];
  $post_id = $_REQUEST["post_id"];
  print $title;
  print $post_id;
  try{
    print "시작";
    $db -> beginTransaction();
    $sql =  "delete  from post where post_id = $post_id "; //조건은 primary로 받을것!
    $stmh = $db -> query($sql);
    $db -> commit();
    } catch(PDOException $Exception) {
      $db -> rollBack();
      print ("오류:" .$Exception -> getMessage());
    }
    echo ("<meta http-equiv='Refresh' content='0; URL=mainboard.php'>");
  ?>
