window.onload=function(){
    if(document.getElementById("keyword").value!==""){
        new Ajax.Request("search_json.php",{
            parameters: {search:document.getElementById("keyword").value},
            onSuccess: search_json,
            onFailure: ajaxFailed,
            onException: ajaxFailed
        });
    }
    document.getElementById("search_button").onclick=search;
};
function search(){
	document.getElementById("search_result").innerHTML="검색중..";
    if(document.getElementById("search").value!==""){
        new Ajax.Request("search_json.php",{
            parameters: {search:document.getElementById("search").value},
            onSuccess: search_json,
            onFailure: ajaxFailed,
            onException: ajaxFailed
        });
    }
}

function search_json(ajax){
    document.getElementById("search_result").innerHTML="";
    var data = JSON.parse(ajax.responseText);
    for (var i = 0; i < data.title.length; i++) {
		var form = document.createElement("form");
        form.setAttribute("action", "writing.php");
        form.setAttribute("method", "post");
        n = i*4;
        form.setAttribute("id", "writing"+n);
        var div = document.createElement("div");
        div.setAttribute("class", "article");
        var p1 = document.createElement("p");
        var title = document.createElement("button");
        title.setAttribute("class", "news_select");
        title.setAttribute("id", "select"+n);
        title.setAttribute("type", "button");
        var span = document.createElement("span");
        span.setAttribute("class", "title");
        span.textContent=data.title[i];
        title.appendChild(span);
        p1.appendChild(title);
        var p2 = document.createElement("p");
        var p3 = document.createElement("p");
        p2.textContent=data.writer[i];
        p3.textContent=data.content[i];
        div.appendChild(p1);
        div.appendChild(p2);
        div.appendChild(p3);
        var hidden = document.createElement("input");
        hidden.setAttribute("type", "hidden");
        hidden.setAttribute("name", "href");
        hidden.setAttribute("value", data.href[i]);
        form.appendChild(div);
        form.appendChild(hidden);
        form.appendChild(document.createElement("br"));
        document.getElementById("search_result").appendChild(form);
        title.onclick= function(){
            this.up(2).submit();
        };
    }
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}

