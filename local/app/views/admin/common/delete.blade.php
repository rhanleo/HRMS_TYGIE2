<div id="deleteModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{trans('core.confirmation')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body" id="info">
            <p>
            {{--Confirm Message Here from Javascript--}}
            </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" data-loading-text="Deleting..." class="demo-loading-btn btn btn-1" id="delete">
                    <span class="icon"><i class="fa fa-trash fa-fw"></i></span>
                    <span class="text">{{trans('core.btnDelete')}}</span>
                </button>
                <button type="button" data-dismiss="modal" class="btn btn-2">
                    <span class="icon"><i class="fa fa-ban fa-fw" aria-hidden="true"></i></span>
                    <span class="text">{{trans('core.btnCancel')}}</span>
                </button>
            </div>
        </div> {{-- end of .modal-content --}}
    </div> {{-- end of .modal-dialog --}}
</div> {{-- end of #deleteModal --}}