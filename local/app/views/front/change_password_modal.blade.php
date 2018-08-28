  <!------------------------------ BEGIN FORM ----------------------------------------->
                           {{Form::open(array('url'=>"",'class'=>'sky-form','id'=>'change_password_form'))}}

											   <fieldset>
												<section>
													<div id="error"></div>
												</section>
												   <section>
													   <div class="row field">
														   <label class="label col col-4"> {{Lang::get('core.newPassword')}}</label>
														   <div class="col col-8">
															   <label class="input">
																   <i class="icon-append fa fa-lock"></i>
																   <input type="password" name="password">
															   </label>
														   </div>
													   </div>
												   </section>

												   <section>
													   <div class="row field">
														   <label class="label col col-4"> {{Lang::get('core.confirmPassword')}}</label>
														   <div class="col col-8">
															   <label class="input">
																   <i class="icon-append fa fa-lock"></i>
																   <input type="password" name="password_confirmation">
															   </label>

														   </div>
													   </div>
												   </section>


											   </fieldset>
											   <footer>
												   <button type="submit" class="btn-u field" id="submitbutton" onclick="change_password();return false;"> {{Lang::get('menu.changePassword')}}</button>

											   </footer>

                               {{ Form::close() }}
                         <!------------------------ END FORM ------------------------------------------>