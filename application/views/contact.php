
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register Form</title>

	<style type="text/css">

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	#container {
		margin: 10px;
		padding: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	.required-star{
		color: red;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Contact Form</h1>

	<div id="body">
		<form id="myForm" class="form-horizontal" action='' method="POST">
			<div class="form-group">
				<label for="name">Name <span class="required-star">* </span></label>
				<input type="text" class="form-control required" id="name" name="name">
			</div>

			<div class="form-group">
				<label for="email_address">Email Address <span class="required-star">* </span></label>
				<input type="text" class="form-control required" id="email_address" name="email_address">
			</div>

			<div class="form-group">
				<label for="phone_number">Phone Number <span class="required-star">* </span></label>
				<input type="text" class="form-control required" id="phone_number" name="phone_number">
			</div>
			<hr/>
			<div id="dynamic"></div>

		<div class="form-group">
				<button type="button" id="add_input" class="btn btn-secondary">Add Field</button> | <input type="button" id="submit" value="Submit" class="btn btn-primary" />
			</div>
		</form>
	</div>

</div>
<br/><br/><br/>
</body>
</html>
<script type="text/javascript">
	$(function() {
		var i = 0;
        $('#add_input').click(function() {
			i++;
			$('#dynamic').append('<div class="form-group" id="row' + i + '"><input type="text" name="databaseVal' + i + '" class="form-control" placeholder="Label" /><br/><input type="text" name="content' + i + '" class="form-control" placeholder="Input Value" /><br/><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Remove</button>');
		});
	}); 

	$(document).on('click', '.btn_remove', function() {
		var button_id = $(this).attr("id");
		$('#row' + button_id + '').remove();
	});

	$("#submit").click(function(e){
		
        var name = $('#name').val();
        var email_address = $('#email_address').val();
        var phone_number = $('#phone_number').val();
        
		if(name == ""){
			bootbox.alert("<strong>Error!</strong> Please enter your name.");
			return;
		}

		if(email_address == ""){
			bootbox.alert("<strong>Error!</strong> Please enter your email-address.");
			return;
		}

		if(email_address != "" && !(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email_address))){
			bootbox.alert("You have entered an invalid email address!");
			return;
		}

		if(phone_number == ""){
			bootbox.alert("<strong>Error!</strong> Please enter your phone number.");
			return;
		}

		var dataValues = $("form").serialize();

		$.post("<?=base_url('/index.php/Contact/save_info')?>",
		{
            /*name: name,
            email_address: email_address,
			phone_number: phone_number*/
			dataValues: dataValues

		},function(data,status){
			if(status == "success"){
				if(data.success ){
					bootbox.alert("Saved");
                }
				if(data.error)
					bootbox.alert(data.error);
			}else
				bootbox.alert("Error! An error has occurred");	
		},"json");
	});

</script>