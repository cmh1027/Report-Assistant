<?php
try{
	/*
	$db = new PDO("mysql:dbname=webapp;host=localhost", "webapp", "webapp");
	$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$em = $_POST['pwd_email'];
	$sql = "SELECT * FROM hash_email where email = '$em'";
	$prepare = $db->prepare($sql);
  	$prepare->execute();
	$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $key => $val){
		foreach($val as $name => $value){
			if($name == 'email'){
				$email_p = $value;	
			}else if($name == 'pwdemail'){
				$pwdemail = $value;
			}			
		}
	}
	var_dump($pwdemail);
	*/
}catch(PDOException $e){
	print_r("SQL 에러");
}
?>
<script src="https://smtpjs.com/smtp.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
var j$ = jQuery;
</script>
<script>
j$('#pass_submit').click( function(){
	console.log(j$('#pass_email')[0].value);
	//console.log("<?=$pwdemail?>");
	Email.send("webteamproject@naver.com",	//보내는 이메일 계정
			j$('#pass_email')[0].value,	//받는 이메일 계정
			"Report Assistant- 비밀번호 찾기",
			"<form action='http://taeuk.run.goorm.io/webapp3/main_min/pwd_reset.php' method='post'>"+
			  '<input type="hidden" name="userid" value="'+j$('#pass_email')[0].value+'"><input type="submit" value="비밀번호 변경"/></form>',
			"smtp.naver.com",//네이버 smtp
			"webteamproject",//네이버 아이디
			"webapp!!");
});
</script>