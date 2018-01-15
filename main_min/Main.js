j$('#Sign_up_btn').click( function(){
	document.getElementById('Sign_up').style.display = 'block';
});

var modal = document.getElementById('Sign_up');
var modal2 = document.getElementById('pass_up');
var modal3 = document.getElementById('msg_pwd');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
		modal2.style.display = "none";
		modal3.style.display = "none";		
    }
};

j$('#cancel').click( function(){
	document.getElementById('Sign_up').style.display = 'none';
});

j$('#cancel_btn').click( function(){
	document.getElementById('Sign_up').style.display='none';
});

j$('#cancel2').click( function(){
	document.getElementById('pass_up').style.display = 'none';
});

j$('#cancel_btn2').click( function(){
	document.getElementById('pass_up').style.display='none';
});
j$('#pass_up_btn').click( function(){
	document.getElementById('pass_up').style.display = 'block';
});

j$('#search_btn').click( function(e){
	j$('#report_result').load('Search.php');
});

j$('#signup_btn').click( function(e){
	 j$.ajax({
		url:'./signup.php',
		type:'post',
		data:j$('form').serialize(),		
		success:function(data){
			alert(data);
			document.getElementById('Sign_up').style.display='none';
		},
		error: function(data){
			alert('서버 에러'); 
	 	}
	});
});




j$('#pass_submit').click( function(){
	console.log(j$('#pass_email')[0].value);
	Email.send("webteamproject@naver.com",//보내는 이메일 계정
			j$('#pass_email')[0].value,//받는 이메일 계정
			"Report Assistant- 비밀번호 찾기",
			"<form action='http://taeuk.run.goorm.io/webapp3/main_min/pwd_reset.php' method='post'>"+
			  '<input type="hidden" name="userid" value="'+j$('#pass_email')[0].value+'"><input type="submit" value="비밀번호 변경"/></form>',
			"smtp.naver.com",//네이버 smtp
			"webteamproject",//네이버 아이디
			"webapp!!");
});

/*
j$('#pwd_modify_submit').click( function(){
	 j$.ajax({
		url:'./pwd_reset2.php',
		type:'post',
		data:j$('form').serialize(),		
		success:function(data2){
			alert(data2);			
		},
		error: function(data2){
			alert('서버 에러'); 
	 	}
	});
});
j$('#cancel3').click( function(){
	document.getElementById('msg_pwd').style.display = 'none';
});
j$('#cancel_pwd').click( function(){
	document.getElementById('msg_pwd').style.display='none';
});
*/

