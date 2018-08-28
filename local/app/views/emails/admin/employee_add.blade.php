<table width="100%" border="1" style="border-collapse:collapse; border-color:white;">
		<tr>
	    	<td style="background-color:black;padding:10px;">
	    		 {{HTML::image("assets/admin/layout/img/logo-big.png",'Logo',array('class'=>'logo-default','height'=>'30px','width'=>'117px'))}}
	    	</td>
	    </tr>
	    <tr>
	    	<td style="padding:10px;">Hi!

	    	<b>{{Str::words($employee_name,1,'')}}</b> {{trans('email.yourAccountCreated')}} {{$setting->website}}<br /><br/>
			 <p>{{trans('email.loginDetailBelow')}}!</p>

			  <p><strong>{{trans('core.email')}}</strong>:  {{$employee_email}}</p>
			  <p><strong>{{trans('core.email')}}</strong>: {{$employee_password}}</p>
			  <br />
			  <br />
			  <p>{{trans('email.tryLogging')}}!<a href="{{URL::to('/');}}">{{URL::to('/');}}</a></p>
<hr>
	       <b> {{$setting->website}}</b><br />
	        <font size="1"><a href="{{URL::to('/');}}">{{URL::to('/');}}</a><br />
	        </font>
	        </td>
	    </tr>
</table>
