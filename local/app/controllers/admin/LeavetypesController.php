<?php

class LeavetypesController extends \AdminBaseController {




    public function __construct()
    {
        parent::__construct();
        $this->data['attendanceOpen']  = 'active open';
        $this->data['pageTitle']       =  trans('core.leaveTypes');
    }

	public function index()
	{
		$this->data['leaveTypes']      = Leavetype::all();
        $this->data['leaveTypeActive'] = 'active';

		return View::make('admin.leavetypes.index', $this->data);
	}


	/**
	 * Store a newly created leavetype in storage.
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Leavetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Leavetype::create($data);

        Session::flash('success',"<strong>{$data['leaveType']}</strong> leave created successfully");
		return Redirect::route('admin.leavetypes.index');
	}


	/**
	 * Show the form for editing the specified leavetype.
	 */
	public function edit($id)
	{
		$leavetype = Leavetype::find($id);

		return View::make('admin.leavetypes.edit', compact('leavetype'));
	}

	/**
	 * Update the specified leavetype in storage.
	 */
	public function update($id)
	{


		$leavetype = Leavetype::findOrFail($id);

		$validator = Validator::make($input = Input::all(), Leavetype::rules($id));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		/** UPDATE LEAVE CREDITS */
		$leave_credits_arr = DB::table('leave_credits')
								->where('leaveType', $input['old_leavetype'])
								->get();

		if (count($leave_credits_arr) > 0) {
			
			foreach ($leave_credits_arr as $key => $val) {
				DB::table('leave_credits')
					->where('id', $val->id)
					->update([
						'leaveType' => $input['leaveType'],
					]);
			}

		}
		unset($input['old_leavetype']);
		
		$leavetype->update($input);

		return Redirect::route('admin.leavetypes.index')->with('success',"<strong>{$input['leaveType']}</strong> updated successfully");;;
	}

	/**
	 * Remove the specified leavetype from storage.
	 */
	public function destroy($id)
	{
        Leavetype::destroy($id);
        $output['success']  =   'deleted';
        return Response::json($output, 200);


	}

}
