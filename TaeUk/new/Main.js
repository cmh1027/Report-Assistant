j$('#Sign_up_btn').click( function(){
	document.getElementById('Sign_up').style.display = 'block';
});

var modal = document.getElementById('Sign_up');
var modal2 = document.getElementById('pass_up');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
		modal2.style.display = "none";
		modal3.style.display = "none";
    }
}

j$('#cancel').click( function(){
	document.getElementById('Sign_up').style.display = 'none';
});

j$('#cancel_btn').click( function(){
	document.getElementById('Sign_up').style.display='none'
});

j$('#cancel2').click( function(){
	document.getElementById('pass_up').style.display = 'none';
});

j$('#cancel_btn2').click( function(){
	document.getElementById('pass_up').style.display='none'
});
j$('#pass_up_btn').click( function(){
	document.getElementById('pass_up').style.display = 'block';
});

j$('#search_btn').click( function(e){
	j$('#report_result').load('Search.php');
});