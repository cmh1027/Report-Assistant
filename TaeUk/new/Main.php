<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="Main.css?ver1.005"> 
</head>
<body>

<?php	//DB 연결 시도
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
#		if(($i % 2) == 0){
#		}
#	}
#}
if($b_login==0){
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
        <li class="active"><a href="Main.php">Home</a></li>
        <li><a href="Search.php">Search</a></li>
        <li><a href="Write.php">Write</a></li>
        <li><a href="#">Debate</a></li>
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
			<div class="panel-body">
				<span>
					<input type="text" placeholder="ID(e-mail)" id="username">
					<input type="text" placeholder="PASSWORD" id="password">
				</span>
				<input type="submit" class="btn" value="Login">
			</div>
			<div class="panel-footer">			  			  
			  <button class="btn btn-lg" id='Sign_up_btn'>Sign Up</button>			 
			  <button class="btn btn-lg" id='pass_up_btn'>PW Serach</button>
			</div>			
		  </div>      
		  
		</div>		
    </div>
	
	<div id="Sign_up" class="modal">
	  <span id="cancel" class="close" title="Close Modal">×</span>
	  <form class="modal-content animate" action="">
		<div class="container">
		  <label><b>Email</b></label>
		  <input type="text" placeholder="Enter Email" name="email" required>
		  <label><b>Password</b></label>
		  <input type="password" placeholder="Enter Password" name="psw" required>
		  <label><b>Repeat Password</b></label>
		  <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
		  <input type="checkbox" checked="checked"> Remember me
		  <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
		  <div class="clearfix">
			<button type="button" id="cancel_btn" class="cancelbtn">Cancel</button>
			<button type="submit" class="signupbtn">Sign Up</button>
		  </div>
		</div>
	  </form>
	</div>
	
	<div id="pass_up" class="modal">
	  <span id="cancel2" class="close" title="Close Modal">×</span>
	  <form class="modal-content animate" action="">
		<div class="container">
		  <label><b>Email</b></label>
		  <input type="text" placeholder="Enter Email" name="email" required>		
		  <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
		  <div class="clearfix">
			<button type="button" id="cancel_btn2" class="cancelbtn">Cancel</button>
			<button type="submit" class="signupbtn">Submit</button>
		  </div>
		</div>
	  </form>
	</div>
	
    <div class="col-sm-3">
		<marquee width="90%" height="100%" direction="" behavior="slide" scrollamount="20" class="title"><p>Report Assistant</p><p>리포트 작성 도우미</p></marquee>
    </div>
	
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright 2017. <br/>(강태욱,문현준,최민혁,최수장,홍지형)<br/> all rights reserved.</p>
</footer>
<?php
}else{
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
        <li class="active"><a href="Main.php">Home</a></li>
        <li><a href="Search.php">Search</a></li>
        <li><a href="Write.php">Write</a></li>
        <li><a href="#">Debate</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown" id="profile_btn" >
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in "></span> Profile<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">ID</a></li>
				<li><a href="#">User</a></li>
				<li><a href="#">Logout</a></li> 
          </ul>
		</li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 col-xs-0">
    </div>	
	
    <div class="col-sm-8 col-xs-12 text-left main center-block"> 		
		<div class="main_search">
			<h1>Report Search</h1>
			<form action="Search.php" method="POST">
				<input type="text" name="search" class="form-control" id="input_key" placeholder="Enter a keyword">
				<input type="submit" name="search_btn" class="form-control btn center-block" id="search_btn2" value="Search">
			</form>
		</div>
	</div>

	
	
    <div class="col-sm-2 col-xs-0">
		
    </div>	
	
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright 2017. <br/>(강태욱,문현준,최민혁,최수장,홍지형)<br/> all rights reserved.</p>
</footer>

<?php
}
?>

<script src="https://smtpjs.com/smtp.js"></script>
<!--script type="text/javascript">
	Email.send("WEBTEAM",//보내는 이메일 계정
				"gmdkrl@naver.com",//받는 이메일 계정
				"이메일 제목",
				"이메일 내용",
				"smtp.naver.com",//네이버 smtp
				"webteamproject",//네이버 아이디
				"webapp!!");
</script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
var j$ = jQuery;
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="Main.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js" type="text/javascript"></script>
<!--script src="search.js" type="text/javascript"></script-->
</body>
</html>
