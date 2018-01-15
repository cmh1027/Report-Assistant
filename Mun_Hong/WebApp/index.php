<!--
### 현재 제작내용:###	서로 만드는 내용이 겹치지 않기위하여 다른사람의 제작내용을 확인할 수 있는 메모공간.
	강태욱	:
	문현준 :
	최민혁 :
	최수장 :
	홍지형 :
###############################################################################################
###	업데이트 내용:
	날짜(이름)		내용
	11/07(강태욱) : html 태그만 작성.
	11/08(강태욱) : html->php 대체 (∵ html파일의 필요성을 느끼지 못함, 실행시 바로 시작페이지.)
	11/08(강태욱) : 부트 스트랩 적용 (∵  css url로 불러오기) 참고사이트: https://www.w3schools.com/bootstrap/default.asp
	11/08(강태욱) : mysql-server 구축완료 및 자동실행.
		★★★★★ DB명:webapp, DB사용자명:webapp, password:webapp
		★★★★★ 밑에 터미널에 입력하시면 됩니다. Ex) mysql -u webapp -p
	11/08(강태욱) : css는 수정시 href="index.css?ver1.0" <-ver을 고쳐줘야 적용됩니다. 예전 버전이 남아있어 적용안되는 현상발생
	11/09(강태욱) : 로그인후 화면구성(HTML).
	11/10(강태욱) : 로그인전 화면구성 중...
	11/10(최민혁) : Search, writing 페이지, 메세지 몇개 추가 + 스타일 수정 원하는부분 주석에 @ 붙여놓을게요
	11/11(강태욱) : 각자 테스트 작업실 한폴더씩 만들어뒀습니다.(현재 버전으로). 그곳에서 자기가 원하는 것을 만들어 완성본을 'WebApp/'에 복사-붙여넣기-주석표시(업데이트내용)-으로 작업하는 방식으로 해요.
	* 동시편집시, 실행화면 보면서 변수들 바꿔가며 수정하기 위하여 이런 방식으로 하는게 좋아보이네요.
	* 혹시, 만드는 기능이 겹칠 수 있으므로 현재 만드는 내용을 표기하도록 해요.
	* mamp와 동일하게 'http://webappteamproject.run.goorm.io/WebApp/~' <- 뒤에 test_'이름'/index.php로 들어가시면 됩니다.
-->
<!DOCTYPE html>
<html lang='ko'>
	<head>
		<title>Report Assistant</title>
		<meta charset="UTF-8" />
		<link rel="shortcut icon" href="box.png" type="image/png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="index.css?ver1.19" type="text/css">
	</head>
	<body>
	<?php
			//DB 연결 시도
			try{
				$db = new PDO("mysql:dbname=webapp;host=localhost", "root", "root");
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
		$b_login = false;
		if($b_login==true){
	?>
<!-- 메뉴창 -->
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<span class="navbar-brand" href="#">Report Assistant</span> <!-- @ 하이라이트 꺼주세요 -->
					</div>
					<ul class="nav navbar-nav">
					  <li class="active"><a href="#">Home</a></li>
					  <li><a href="#">글쓰기</a></li> <!-- 로그인해야 사용가능하다고 팝업 -->
					  <li><a href="#">게시판</a></li>
					  <li><a href="#">포럼</a></li>
					</ul>
				</div>
			</nav>

<!-- 로그인창 -->
			<div class="message">
				<p>
					Report Assistant는 리포트 작성을 보조해 주며 보고서를 저장해주는 리포지토리입니다. 개인 목적을 위한 보고서부터 과제 및 회사 보고서까지 당신은 보고서를 저장하거나 남이 쓴 보고서를 읽고 포럼에서 의견을 교환할 수 있습니다.
				</p>
				<!-- @ 로그인 창 왼쪽에 박스 하나 만들어서 넣어주세요 -->
			</div>
			<div class="col-sm-4 col-xs-12">
			  <div class="panel panel-default text-center">
				<div class="panel-heading">
				  <h1>로그인 창</h1>
				</div>
				<div class="panel-body">
				  	<p><strong>ID: </strong> <input type='text' placeholder="아이디" ></p>
				 	<p><strong>PW: </strong> <input type='password' placeholder="비밀번호" ></p>
				</div>
				<div class="panel-footer">
          			<button class="btn btn-lg">login</button>
					<button class="btn btn-lg">Sign Up</button>
					<button class="btn btn-lg">ID/PW</button>
				</div>
			  </div>
			</div>
	<?php
		}else{
	?>
		<nav class="navbar navbar-inverse">
  			<div class="container-fluid">
    			<div class="navbar-header">
      				<span class="navbar-brand" href="#">Report Assistant</span> <!-- @ 하이라이트 꺼주세요 -->
    			</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="search.php">글쓰기</a></li>
					<li><a href="./board/board.html">게시판</a></li>
					<li><a href="#">포럼</a></li>
    			</ul>
				<!-- @ 프로필 아이콘 오른쪽 끝에 추가, 클릭 시 프로필 수정 페이지로 이동 -->
  			</div>
		</nav>

		<div class="jumbotron text-center" id="headlin">
			<br/>
  			<h1>Try Report Assistant!</h1>
  			<p>Report Assistant는 리포트 작성을 보조해 주며 보고서를 저장해주는 리포지토리입니다.<br/> 개인 목적을 위한 보고서부터 과제 및 회사 보고서까지 당신은 보고서를 저장하거나 남이 쓴 보고서를 읽고 포럼에서 의견을 교환할 수 있습니다.</p>
		</div>

		<div class="container">
    		<div class="col-sm-12">
				<form action="search.php" method="POST">
      				<input type="text" name="search" class="form-control" id="input_key" placeholder="Enter a keyword">
					<input type="submit" class="btn btn-success center-block" value="검색" />
				</form>
    		</div>
			<div class="col-sm-12 thumbnail text-center" id="keyword_box" >
				<!-- php, 혹은 javascript를 이용하여 동적으로 최근 검색어를 출력 -->
			</div>

		</div>
	<?php
		}
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src='index.js'></script>
	</body>
</html>
