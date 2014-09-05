<?php

class DashboardController extends \BaseController {

	public function index(){
		Session::set("current", "dashboard");
		$totalProduct = Sell::whereRaw(" DATE(`created_at`) = CURDATE()")->count();
		$totalUnit = Sell::whereRaw(" DATE(`created_at`) = CURDATE()")->sum('quantity');

		$invoice = Sell::whereRaw(" DATE(`created_at`) = CURDATE()")->get();

		$totalItems = Inventory::distinct()->count();
		$totalStock = Inventory::sum("in_stock");
		$totalPrice = DB::table("inventories")
						->select(DB::raw('sum(in_stock*sell_price) as total'))->get();

		$total = 0;
		foreach ($invoice as $item){
			$total += ($item->quantity * $item->inventories[0]->sell_price);
		}


		return View::make("dashboard")->with(array(
				'totalProduct' => $totalProduct,
				'totalUnit' => $totalUnit,
				'totalSold' => $total,
				'totalItems' => $totalItems,
				'totalStock' => $totalStock,
				'totalInvest' => $totalPrice[0]->total
			));
	}


	public function settings(){
		return View::make("setting");
	}

	public function changePassword(){
		$valid = array(
				"password" => "required|min:6"
			);
		$validator = Validator::make(Input::all(), $valid);
		if($validator->fails()) 
			return Redirect::back()->withErrors($validator);
		$user = User::find(Auth::id());
		$user->password = Hash::make(Input::get("password"));
		$user->save();
		$user->touch();
		return Redirect::back();
	}
}