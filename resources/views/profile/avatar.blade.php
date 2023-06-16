@extends('layouts.app')

@section('content')
<div class="card shadow mt-3 mb-4">
	<div class="card-body">
		{{ Form::model($profile, array('route' => 'profile.avatar.update', 'method' => 'post','enctype' => 'multipart/form-data')) }}
		<fieldset>
			<div class="form-group row">
				<label for="avatarID" class="col-md-3 col-form-label">Avatar</label>
				<div class="col-md-5">

					<div class="custom-file">
						<input type="file" name="avatar" id="avatarID" class="custom-file-input">
						<label class="custom-file-label" for="customFile">Scegli file</label>
					</div>


					<div class="row mt-3">

						<label for="deleteavatarID" class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-form-label-sm col-form-label-sm-custom-checkbox">
							Cancella
						</label>
						<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">
							<div class="custom-control custom-checkbox">
								<input name="deleteavatar" id="deleteavatarID" value="1" type="checkbox" class="custom-control-input">
								<label class="custom-control-label" for="deleteavatarID"></label>
							</div>
						</div>
					</div>





				</div>
				<div class="col-md-2">
					<?php
					if ($profile->avatar != '') {
						echo showUserAvatar($profile->id);
					} else {
						echo '<img alt="' . $profile->name . ' avatar" src="/assets/img/avatars/user.png"  style="max-height:100px;">';
					}
					?>
				</div>
			</div>

		</fieldset>
		<div class="form-group row">
			<div class="col-md-12 col-xs-12 text-center">
				<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
			</div>
		

		</div>
		{{ Form::close() }}
	</div>
</div>






@stop