<nav class="navbar navbar-expand-lg navbar-light bg-light">
  	<!-- <a class="navbar-brand" href="#">Twitter to Commons</a> -->
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>

  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    	<ul class="navbar-nav mr-auto">
      		<li class="nav-item @if (Request::url() == url('/')) active @endif>">
        	<a class="nav-link" href="{{ url('/')}}">Home <span class="sr-only">(current)</span></a>
	      	</li>
	      	<li class="nav-item @if (Request::url() == url('/uploads')) active @endif ">
	        	<a class="nav-link" href="{{ url('/uploads') }}">Uploads</a>
	      	</li>
	      	<li class="nav-item @if (Request::url() == url('/statistics')) active @endif>">
	        	<a class="nav-link" href="{{ url('/statistics') }}">Statsistics</a>
	      	</li>
	      	@if (isset($user))
	      	<li class="nav-item @if (Request::url() == url('/administartion')) active @endif>">
	        	<a class="nav-link" href="{{ url('/administration') }}">Administration</a>
	      	</li>
	      	@endif
	      	<!-- <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          		Dropdown
	        	</a>
	        	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          		<a class="dropdown-item" href="#">Action</a>
	          		<a class="dropdown-item" href="#">Another action</a>
	          		<div class="dropdown-divider"></div>
	          		<a class="dropdown-item" href="#">Something else here</a>
	        	</div>
	      	</li> -->
	    </ul>
	    @if (isset($user))
		    <ul class="nav navbar-nav ml-auto">
		      	<li class="nav-item active">
		        	<a class="nav-link" href="{{ url('logout') }}">Logout<span class="sr-only">(current)</span></a>
		      	</li>
		    </ul>
	    @endif
	   <!--  <form class="form-inline my-2 my-lg-0">
	      	<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	      	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    </form> -->
  	</div>
</nav>