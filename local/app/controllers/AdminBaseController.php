<?php

class AdminBaseController extends Controller {

    protected  $data = [];


    public function __construct()
    {
	    $this->data['setting']      = Setting::all()->first();

	    $this->data['datatabble_lang'] ='';
        if (file_exists("assets/global/plugins/datatables/langjson/{$this->data['setting']->locale}.json"))
	    {
		        $url = URL::asset("assets/global/plugins/datatables/langjson/{$this->data['setting']->locale}.json");
	             $this->data['datatabble_lang']  = "'language': {
                    'url': '$url'
                },";
	    }

	    App::setLocale($this->data['setting']->locale);

	    if(!isset($this->data['setting']) && count($this->data['setting'])==0){
		    die('Database not uploaded.Please Upload the database');
	    }

	    $this->data['loggedAdmin']  = Auth::admin()->get();
	    $this->data['pending_applications']   = LeaveApplication::where('application_status','=','pending')->get();
	    $this->data['languages']   = Language::all();
	    /** GET SLUG */
			$current_uri = Route::current()->uri();
     	$current_uri = explode('/', $current_uri);
     	$this->data['slug'] = count($current_uri) > 1 ? $current_uri[1] : $current_uri[0];


    }


	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
