@extends('front.layouts.frontlayout')

@section('head')

{{HTML::style("assets/global/css/components.css")}}
{{HTML::style("assets/global/css/plugins.css")}}
{{HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}

@stop

@section('mainarea')
            <div class="col-md-9">
                <!--Profile Body-->
                <div class="profile-body">
                    <div class="row margin-bottom-20">
                        <!--Profile Post-->
                        <div class="col-sm-12">
					 <a  class="btn-u btn-u-dark" href="{{route('front.expenses.index')}}"><i class="fa fa-arrow-left"></i>  {{Lang::get('menu.back')}}</a>
					 <hr>
                    <div class="panel ">
                                                <div class="panel-heading service-block-u">
                                                    <h3 class="panel-title"><span class="fa fa-plus"></span> Add New Expense</h3>
                                                </div>
                                                <div class="panel-body">

															<div class="col-md-8">

                                                                                                        <!-- Reg-Form -->
											 {{Form::open(array('route'=>'front.expenses.store','class'=>'sky-form','id'=>'expenses_form','files'=>true))}}




															<fieldset>
															 @if ($errors->has())
															 		<section>
																		<div class="alert alert-danger alert-dismissable ">
																	   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
																			@foreach ($errors->all() as $error)
																				<p><strong><i class="fa fa-warning"></i></strong> {{ $error }}</p>
																			@endforeach
																		</div>
																	</section>
																 @endif
																<section>
																	<label class="input">

																		<input type="text" name="itemName" placeholder="Item" value="{{ Input::old('itemName') }}">
																		<b class="tooltip tooltip-bottom-right">Name of item</b>
																	</label>
																</section>

																<section>
																	<label class="input">

																		<input type="text" name="purchaseFrom" placeholder="Purchased From" value="{{ Input::old('purchaseFrom') }}">
																		<b class="tooltip tooltip-bottom-right">location of purchase</b>
																	</label>
																</section>
																<section>
																	<label class="input">

																		 <i class="icon-append fa fa-money"></i>
																		<input type="text" name="price" placeholder="Price" value="{{ Input::old('price') }}">
																		<b class="tooltip tooltip-bottom-right">Price in {{$setting->currency}}</b>
																	</label>
																</section>
																<section>
																	<label class="input">
																		 <i class="icon-append fa fa-calendar"></i>
																		<input type="text" name="purchaseDate" placeholder="Date of purchase" id="purchaseDate" value="{{ Input::old('purchaseDate') }}">
																		<b class="tooltip tooltip-bottom-right">Date of purchase</b>
																	</label>
																</section>


																	  <section>
																	  <label class="label">Bill</label>
																		<label for="file" class="input input-file">
																			<div class="button"><input type="file" name="bill" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Include some file" readonly>
																		</label>
																	</section>
															</fieldset>


															<footer>
																<button type="submit" class="btn-u">Submit</button>
															</footer>
														</form>
														<!-- End Reg-Form -->
													</div>
                                                </div>
                                            </div>


                        <!--End Profile Post-->


                    </div><!--/end row-->

                    <hr>



                </div>
                <!--End Profile Body-->
            </div>

</div>


{{--------------------------Show Notice MODALS-----------------}}


                        <div class="modal fade show_notice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 id="myLargeModalLabel" class="modal-title">
                                        Leave Application
                                        </h4>
                                    </div>
                                    <div class="modal-body" id="modal-data">
                                        {{--Notice full Description using Javascript--}}
                                    </div>
                                </div>
                            </div>
                        </div>


  {{------------------------END Notice MODALS---------------------}}

@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

	{{ HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}
	{{ HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js")}}


<!-- END PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->

 <script>
$('#purchaseDate').datepicker({
				prevText: '<i class="fa fa-angle-left"></i>',
				nextText: '<i class="fa fa-angle-right"></i>',
				dateFormat: 'dd-mm-yy'
        });




    </script>


@stop