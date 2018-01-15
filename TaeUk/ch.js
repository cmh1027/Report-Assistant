function make_result(url){
	var client = require('cheerio-httpcli');
	const fs = require('fs'); 
	
	//var url = "http://news.khan.co.kr/kh_news/khan_art_view.html?artid=201712141722001";
	var param = {};
	client.fetch(url, param, function(err, $, res) {
		if(err){return;}
		
		var text ='';
		$("p[class *='content']").each(function(idx){
			text += $(this).text();
			text += "\n";
			//var href= $(this).attr('href');
			//console.log(text+"\n");				
			//const text = 'UTF-8로 저장될 텍스트'; 	
		});
		console.log(text);
		fs.writeFileSync("result.txt", '\ufeff' + text, {encoding: 'utf8'});	

	});
}
make_result("http://news.khan.co.kr/kh_news/khan_art_view.html?artid=201712141722001");