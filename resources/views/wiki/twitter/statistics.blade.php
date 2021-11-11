@extends('wiki.twitter.layout')

@section('pageTitle', 'All statistics of Twitter to Commons')

@section('css')

<link href="{{ secure_asset('css/twitter_commons.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container">
	<section id="general-page" class="wow fadeIn">
		<div class="row mt-3">
			<div class="text-center col-sm-12">
				<p><strong>All statistics related to this tool.</strong></p>
				<p><strong>This page will be improved and more data will be shown eventually with user requests and more uploads</strong></p>
			</div>
		</div>
		<div class="row">

			<div class="col-sm-2 offset-sm-1" align="center">
				<div class="stat-grid grid1" >
					<h2><strong>{{ count($uploads->where('status',1))}}</strong></h2>
					<p>Successful Uploads</p>	
				</div>
				
			</div>
			<div class="col-sm-2" align="center">
				<div class="stat-grid grid2" >
					<h2><strong>{{ count($uploads->where('status',2))}}</strong></h2>
					<p>Canceled Uploads</p>	
				</div>
				
			</div>
			<div class="col-sm-2" align="center">
				<div class="stat-grid grid3" >
					<h2><strong>{{ count($uploads->where('status',0))}}</strong></h2>
					<p>Failed Uploads</p>	
				</div>
				
			</div>
			<div class="col-sm-2" align="center">
				<div class="stat-grid grid4" >
					<h2><strong>{{ count($uploads) }}</strong></h2>
					<p>Uploads Efforts</p>	
				</div>
				
			</div>
			<div class="col-sm-2" align="center">
				<div class="stat-grid grid5" >
					<h2><strong>{{ App\User::all()->count()}}</strong></h2>
					<p>Users Involved</p>	
				</div>
				
			</div>
		</div>

		<hr>
		<div class="row">
			<div class="col-sm-6 offset-sm-3" align="center">
				<h5>User Details</h5>
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th>User</th>
							<th>Total Uploads</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($uploaders as $uploader)
						<tr>
							<td><a target="_blank" href="https://commons.wikimedia.org/wiki/User:{{ App\User::find($uploader->user_id)->wiki_username}}">{{ App\User::find($uploader->user_id)->wiki_username}}</a></td>
							<td>{{ $uploader->count }}</td>
						</tr>
						@endforeach
						{{ $uploaders->links() }}
					</tbody>
				</table>
			</div>	
		</div>
		
	</section>
</div>
@endsection
@section('js')
@endsection