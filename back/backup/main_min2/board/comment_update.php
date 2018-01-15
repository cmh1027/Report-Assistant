<?php session_start(); 
?>

<?php  // 댓글에서 번호는 그게시글번호로 하여금 추가시켜야 한다. 따로받아올순 없다.
	require_once("./MYDB.php");
	$db = db_connect();

	$dept_name = $_POST["dept_name"];
	$post_id = $_POST["post_id"];
	$user_nick = $_POST["user_nick"];
	$comment = $_POST["comment"];
	$comment_id = $_POST["comment_id"] + 1;
	$title = $_POST["title"];
?>

 <p> dept_name = <?= $dept_name; ?>// post_id = <?= $post_id; ?> // user_nick = <?= $user_nick; ?>
	//	comment = <?= $comment; ?> // title: <?= 	$title?>   <br> comment_id = <?= $comment_id ?></p>


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
header("Location:http://taeuk.run.goorm.io/webapp3/main_min/board/view.php?title=$title&post_id=$post_id");
?>
