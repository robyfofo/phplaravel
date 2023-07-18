@extends('layouts.app')

@section('content')
<div class="card shadow mt-3 mb-4">
	<div class="card-body">
		{{ Form::model($profile, array('route' => 'profile.avatar.update', 'method' => 'post','enctype' => 'multipart/form-data')) }}
		<fieldset>


			<div class="row mb-3">

				<div class="col-md-12">

					<div class="row mb-3">

						<label for="avatarID" class="col-md-3 col-form-label">Avatar</label>
						<div class="col-md-7">
							<input type="file" name="avatar" id="avatarID" class="form-control">
						</div>

					</div>

					<div class="row mb-3">

						<label for="deleteavatarID" class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-form-label-sm">
							Cancella
						</label>
						<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3'">
							<div class="form-check">
								<input name="deleteavatar" id="deleteavatarID" value="1" type="checkbox" class="form-check-input">
								<label class="form-check-label" for="deleteavatarID"></label>
							</div>
						</div>

						<div class="col-md-10 text-end">

							@if ($profile->avatar != '')
							<img alt="{{ auth()->user()->name }}" src="@php echo getImageUserAvatar(auth()->user()->id) @endphp" style="max-width:120px;" class="h-auto rounded-circle">
							@else
							<img alt="{{ $profile->name}} avatar" src="/assets/img/avatars/user.png" style="max-height:100px;">
							@endif

						</div>



					</div>


				</div>






			</div>

		</fieldset>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<button data-color="red" data-size="s" data-style="expand-right" id="submitFormID" type="submit" name="submitForm" value="submit" class="btn btn-primary submittheform">Invia</button>
			</div>


		</div>
		{{ Form::close() }}
	</div>
</div>






@stop