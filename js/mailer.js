function switch1() {
	document.getElementsByClassName("emailform")[0].style.display = "none";
	document.getElementsByClassName("listview")[0].style.display = "block";
}

function switch2() {
	document.getElementsByClassName("emailform")[0].style.display = "block";
	document.getElementsByClassName("listview")[0].style.display = "none";
}


var sender = document.getElementById("send");


$("#send").click(function(e) {
	e.preventDefault();
	document.getElementById("errorBox").innerHTML = "";


	var _subject = document.getElementById("exampleInputSubject1").value;
	var _body = document.getElementById("exampleBody1").value;
	var _mails = document.getElementById("exampleEmail1").value;

	if(_subject !== "" && _body !== "" && _mails != "") {
		SendMail(_subject, _body, _mails);
	}
	else {
		document.getElementById("errorBox").innerHTML = '<span class="alert alert-warning">Please fill the form completely before sending</span>';
	}

});



function SendMail(subject, body, mails) {
	
	$.ajax({
		url: "mailer.php",
		method: "GET",
		data: {subject:subject, body:body, mails: mails},
		success: function(res){
			if(res !== "") {
				res = JSON.parse(res);
				if(res.length){
					document.getElementsByClassName("emailform")[0].style.display = "none";
					document.getElementsByClassName("listview")[0].style.display = "block";
				}
				
				_Manipulate(res);
			}
		}
	});
}


function _Manipulate(data) {
	var i = 0;
	var row = "";
	var sent = 0, unsent = 0;

	for(i; i < data.length; i++) {
		row += '<tr role="row" class="odd">';
	       row += '<td class="sorting_1">'+ (i + 1) +'</td>';
	       row += '<td>' + data[i].email + '</td>';

	       if(Boolean(Number(data[i].status))) {
	       	sent += 1;
	        row += '<td><span class="badge badge-success">sent</span></td>';
	       } else {
	       	unsent += 1;
	        row += '<td><span class="badge badge-danger"> not sent</span></td>';
	       }
	       row += '</tr>';
	}

	var _tbody = document.getElementById("mailtable");
	_tbody.innerHTML = row;

	$(".allmails").html(i);
	$(".sent").html(sent);
	$(".unsent").html(unsent);
}

function get_previous_status() {
	$.ajax({
		url: "mailer.php",
		method: "GET",
		data: {previous:true},
		success: function(res){
			if(res !== "") {
				res = JSON.parse(res);
				_Manipulate(res);
			}
		}
	});
}

function get_mail_title() {
	$.ajax({
		url: "mailer.php",
		method: "GET",
		data: {previous:true},
		success: function(res){
			res = JSON.parse(res);
			_Manipulate(res);
		}
	});
}

get_previous_status();

$("#add-title").click(function(){
	var title = $(".create-title").val();
	console.log("Hello! "+title);
	if(title !== "") {
		$.ajax({
			url: 'mailer.php',
			method: 'POST',
			data: {title:title},
			success: function(res) {
				if(res !== "failed") {
					res = JSON.parse(res);
					_ManipulateTitles(res);
				}
			}
		});
	}
});


function getTitle() {
	$.ajax({
		url: 'mailer.php',
		method: 'GET',
		data: {title:true},
		success: function(res) {
			if(res !== "failed") {
				res = JSON.parse(res);
				_ManipulateTitles(res);
			}
		}
	});
}

getTitle();


function _ManipulateTitles(data) {

	var _dom = "";
	for(var i = 0; i < data.length; i++) {
		_dom += '<li class="completed">';
		_dom += '<div class="form-check">';
		_dom += '<label class="title-label">';
		_dom += data[i].title;
		_dom += '</label>';
		_dom += '</div>';
		_dom += '<i class="remove icon-close" onClick="remove(' + data[i].sn + ')"></i>';
		_dom += '</li>';
	}

	$(".title-list").html(_dom);

	var _options = "";
	for(var i = 0; i < data.length; i++) {
		_options += '<option value="' + data[i].title +'">' + data[i].title + '</option>';
	}

	$("#exampleInputSubject1").append(_options);

}


function remove(sn) {
	$.ajax({
		url: "mailer.php",
		method: "GET",
		data: {remove:sn},
		success: function(res){
			if(res !== "") {
				res = JSON.parse(res);
				_ManipulateTitles(res);
			}
		}
	});
}


$("#status").change(function(){
	var status = $(this).val();

	if(status == "sent"){
		status = "1";
	} else if(status == "unsent") {
		status = "0"
	}

	else {
		get_previous_status();
		return;
	}

	getByStatus(status);
});

function getByStatus(status) {
	$.ajax({
		url: "mailer.php",
		method: "GET",
		data: {status:status},
		success: function(res){
			if(res !== "") {
				res = JSON.parse(res);
				_Manipulate(res);
			}
		}
	});
}

