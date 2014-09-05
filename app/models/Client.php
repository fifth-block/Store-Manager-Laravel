<?php

class Client extends \Eloquent {
	protected $fillable = ['name'];
	protected $table = 'clients';
	public $timestamps = false;

	public function sells (){
		return $this->hasMany('Sell');
	}
}