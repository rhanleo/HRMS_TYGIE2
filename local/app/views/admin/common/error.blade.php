
 @if ($errors->has())
       <div class="alert alert-danger alert-dismissable ">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            @foreach ($errors->all() as $error)
                <p><strong><i class="fa fa-close"></i></strong> {{ $error }}</p>
            @endforeach
        </div>
 @endif