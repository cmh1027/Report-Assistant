<?php
print "성공?";
  require_once("MYDB.php");
  $db = db_connect();
  print "성공!";
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body></body>
</html>
<?php
  $title = $_POST["title"];
  $content = $_POST["content"];
  //$hit = $_POST["hit"]; 조회수
  $dept_name = 30;  //dept_name 과 post_id 는 writing에서 받아와야 한다.
  $post_id = 20;  //
  $nickname = "mc0i";  //login쪽에서 받아와야함.
  print $title;
  print $content;
  print $dept_name;
  print $post_id;
  print $nickname;
  try {
    print "시작";
    $db ->beginTransaction();
    $sql = "insert into post values (?,?,?,?,?,now(),1)";
    $stmh = $db->prepare($sql);
    $stmh ->bindValue(1,$dept_name,PDO::PARAM_STR);
    $stmh ->bindValue(2,$post_id,PDO::PARAM_STR);
    $stmh ->bindValue(3,$nickname,PDO::PARAM_STR);
    $stmh ->bindValue(4,$title,PDO::PARAM_STR);
    $stmh ->bindValue(5,$content,PDO::PARAM_STR);
    //$stmh ->bindValue(6,$hit,PDO::PARAM_STR); 수정되는경우엔 hit받아야함
    $stmh ->execute();
    $db->commit();
  } catch(PDOException $Exception) {
    $db -> rollBack();
    print ("오류:" .$Exception -> getMessage());
  }
  header("Location:http://localhost:8888/web_board_test/%EA%B2%8C%EC%8B%9C%ED%8C%90/board.php");
  ?>
