<?php
    header("Content-type: application/json");
    if(isset($_REQUEST["search"])){
	    exec("python3 crawl.py ".$_REQUEST["search"]);
        $data = file("search.txt");
        $output = array();
        $title = array();
        $href = array();
        $writer = array();
        $content = array();
        for($i=0; $i<count($data); $i=$i+4){
            $title[]=$data[$i];
            $href[]=$data[$i+1];
            $writer[]=$data[$i+2];
            $content[]=$data[$i+3];
        }
        $output["title"]=$title;
        $output["href"]=$href;
        $output["writer"]=$writer;
        $output["content"]=$content;
        $output = json_encode($output);
        print $output;
    }
    else{
        print array();
    }
?>