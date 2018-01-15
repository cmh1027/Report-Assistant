<?php
  require_once("./MYDB.php");
  $db = db_connect();
  if(!isset($_POST["ir1"])) {
    $text = $_POST["ir1"];
  }
  $title = $_REQUEST["title"];
  $post_id = $_REQUEST["post_id"];

  $sql = "select title, content from post where post_id = $post_id" ; //&& title = $title"
  $stmh = $db ->query($sql);
  $var = $stmh -> fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset ="utf-8">
  <link href = "border.css" rel ="stylesheet" type="text/css">
</head>
<body>

<div class = "header">
  <h2>Header</h2>
  <div class ="login">
    <div class ="login_form">
      로그인:<input type = "text" name = "input" value ="input">
      비밀번호:<input type = "text" name = "input" value ="input">
    </div>
  </div>
  <div class ="topnav">
    <a href = "#">게시판</a>
    <a href = "#">포럼</a>
    <a href = "#">글쓰기</a>
  </div>
</div>

<div class ="row">
  <div class = "column">
    <form action ="insert.php" method="POST" enctype="multipart/form-data">
      제목:<input type="text" name ="title" value ="<?= $var["title"]?>" required><br>
      내용<br><textarea name ="content" cols ="140" rows = "30" required><?= $var["content"]?></textarea><br>
      <input type ="submit" name ="modify" value ="수정하기">
      <a href ="./delete.php?post_id=<?= $post_id?>&title=<?= $title ?>"><button>삭제하기</button></a> <!-- post_id도 보내주어야 한다-->
      <a href = "./board.php"><button>목록</button></a>
    </form>

  </div>

</div>


<div class ="footer">
  <p>Footer</p>
</div>

</body>
</html>
