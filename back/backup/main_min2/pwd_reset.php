<?php

//var_dump($_POST['userid']);
//print_r($_POST['password']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="Main.css?ver1.019"> 
</head>
<body>
	
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
			  <h1>PASSWORD CHANGE</h1>
			</div>
			<form action="pwd_reset2.php" method="post">
				<div class="panel-body">
					<span>
						<input type="hidden" value="<?=$_POST['userid']?>" name='modify_email' />
						<input type="password" placeholder="PASSWORD" id="modify_pwd" name="modify_pwd">
						<input type="password" placeholder="PASSWORD-REPEAT" id="modify_pwd_r" name="modify_pwd_r">
					</span>
					<input type="submit" class="btn" name="pwd_modify_submit" id="1" value="CHANGE">
				</div>
			</form>
			<div class="panel-footer">
			</div>	
		  </div>      
		  
		</div>
    </div>
	  
	<div id="msg_pwd" class="modal">
	  <span id="cancel3" class="close" title="Close Modal">×</span>
	  <form class="modal-content animate" action="">
		<div class="container">
		  <label><b>Message</b></label>		  
		  <p>패스워드가 변경되었습니다.</p>
		  <div class="clearfix">
			<button type="button" class="cancelbtn" id="cancel_pwd">OK</button>
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
<script src="Main.js?ver1.007"></script>
</body>
</html>	