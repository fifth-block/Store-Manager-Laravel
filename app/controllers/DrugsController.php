<?php

class DrugsController extends \BaseController {

	protected $validatorRules = array(
			'company' => 'required',
			'medicine_name' => 'required',
			'expire_date' => 'required|date',
			'buy_price' => 'required|numeric',
			'sell_price' => 'required|numeric',
			'stock_size' => 'required|numeric'
		);

	protected $validatorUpdate = array(
			'company' => 'required',
			'title' => 'required',
			'expire_date' => 'required|date',
			'buy_price' => 'required|numeric',
			'sell_price' => 'required|numeric',
			'in_stock' => 'required|numeric'
		);
	public function index()
	{
		/*$inventories = Inventory::with(array('company'))
						->groupBy('title')
						->paginate(15); */
		$searchKey = Input::get("search", "");
		$inventories = DB::table('inventories')
						->select(DB::raw("sum(in_stock) as in_stock, title, expire_date, id, count(*) as times"))
						->where("title", "LIKE", "%{$searchKey}%")
						->groupBy('title')
						->paginate(15);
		
		Session::set("current", "store");
		return View::make("drugs.index")->with(array("inventories" => $inventories, "searchKey" => $searchKey));
	}

	
	public function create(){
	
		$company = Company::all();
		$com = array();
		foreach($company as $comp){
			$com[] = $comp->name;
		}
		File::put(public_path().'/feeds/companies.json', json_encode($com));

		$drugs = Inventory::distinct('title')->get();
		$drug = array();
		foreach($drugs as $comp){
			$drug[] = $comp->title;
		}
		File::put(public_path().'/feeds/medicine_name.json', json_encode($drug));

		return View::make("drugs.create");
	}

	public function store(){
		$validator = Validator::make(Input::all(), $this->validatorRules);
		if($validator->fails()) return Redirect::back()->withInput()->withErrors($validator);

		$company = Company::firstOrCreate(array('name' => Input::get("company")));
		$inventory = new Inventory;
		$inventory->title = Input::get("medicine_name");
		$inventory->buy_price = Input::get('buy_price');
		$inventory->sell_price = Input::get('sell_price');
		$inventory->in_stock = Input::get('stock_size');
		$inventory->expire_date = Input::get('expire_date');
		$inventory->note = Input::get('note_about_stock');
		$inventory->companies_id = $company->id;

		$inventory->save();
		$inventory->touch();
		return Redirect::route("store.index");
	}

	public function details($medicine_name){
		$inventories = Inventory::with("company")->where(array("title" => $medicine_name))->get();
		
		Session::set("current", "store");
		return View::make("drugs.details")->with(array(
			"inventories" => $inventories,
			"title" => $medicine_name
			));
	}

	public function edit($id) {
		$inventory = Inventory::with('company')->find($id);
		$inventory->company = $inventory->company->name;
		Session::set("current", "store");
		return View::make("drugs.edit")->with('inventory', $inventory);
	}

	public function update($id){
		$validator = Validator::make(Input::all(), $this->validatorUpdate);
		if($validator->fails()) return Redirect::back()->withInput()->withErrors($validator);

		$company = Company::firstOrCreate(array('name' => Input::get("company")));
		$inventory = Inventory::find($id);
		$inventory->title = Input::get("title");
		$inventory->buy_price = Input::get('buy_price');
		$inventory->sell_price = Input::get('sell_price');
		$inventory->in_stock = Input::get('in_stock');
		$inventory->expire_date = Input::get('expire_date');
		$inventory->note = Input::get('note');
		$inventory->companies_id = $company->id;

		$inventory->save();
		$inventory->touch();
		return Redirect::route("store.index");
	}	

	public function delete($id){
		$inventory = Inventory::find($id);
		$inventory->delete();
		return Redirect::route("store.index");
	}

}