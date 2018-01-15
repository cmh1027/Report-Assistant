<?php
require_once 'password.php';
try{
	$db = new PDO("mysql:dbname=webapp;host=localhost", "webapp", "webapp");
	$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$email = $_POST['modify_email'];
	$pwd = $_POST['modify_pwd'];
	$pwd_r = $_POST['modify_pwd_r'];
	$hash = password_hash($pwd, PASSWORD_DEFAULT, array('cost' => 10));
	if( $pwd_r != $pwd){
		print_r("비밀번호가 일치하지않습니다.");
		header('Location: pwd_reset.php');
		exit();
	}
	
	$sql = "update signup set password = '$hash' where email= '$email'";
	$prepare = $db->prepare($sql);
	$prepare->execute();
	//$sql = "INSERT INTO signup(email,nickname,password) VALUES($_POST['email'], $_POST['nickname'], $_POST['pwd'])";
	//$prepare = $db->prepare($sql);
	//$prepare->execute();
	/*
	$sql = 'SELECT * FROM test';
	$prepare = $db->prepare($sql);
	$prepare->bindValue(':name', 'taeuk', PDO::PARAM_STR);
  	$prepare->execute();
	$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $key => $val){
		foreach($val as $name => $value){
			print_r($value);	
		}
	}
	*/
	print_r("패스워드 변경완료");
	header('Location: index.php');
}catch(PDOException $e){
	print_r("에러");
	//header('Location: index.php');
}
exit();