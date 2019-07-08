@extends('wiki.twitter.layout')

@section('pageTitle', 'Administration on Twitter to Commons')

@section('css')

<link href="{{ secure_asset('css/twitter_commons.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container">
	<section id="general-page" class="wow fadeIn">
		<div class="row mt-3">
			<div class="text-center col-sm-12">
				<p><strong>Administrative work</strong></p>
			</div>
		</div>
		<div class="row mt-6">
			<div class="col-sm-4 offset-sm-4">
				<form method="POST" action="{{ url('ban')}}">
				  	<div class="form-group">
				  		@csrf
						<!-- <label for="twitter_handles">Choose a twitter handle to show recent tweets</label> -->
						<select class="form-control" name="user_id" required>
						  	<option value="" selected>Select a user to ban </option>
						  	@foreach($users as $user)
						  		<option value="{{$user->id}}">{{$user->wiki_username}}</option>
						  	@endforeach
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary col-sm-12">Ban User</button>
					</div>
				</form>
				<a href="{{ url('canceled') }}">Check canceled images</a>
				<p>Banned users</p>
				@foreach($users as $user)
					@if ($user->is_banned == 1)
					<p>{{ $user->wiki_username }}</p>
					@endif
				@endforeach
			</div>
		</div>
	</section>
</div>
@endsection
@section('js')
@endsection