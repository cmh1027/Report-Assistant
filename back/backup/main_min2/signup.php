<?php
require_once 'password.php';
try{
	$db = new PDO("mysql:dbname=webapp;host=localhost", "webapp", "webapp");
	$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$email = $_POST['email'];
	$nickname = $_POST['nickname'];
	$pwd = $_POST['pwd'];
	$hash = password_hash($pwd, PASSWORD_DEFAULT, array('cost' => 10));
	
	$regExp = '/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i';
	if(! preg_match($regExp, $email)){
		print_r("이메일 형식이 맞지 않습니다.");
		return;
	}
	$regExp2 = '/\A[0-9a-zA-Z가-힣]{5,15}\z/';
	if(! preg_match($regExp2, $nickname)){
		print_r("닉네임은 5~12글자로 해주세요.");
		return;
	}
	if( $_POST['pwd-repeat'] != $pwd){
		print_r("비밀번호가 일치하지않습니다.");
		return;
	}
	$sql = "INSERT INTO signup(email,nickname,password) VALUES('$email', '$nickname', '$hash')";
	$prepare = $db->prepare($sql);
	$prepare->execute();
	
	/*
	$hash2 = password_hash($email, PASSWORD_DEFAULT, array('cost' => 10));
	$sql = "INSERT INTO hash_email VALUES('$email', '$hash2')";
	$prepare = $db->prepare($sql);
	$prepare->execute();
	*/
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
	print_r("이메일: $email \n닉네임: $nickname \n 정상 회원가입되었습니다.");
}catch(PDOException $e){
	print_r("이미 존재하는 형식입니다.");
}
exit();