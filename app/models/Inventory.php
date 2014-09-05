<?php

class Inventory extends \Eloquent {
	protected $fillable = [];

	public function company(){
		return $this->belongsTo("Company", "companies_id");
	}

	public function bags(){
		return $this->hasMany('Bag', 'inventory_id');
	}

	public function sell(){
		return $this->belongsToMany('Sell');
	}
}