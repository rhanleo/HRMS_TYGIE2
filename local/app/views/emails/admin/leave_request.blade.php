<table width="100%" border="1" style="border-collapse:collapse; border-color:white;">
		<tr>
	    	<td style="background-color:black;padding:10px;">
	    		 {{HTML::image("assets/admin/layout/img/logo-big.png",'Logo',array('class'=>'logo-default','height'=>'30px','width'=>'117px'))}}
	    	</td>
	    </tr>
	    <tr>
	    	<td style="padding:10px;">

	    	<br /><br/>

			  Your leave request of date <strong>{{date('d-M-Y',strtotime($leave_applications->start_date))}} {{(isset($leave_applications->end_date)?' to '.date('d-M-Y',strtotime($leave_applications->end_date)):'')}}</strong> has been <strong>{{$data['application_status']}}</strong>

			  <br /><br />

	       <b> {{$setting->website}}</b><br />
	        <font size="1"><a href="{{URL::to('/');}}">{{URL::to('/');}}</a><br />
	        </font>
	        </td>
	    </tr>
</table>



