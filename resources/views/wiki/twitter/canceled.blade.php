@extends('wiki.twitter.layout')

@section('pageTitle', 'Canceled Tweets on Twitter to Commons')

@section('css')

<link href="{{ secure_asset('css/twitter_commons.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container">
	<section id="general-page" class="wow fadeIn">
		<div class="row mt-3">
			<div class="text-center col-sm-12">
				<p><strong>Canceled Tweets using this tool.</strong></p>
				<a href="{{ url('uploads') }}">Uploaded images</a>
			</div>
		</div>
		<div class="row">
			<div class="row col-sm-12 shadow-sm p-2 mb-2 bg-white rounded">
				<div class="col-sm-2 text-center">
					Time
				</div>
				<div class="col-sm-2 text-center">
					Username
				</div>
				<div class="col-sm-2 text-center">
					Photos
				</div>
				<div class="col-sm-3 text-center">
					Reason
				</div>
				<div class="col-sm-2 text-center">
					Tweet Link
				</div>
				@if(isset($user) && $user->is_admin == 1)
				<div class="col-sm-1 text-center">
					Action
				</div>
				@endif
			</div>
			@foreach ($uploads as $upload)
			<div class="row col-sm-12 shadow-sm p-2 mb-2 bg-white rounded">
				<div class="col-sm-2 text-center">
					{{$upload->created_at}}
				</div>
				<div class="col-sm-2 text-center">
					<a href="https://commons.wikimedia.org/wiki/User:{{$upload->user->wiki_username}}">{{$upload->user->wiki_username}}</a>
				</div>
				<div class="col-sm-2 text-center">
					<a data-fancybox="gallery" href="{{$upload->image_url_twitter}}"><img src="{{$upload->image_url_twitter}}" width="50px"></a>
				</div>
				<div class="col-sm-3 text-center">
					{{$upload->form_data}}
				</div>
				<div class="col-sm-2 text-center">
					<a href="https://twitter.com/ipr_odisha/status/{{$upload->tweet_id}}}">Tweet Link</a>
				</div>
				@if(isset($user) && $user->is_admin == 1)
				<div class="col-sm-1 text-center">
					<a onclick="return confirm('Are you sure to delete the canceled tweet? It will re appear?')" class="btn btn-sm btn-danger" href="{{ url('delete/') . '/' . $upload->id}}">Delete</a>
				</div>
				@endif
			</div>
			@endforeach
			{{ $uploads->links() }}
		</div>
	</section>
</div>
@endsection
@section('js')
@endsection