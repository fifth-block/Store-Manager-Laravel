<?php

class ReportController extends \BaseController { 

	public function __construct(){
		Session::set("current", "report");
	}


	public function index(){

		$date = Input::get("date", date("Y-m-d"));
		$date = strtotime($date);

		$date = date("Y-m-d", $date);

		$productAdded = Inventory::with("sell")->whereRaw("DATE(created_at) = ?", array($date))->get();

		$productSold = Sell::with("inventories")
						->whereRaw("DATE(created_at) = ?", array($date))
						->get();

		$productAddedProcessedTotal = 0;
		foreach ($productAdded as $product) {
			$productAddedProcessedTotal += ($product->in_stock * $product->buy_price);
		}

		$productSoldProcessed = array();
		$productSoldProcessedTotal = 0;
		foreach ($productSold as $product) {
			$productSoldProcessed[] = array(
				"title" => $product->inventories->first()->title,
				"sell_price" => $product->inventories->first()->sell_price,
				"buy_price" => $product->inventories->first()->buy_price,
				"note" => $product->inventories->first()->note,
				"stock" => $product->inventories->first()->in_stock,
				"quantity" => $product->quantity,
				"total" => $product->quantity*$product->inventories->first()->sell_price
			);
			$productSoldProcessedTotal += ($product->quantity*$product->inventories->first()->sell_price);
		}
		
		return View::make("report.index")->with(array(
				"productAdded" => $productAdded,
				"productSold" => $productSoldProcessed,
				"productSoldTotal" => $productSoldProcessedTotal,
				"productAddedTotal" => $productAddedProcessedTotal,
				"currentDate" => $date
			));
	}


	public function monthly(){

		$month = Input::get("month", date("m"));
		$year = Input::get("year", date("Y"));


		$productAdded = Inventory::with("sell")
			->whereRaw("MONTH(created_at) = ? AND YEAR(created_at) = ?", 
				array($month, $year))
			->get();

		$productSold = Sell::with("inventories")
						->whereRaw("MONTH(created_at) = ? AND YEAR(created_at) = ?", 
							array($month, $year))
						->get();

		$productAddedProcessedTotal = 0;
		foreach ($productAdded as $product) {
			$productAddedProcessedTotal += ($product->in_stock * $product->buy_price);
		}

		$productSoldProcessed = array();
		$productSoldProcessedTotal = 0;
		foreach ($productSold as $product) {
			$productSoldProcessed[] = array(
				"title" => $product->inventories->first()->title,
				"sell_price" => $product->inventories->first()->sell_price,
				"buy_price" => $product->inventories->first()->buy_price,
				"note" => $product->inventories->first()->note,
				"stock" => $product->inventories->first()->in_stock,
				"quantity" => $product->quantity,
				"total" => $product->quantity*$product->inventories->first()->sell_price
			);
			$productSoldProcessedTotal += ($product->quantity*$product->inventories->first()->sell_price);
		}
		
		return View::make("report.monthly")->with(array(
				"productAdded" => $productAdded,
				"productSold" => $productSoldProcessed,
				"productSoldTotal" => $productSoldProcessedTotal,
				"productAddedTotal" => $productAddedProcessedTotal,
				"month" => $month,
				"year" => $year
			));
	}


	public function yearly(){

		$year = Input::get("year", date("Y"));



		$productAdded = Inventory::with("sell")
			->whereRaw("YEAR(created_at) = ?", 
				array($year))
			->get();

		$productSold = Sell::with("inventories")
						->whereRaw("YEAR(created_at) = ?", 
							array($year))
						->get();


		$productAddedProcessedTotal = 0;
		foreach ($productAdded as $product) {
			$productAddedProcessedTotal += ($product->in_stock * $product->buy_price);
		}

		$productSoldProcessed = array();
		$productSoldProcessedTotal = 0;
		foreach ($productSold as $product) {
			$productSoldProcessed[] = array(
				"title" => $product->inventories->first()->title,
				"sell_price" => $product->inventories->first()->sell_price,
				"buy_price" => $product->inventories->first()->buy_price,
				"note" => $product->inventories->first()->note,
				"stock" => $product->inventories->first()->in_stock,
				"quantity" => $product->quantity,
				"total" => $product->quantity*$product->inventories->first()->sell_price
			);
			$productSoldProcessedTotal += ($product->quantity*$product->inventories->first()->sell_price);
		}
		
		return View::make("report.yearly")->with(array(
				"productAdded" => $productAdded,
				"productSold" => $productSoldProcessed,
				"productSoldTotal" => $productSoldProcessedTotal,
				"productAddedTotal" => $productAddedProcessedTotal,
				"year" => $year
			));
	}


	public function range(){

		$fromDate = Input::get("fromDate", date("Y-m-d"));
		$fromDate = strtotime($fromDate);
		$fromDate = date("Y-m-d", $fromDate);

		$toDate = Input::get("toDate", date("Y-m-d"));
		$toDate = strtotime($toDate);
		$toDate = date("Y-m-d", $toDate);
		

		$productAdded = Inventory::with("sell")
			->whereRaw("DATE(created_at) >= ? AND DATE(created_at) <= ?", 
				array($fromDate, $toDate))
			->get();

		$productSold = Sell::with("inventories")
						->whereRaw("DATE(created_at) >= ? AND DATE(created_at) <= ?", 
							array($fromDate, $toDate))
						->get();


		$productAddedProcessedTotal = 0;
		foreach ($productAdded as $product) {
			$productAddedProcessedTotal += ($product->in_stock * $product->buy_price);
		}

		$productSoldProcessed = array();
		$productSoldProcessedTotal = 0;
		foreach ($productSold as $product) {
			$productSoldProcessed[] = array(
				"title" => $product->inventories->first()->title,
				"sell_price" => $product->inventories->first()->sell_price,
				"buy_price" => $product->inventories->first()->buy_price,
				"note" => $product->inventories->first()->note,
				"stock" => $product->inventories->first()->in_stock,
				"quantity" => $product->quantity,
				"total" => $product->quantity*$product->inventories->first()->sell_price
			);
			$productSoldProcessedTotal += ($product->quantity*$product->inventories->first()->sell_price);
		}
		
		return View::make("report.range")->with(array(
				"productAdded" => $productAdded,
				"productSold" => $productSoldProcessed,
				"productSoldTotal" => $productSoldProcessedTotal,
				"productAddedTotal" => $productAddedProcessedTotal,
				"fromDate" => $fromDate,
				"toDate" => $toDate
			));
	}

}