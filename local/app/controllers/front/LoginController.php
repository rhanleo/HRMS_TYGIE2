<?php

class LoginController extends \AdminBaseController {



    public function __construct()
    {
        parent::__construct();
        $this->data['pageTitle']    =   'Login Page';
	   
    }

	public function index()
	{

        if(Auth::employees()->check())
        {
            return Redirect::route('dashboard.index');
        }else
        {
            return View::make('front.login',$this->data);
        }

	}

    public function ajaxLogin()
    {
        if (Request::ajax())
        {
            $output =   [];
            $input  = Input::all();

            $data	=	[
                'email'	    =>	$input['email'],
                'password'	=>	$input['password'],
	            'status'    =>  'active'
            ];

            //Rules to validate the incoming username and password
            $rules  =[
                'email'	    => 'required|email',
                'password'	=>	'required'
            ];

            $validator	= Validator::make($input,$rules);


            //if validator fails then move to this block
            if($validator->fails())
            {
                $output['status'] = 'error';
                $output['msg']    =  $validator->getMessageBag()->toArray();

            }

            // Check if employee exists in database with the credentials of not
            if (Auth::employees()->attempt($data))
            {
		            Event::fire('auth.login', Auth::employees()->get());
		            $output['status'] = 'success';
		            $output['msg']    = Lang::get('messages.loginSuccess');

	                return Response::json($output, 200);
            }

	        // For Blocked Users
	        $data['status']         =   'inactive';
            if(Auth::employees()->validate($data))
            {
	            $output['status']	=	'error';
	            $output['msg']		=	['error'=>Lang::get('messages.loginBlocked')];

            }
            //Show error Message if Employee with posted data does not exists
            else
	        {
		        $output['status']	=	'error';
		        $output['msg']		=	['error'=>Lang::get('messages.loginInvalid')];

	        }

            return Response::json($output, 200);

        }
    }

    public function logout()
    {
        Auth::employees()->logout();

        return Redirect::to('/');
    }

}