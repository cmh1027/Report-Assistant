<?php
  require_once("MYDB.php");
  $db = db_connect();
  if(!isset($_POST["ir1"])) {
    $text = $_POST["ir1"];
  }
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
    <a href = "#">Link</a>
    <a href = "#">Link</a>
    <a href = "#">Link</a>
  </div>
</div>

<div class ="row">
  <div class = "column">
    <form action ="insert.php" method="POST" enctype="multipart/form-data">
      제목:   <input type="text" name ="title" required><br>
      내용<br><textarea name ="content" cols ="140" rows = "30" required></textarea><br>
      <input type = "submit" name = "write" value ="작성하기">
      <a href="mainboard.php" ><button>목록</buton></a>
    </form>

  </div>

</div>


<div class ="footer">
  <p>Footer</p>
</div>

</body>
</html>
