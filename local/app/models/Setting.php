<?php

class Setting extends \Eloquent {

	// Add your validation rules here
    public static $rules = [
        'website'    =>  'required',
        'email'      =>  'required|email',
        'name'       =>  'required',
        'logo'       =>  'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:1000'

    ];

	// Don't forget to fill this array
	protected $fillable =   [];
    protected $guarded  =   ['id'];

	public function getLangName()
	{
		// belongs('OtherClass','thisclasskey','otherclasskey')
		return $this->belongsTo('Language','locale','locale');
	}

}