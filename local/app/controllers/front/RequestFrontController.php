<?php

class RequestFrontController extends \FrontBaseController {

	public function __construct()
    {

        parent::__construct();
        $this->data['pageTitle']   =   'Request';

    }



	public function index()
	{
		$id = Auth::employees()->get()->employeeID;
		$this->data['requests']      =      RequestOther::where('employeeID','=',$id)->get();
		return View::make('front.request_other.index',$this->data);
	}


	//	Store
	public function store()
	{
		
		$validator = Validator::make($input = Input::all(), RequestOther::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$input['employeeID'] = Auth::employees()->get()->employeeID;
		
		RequestOther::create([
			'employeeID' => $input['employeeID'],
			'quantity' => ($input['quantity'])?:0,
			'remarks' => $input['remarks'],
			'description' => $input['description'],
			'status' => 'pending',

		]);
		Session::flash('success','Successfully added your request!');
		return Redirect::route('front.request.index');
	}

	public function update($id)
	{
		$request = RequestOther::findOrFail($id);
		
		$validator = Validator::make($data = Input::all(), RequestOther::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$request->update($data);
		Session::flash('success_ca','Successfully updated your request!');
		return Redirect::route('front.request.index');
	}

	public function ajax_cashadvance()
    {
	    if (Request::ajax()) {
		    $input = Input::get('id');
		    $request = RequestOther::where('id', '=', $input)
		                              ->get();
			// $designation = array(array('id'=>'1', 'designation'=>'web'),array('id'=>'2', 'designation'=>'web2'));
		    return Response::json($request, 200);
		}
	
	}


}