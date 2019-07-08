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
		<h5>Total number of successful uploads <span class="badge badge-success">{{ count($uploads->where('status',1))}}</span></h5>
		<h5>Total number of canceled tweets <span class="badge badge-warning">{{ count($uploads->where('status',2))}}</span></h5>
		<h5>Total number of failed uploads <span class="badge badge-danger">{{ count($uploads->where('status',0))}}</span></h5>
		<h5>Total number of upload efforts <span class="badge badge-secondary">{{ count($uploads)}}</span></h5>
		<hr>
		<p>Top 5 Uploader</p>
		<div class="col-sm-6">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th>User</th>
						<th>Total Uploads</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($max as $uploader)
					<tr>
						<td>{{ App\User::find($uploader->user_id)->wiki_username }}</td>
						<td>{{ $uploader->count }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>
</div>
@endsection
@section('js')
@endsection