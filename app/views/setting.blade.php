@extends('dashboardLayout')

@section('header')
	<title>Settings</title>
@stop

@section("body")
	<div class="section-header">
		<h2><i class="fa fa-key"></i> Settings</h2>		
	</div>

	<div class="listWrapper">

		<br>
		{{Form::open()}}
			
			{{Bootstrap::password("password", "New Password", $errors)}}
		
			<button type="submit" class="btn btn-success"> Change password</button>
		{{Form::close()}}
	</div>
@stop