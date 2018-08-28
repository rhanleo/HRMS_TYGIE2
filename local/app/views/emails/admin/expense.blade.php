<table width="100%" border="1" style="border-collapse:collapse; border-color:white;">
		<tr>
	    	<td style="background-color:black;padding:10px;">
	    		 {{HTML::image("assets/admin/layout/img/logo-big.png",'Logo',array('class'=>'logo-default','height'=>'30px','width'=>'117px'))}}
	    	</td>
	    </tr>
	    <tr>
	    	<td style="padding:10px;">

	    	<br /><br/>

			  {{trans('email.expense',['attributeDate'=>date('d-M-Y',strtotime($purchaseDate)),'attributeStatus'=>$status])}}

			  <br /><br />

	       <b> {{$setting->website}}</b><br />
	        <font size="1"><a href="{{URL::to('/');}}">{{URL::to('/');}}</a><br />
	        </font>
	        </td>
	    </tr>
</table>



