<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!--script>
			$.ajax({
				url:'./snoopy2.php',
				type:'post',
				data:{url: "<?=$_GET['url']?>" },		
				success:function(data){	
					//alert(data);
					console.log('ajax success');
				},
				error: function(data){
					console.log('ajax fail');
				}
			});
		</script-->
		<title>Writing</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="box.png" type="image/png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="Main.css?ver1.006"> 
		<script type="text/javascript" src="HuskyEZCreator.js" charset="utf-8"></script>		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="index.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<span class="navbar-brand" href="#">Report Assistant</span> <!-- @ 하이라이트 꺼주세요 -->
				</div>
				<ul class="nav navbar-nav">
				  <li><a href="index.php">Home</a></li>
				  <li  class="active"><a href="search.php">Search</a></li>
				  <li><a href="board/mainboard.php">Board</a></li>
				</ul>
			</div>
		</nav>
		
		<div id="writing_body" class="container-fluid">
			<!--form action="search.php" method="POST">
				<input type="text" name="search"/>
				<button type="submit" value="Search">Search</button>
			</form-->
			<br/>
			<div class="">
				
			</div>
			<div class="writing">
				<form action="insert.php" id="frm" name="frm" method="POST">
					<?php
						if(!isset($_POST["modify"])){
							require_once './snoopy2.php';
							exec("python analyze.py");
							$data = file_get_contents("output.txt");
							exec("rm result.txt");
							exec("rm output.txt");
							$data = preg_replace('/\(function.*\);/', "", $data);
							$data = nl2br($data);
						}
						else{
							$db = new PDO("mysql:dbname=webapp;host=localhost", "webapp", "webapp");
							$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
							$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$dept_name = $_POST["dept_name"];
							$post_id = $_POST["post_id"];
							$rows = $db->query("SELECT * FROM post where dept_name = '$dept_name' and post_id = '$post_id'");
							foreach ($rows as $row) {
								$result = $row;
								break;
							}						
						}
					?>
					<span class="board_select">게시판</span>
					<select name="board" id="board">
						<option value="policy" selected="selected">정치</option>
						<option value="economy">경제</option>
						<option value="it">IT</option>
						<option value="science">과학</option>
						<option value="sport">스포츠</option>
						<option value="issue">이슈</option>
					</select></br>
					<?php if(!isset($_POST["modify"])){ ?> 
						<a href=<?=$_GET['url']?> >해당 기사 링크</a><br/>
						<span class="title">제목 </span><input type="text" name="title" id="title" size="80" /><br/>
						<textarea name="content" id="ir1" rows="10" cols="100"><?=$data?></textarea>
						<input type="hidden" name="modify" value="false"/>
					<?php }else{ ?>
						<span class="title">제목 </span><input type="text" name="title" id="title" size="80" value="<?= $result["title"] ?>"></input></br>
						<textarea name="content" id="ir1" rows="10" cols="100"><?= $result["content"] ?></textarea>
						<input type="hidden" name="dept_name" value=<?= $result["dept_name"] ?>></input>
						<input type="hidden" name="post_id" value=<?= $result["post_id"] ?>></input>
						<input type="hidden" name="date" value=<?= $result["date"] ?>></input>
						<input type="hidden" name="hit" value=<?= $result["hit"] ?>></input>
						<input type="hidden" name="modify" value="true"/>
					<?php } ?>
					<button type="button" class="btn" id="submitbutton" value="Search">확인</button>
					<!-- 네이버 SmartEditor 2.0 스크립트. js파일로 분리하려고 했는데 적용이 안되서 부득이하게 obstructive하게 두었습니다 -->
					<script type="text/javascript">
						var oEditors = [];
						nhn.husky.EZCreator.createInIFrame({
							oAppRef: oEditors,
							elPlaceHolder: "ir1",
							sSkinURI: "SmartEditor2Skin.html",
							fCreator: "createSEditor2",
							htParams : {
								bUseToolbar : true,
								BUseVerticalResizer : true,
								bUseModeChanger : false,
							}
						});
						document.getElementById("submitbutton").onclick = submitContents;
						function submitContents() {
							oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
							if(document.getElementById("title").value!="" && document.getElementById("ir1").value!=""){
								document.getElementById("frm").submit();
							}
							else{
								alert("제목과 본문을 채워주세요");
							}
						}
							
					</script>
				</form>
                    
			</div>
			<div class="">
				
			</div>
		</div>
	</body>
</html>