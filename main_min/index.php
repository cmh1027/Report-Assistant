<?php
require_once './login.php';	
//var_dump($_POST['userid']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="Main.css?ver1.016"> 
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
        <li class="dropdown" id="profile_btn" >
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in "></span> Profile<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#"><?=$_SESSION['username']?></a></li>
				<li><a href="logout.php">Logout</a></li> 
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
			
			<div class="main_title1">Share your reports</div>
<div class="main_title2">Report assistant is a report-writing platform inspired by the way you work. From sharing your opinion to cultivating your report skill, and writing a report alongside millions of other people.</div><br/>
			<form action="search.php" method="POST">
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

<script src="https://smtpjs.com/smtp.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
var j$ = jQuery;
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="Main.js?ver1.001"></script>
<!--script src="http://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js" type="text/javascript"></script-->
<!--script src="search.js" type="text/javascript"></script-->
</body>
</html>
