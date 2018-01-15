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
				  <li><a href="index.php">Home</a></li>
				  <li class="active"><a href="search.php">글쓰기</a></li>
				  <li><a href="#">게시판</a></li>
				  <li><a href="#">포럼</a></li>
				</ul>
			</div>
		</nav>	
		<div id="search_body">
			<form action="search.php" method="POST">
				<button type="button" id="config" onclick="search_config_button()">Config</button>
				<input type="text" name="search" value=<?=$_POST["search"]?>>
				<button type="submit" id="search_button" onclick="search_button()">Search</button>
			</form>
			<div class="search_result">
				<?php
					if(isset($_POST["search"])){
						exec("python crawl.py ".$_POST["search"]);
						$data = file("search.txt");
						for($i=0; $i<count($data); $i=$i+4){
							# 추후 제목 눌렀을때 writing.html(혹은 php)로 옮겨지도록 수정해야 함 $data[$i+1]는 뉴스의 링크, 임시로 href에 둠
							?><div><p><a href=<?=$data[$i+1]?>><?=$data[$i]?></a></p>
							<p><?=$data[$i+2]?></p>
							<p><?=$data[$i+3]?></p></div>
							<?
						}
					}
				?>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="index.js"></script>
	</body>
</html>