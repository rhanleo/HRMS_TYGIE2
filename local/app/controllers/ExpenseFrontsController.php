<?php

class ExpenseFrontsController extends \FrontBaseController {

	public function __construct()
	{

		parent::__construct();
		$this->data['pageTitle']   =   Lang::get('core.jobTitle');
		$this->data['accountActive'] =    'active';

	}
	public function index()
	{
		$this->data['expenses'] = Expense::all();

		return View::make('front.expense.index', $this->data);
	}

	//Datatable ajax request
	public function ajax_expenses()
	{
		$result = Expense::
		select('id','itemName','purchaseFrom','purchaseDate','price','expenses.status')
							->where('employeeID','=',$this->data['employeeID'])
		                 ->orderBy('expenses.id','desc');

		return Datatables::of($result)
		                 ->edit_column('purchaseDate',function($row){
			                 return date('d-M-Y',strtotime($row->purchaseDate));
		                 })
		                 ->edit_column('status',function($row)
		                 {
			                 $color = [
				                 'pending'   =>  'warning',
				                 'approved'  =>  'success',
				                 'rejected'  =>  'danger'
			                 ];

			                 return "<span class='label label-{$color[$row->status]}'>{$row->status}</span>";
		                 })

		                 ->make();
	}


	public function create()
	{
		return View::make('front.expense.create',$this->data);
	}

	/**
	 * Store a newly created expensefront in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Expense::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$data['employeeID']   = $this->data['employeeID'];
		$data['purchaseDate'] = date('Y-m-d',strtotime($data['purchaseDate']));
		Expense::create($data);

		//        Send email to all admins
		$this->data['expense'] =$data;
		$admins = Admin::select('email')->get()->toArray();
		foreach ($admins as $admin){
			Mail::send('emails.expense', $this->data, function ($message) use ($admin) {
				$message->from(Auth::employees()->get()->email, Auth::employees()->get()->fullName);
				$message->to($admin['email'])
				        ->subject('Expense Claim Request - ' . $this->data['setting']->website);
			});
		}

		Session::flash('success',Lang::get('messages.successExpenseAdd'));

		return Redirect::route('front.expenses.index');
	}


}
