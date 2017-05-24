<?php
session_start();
$_SESSION['root'] = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/nocv2/';
if(isset($_SESSION['np_user_id'])){
	header('Location:'.$_SESSION['root']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MotivIT NOC Portal | Login</title>
	<link href="images/icons/favicon.png" rel="shortcut icon">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
	<link href="css/global.css" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet">
	<link href="library/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	<!--Added CSS and JS files-->
	<link href="css/login.css" rel="stylesheet" type="text/css">
	<script src="js/global.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>
	<script src="js/popup.js" type="text/javascript"></script>
	<script src="js/process.js" type="text/javascript"></script>
	<script src="library/jquery-ui-1.11.4/external/jquery/jquery.js" type="text/javascript"></script>
	<script src="library/jquery-ui-1.11.4/jquery-ui.js" type="text/javascript"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">
	
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="container">
					<form id="login_form">
						<img src="images/logo_index.png" class="loginLogo" style="width: 278px;"></img>
						<div class="form-group">
							<input type="text" class="form-control" id="username" placeholder="Enter Username">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="password" placeholder="Enter Password">
						</div>
						<button type="submit" class="btn btn-default">Continue</button>
						<div class="checkbox">
							<input type="checkbox" id="remember_me"><label for="remember_me">Remember Me</label>
						</div>
					</form>
				</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script>
	$('#username, #password').keyup(function(e){
		if((e.keyCode == 13 || e.which == 13))
			$( "form" ).submit();
	});
	$( "form" ).on( "submit", function( event ) {
		event.preventDefault();
		main.login();
	});
	$(function() {
		if (localStorage.chkbx && localStorage.chkbx != '') {
			$('#remember_me').attr('checked', 'checked');
			$('#username').val(localStorage.usrname);
			$('#password').val(localStorage.pass);
		} else {
			$('#remember_me').removeAttr('checked');
			$('#username').val('');
			$('#password').val('');
		}

		$('#remember_me').click(function() {

			if ($('#remember_me').is(':checked')) {
				localStorage.usrname = $('#username').val();
				localStorage.pass = $('#password').val();
				localStorage.chkbx = $('#remember_me').val();
			} else {
				localStorage.usrname = '';
				localStorage.pass = '';
				localStorage.chkbx = ''; 
			}
		});
	});
	</script>
</body>

</html>
