<?php

class SettingsController extends \AdminBaseController {



    public function __construct()
    {
        parent::__construct();
        $this->data['settingOpen']  =   'active open';
        $this->data['pageTitle']    =    'Settings';
    }

	public function edit()
	{
        $this->data['settingActive']    =   'active';
        $this->data['setting']          =    Setting::all()->first();
        $this->data['countries']        =    Country::where('currency_symbol','!=','null')->groupBy('currency_code')->get();


		return View::make('admin.settings.edit', $this->data);
	}

	public function theme()
	{
		$this->data['themeSettingActive']    =   'active';
		$this->data['setting']          =    Setting::all()->first();
		return View::make('admin.settings.theme', $this->data);
	}

	public function change_language(){
		$setting = Setting::findOrFail($this->data['setting']->id);
		$data = Input::all();


		$setting->update($data);

		$output['success']  =   'success';

		return Response::json($output, 200);
	}


	public function update($id)
	{
		$setting = Setting::findOrFail($id);
		if(Input::get('admin_theme')!='' || Input::get('front_theme')!=''){
			$setting->update(Input::all());

			Session::flash('success', '<strong>Success! </strong>Updated Successfully');
			return Redirect::route('admin.settings.theme','setting');
		}


		$validator = Validator::make($data = Input::all(), Setting::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        unset($data['logo']);
        // Logo Image Upload
        if (Input::hasFile('logo')) {
            $path       = public_path()."/assets/admin/layout/img/";
            File::makeDirectory($path, $mode = 0777, true, true);

            $image 	    = Input::file('logo');
            $extension  = $image->getClientOriginalExtension();
            $filename	= "logo.$extension";
            $filename_big	= "logo-big.$extension";

            Image::make($image->getRealPath())->save($path.$filename);
            Image::make($image->getRealPath())->save($path.$filename_big);

            $data['logo']   =   $filename;

        }
        $currencyArray   =   explode(':',$data['currency']);
        $data['currency']   =  $currencyArray[1];
        $data['currency_symbol']   =  $currencyArray[0];
        $data['enable_two_payroll_period']  = ( isset($data['enable_two_payroll_period'])) ? 1 : 0;
        // DEFAULT 2nd PERIOD
        $data['sss_deduction_period']  = ( isset($data['sss_deduction_period'])) ? 1 : 2;
        $data['pagibig_deduction_period']  = ( isset($data['pagibig_deduction_period'])) ? 1 : 2;
        $data['philhealth_deduction_period']  = ( isset($data['philhealth_deduction_period'])) ? 1 : 2;
		$setting->update($data);

        Session::flash('success', '<strong>Success! </strong>Updated Successfully');
		return Redirect::route('admin.settings.edit','setting');
	}



}
