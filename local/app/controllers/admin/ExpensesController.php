<?php

class ExpensesController extends \AdminBaseController {



    public function __construct()
    {
        parent::__construct();
	    $emp = [];
        $this->data['expensesOpen'] ='active open';
        $this->data['pageTitle']    =  trans('menu.expense');
	    $this->data['employees'] = Employee::selectRaw('CONCAT(fullName, " (EmpID:", employeeID,")") as full_name, employeeID')
	                                       ->where('status','=','active')
	                                       ->lists('full_name','employeeID');

	    foreach (Employee::where('status','=','active')->select('fullName')->get() as $index=>$value) {
		    $emp[] = "'".addslashes($value->fullName)."'";
	    }

	    $this->data['emp']  = implode(',',$emp);
    }

    public function index()
	{
		$this->data['expenses']          =   Expense::all();
        $this->data['expensesActive']    =   'active';

		return View::make('admin.expenses.index', $this->data);
	}

    //Datatable ajax request
    public function ajax_expenses()
    {
        $result = Expense::
            select('expenses.id','itemName','purchaseFrom','purchaseDate','employees.fullName','price','expenses.status')
	        ->leftJoin('employees', 'expenses.employeeID', '=', 'employees.employeeID')
            ->orderBy('expenses.id','desc');

        return Datatables::of($result)
            //->edit_column('purchaseDate',function($row){
            //    return date('d-M-Y',strtotime($row->purchaseDate));
            //})
	        ->edit_column('status',function($row)
	        {
		        $color = [
			        'pending'   =>  'warning',
			        'approved'  =>  'success',
			        'rejected'  =>  'danger'
		        ];

		        return "<span id='status{$row->id}' class='label label-{$color[$row->status]}'>{$row->status}</span>";
	        })
            ->add_column('edit', function($row){
	            $string ='';
	            $display_accept    =   '';
	            $display_reject    =   '';

	            if($row->status=='rejected'){
		            $display_reject = 'style="display:none"';

	            }

	            elseif($row->status=='approved') {
		            $display_accept= 'style="display:none"';

	            }
	            $string='';
	            $accept ='<a '.$display_accept.' id="accept'.$row->id.'"  data-container="body" data-placement="top" data-original-title="Approve" href="javascript:;" onclick="changeStatus('.$row->id.',\'approved\');return false;" class="btn btn-1"><i class="fa fa-check fa-fw"></i></a>';
	            $reject ='<a '.$display_reject.' id="reject'.$row->id.'" data-placement="top" data-original-title="Reject"  href="javascript:;" onclick="changeStatus('.$row->id.',\'rejected\');return false;" class="btn btn-1"><i class="fa fa-close fa-fw"></i></a>';
	            
				$string .= '<div class="btn-actions">';
	            $string .= $accept . $reject;
	            $string .= '<a  class="btn btn-1"  href="'.route('admin.expenses.edit',$row->id).'" ><i class="fa fa-edit fa-fw"></i></a>
	                    <a href="javascript:;" onclick="del('.$row->id.',\''.$row->itemName.'\');return false;" class="btn btn-1">
                        <i class="fa fa-trash fa-fw"></i></a>';
                $string .= '</div>';
	            return $string;

            })

            ->make();
    }


	public function change_status(){

		$input  = Input::all();
		$expense = Expense::findOrFail($input['id']);
		$expense->status = $input['status'];
		$expense->save();

		$output['status'] = 'success';

		$output['msg']    = 'Updated Successfully';

		return Response::json($output, 200);
	}


	public function create()
	{
        $this->data['expensesAddActive']    =   'active';

		return View::make('admin.expenses.create',$this->data);
	}

	/**
	 * Store a newly created expense in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($input = Input::all(), Expense::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        //----------------   Check if Bill is attached or not

		if($input['employeeID'] == '')$input['employeeID']=NULL;
        $input['purchaseDate']   =   date('Y-m-d',strtotime( $input['purchaseDate']));
	    $expense =	Expense::create($input);

        if (Input::hasFile('bill')) {

            $expense   = expense::find($expense->id);

            $path = public_path()."/expense/bills/";
            File::makeDirectory($path, $mode = 0777, true, true);

            $file 	= Input::file('bill');
            $extension      = $file->getClientOriginalExtension();
            $filename	= "bill-{$expense->slug}.$extension";
            Input::file('bill')->move($path, $filename);
            $expense->bill = $filename;

            $expense->save();

        }

		if($this->data['setting']->expense_notification==1)
		{
			$this->data['itemName']     = $input['itemName'];
			$this->data['purchaseDate']         = $input['purchaseDate'];
			$this->data['status']       = $input['status'];
			$employee = Employee::select('email','fullName')->where('employeeID', '=', $expense->employeeID)->first();

			//        Send award Mail
			Mail::send('emails.admin.expense', $this->data, function ($message) use ($employee) {
				$message->from($this->data['setting']->email, $this->data['setting']->name);
				$message->to($employee['email'], $employee['fullName'])
				        ->subject('Expense - ' . $this->data['itemName']);
			});
		}

		return Redirect::route('admin.expenses.index')->with('success',"<strong>{$input['itemName']}</strong> successfully added to the Database");;
	}



	/**
	 * Show the form for editing the specified expense.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$this->data['expense'] = Expense::find($id);
		return View::make('admin.expenses.edit', $this->data);
	}

	/**
	 * Update the specified expense in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$expense = Expense::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Expense::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $data['purchaseDate']   =   date('Y-m-d',strtotime( $data['purchaseDate']));


        if (Input::hasFile('bill')) {

            $path = public_path()."/expense/bills/";
            File::makeDirectory($path, $mode = 0777, true, true);

            $file 	= Input::file('bill');
            $extension      = $file->getClientOriginalExtension();
            $filename	= "bill-{$expense->slug}.$extension";

            Input::file('bill')->move($path, $filename);
            $data['bill'] = $filename;

        }else{
            $data['bill'] = $data['billhidden'];
        }
            unset($data['billhidden']);
		$expense->update($data);

		if($this->data['setting']->expense_notification==1)
		{
			$this->data['itemName']     = $expense->itemName;
			$this->data['purchaseDate']         = $expense->purchaseDate;
			$this->data['status']       = $expense->status;
			$employee = Employee::select('email','fullName')->where('employeeID', '=', $expense->employeeID)->first();

			//        Send award Mail
			Mail::send('emails.admin.expense', $this->data, function ($message) use ($employee) {
				$message->from($this->data['setting']->email, $this->data['setting']->name);
				$message->to($employee['email'], $employee['fullName'])
				        ->subject('Expense - ' . $this->data['itemName']);
			});
		}

        Session::flash('success',"<strong>{$data['itemName']}</strong> updated successfully");
		return Redirect::route('admin.expenses.edit',$id);
	}

	/**
	 * Remove the specified expense from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Request::ajax()) {

			Expense::destroy($id);
			$output['success'] = 'deleted';

			return Response::json($output, 200);
		}
	}

}
