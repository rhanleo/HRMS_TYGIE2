<?php

class BaseController extends Controller {

    protected  $data = array();

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    public function __construct()
    {
        $this->data['setting']    = Setting::all()->first();

    }


	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


}

