<?php

class Company extends \Eloquent {
	protected $fillable = ["name"];
	public $timestamps = false;
	public function inventory(){
		return $this->hasMany("inventory", "companies_id");
	}
}