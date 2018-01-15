<!DOCTYPE html>
<html lang="en">
<head>
	<title>Main</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="Main.css?ver1.010">		
</head>
<body>

<?php	//DB 연결 시도
require_once 'login.php';	
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
        <li class="dropdown" id="profile_btn" >
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in "></span> Profile<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">ID</a></li>
				<li><a href="#">User</a></li>
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
		<div class="main_after" id="main_after">
			<h1>Search Result...</h1>						
			<!--gcse:searchbox></gcse:searchbox-->
				<input type="text" name="search" id="search" class="form-control" value="<?=$_POST["search"]?>" placeholder="Enter a keyword">
				<button type="button" name="search_btn" class="form-control btn center-block search_btn" id="search_button">Search</button>	
			<div id="search_result">
					<p>TEST</p>
					<p><?= $_SESSION['username'] ?></p>
					<p>TEST</p>
				<input type="hidden" id="keyword" value=<?=$_POST["search"]?>>
				<gcse:searchresults></gcse:searchresults>
			</div>
		</div>
	</div>

	
	
    <div class="col-sm-2 col-xs-0">
		
    </div>	
	
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright 2017. <br/>(강태욱,문현준,최민혁,최수장,홍지형)<br/> all rights reserved.</p>
</footer>

	
<script>
var myCallback = function() {
  if (document.readyState == 'complete') {
    google.search.cse.element.render({
          div: "main_after",
          tag: 'search'
   });
  } else {
    google.setOnLoadCallback(function() {
        google.search.cse.element.render({
              div: "main_after",
              tag: 'search'
            });
    }, true);
  }
};	
	
window.__gcse = {parsetags: 'explicit', callback: myCallback};
(function() {
	var cx = '001579166103861849215:cgdipvl_ujy';
	var gcse = document.createElement('script');
	gcse.type = 'text/javascript';
	gcse.async = true;
	gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(gcse, s);
})();
</script>	
<script src="https://smtpjs.com/smtp.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
var j$ = jQuery;
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="Main.js"></script>
<script src="prototype.js" type="text/javascript"></script>
<!--script src="search.js?ver1.001" type="text/javascript"></script-->
</body>
</html>
