<!DOCTYPE html>
<html lang="">
	<head>
		<title>Login</title>
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		{{Bootstrap::css('local', ['type' => 'text/css'])}}

		<style type="text/css">
			body {
				background: #eee;

			}
			.loginBox {
				margin-top: 10%;
				background: #fff;
				padding: 0;
				padding-bottom: 20px;
			}
			.loginBox .loginHeader {
				width: 100%;
				display: block;
				padding: 10px;
				background: #444;
				color: #fff;
				font-size: 14px;
				margin-bottom: 20px;
			}
			.loginBox .loginBody {
				padding-left: 10px;
				padding-right: 10px;
			}
		</style>
	</head>
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 loginBox">
					<div class="loginHeader">
						Login To Continue...
					</div>
					<div class="loginBody">
						@if($errors->has("loginError"))
							{{Bootstrap::danger("Username or Password doesn't matched", 'Oops!', true)}}
						@endif
						{{Form::open()}}
						{{Bootstrap::vertical()->text('username', 'Username', Input::old("username"), $errors)}}
						{{Bootstrap::vertical()->password('password', 'Password', $errors)}}
						
						{{Bootstrap::submit("Login")}}
						{{Form::close()}}
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		{{Bootstrap::js('local', ['type' => 'text/javascript'])}}
	</body>
</html>