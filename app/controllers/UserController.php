<?php

class UserController extends \BaseController {

	public function login(){
		$data = array(
			"username" => Input::get("username"),
			"password" => Input::get("password")
		);

		$valid = Validator::make($data, array("username" => "required", "password" => "required"));
		if($valid->fails()) return Redirect::back()->withInput()->withErrors($valid);

		if(Auth::attempt(array("username" => $data["username"], "password" => $data["password"]), false)){
			Session::put('current', 'dashboard');
			return Redirect::to("/dashboard");
		}else return Redirect::back()->withInput()->withErrors(array("loginError" => "Username or Password not matched"));
	}


	public function logout(){
		Auth::logout();
		return Redirect::to('/');
	}
}