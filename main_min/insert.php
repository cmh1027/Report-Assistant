<?php
	try{
		session_start();
		$db = new PDO("mysql:dbname=webapp;host=localhost", "webapp", "webapp");
		$db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dept_name = $_POST['board'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $content = nl2br($content);
        $nickname = $_SESSION['username'];
		if($_POST['modify']=="false"){ // 글 작성
			$rows = $db->query("SELECT post_id FROM post where dept_name = '$dept_name' order by post_id desc");
			$post_id = -1;
			foreach ($rows as $row) {
				$post_id = $row["post_id"];
				break;
			}
			$post_id = $post_id + 1;
			$date = date('Y-m-d H:i:s');
			$sql = "INSERT INTO post (dept_name, post_id, nickname, title, content, date, hit) VALUES (:dept_name, :post_id, :nickname, :title, :content, :date, :hit)";
			$statement = $db->prepare($sql);
			$statement->bindValue(':dept_name', $dept_name, PDO::PARAM_STR);
			$statement->bindValue(':post_id', $post_id, PDO::PARAM_INT);
			$statement->bindValue(':nickname', $nickname, PDO::PARAM_STR);
			$statement->bindValue(':title', $title, PDO::PARAM_STR);
			$statement->bindValue(':content', $content, PDO::PARAM_STR);
			$statement->bindValue(':date', $date, PDO::PARAM_STR);
			$statement->bindValue(':hit', 0, PDO::PARAM_INT);
			$statement->execute();
        }
		else{ // 글 수정
            $before_dept_name = $_POST['dept_name'];
            $post_id = $_POST['post_id'];
            $date = $_POST['date'];
            $hit = $_POST['hit'];
            $deleted_check = TRUE;
            $rows = $db->query("SELECT * FROM post where dept_name = '$before_dept_name' and post_id = '$post_id'");
			foreach ($rows as $row) {
				$deleted_check = FALSE;
				break;
            }
            if(!$deleted_check){ // 기존 글이 존재
                if($dept_name == $before_dept_name){ // 게시판 그대로
                    $sql = "UPDATE post set title = ?, content = ?, nickname = ?, date = ? where dept_name = ? and post_id = ?";
                    $statement = $db->prepare($sql);
                    $statement->bindParam(1, $title);
                    $statement->bindParam(2, $content);
                    $statement->bindParam(3, $nickname);
                    $statement->bindParam(4, $date);
                    $statement->bindParam(5, $before_dept_name);
                    $statement->bindParam(6, $post_id);
                    $statement->execute();
                }
                else{ // 게시판 옮김
                    $rows = $db->query("SELECT post_id FROM post where dept_name = '$dept_name' order by post_id desc");
                    $new_post_id = -1;
                    foreach ($rows as $row) {
                        $new_post_id = $row["post_id"];
                        break;
                    }
                    $new_post_id = $new_post_id + 1;
                    $sql = "UPDATE post set dept_name = ?, post_id = ?, title = ?, content = ?, nickname = ?, date = ? where dept_name = ? and post_id = ?";
                    $statement = $db->prepare($sql);
                    $statement->bindParam(1, $dept_name);
                    $statement->bindParam(2, $new_post_id);
                    $statement->bindParam(3, $title);
                    $statement->bindParam(4, $content);
                    $statement->bindParam(5, $nickname);
                    $statement->bindParam(6, $date);
                    $statement->bindParam(7, $before_dept_name);
                    $statement->bindParam(8, $post_id);
                    $statement->execute();
                }
            }
            else{ // 기존 글이 삭제됨
                if($dept_name == $before_dept_name){ // 게시판 그대로
                    $sql = "INSERT INTO post (dept_name, post_id, nickname, title, content, date, hit) VALUES (:dept_name, :post_id, :nickname, :title, :content, :date, :hit)";
                    $statement = $db->prepare($sql);
                    $statement->bindValue(':dept_name', $before_dept_name, PDO::PARAM_STR);
                    $statement->bindValue(':post_id', $post_id, PDO::PARAM_INT);
                    $statement->bindValue(':title', $title, PDO::PARAM_STR);
                    $statement->bindValue(':content', $content, PDO::PARAM_STR);
                    $statement->bindValue(':nickname', $nickname, PDO::PARAM_STR);
                    $statement->bindValue(':date', $date, PDO::PARAM_STR);
                    $statement->bindValue(':hit', $hit, PDO::PARAM_INT);
                    $statement->execute();
                }
                else{ // 게시판 옮김
                    $rows = $db->query("SELECT post_id FROM post where dept_name = '$dept_name' order by post_id desc");
                    $new_post_id = -1;
                    foreach ($rows as $row) {
                        $new_post_id = $row["post_id"];
                        break;
                    }
                    $new_post_id = $new_post_id + 1;
                    $sql = "INSERT INTO post (dept_name, post_id, nickname, title, content, date, hit) VALUES (:dept_name, :post_id, :nickname, :title, :content, :date, :hit)";
                    $statement = $db->prepare($sql);
                    $statement->bindValue(':dept_name', $dept_name, PDO::PARAM_STR);
                    $statement->bindValue(':post_id', $new_post_id, PDO::PARAM_INT);
                    $statement->bindValue(':title', $title, PDO::PARAM_STR);
                    $statement->bindValue(':content', $content, PDO::PARAM_STR);
                    $statement->bindValue(':nickname', $nickname, PDO::PARAM_STR);
                    $statement->bindValue(':date', $date, PDO::PARAM_STR);
                    $statement->bindValue(':hit', $hit, PDO::PARAM_INT);
                    $statement->execute();
                }
            }
		}
	}
    catch(PDOException $ex){
        print $ex->getMessage();
    } 
    echo ("<meta http-equiv='Refresh' content='0; URL=board/mainboard.php'>");
?>