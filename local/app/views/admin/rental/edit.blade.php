
<div id="deptresponse">
@foreach($rentals as $rental)
    <label for="timeIn">{{'Amount'}}</label>
	<input class="form-control form-control-inline" name="amount" id="amount" type="text" value="{{$rental->amount}}" />
    
    <label for="dateCovered" class="text-success">Date Covered</label>
    <input  type="text" name="date_covered" class="date date-picker form-control" value="{{$rental['date_covered']}}" placeholder="2018-09-30"></br>
                                                
    <label for="timeOut">{{'Status'}}</label>
    <select class="form-control form-control-inline" name="status" id="select-status" required onchange="getRemarks()">
   <?php
   switch($rental['status']){
    case 'paid':
    $p = 'selected';
    $up = '';
    $pr = '';
    break;
    case 'unpaid':
    $p = '';
    $up = 'selected';
    $pr = '';
    break;
    case 'partial':
    $p = '';
    $up = '';
    $pr = 'selected';
    break;
   }
   ?>
    <option value="paid" {{$p}}>Paid</option>
    <option value="unpaid" {{$up}}>Unpaid</option>
    <option value="partial" {{$pr}}>Partial</option>
    </select>
    <div id="remarks_wrapper">
        <label for="breakOut">{{'Remarks'}}</label>
        <textarea class="form-control form-control-inline" name="remarks" id="remarks"></textarea>
    </div>

@endforeach
</div>
{{-- This is ajax called inside the index page modal  --}}

    {{HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
    {{HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
    {{HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}
    {{HTML::script('assets/admin/pages/scripts/components-pickers.js')}}
    {{ HTML::script("assets/global/plugins/jquery.min.js") }}


<script>  
$('document').ready(function(){
    
    ComponentsPickers.init();
    getRemarks();
})
    var remarks = $("#remarks_wrapper");  
       
    function getRemarks(){
        
        var selectStats = $('#select-status').val();
       
        if(selectStats == 'partial'){
            remarks.show();
            if($('#remarks').val() == ""){
                $('#remarks').prop("required", true);
               return false;
              
            }
        }else if(selectStats == 'paid'){
            $('#remarks').prop("required", false);
            remarks.hide();
           
        }
    }
</script>

