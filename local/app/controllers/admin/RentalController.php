<?php

class RentalController extends \AdminBaseController {


    public function __construct()
    {
        parent::__construct();
        $this->data['rentalOpen'] ='active open';
        $this->data['pageTitle']  =  'Rental';
    }

    //    Display a listing of awards
    public function index()
	{
		$this->data['pageTitle']  =  'Rental';
		$this->data['rentals'] = Rental::all();
		$this->data['Employees'] = Employee::all();
		$this->data['employees'] = Employee::selectRaw('CONCAT(firstName, " ", lastName, " (EmpID:", employeeID,")") as full_name, employeeID')
	                                        ->where('status','=','active')
	                                        ->lists('full_name','employeeID');
		
		return View::make('admin.rental.index', $this->data);
	}


	/**
	 * Store a newly created award in storage.
	 */

	public function store()
	{

		$validator = Validator::make($input = Input::all(), Rental::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$dateCovered =   date_format( date_create($input['date_covered']), 'Y-m-d' );
		
		Rental::create([
			'employeeID' => $input['employeeID'],
			'amount' => ($input['amount'])?:0,
			'remarks' => $input['remarks'],
			'date_covered' => $dateCovered,
			'status' => $input['status'],

		]);

		return Redirect::route('admin.rental.index')->with('success',"<strong>{$input['employeeID']}</strong> Successfully added  rental!");
	}


	
	/**
	 * Show the form for editing the specified award.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $this->data['rentals']    = Rental::where('id','=',$id)->get();
      
		return View::make('admin.rental.edit', $this->data);
	}

	/**
	 * Update the specified award in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rental = Rental::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Rental::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$rental->update($data);

		return Redirect::route('admin.rental.index')->with('success',"<strong>Success</strong> Updated Successfully");
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
