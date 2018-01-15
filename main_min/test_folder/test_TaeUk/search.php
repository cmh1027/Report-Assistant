<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<title>Search Keyword</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="box.png" type="image/png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="index.css?ver1.10" type="text/css">		
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<span class="navbar-brand" id="nav_title" href="#">Report Assistant</span> <!-- @ 하이라이트 꺼주세요> 껏습니다. -->
				</div>
				<ul class="nav navbar-nav">
				  <li class="active"><a href="#">Home</a></li>
				  <li><a href="search.php">글쓰기</a></li>
				  <li><a href="#">게시판</a></li>
				  <li><a href="#">포럼</a></li>
				</ul>
			</div>
		</nav>	
		<div id="search_body">
			<button type="button" id="config" onclick="search_config_button()">Config</button>
			<input type="text" name="search" value=<?=$_POST["search"]?>/>
			<button type="button" id="search_button" onclick="search_button()">Search</button>
			<div class="search_result">
				<!-- Show articles crawled from google news page using javascript.
				If a title of an artice is selected, page moves to writing.html-->
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="index.js"></script>
	</body>
</html>