$("#SignUpForm").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();

$.ajax({
	url: "signup.php",
	type: "POST",
	data: datatopost,
	success: function(data){
		if(data){
			$("#signuperror").html(data);
		}
	},
	error: function(){
	    $("#signuperror").html("<div class = 'alert alert-danger'>There was an error with the ajax call.Please try again later</div>");	
	}
});

});

$("#loginForm").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();

$.ajax({
	url: "login.php",
	type: "POST",
	data: datatopost,
	success: function(data){
		if(data == "success"){
			window.location="notesDisplay.php";
		}
		else{
			$("#loginerror").html(data);
		}
	},
	error: function(){
	    $("#loginerror").html("<div class = 'alert alert-danger'>There was an error with the ajax call.Please try again later</div>");	
	}
});

});
