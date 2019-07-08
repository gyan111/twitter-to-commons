@extends('wiki.twitter.layout')

@section('pageTitle', 'Twitter to Commons')

@section('pageKeywords', 'Twitter, Wikimedia Commons')

@section('pageDescription', 'Upload photos directly from twitter to wikimedia commons')

@section('css')

<link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
<link href="{{ secure_asset('css/twitter_commons.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="container">
	<section id="general-page" class="wow fadeIn">
		<div class="row mt-3">
			<div class="text-center col-sm-12">
				<h2></h2>
				<h2><strong>Twitter to commons</strong></h2>
				<p><strong>Upload photos from twitter to Wikimedia Commons.</strong></p>
			</div>
		</div>
		@if (!isset($user))
		<div class="alert alert-warning alert-dismissible fade show col-sm-6 offset-sm-3" role="alert" >
		  <strong>Please Login!</strong> You must be logged in to use this app.
		  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button> -->
		</div>
		<a class="col-sm-4 offset-sm-4 btn btn-secondary login" href="{{ url('authorize'). '?url=' }}">Login to Mediawiki</a>
		<div class="form-group"></div>
		@else
			<div class="alert fade show text-center" role="alert" >
			  	<strong>Hi {{$user->username}}</strong>
			</div>
		@endif
		<div class="row mt-6">
			<div class="col-sm-4 offset-sm-4">
				<form>
				  	<div class="form-group">
						<!-- <label for="twitter_handles">Choose a twitter handle to show recent tweets</label> -->
						<select class="form-control" id="twitter_handles_select" required>
						  	<option value="" selected>Select a Twitter handle </option>
						  	@foreach($twitters as $twitter)
						  	<option value="{{$twitter->handle}}">{{$twitter->name}}</option>
						  	@endforeach
						</select>
					</div>
					<!-- <div class="form-group">
						<select class="form-control" id="tweet_number" required>
						  	<option value="10" selected>10 Tweets</option>
						  	<option value="50">50 Tweets</option>
						  	<option value="100">100 Tweets</option>
						</select>
					</div> -->
					<div class="form-group">
						<button type="button" class="btn btn-primary col-sm-12" id="show_tweets_button">Show Tweets</button>
					</div>
				</form>
			</div>
		</div>
		<div class="alert text-center">
			<div class="text-center"><strong>Select twitter handle and click on Show Tweets button.</strong></div>
		</div>
		<div class="row" id="tweet_div">
			<div class="row col-sm-12 shadow-sm p-2 mb-2 bg-white rounded">
				<div class="col-sm-4 text-center">
					Tweet
				</div>
				<div class="col-sm-4 text-center">
					Photos
				</div>
				<div class="col-sm-2 text-center">
					Tweet Link
				</div>
				<div class="col-sm-2 text-center">
					Actions
				</div>
			</div>
		</div>
		<div class="alert alert-danger no_tweets" role="alert">
		  No tweets to show now. Please check back later.
		</div>
		<div class="row mt-6 mb-6" id="loading">
			<div class="col-sm-12 text-center">
				<img src="{{ secure_asset('img/loading.gif') }}">
			</div>
		</div>
		<div class="row mt-6">
			<div class="col-4 mx-auto">
				<button class="btn btn-primary btn-block btn-primary load_more_tweets" id="load_more_tweets">Show older tweets</button>
			</div>
		</div>
	</section>
</div>
<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Confirm or change details before upload</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<div class="alert alert-success modal-message" role="alert"></div>
	      		<a target="_blink" href="#" class="btn btn-success btn-lg btn-block commons-link">See image on commons.</a>
	      		<form id="upload_tweet_form">
		          	<div class="form-group">
		            	<label for="name" class="col-form-label">Image Title</label>
		            	<input type="text" class="form-control" id="name" name="name" placeholder="Enter the image title/name" required>
		          	</div>
		          	<div class="form-group">
		            	<label for="description" class="col-form-label">Description (English) <small>Enter a good description. You may delete the default tweet text.</small></label>
		            	<textarea class="form-control" id="description" name="description" rows="3"></textarea>
		          	</div>
		          	<div class="form-group ui-front">
		            	<label for="category_search" class="col-form-label">Add Category</label>
		            	<input class="form-control" id="category_search" name="category_search" placeholder="Start typing slowly and wait a little..">
		          	</div>
		          	<div class="form-group" id="categories_div">
		            	<span class="badge badge-primary static-category"></span>
		          	</div>
		          	<div class="form-group">
		            	<textarea class="form-control" id="other_information" name="other_information" placeholder="Add any other information like templates and categories. Ex. @{{Location|20.457279|85.884308}}" rows="2"></textarea>
		          	</div>
		            <input type="hidden" id="upload_media_id" name="upload_media_id" required>
		            <input type="hidden" id="upload_tweet_id" name="upload_tweet_id" required>

		        </form>
			</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        	<button type="button" class="btn btn-primary upload_tweet">Confirm & Upload</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Confirm & Cancel</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<div class="alert alert-warning cancel-modal-message" role="alert">Tweet Canceled</div>
	      		<p>If you cancel the tweet, it will not appear in the list.</p>
	      		<form id="cancel_tweet_form">
		          	<div class="form-group">
		            	<label for="name" class="col-form-label">Reason</label>
		            	<input type="text" class="form-control" id="message" name="message" placeholder="Please specify a short reason" required>
		          	</div>
		            <input type="hidden" id="cancel_media_id" name="cancel_media_id" required>
		            <input type="hidden" id="cancel_tweet_id" name="cacnel_tweet_id" required>

		        </form>
			</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        	<button type="button" class="btn btn-primary confirm_cancel">Confirm & Cancel</button>
	      	</div>
	    </div>
  	</div>
</div>
@endsection
@section('js')
<script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://tools-static.wmflabs.org/cdnjs/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script src="{{ secure_asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ secure_asset('js/twitter_commons.js') }}"></script>
<script type="text/javascript">
    var base_url = '{{ secure_url('/') }}';
</script>
@endsection