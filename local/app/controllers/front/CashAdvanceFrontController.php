<?php

class CashAdvanceFrontController extends \FrontBaseController {

	public function __construct()
    {

        parent::__construct();
        $this->data['pageTitle']   =   'CashAdvance';

    }



	public function index()
	{
		$id = Auth::employees()->get()->employeeID;
		$this->data['cashAdvance']      =      CashAdvance::where('employeeID','=',$id)->get();
		return View::make('front.cash_advance.index',$this->data);
	}

	//	show Job  Page
	public function edit($id)
	{
		$this->data['jobActive'] =    'active';
		$this->data['jobs']      =      Job::where('status','=','active')->get();
		$this->data['job_detail']       =      Job::find($id);
		
		return View::make('front.jobs.show',$this->data);
	}

	//	show Job  Page
	public function store()
	{
		
		$validator = Validator::make($input = Input::all(), CashAdvance::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$input['employeeID'] = Auth::employees()->get()->employeeID;
		
		CashAdvance::create([
			'employeeID' => $input['employeeID'],
			'amount' => ($input['amount'])?:0,
			'purpose' => $input['purpose'],
			'status' => 'pending',

		]);
		Session::flash('success_ca','Successfully applied cash advance!');
		return Redirect::route('front.cashadvance.index');
	}

	public function update($id)
	{
		$ca = CashAdvance::findOrFail($id);

		$validator = Validator::make($data = Input::all(), CashAdvance::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ca->update($data);
		Session::flash('success_ca','Successfully updated cash advance!');
		return Redirect::route('front.cashadvance.index');
	}

	public function ajax_cashadvance()
    {
	    if (Request::ajax()) {
		    $input = Input::get('id');
		    $cash = CashAdvance::where('id', '=', $input)
		                              ->get();
			// $designation = array(array('id'=>'1', 'designation'=>'web'),array('id'=>'2', 'designation'=>'web2'));
		    return Response::json($cash, 200);
		}
	
	}


}