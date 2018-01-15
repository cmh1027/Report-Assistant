<?php
header("Content-Type: text/html; charset=utf-8");
//Snoopy.class.php를 불러옵니다
//require($_SERVER['DOCUMENT_ROOT'].'./Snoopy/Snoopy.class.php');
require('./Snoopy/Snoopy.class.php');

//스누피를 생성해줍시다
$snoopy = new Snoopy;

$o="";
//중앙
//$snoopy->fetch("http://news.joins.com/article/22210373");
//경향
$snoopy->fetch("http://news.khan.co.kr/kh_news/khan_art_view.html?artid=201712141722001");
$txt=$snoopy->results;

//중앙일보article_body''
//$rex="/\<div.\>(.*)\<\/div\>/";
//경향신문
$rex="/\<p class=\"content.+\"\>(.*)\<\/p\>/";
preg_match_all($rex,$txt,$o);


$text ='';
foreach($o[0] as $key => $val){	
	$text .= strip_tags($val);
	$text .= "\n";
}
$fileName = 'result.txt';
$fp = fopen($fileName, 'w+');
if (! is_resource($fp)) {
  die('파일을 열지 못했습니다.');
}
$text = iconv("euc-kr", "utf-8", $text);
$log = $text;
flock($fp, LOCK_EX);
fwrite($fp, $log);
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);
print_r($text);
?>