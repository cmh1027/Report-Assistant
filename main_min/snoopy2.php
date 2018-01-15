<?php
header("Content-Type: text/html; charset=utf-8");
require('./Snoopy/Snoopy.class.php');
require('./Snoopy/simple_html_dom.php');

//var_dump($_GET['url']);
//var_dump(strpos($_POST['url'], "news.khan.co.kr") != false);
if($_GET['url'] == null){
	exit();
}
$url = $_GET['url'];
//경향
//$url="http://news.khan.co.kr/kh_news/khan_art_view.html?artid=201712141722001";
//중앙
//$url="http://news.joins.com/article/22210373"; 
//동아
//$url="http://news.donga.com/List/3/all/20171217/87782424/1";
//한국경제
//$url="http://auto.hankyung.com/article/2017121708471";
//조선일보
//$url="http://news.chosun.com/site/data/html_dir/2017/12/17/2017121701294.html";
//노컷뉴스
//$url="http://www.nocutnews.co.kr/news/4893727";
//한겨레
//$url="http://www.hani.co.kr/arti/society/society_general/823896.html?_fr=mt2";
//연합뉴스
//$url="http://www.yonhapnews.co.kr/politics/2017/12/17/0502000000AKR20171217024751001.HTML?template=2087";
//매일경제
//$url="http://news.mk.co.kr/newsRead.php?sc=30000001&year=2017&no=833949";
//아시아경제
//$url="http://www.asiae.co.kr/news/view.htm?idxno=2017121720085919264";
//머니투데이
//$url="http://news.mt.co.kr/mtview.php?no=2017121713373120746&MTS";
//한국i닷컴
//$url="http://daily.hankooki.com/lpage/politics/201712/dh20171217162247137450.htm";
//서울신문
//$url="http://www.seoul.co.kr/news/newsView.php?id=20171218001003";
	
$snoopy = new Snoopy;  //스누피 객체 생성
$snoopy->fetch($url);  // 배열 생성
 
$html =new simple_html_dom();  //돔 객체 생성
$html->load($snoopy->results); // 로드 함수 호출하여 스누피 결과값 입력

if(strpos($_GET['url'], "news.khan.co.kr") != false){
//경향
$lists=$html->find('p.content_text'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "news.joins.com") != false){
//중앙
$lists=$html->find('div#article_body'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "news.donga.com") != false){
//동아
$lists=$html->find('div.article_txt'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "auto.hankyung.com") != false){
//한국경제
$lists=$html->find('div.articlebody'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "news.chosun.com") != false){
//조선일보
$lists=$html->find('div.par'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "www.nocutnews.co.kr") != false){
//노컷뉴스
$lists=$html->find('div#pnlContent'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "www.hani.co.kr") != false){
//한겨레
$lists=$html->find('div.article-text'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "www.yonhapnews.co.kr") != false){
//연합뉴스
$lists=$html->find('div#articleWrap'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "news.mk.co.kr") != false){
//매일경제
$lists=$html->find('div.art_txt'); // selector를 이용하여 요소값 인
}else if(strpos($_GET['url'], "www.asiae.co.kr") != false){
//아시아경제
$lists=$html->find('div.txt'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "news.mt.co.kr") != false){
//머니투데이
$lists=$html->find('div#textBody'); // selector를 이용하여 요소값 인
}else if(strpos($_GET['url'], "daily.hankooki.com") != false){
//한국i닷컴
$lists=$html->find('div.last'); // selector를 이용하여 요소값 인식
}else if(strpos($_GET['url'], "www.seoul.co.kr") != false){
//서울신문
$lists=$html->find('div.v_article'); // selector를 이용하여 요소값 인식
}else{
	exit();	
}

$text ='';
foreach($lists as $list){
    //echo $list;    // 리스트 출력
	$text .= strip_tags($list);
	$text .= "\n";
}
//print $text;
$fileName = 'result.txt';
$fp = fopen($fileName, 'w+');
if (! is_resource($fp)) {
  die('파일을 열지 못했습니다.');
}
//조선일보
if(strpos($_GET['url'], "news.chosun.com") != false){
	$text = iconv("euc-kr", "utf-8", $text);
}
$log = $text;
flock($fp, LOCK_EX);
fwrite($fp, $log);
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);
//print_r($text);
?>