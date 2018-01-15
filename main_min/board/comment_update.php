<!-- 댓글을 추가해주는 php입니다 -->
<?php  
	require_once("./MYDB.php");
	$db = db_connect();

	$dept_name = $_POST["dept_name"];
	$post_id = $_POST["post_id"];
	$user_nick = $_POST["user_nick"];
	$comment = $_POST["comment"];
	$comment_id = $_POST["comment_id"] + 1;
	$title = $_POST["title"];
?>


<?php
	try{
	print("시작");
	$db ->beginTransaction();
	$sql = "insert into comment values (?,?,?,?,?)";	//(dept_name, post_id , comment_id , comment_nickname , comment_content)
	$stmh = $db -> prepare($sql);
	$stmh ->bindValue(1,$dept_name,PDO::PARAM_STR);
	$stmh ->bindValue(2,$post_id,PDO::PARAM_STR);
	$stmh ->bindValue(3,$comment_id,PDO::PARAM_STR);
	$stmh ->bindValue(4,$user_nick,PDO::PARAM_STR);
	$stmh ->bindValue(5,$comment,PDO::PARAM_STR);
	$stmh -> execute();
	$db -> commit();
	print("성공");
} catch (PDOException $Exception) {
	$db -> rollBack();
	print("오류" .$Exception -> getMessage());
}
header("Location:view.php?title=$title&post_id=$post_id"); // 댓글을 넣고 게시글로 다시 돌려보냅니다..
?>
