<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="Main.css?ver1.011"> 
</head>
<body>

<?php	
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
		<div class="main_after">
			<h1>Search Result...</h1>			
			<!--input type="text" name="search" id="search" class="form-control" value="<?=$_POST["search"]?>" placeholder="Enter a keyword">
			<button type="button" name="search_btn" class="form-control btn center-block search_btn" id="search_button">Search</button-->
			<gcse:searchbox></gcse:searchbox>
			<input type="hidden" value="<?=$_POST['search']?>" id="search_value"/>
			<div id="search_result">
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
<!--script src="ch.js"></script-->
<!--script src="prototype.js" type="text/javascript"></script-->
<!--script src="search.js" type="text/javascript"></script-->
<script>
	
	window.onload =function(){		
		j$('#gsc-i-id1')[0].value = "<?=$_POST['search']?>";
		j$(document).ready(function() {
			j$('.gsc-search-button').last().trigger('click');
			//console.log('click');
		});
		
		j$('input.gsc-search-button').click( function() {
			//console.log('click');
			
			setTimeout(function(){	
				//console.log('start');
				j$('a.gs-title').click( function(){
					//console.log(this.href);										
					var str = this.href;
					//console.log(str.substring(str.indexOf('q=')+2,str.length));
					//make_result(str.substring(str.indexOf('q=')+2,str.length));
					/*
					 j$.ajax({
						url:'./snoopy2.php',
						type:'post',
						data:{url: str.substring(str.indexOf('q=')+2,str.length)},		
						success:function(data){	
							alert(data);
						},
						error: function(data){
							console.log('ajax fail');
						}
					});
					*/
					//this.href= 'writing.php?url='+this.href;
					console.log(str.substring(str.indexOf('q=')+2,str.length));
					this.href= 'writing.php?url='+str.substring(str.indexOf('q=')+2,str.length);
				});}, 1000);
		});
	}	
</script>
</body>
</html>
