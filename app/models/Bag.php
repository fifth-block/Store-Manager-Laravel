<?php

class Bag extends \Eloquent {
	protected $fillable = [];
	protected $table = 'bag';
	public $timestamps = false;

	public function inventory(){
		return $this->belongsTo('Inventory', 'inventory_id');
	}
}