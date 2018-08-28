<?php

class Noticeboard extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'title' => 'required|min:10',
		 'description' => 'required|min:10'
	];

	// Don't forget to fill this array
	protected $fillable = ['title','description','status'];



}