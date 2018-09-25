

@foreach($cashAdvance as $cash)
    <label for="timeIn">{{'Amount'}}</label>
	<input class="form-control form-control-inline" name="amount" id="amount" type="text" value="{{$cash->amount}}" />
    <label for="timeOut">{{'Status'}}</label>
    <select class="form-control form-control-inline" name="status" id="select-status" required onchange="getRemarks()">
    <option value="">Pending</option>
    <option value="approved">Approved</option>
    <option value="rejected">Rejected</option>
    </select>
    <div id="remarks_wrapper">
        <label for="breakOut">{{'Remarks'}}</label>
        <textarea class="form-control form-control-inline" name="remarks" id="remarks"></textarea>
    </div>
    <input class="form-control form-control-inline" name="approved_by" id="approved_by" type="hidden" value="<?php echo Auth::admin()->get()->id; ?>" />
@endforeach
{{-- This is ajax called inside the index page modal  --}}


{{ HTML::script("assets/global/plugins/jquery.min.js") }}
<script>
$('document').ready(function(){
    getRemarks();
})
    var remarks = $("#remarks_wrapper");  
       
    function getRemarks(){
        
        var selectStats = $('#select-status').val();
       
        if(selectStats == 'rejected'){
            remarks.show();
            if($('#remarks').val() == ""){
                $('#remarks').prop("required", true);
               return false;
              
            }
        }else if(selectStats == 'approved'){
            $('#remarks').prop("required", false);
            remarks.hide();
           
        }
    }
</script>

