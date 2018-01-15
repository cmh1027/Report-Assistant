<!-- 다른 종류의 게시판을 한곳에서 처리하는 board.php 입니다.
	게시판에서 목록을 누르면
mainboard와 유사합니다 -->


<?php
  require_once("./MYDB.php");
  $db = db_connect();
  $dept_name = $_GET["dept_name"];   //dept_name은 mainboard 혹은 board 자기자신한테서 찾아옵니다.

  $sql = "select dept_name from department where dept_name = $dept_name";    //url로 들어오는 경우 dept_name의존재여부를 체크합니다.
  $check_dept = $db -> query($sql);
  $check_dept_name = $check_dept ->fetch(PDO::FETCH_ASSOC);

  if( $check_dept_name == null ) {  ?> //url의 경로가 옳지 않은경우 에러를 발생합니다.
    <script>
      alert("존재하지 않는 게시판입니다");
      history.back();
    </script>
  <?php exit; } ?>
  <?php

  if(isset($_GET["page"]) ) { //이부분은 mainboard.php 와 유사하며 paging처리와 관련되어있습니다.
    $page = $_GET["page"];
  } else {
    $page = 1;
  }
  $sql = "select count(*) as cnt from post where dept_name = $dept_name order by post_id desc";
  $result = $db -> query($sql);
  $row = $result-> fetch(PDO::FETCH_ASSOC);
  $allpost = $row['cnt'];   //전체 게시글수

  $onePage = 10; // onepage: 페이지에 보여줄 
  $allPage = ceil( $allpost / $onePage); //전체 페이지수

  if ($page < 1 || ( $allPage && $page) > $allPage) {
    ?>
    <script>
      alert("존재하지 않는 페이지 입니다");
      history.back();
    </script>
<?php   exit; }
  $oneSection = 10; //한번에 보여줄 총 페이지 개수
  $currentSection = ceil($page / $oneSection); //현재 섹션
  $allSection = ceil($allPage / $oneSection); //전체 섹션

  $firstPage = ($currentSection * $oneSection) - ($oneSection - 1);

  if($currentSection == $allSection) {
    $lastPage = $allPage;  //현재 섹션이 마지막 섹션이라면 $allpage를 마지막 페이지 처리
  } else {
    $lastPage = $currentSection * $oneSection;  //현재섹션의 마지막페에지
  }
  $prevPage = ( ($currentSection - 1) * $oneSection); //이전페이지
  $nextPage = ( ($currentSection + 1) * $oneSection) - ($oneSection - 1);

  $paging = '<ul class="pagination">';  //paging 링크 생성.

  if($page != 1) {
    $paging .= '<li class="page-item"><a class="page-link" href ="./board.php?dept_name='.$dept_name.'&page=1">처음</a></li>' ;
  }
  if ($currentSection != 1) {
    $paging .= '<li class="page-item"><a class="page-link" href = "./board.php?dept_name='.$dept_name.'&page='.$prevPage.'">이전</a></li>';
  }
  for ( $i = $firstPage; $i <= $lastPage; $i++) {
    if ($i == $page) {
      $paging .='<li class="page-item"><a class="page-link" href = "./board.php?dept_name='.$dept_name.'&page='.$i.'">'.$i.'</a></li>';
    } else {
      $paging .= '<li class="page-item"><a class="page-link" href = "./board.php?dept_name='.$dept_name.'&page='.$i.'">'.$i.'</a></li>';
    }
  }
  if($currentSection != $allSection) {
    $paging .= '<li class="page-item"><a class="page-link" href = "./board.php?dept_name='.$dept_name.'&page='.$nextPage.'">다음</a></li>';
  }
  if ($page != $allpage) {
    $paging .= '<li class="page-item"><a class="page-link" href = "./board.php?dept_name='.$dept_name.'&page='.$allPage.'">끝</a></li>';
  }
  $paging .= '</ul>';

  $currentLimit = ($onePage * $page) - $onePage;
  $sqlLimit = 'limit ' .$currentLimit. ',' .$onePage;
  $sql = 'select * from post where dept_name =' .$dept_name.  'order by post_id desc ' .$sqlLimit;  //이부분은 dept_name으로 입력받은걸 list로 나오게해주는 sql입니다
  $result = $db -> query($sql);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset ="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Main.css?ver1.030">
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
			  <li><a href="../index.php">Home</a></li>
			  <li><a href="../search.php">Search</a></li>
			  <li class="active"><a href="./mainboard.php">Board</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li class="dropdown" id="profile_btn" >
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in "></span> Profile<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#"><?=$_SESSION['username']?></a></li>
					<li><a href="../logout.php">Logout</a></li>
				</ul>
			  </li>
			</ul>
		  </div>
		</div>
	</nav>


	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-2 sidenav" id="view_side">
				<ul class="nav nav-pills nav-stacked">
					<li><a href ="./mainboard.php">main</a></li>
					<li><a href ="./board.php?dept_name='policy'">policy</a></li>
					<li><a href ="./board.php?dept_name='economy'">economy</a></li>
					<li><a href ="./board.php?dept_name='it'">it</a></li>
					<li><a href ="./board.php?dept_name='science'">science</a></li>
					<li><a href ="./board.php?dept_name='issue'">issue</a></li>
					<li><a href ="./board.php?dept_name='sport'">sport</a></li>
				</ul>
		</div>
			<div class ="col-sm-8">
				<div id = "mainstage">
					<h1>게시판</h1>
					<table class="table" id="mainb_tb">
						<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>글쓴이</th>
							<th>날짜</th>
							<th>조회수</th>
						</tr>
						</thead>
					<?php while($row = $result -> fetch(PDO::FETCH_ASSOC)) {  
              $post_id = $row["post_id"];
              $dept_name = $row["dept_name"];
              $sql = "select count(*) from comment where dept_name = '$dept_name' and post_id ='$post_id'"; 
              $c = $db -> query($sql);
              $comment_count = $c->fetchColumn();
              $title = $row["title"]." [$comment_count]";
						?>
						<tr>
							<td class = "num"><?= $row["post_id"]; ?></td>
							<td class ="name"><a href ="./view.php?title=<?= $row["title"];?>&post_id=<?= $post_id ?>"><?= $title ?></a></td> <!-- post id도 보내야함-->
							<td class ="nick"><?= $row["nickname"]; ?></td>
							<td class = "date"><?= $row["date"]; ?></td>
							<td class = "num"><?= $row["hit"] ?></td>
						</tr>
					<?php } ?>
					</table>
				</div>

			<!--페이지 -->
			<div class="container text-left">
				<?php if ($allpost != 0) echo $paging ?> <!-- 게시글이 존재할때만 페이지를 보여줍니다.  -->
				</div>
			</div>  <!-- col-sm-8 -->
		</div>  <!-- row content -->
	</div> <!-- container-fluid -->

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
	<script src="Main.js"></script>
	<script src="prototype.js" type="text/javascript"></script>
	<script src="search.js" type="text/javascript"></script>

</body>
</html>
