<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="Main.css?ver1.015"> 
</head>
<body>

<?php
require_once 'h.php';	
require_once 'password.php';
header('X-FRAME-OPTIONS: SAMEORIGIN');
session_start();
	
$userid[] = 'admin'; 
$username[] = '관리자'; 
//$hash[] = '$2y$10$7llM8TDTW3cxrMPzwd1ydOky3FP7yYOzn/d4bEWWbeFDiQ.tTbM3O';
$hash[] = password_hash('pass1', PASSWORD_DEFAULT, array('cost' => 10));

try{
	$db = new PDO("mysql:dbname=webapp;host=localhost", "webapp", "webapp");
	$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = 'SELECT * FROM signup';
	$prepare = $db->prepare($sql);
	//$prepare->bindValue(':name', 'taeuk', PDO::PARAM_STR);
  	$prepare->execute();
	$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $key => $val){
		foreach($val as $name => $value){
			if($name == 'email'){
				$userid[] = $value;	
			}else if($name == 'nickname'){
				$username[] = $value;
			}else if($name == 'password'){
				$hash[] = $value;
			}
		}
	}
	
}catch(PDOException $e){
	print_r("SQL 에러");
}
$error = '';
if (! isset($_SESSION['auth'])) {
  $_SESSION['auth'] = false;
}

if (isset($_POST['userid']) && isset($_POST['password'])) {
  foreach ($userid as $key => $value) {
    if ($_POST['userid'] === $userid[$key] &&
        password_verify($_POST['password'], $hash[$key])) {
      session_regenerate_id(true);
      $_SESSION['auth'] = true;
      $_SESSION['username'] = $username[$key];
      break;
    }
  }
  if ($_SESSION['auth'] === false) {
?>
    <div class="idcheck alert alert-danger alert-dismissable fade in" data-spy="affix">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Danger!</strong> ID 또는 비밀번호가 일치하지않습니다.
	 </div>
<?php
  }
}
?>

<?php
//$b_login = false;
if($_GET['b_login'] !=null){
	$b_login = $_GET['b_login'];
}else{
	$b_login = false;
}
#TEST DB 데이터 불러오기
#$rows = $db -> query("select * from test");
#foreach( $rows as $row => $values){
#	foreach( $values as $type => $val){
#		$i = $i +1;
#		if(($i % 2) == 0
#		   
#		}
#	}
#}
if ($_SESSION['auth'] !== true) {
	if ($error) {
    	echo '<p>' . h($error) . '</p>';
  	}
?>

<?php
try{
	$db = new PDO("mysql:dbname=webapp;host=localhost", "webapp", "webapp");
	$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//print_r("DB 연결 성공");
	
?>
	<div class="dbcheck alert alert-success alert-dismissable fade in" data-spy="affix">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> DB 연결 성공!
	</div>
<?php
}catch(PDOException $e){
?>
	<div class="dbcheck alert alert-danger alert-dismissable fade in" data-spy="affix">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Danger!</strong> DB 연결 실패...
	 </div>
<?php
	//print_r("DB 연결 실패");	
}
?>	
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Report Assistant</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="board/mainboard.php">Board</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li-->
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-3">
    </div>	
	
    <div class="col-sm-6 text-left main center-block"> 
    <div class="login">	  
		<div class="panel panel-default text-center center-block">
			<div class="panel-heading">
			  <h1>LOGIN</h1>
			</div>
			<form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="post">							
				<div class="panel-body">
					<span>
						<input type="text" placeholder="ID(e-mail)" id="username" name="userid">
						<input type="password" placeholder="PASSWORD" id="password" name="password">
					</span>
					<input type="submit" class="btn" name="submit" value="Login">
				</div>
			</form>
			<div class="panel-footer">			  			  
			  <button class="btn btn-lg" id='Sign_up_btn'>Sign Up</button>			 
			  <button class="btn btn-lg" id='pass_up_btn'>PW Serach</button>
			</div>			
		  </div>      
		  
		</div>		
    </div>
	
	<div id="Sign_up" class="modal">
	  <span id="cancel" class="close" title="Close Modal">×</span>
	  <form class="modal-content animate" action="" method="post">
		<div class="container">
		  <label><b>Email</b></label>
		  <input type="text" placeholder="Enter Email" name="email" required>
		  <label><b>Nickname</b></label>
		  <input type="text" placeholder="Nickname" name="nickname" required>
		  <label><b>Password</b></label>
		  <input type="password" placeholder="Enter Password" name="pwd" required>
		  <label><b>Repeat Password</b></label>
		  <input type="password" placeholder="Repeat Password" name="pwd-repeat" required>
		  <input type="checkbox" checked="checked"> Remember me
		  <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
		  <div class="clearfix">
			<button type="button" id="cancel_btn" class="cancelbtn">Cancel</button>
			<button type="button" class="signupbtn" id="signup_btn">Sign Up</button>
		  </div>
		</div>
	  </form>
	</div>	
	  
	<div id="pass_up" class="modal">
	  <span id="cancel2" class="close" title="Close Modal">×</span>
	  <form class="modal-content animate" action="">
		<div class="container">
		  <label><b>Email</b></label>
		  <input type="text" id="pass_email" placeholder="Enter Email" name="pwd_email" required>		
		  <div class="clearfix">
			<button type="button" id="cancel_btn2" class="cancelbtn">Cancel</button>
			<button type="button" class="signupbtn" id="pass_submit">Submit</button>
		  </div>
		</div>
	  </form>
	</div>
	
    <div class="col-sm-3">
		<marquee width="90%" height="100%" direction="" behavior="slide" scrollamount="20" class="mar_title"><p>Report Assistant</p><p>리포트 작성 도우미</p></marquee>
    </div>
	
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright 2017. <br/>(강태욱,문현준,최민혁,최수장,홍지형)<br/> all rights reserved.</p>
</footer>

<script src="https://smtpjs.com/smtp.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
var j$ = jQuery;
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="Main.js?ver1.006"></script>
<!--script src="http://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js" type="text/javascript"></script-->
<!--script src="search.js" type="text/javascript"></script-->
</body>
</html>
<?php
exit();
}