
<div id="deptresponse">
@foreach($requests as $request)
    <div calss="form-control">
        <label for="purpose" class="text-success">Description</label>
        <textarea type="text" name="description" placeholder=" USB Flash Drive 32GB, etc.">{{$request->description}}</textarea>
    </div>
    <div calss="form-control">
        <label for="amount" class="text-success">Quantity</label>
        <input type="number" name="quantity" value="{{$request->quantity}}" placeholder="3"></br>
    </div>
    <div calss="form-control">
        <label for="purpose" class="text-success">Remarks</label>
        <textarea type="text" name="remarks" placeholder="it use for my department etc.">{{$request->remarks}}</textarea>
    </div>
    <div calss="form-control">
        <label for="amount" class="text-success">Status</label>
        <?php
   switch($request['status']){
    case 'pending':
    $p = 'selected';
    $a = '';
    $r = '';
    break;
    case 'approved':
    $p = '';
    $a = 'selected';
    $r = '';
    break;
    case 'rejected':
    $p = '';
    $a = '';
    $r = 'selected';
    break;
   }
   ?>
        <select  name="status">
            <option value="pending" {{$p}}>Pending</option>
            <option value="approved" {{$a}}>Approved</option>
            <option value="rejected" {{$r}}>Rejected</option>
        </select>
    </div> <br/>
    <input class="form-control form-control-inline" name="approved_by" id="approved_by" type="text" value="<?php echo Auth::admin()->get()->id; ?>" />
@endforeach
</div>
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

