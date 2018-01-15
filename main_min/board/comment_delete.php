<!-- 댓글을 삭제해주는 php 입니다. 해당 게시물이 있는 리스트와 post_id ,nick을 받아서 구별합니다 -->

<?php
require_once("./MYDB.php");
$db = db_connect();

$post_id = $_POST["post_id"];
$nick = $_POST["nick"];
$comment_id = $_POST["comment_id"];
$dept_name = $_POST["dept_name"];
$title =$_POST["title"];

?>

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
header("Location:view.php?title=$title&post_id=$post_id"); // 게시글로 다시 돌아가게 합니다.
?>


