<?php

class Sell extends \Eloquent {
	protected $fillable = [];

	public function inventories(){
		return $this->belongsToMany('Inventory');
	}

	public function client(){
		return $this->belongsTo('Client', 'client_id');
	}
}