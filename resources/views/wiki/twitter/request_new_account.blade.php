@extends('wiki.twitter.layout')

@section('pageTitle', 'Request Twitter Account')

@section('pageKeywords', 'Request Twitter Account')

@section('pageDescription', 'Request new acccount on twitter to commons')

@section('css')

<link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
<link href="{{ secure_asset('css/twitter_commons.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="container">
	<section id="general-page" class="wow fadeIn">
		<div class="row">
			<div class="text-center col-sm-12">
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{ $message }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				<p><strong>Request for a new account to be listed in this tool.</strong></p>
				<p>All approved accounts show in free licensed account list. </br>While uplaoding the author and license is more clear and images have less chance of delete.</p>
				<p>You can check approved account on <a href="{{ url('administration') }}">administration Page</a> aproved request section, before requesting new account.</p>
				<table class="table table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<th>Handle</th>
							<th>Name</th>
							<th>Template</th>
							<th>Categoty</th>
							<th>Author</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a target="_blank" href="https://twitter.com/CMO_Odisha">CMO_Odisha</a></td>
							<td>CMO_Odisha</td>
							<td>@{{GoO-donation}}</td>
							<td>Content donated by Government of Odisha</td>
							<td>[[:en:Government of Odisha|Government of Odisha]]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row mt-6">
			<div class="col-sm-6 offset-sm-2">
				<div class="alert alert-dismissible fade show" role="alert" ><strong>Request a new account here.</strong></div>
				<form method="post">
					@csrf
				  	<div class="form-group">
		            	<!-- <label for="handle" class="col-form-label">Twitter Handle</label> -->
		            	<input type="text" class="form-control" id="handle" name="handle" placeholder="Enter the twitter handle/username" required>
					</div>
					<div class="form-group">
		            	<!-- <label for="name" class="col-form-label">Name</label> -->
		            	<input type="text" class="form-control" id="name" name="name" placeholder="Name of the Account" required>
					</div>
					<div class="form-group">
		            	<!-- <label for="name" class="col-form-label">Name</label> -->
		            	<input type="text" class="form-control" id="template" name="template" placeholder="Default template. having license information. EX: @{{{GoO-donation}}}" required>
					</div>
					<div class="form-group">
		            	<!-- <label for="name" class="col-form-label">OTRS Token</label> -->
		            	<input type="text" class="form-control" id="otrs" name="otrs" placeholder="OTRS Ticket">
					</div>
					<div class="form-group">
		            	<!-- <label for="name" class="col-form-label">Author</label> -->
		            	<input type="text" class="form-control" id="author" name="author" placeholder="Author, EX: [[:en:Government of Odisha|Government of Odisha]] can be link too" required>
					</div>
					<div class="form-group">
		            	<!-- <label for="name" class="col-form-label">Default Category</label> -->
		            	<input type="text" class="form-control" id="name" name="category" placeholder="Default Category. EX: Content donated by Government of Odisha" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary col-sm-12">Request New Account</button>
					</div>
				</form>
			</div>
		</div>
	</section>
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