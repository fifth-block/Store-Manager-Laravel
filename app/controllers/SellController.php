<?php

class SellController extends \BaseController {

	public function __construct(){
		Session::set("current", "sell");
	}
	public function index(){
		$searchKey = Input::get("search", "");
		$inventories = Inventory::where('title', 'LIKE', "%{$searchKey}%")->paginate(15);
		$bag = Bag::count();
		return View::make("sell.index")->with( array(
			"inventories" => $inventories,
			"bag" => $bag,
			"searchKey" => $searchKey
			));
	}

	public function toBag($id){
		$item = Inventory::find($id);
		return View::make("sell.create")->with('item', $item);

	}

	public function addToBag($id){

		$quantity = Input::get("quantity");
		$item = Inventory::find($id);

		if(!is_numeric($quantity)) 
			return Redirect::route("sell.index");

		else if($quantity > $item->in_stock) return Redirect::route("sell.index");

		$bag = new Bag;
		$bag->inventory_id = $id;
		$bag->quantity = $quantity;
		$bag->save();
		return Redirect::route("sell.index");
	}

	public function emptyBag(){
		DB::table('bag')->truncate();
		return Redirect::route("sell.index");
	}

	public function showBag(){
		$items = Bag::with('inventory')->get();

		$bag = Bag::count();

		$total = 0;
		foreach ($items as $item){
			$total += ($item->quantity * $item->inventory->sell_price);
		}
		return View::make("sell.showBag")->with(array('items' => $items, 'bag' => $bag, 
			'total' => $total));
	}


	public function createInvoice(){
		$items = Bag::with('inventory')->get();
		$invoiceId = str_random(5);
		$client = Client::firstOrCreate(array('name' => Input::get("client_name")));
		foreach ($items as $item) {
			$update_data = Inventory::find($item->inventory->id);
			$update_data->in_stock = $update_data->in_stock - $item->quantity;
			$update_data->save();
		}

		foreach ($items as $item){
			$sell = new Sell;
			$sell->invoice_id = $invoiceId;
			$sell->client_id = $client->id;
			$sell->quantity = $item->quantity;
			$sell->save();
			Inventory::find($item->inventory->id)->sell()->save($sell);
		}

		DB::table('pay')->insert(array(
				"invoice_id" => $invoiceId,
				"status" => 0,
				"created_at" => date('Y-m-d H:i:s'),
				"updated_at" => date('Y-m-d H:i:s')
			));
		DB::table('bag')->truncate();
		return Redirect::route("invoice.show", array("id" => $invoiceId));
	}


	public function invoice(){
		Session::set("current", "invoice");
		$searchKey = Input::get("search", "");
		$invoice = DB::table("sells")
						->join('pay', 'sells.invoice_id', '=', 'pay.invoice_id')
						->join('clients', 'sells.client_id', '=', 'clients.id')
						->where("sells.invoice_id", "LIKE", "%{$searchKey}%")
						->orWhere("clients.name", "LIKE", "%{$searchKey}%")
						->groupBy('sells.invoice_id')
						->paginate(15);

		return View::make("sell.invoices")->with('invoice', $invoice);

	}


	public function invoiceShow($id){
		Session::set("current", "invoice");
		$invoice = Sell::where('invoice_id', '=', $id)->get();
		$total = 0;
		foreach ($invoice as $item){
			$total += ($item->quantity * $item->inventories[0]->sell_price);
		}
		$invoiceStatus = DB::table("pay")->where('invoice_id', "=" ,$id)->first();

		return View::make("sell.invoiceShow")->with(array(
			'invoice' => $invoice, 
			'total' => $total,
			'invoiceStatus' => $invoiceStatus,
			'invoice_id' => $id
			));
	}


	public function destroyInvoice($id){

		Sell::where('invoice_id', '=', $id)->delete();
		return Redirect::route('invoice.index');

	}

	public function changeStat($id) {
		DB::table('pay')
            ->where('invoice_id',"=", $id)
            ->update(array('status' => 1));
        return Redirect::back();
   	}
}