<?php
require_once("./MYDB.php");
$db = db_connect();

$post_id = $_POST["post_id"];
$nick = $_POST["nick"];
$comment_id = $_POST["comment_id"];
$dept_name = $_POST["dept_name"];
$title =$_POST["title"];

?>

<p>
post_id : <?= $post_id ?> <br>
nick: <?=  $nick ?> <br>
comment_id <?= $comment_id ?> <br>
dept_name <?= $dept_name ?> <br>
</p>
<?php
try{
  print("시작");
  $db -> beginTransaction();
  $sql = "delete from comment where dept_name = '$dept_name' && post_id = $post_id && comment_id = $comment_id && comment_nickname='$nick' ";
  $stmh = $db -> query($sql);
  $db -> commit();
  print ($sql);
} catch (PDOException $Exception) {
  $db -> rollBack();
  print("오류: " .$Exception -> getMessage() );
}
header("Location:http://taeuk.run.goorm.io/webapp3/main_min/board/view.php?title=$title&post_id=$post_id");
?>


<!--
 $db -> beginTransaction();
 $sql =  "delete  from post where post_id = $post_id "; //조건은 primary로 받을것!
 $stmh = $db -> query($sql);
 $db -> commit();
 } catch(PDOException $Exception) {
   $db -> rollBack();
   print ("오류:" .$Exception -> getMessage());
 }
 header("Location:http://localhost:8888/web_board_test/%EA%B2%8C%EC%8B%9C%ED%8C%90/board.php");
-->
