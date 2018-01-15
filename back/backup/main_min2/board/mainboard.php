<!--  메인보드 게시판은 전체 글의 게시판입니다.
리스트를 이용하여 board.php에서 deptname 별로 진행시킬수가 있습니다.
목록을 통해 메인보드로 다시 돌아올수 있습니다.
-->

<?php session_start();
	$nick = $_SESSION["userid"];
?>

<?php 
	session_start();
	$nick = $_SESSION["nickname"];
	$userid = $_SESSION["user_id"];
	$pass = $_SESSION["password"];
?>



<?php
  require_once("./MYDB.php");
  $db = db_connect();

  if(isset($_GET["page"]) ) {    //page 변수를 받아오면 page를 지정해줍니다.
    $page = $_GET["page"];
  } else {
    $page = 1;  //page로 받지 않으면 1로 지정합니다.(첫페이지를 1로 해줍니다.)
  }
  //search 기능 부분 시작
  if(isset($_GET['searchColumn'])) {
    $searchColumn = $_GET['searchColumn'];
    $subString .='&amp;searchColumn='.$searchColumn;
  }
  if(isset($_GET['searchText'])) {
    $searchText = $_GET['searchText'];
    $subString .= '&amp;searchText='.$searchText;
  }

  if(isset($searchColumn) && isset($searchText)) {
    $searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
} else {
  $searchSql = "";
}
/* 검색 끝 */
  $sql = "select count(*) as cnt from post" .$searchSql;   //전체 게시글에 대한 sql 입니다.
  $sql_copy = $sql;
//  $sql = "select count(*) as cnt from post order by post_id desc";
  $result = $db -> query($sql);
  $row = $result-> fetch(PDO::FETCH_ASSOC);
  $allpost = $row['cnt']; //전체 게시글수

  if ($allpost == 0) {
    $emptyData = '<tr><td class = "textCenter" colspan = "5">글이 존재하지 않습니다.</td></tr>';
  } else {

  $onePage = 5; // 페이지에 보여줄 글 수
  $allPage = ceil( $allpost / $onePage); //전체 페이지수

  if ($page < 1 || ( $allPage && $page) > $allPage) {  //경로를 통해 page접근이 오류가 있을경우 경고문을 줍니다.
    ?>
    <script>
      alert("존재하지 않는 페이지 입니다");
      history.back();
    </script>
<?php   exit; }
  $oneSection = 5; //한번에 보여줄 총 페이지 개수
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

  $paging = '<ul class="pagination">';

  if($page != 1) {
  //  $paging .= '<li class="page-item"><a class="page-link" href ="./mainboard.php?page=1">처음</a></li>' ;
  $paging .= '<li class="page-item"><a class="page-link" href="./mainboard.php?page=1' . $subString . '">처음</a></li>';
  }
  if ($currentSection != 1) {
    //$paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='.$prevPage.'">이전</a></li>';
    $paging .= '<li class="page-item"><a class="page-link" href="./mainboard.php?page=' . $prevPage . $subString . '">이전</a></li>';
  }
  for ( $i = $firstPage; $i <= $lastPage; $i++) {
    if ($i == $page) {
      //$paging .='<li class="page-item"><a class="page-link" href = "./mainboard.php?page='.$i.'">'.$i.'</a></li>';
      $paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='. $i . $subString . '">' . $i . '</a></li>';
    } else {
      //$paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='.$i.'">'.$i.'</a></li>';
      $paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='. $i . $subString . '">' . $i . '</a></li>';
    }
  }
  if($currentSection != $allSection) {
    //$paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='.$nextPage.'">다음</a></li>';
    $paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='.  $nextPage . $subString . '">다음</a></li>';
  }
  if ($page != $allpage) {
    //$paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='.$allPage.'">끝</a></li>';
    $paging .= '<li class="page-item"><a class="page-link" href = "./mainboard.php?page='. $allPage . $subString . '">끝</a></li>';
  }
  $paging .= '</ul>';

  $currentLimit = ($onePage * $page) - $onePage;
  $sqlLimit = 'limit ' .$currentLimit. ',' .$onePage;
  $sql = 'select * from post ' .$searchSql. ' order by post_id desc ' .$sqlLimit;  //limit를 통해 출력될 페이지를 정해줍니다.
  $result = $db -> query($sql);
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset ="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../Main.css?ver1.009">
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
	  <li class="active"><a href="../index.php">Home</a></li>
	  <li><a href="../search.php">Search</a></li>
	  <li><a href="./mainboard.php">Board</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
	  <li class="dropdown" id="profile_btn" >
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in "></span> Profile<span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="#">ID</a></li>
			<li><a href="#">User</a></li>
			<li><a href="../logout.php">Logout</a></li>
		</ul>
	</li>
	</ul>
  </div>
</div>
</nav>

<div class="container-fluid">
<div class="row content">
  <div class="col-sm-2 sidenav">
	<ul class="nav nav-pills nav-stacked">
	  <li><a href ="./mainboard.php">main</a></li>
	  <li><a href ="./board.php?dept_name='policy'">poilicy</a></li>
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
	<table class="table">
	  <thead>
		<tr>
		  <th>번호</th>
		  <th>제목</th>
		  <th>글쓴이</th>
		  <th>날짜</th>
		  <th>조회수</th>
		</tr>
	  </thead>
      <?php
        if(isset($emptyData) ) {
         echo $emptyData;
       } else {
			
            //$sql = "select * from post order by post_id desc";
            //$stmh = $db ->query($sql);
            //$count = $stmh ->rowCount();
            //$row = $stmh -> fetch(PDO::FETCH_ASSOC); 매번반복해야함.
            while($row = $result -> fetch(PDO::FETCH_ASSOC)) {  //출력을 받습니다.
        ?>
      <tr>
        <td class = "num"><?= $row["post_id"]; ?></td>
        <td class ="name"><a href ="./view.php?title=<?= $row["title"];?>&post_id=<?=$row["post_id"]?>"><?= $row["title"]; ?></a></td> <!-- post id도 보내야함-->
        <td class ="nick"><?= $row["nickname"]; ?></td>
        <td class = "date"><?= $row["date"]; ?></td>
        <td class = "num"><?= $row["hit"] ?></td>
      </tr>
    <?php } }  ?>
    </table>
	  
    <div class ="boardfoot">
      <a href = "../writing.php">글쓰기</a> <!--<input type = "submit" name = "write" value ="글쓰기">--><!--<input type = "submit" name = "modify" value ="수정하기">-->
    </div>
  </div>
	 
		<!-- 검색기능 -->
      <div class="text-center">
        <form action = mainboard.php method ="get">
          <select name = "searchColumn">
            <option <?php echo $searchColumn =='title'?'selected="selected"':null?> value ="title">제목</option>
            <option <?php echo $searchColumn =='nickname'?'selected="selected"':null?> value ="nickname">작성자</option>
          </select>
          <input type = "text" name = "searchText" value = "<?php echo isset($searchText)?$searchText:null?>">
          <button type ="submit">검색</button>
        </form>
      </div>
      <!--페이지 -->
      <div class="container text-center">
        <?php echo $paging ?>
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
