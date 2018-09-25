<?php

class CashAdvanceController extends \AdminBaseController {


    public function __construct()
    {
        parent::__construct();
        $this->data['CashAdvance'] ='active open';
        $this->data['pageTitle']  =  'CashAdvance';
    }

    //    Display a listing of awards
    public function index()
	{
		$this->data['pageTitle']  =  'CashAdvance';
		$this->data['CashAdvance'] = CashAdvance::all();
		$this->data['Employees'] = Employee::all();
		
		return View::make('admin.cash_advance.index', $this->data);
	}


	/**
	 * Store a newly created award in storage.
	 */

	public function store()
	{

		$validator = Validator::make($input = Input::all(), CashAdvance::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
   
		CashAdvance::create([
			'employeeID' => $input['employeeID'],
			'amount' => ($input['amount'])?:0,
			'purpose' => $input['purpose'],
			'status' => 'pending',

		]);

		return Redirect::route('admin.cashadvance.index')->with('success',"<strong>{$input['employeeID']}</strong> Daily Time Record added");
	}


	
	/**
	 * Show the form for editing the specified award.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $this->data['cashAdvance']    = CashAdvance::where('id','=',$id)->get();
      
		return View::make('admin.cash_advance.edit', $this->data);
	}

	/**
	 * Update the specified award in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ca = CashAdvance::findOrFail($id);

		$validator = Validator::make($data = Input::all(), CashAdvance::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ca->update($data);

		return Redirect::route('admin.cashadvance.index')->with('success',"<strong>Success</strong> Updated Successfully");
	}

	/**
	 * Remove the specified award from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Request::ajax()) {
			CashAdvance::destroy($id);
			$output['success'] = 'deleted';

			return Response::json($output, 200);
		}else{
			throw(new Exception('Wrong request'));
		}

	}

}
