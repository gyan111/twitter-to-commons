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
				@if ($message = Session::get('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>{{ $message }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{ $message }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				<p><strong>Administrative work</strong></p>
				<p>Any action here can only be performed by Admins. For any queries please write on their talk page.</p>
				<p>
					Current Admins are: 
					@foreach($users as $wiki_user)
						@if($wiki_user->is_admin == 1)
						<a target="_blank" href="https://meta.wikimedia.org/wiki/User_talk:{{ $wiki_user->wiki_username}}">{{ $wiki_user->wiki_username}}</a>
						@endif
					@endforeach
				</p>

			</div>
		</div>
		<div class="row mt-6">
			<div class="col-sm-4 offset-sm-4">
				<form method="POST" action="{{ url('ban')}}" onsubmit="return confirm('Do you really want to ban the user?')">
				  	<div class="form-group">
				  		@csrf
						<label for="twitter_handles">Ban a user</label>
						<select class="form-control" name="user_id" required>
						  	<option value="" selected>Select a user to ban </option>
						  	@foreach($users as $wiki_user)
						  		@if($wiki_user->is_banned == 0)
						  		<option value="{{$wiki_user->id}}">{{$wiki_user->wiki_username}}</option>
						  		@endif
						  	@endforeach
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary col-sm-12">Ban User</button>
					</div>
				</form>
				<p>Banned users:</p>
				<p>
					@foreach($users as $wiki_user)
						@if ($wiki_user->is_banned == 1)
						<a target="_blank" href="https://commons.wikimedia.org/wiki/Special:Contributions/{{ $wiki_user->wiki_username}}">{{ $wiki_user->wiki_username }}, </a>
						@endif
					@endforeach
				</p>
				<a class="btn btn-primary btn-sm" href="{{ url('canceled') }}">Check & delete canceled images</a>
			</div>
			<div class="col-sm-10 offset-sm-1 text-center mt-3">
				<hr class="col-xs-12">
				<h5><span class="badge badge-primary">New account requests</span></h5> 
				<table class="table table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<th>Handle</th>
							<th>Name</th>
							<th>Template</th>
							<th>Categoty</th>
							<th>Author</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="table-striped ">
						@foreach($accountRequests as $accountRequest)
							@if ($accountRequest->is_approved == 0)
							<tr>
								<td><a target="_blank" href="https://twitter.com/{{ $accountRequest->handle }}">{{ $accountRequest->handle }}</td>
								<td>{{ $accountRequest->name }}</td>
								<td>{{ $accountRequest->template }}</td>
								<td>{{ $accountRequest->category }}</td>
								<td>{{ $accountRequest->author }}</td>
								<td><a class="btn btn-sm btn-success approve" href="{{ url('approve') . '/' . $accountRequest->id}}" onclick="return confirm('Do you really want to approve this account?')">Aprove</a><a class="btn btn-sm btn-danger" href="{{ url('reject') . '/' . $accountRequest->id}}" onclick="return confirm('Do you really want to reject this account?')">Reject</a></td>
							</tr>
							@endif
						@endforeach
					</tbody>
				</table>
				<h5><span class="badge badge-success">Approved requests</span></h5> 

				<table class="table table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<th>Handle</th>
							<th>Name</th>
							<th>Template</th>
							<th>Categoty</th>
							<th>Author</th>
							<th>Aproved By</th>
						</tr>
					</thead>
					<tbody>
						@foreach($accountRequests as $accountRequest)
							@if ($accountRequest->is_approved == 1)
							<tr>
								<td><a target="_blank" href="https://twitter.com/{{ $accountRequest->handle }}">{{ $accountRequest->handle }}</td>
								<td>{{ $accountRequest->name }}</td>
								<td>{{ $accountRequest->template }}</td>
								<td>{{ $accountRequest->category }}</td>
								<td>{{ $accountRequest->author }}</td>
								<td><a target="_blank" href="https://commons.wikimedia.org/wiki/User:{{ $accountRequest->user->wiki_username }}">{{ $accountRequest->user->wiki_username }}</a></td>
							</tr>
							@endif
						@endforeach
						@foreach($twitterAccounts as $twitterAccount)
							@if ($twitterAccount->id < 5)
							<tr>
								<td><a target="_blank" href="https://twitter.com/{{ $twitterAccount->handle }}">{{ $twitterAccount->handle }}</td>
								<td>{{ $twitterAccount->name }}</td>
								<td>{{ $twitterAccount->template }}</td>
								<td>{{ $twitterAccount->category }}</td>
								<td>{{ $twitterAccount->author }}</td>
								<td>Preapproved</td>
							</tr>
							@endif
						@endforeach
					</tbody>
				</table>
				<h5><span class="badge badge-warning">Rejected requests</span></h5> 
				<table class="table table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<th>Handle</th>
							<th>Name</th>
							<th>Template</th>
							<th>Categoty</th>
							<th>Author</th>
							<th>Rejected By</th>
						</tr>
					</thead>
					<tbody>
						@foreach($accountRequests as $accountRequest)
							@if ($accountRequest->is_approved ==2)
							<tr>
								<td><a target="_blank" href="https://twitter.com/{{ $accountRequest->handle }}">{{ $accountRequest->handle }}</td>
								<td>{{ $accountRequest->name }}</td>
								<td>{{ $accountRequest->template }}</td>
								<td>{{ $accountRequest->category }}</td>
								<td>{{ $accountRequest->author }}</td>
								<td><a target="_blank" href="https://commons.wikimedia.org/wiki/User:{{ $accountRequest->user->wiki_username }}">{{ $accountRequest->user->wiki_username }}</a></td>
							</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection
@section('js')
@endsection