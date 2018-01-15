<?php session_start(); ?>

<?php
  $nick = $_SESSION["username"];
  require_once("MYDB.php");
  $db = db_connect();
  $title = $_REQUEST["title"];
  $post_id = $_REQUEST["post_id"];
  $sql = "";


  $sql = "update post set hit = hit + 1 where post_id = $post_id && title = '$title' ";  //회수 증가.
  $stmh = $db ->query($sql);
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
		   <li><a href="../index.php">Home</a></li>
		   <li><a href="../search.php">Search</a></li>
		   <li class="active"><a href="./mainboard.php">Board</a></li>
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
       <div class="col-sm-1 sidenav">
         <ul class="nav nav-pills nav-stacked">
           <li><a href ="./mainboard.php">main</a></li>
           <li><a href ="./board.php?dept_name='policy'">poilicy</a></li>
           <li><a href ="./board.php?dept_name='economy'">economy</a></li>
           <li><a href ="./board.php?dept_name='it'">it</a></li>
           <li><a href ="./board.php?dept_name='science'">science</a></li>
           <li><a href ="./board.php?dept_name='issue'">issue</a></li>
           <li><a href ="./board.php?dept_name='sport'">sport</a></li>
         </ul>
       </div> <!-- col-sm-2 sidenav -->
   <?php
      try{
        $sql = "select * from post where post_id = $post_id && title = '$title' ";
         $stmh = $db ->query($sql);
         $var = $stmh -> fetch(PDO::FETCH_ASSOC);
		 $dept_name = $var["dept_name"];
       } catch(PDOException $Exception) {
         $db -> rollBack();
         print ("오류:" .$Exception -> getMessage());
       }
       ?>
   <div class ="col-sm-11">
     <h4>제목: <text> <?= $var["title"]?> </text> <small>작성자: <text> <?= $var["nickname"]?> </small></text></h4>
	 <h4>내용:</h4><p><?= $var["content"]?> </p>
<?php if($nick == $var["nickname"] ) { ?>
     <form action="../writing.php" method="POST">
	   <input type="hidden" name="title" value="<?=$var["title"]?>"></input>
	   <input type="hidden" name="dept_name" value="<?= $dept_name ?>"></input>
	   <input type="hidden" name="content" value="<?= $var["content"] ?>"></input>
	   <input type="hidden" name="post_id" value="<?= $post_id?>"></input>
	   <input type="hidden" name="date" value="<?= $var["date"]?>"></input>
	   <input type="hidden" name="hit" value="<?= $var["hit"]?>"> </input>
	   <input type= "submit" value="수정하기"/> <!-- 글작성자의 소유인경우만 보여줄것-->
	 </form>
<?php } ?>
     <a href = "./mainboard.php"><button>목록</button></a><br/>
<?php if($nick == $var["nickname"] ) { ?>
     <a href = "./delete.php?title=<?= $title?>&post_id=<?= $post_id?>"><button>삭제하기</button></a><!-- 글작성자의 소유인경우만 보여줄것-->
<?php } ?>


       <?php
		try {
			$sql2 = "select * from comment where dept_name = '$dept_name' && post_id = $post_id order by comment_id desc";
			$stmh = $db ->query($sql2);
			$rows = $stmh -> rowCount();
		 } catch(PDOException $Exception) {
			$db -> rollBack();
			print ("오류:" .$Exception -> getMessage());
  		 }?>
	
<div class ="footer">
		  <p>Comment</p>
		  <table>
			<tr>
			 <form action = "comment_update.php" method= "post">
				<input type ="hidden"name = "title" value ="<?= $var["title"] ?>" >
				<input type ="hidden"name = "dept_name" value ="<?= $var["dept_name"] ?>" >
				<input type = "hidden" name ="post_id" value = "<?= $post_id ?>" >
				<input type = "hidden" name ="user_nick" value = "<?= $nick ?>" >
				<input type = "hidden" name ="comment_id" value = "<?= $rows ?>" >
				<textarea cols ="100" rows ="3" name ="comment" >댓글을 작성해주세요</textarea>
			  <div class = "sub_but">
				<input type = "submit" name ="submit" value = "등록">
			  </div>
			 </form>
			</tr>
		</table>
		
		 <?php while ($var_co = $stmh ->fetch(PDO::FETCH_ASSOC) ) {
			?>
		<div class="row">
			<div class="col-sm-1 text-center">
			  <img src="https://www.zuckermanlaw.com/wp-content/uploads/whistleblowing/anonymous-sec-whistleblower-768x799.jpg" class="img-circle" height="65" width="65" alt="Avatar">
			</div>
			<div class="col-sm-10">
			  <h4><?= $var_co["comment_nickname"] ?></h4>
			  <p><?= $var_co["comment_content"] ?></p>
			  <br>
				<div>
				<form action = "comment_delete.php" method = "post" >
				  <input type = "hidden" name ="dept_name" value ="<?= $dept_name?>" >
				  <input type = "hidden" name ="post_id" value ="<?= $var_co["post_id"] ?>" >
				  <input type = "hidden" name ="comment_id" value ="<?= $var_co["comment_id"] ?>" >
				  <input type = "hidden" name ="nick" value = "<?= $var_co["comment_nickname"] ?>" >
				  <input type = "hidden" name ="title" value = "<?= $title; ?>" >
				  <div class ="sub_but">
					<?php if($nick == $var_co["comment_nickname"] ) { ?>
					  <input type = "submit" name ="submit" value ="삭제" >
					 <?php } ?>
				  </div>
				</form>
			  </div>
			</div><!-- col-sm-10 -->
		</div><br /><!-- row -->
		  <?php } ?>
		<p>총 댓글 : <?= $rows ?></p><br />
   </div> <!-- footer -->
</div> <!-- col-sm-10 -->
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
</html>



