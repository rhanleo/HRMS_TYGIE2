 {{--Confirm Box Model--}}
<div id="confirmBox" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{trans('core.confirmation')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body" id="info"></div>
        <div class="modal-footer">
	        <button type="button" data-dismiss="modal" class="btn btn-1">            
	          <span class="text">Cancel</span>
	        </button>
	        <button type="button" data-dismiss="modal" class="btn btn-2" id="show">
	          <span class="icon"><i class="fa fa-edit"></i></span>
	          <span class="text">Modify</span>
	        </button>
		    </div>
      </div> {{-- end of .modal-content --}}
  </div> {{-- end of .modal-dialog --}}
</div> {{-- end of #confirmBox --}}