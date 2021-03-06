<!DOCTYPE html>
<html>
<head>
  <script src = "leftboard.js" type = "text/javascript"></script>
  <link href = "leftboard.css" type = "text/css" rel = "stylesheet">
  <meta charset="utf-8">
  <link rel="shortcut icon" href="box.png" type="image/png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="index.css?ver1.10" type="text/css">
      <script type="text/javascript" src="HuskyEZCreator.js" charset="utf-8"></script>
      <title>Bootstrap Example</title>

<?php

</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <span class="navbar-brand" href="#">Report Assistant</span> <!-- @ 하이라이트 꺼주세요 -->
      </div>
      <ul class="nav navbar-nav">
        <li><a href="../index.php">Home</a></li>
        <li><a href="#">글쓰기</a></li>
        <li class="active"><a href="#">게시판</a></li>
        <li><a href="#">포럼</a></li>
      </ul>
    </div>
  </nav>
<!--<div>
  <text>찾기<text>
  <input type="text" name="search" placeholder="Search..">
</div>
-->
    <div id = "mainstage"> <!-- 목록및 검색 제목-->
      <h2>사용자게시판</h2>
      <p>마음껏 글을 작성하고 수정해보세요</p>
      <table class="table">
         <thead>
           <tr>
             <th>번호</th>
             <th>제목</th>
             <th>작성자</th>
             <th>등록일</th>
             <th>조회수</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>John</td>
             <td><a href = " ">Doe</a></td>
             <td>Doe</td>
             <td>Doe</td>
             <td>Doe</td>
           </tr>
           <tr>
             <td>Mary</td>
             <td><a href = " ">Moe</a></td>
             <td>Doe</td>
             <td>Doe</td>
             <td>Doe</td>
           </tr>
           <tr>
             <td>July</td>
             <td><a href = " ">Dooley</a></td>
             <td>Doe</td>
             <td>Doe</td>
             <td>Doe</td>
           </tr>
         </tbody>
       </table>
     <div id ="write">
        <button type="button" class="btn btn-outline-light text-dark"><a href="./write.php">글쓰기</a></button>
     </div>
     <div class="container">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <!--<li class="page-item "><a class="page-link" href="#">2</a></li> -->
        <!--<li class="page-item"><a class="page-link" href="#">3</a></li> -->
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </div>
    </div>
    </div>

    <div class="tab">
      <button class="tablinks" onclick="openboard(event, '')">정치</button>
      <button class="tablinks" onclick="openboard(event, '')">경제</button>
      <button class="tablinks" onclick="openboard(event, '')">IT</button>
      <button class="tablinks" onclick="openboard(event, '')">과학</button>
      <button class="tablinks" onclick="openboard(event, '')">예술</button>
      <button class="tablinks" onclick="openboard(event, '')">과학</button>
      <button class="tablinks" onclick="openboard(event, '')">스포츠</button>
      <button class="tablinks" onclick="openboard(event, '')">이슈</button>
    </div>
</body>
</html>
