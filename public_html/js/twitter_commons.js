$( document ).ready(function() {
	// on change of twitter handle dropdowns make the twitter handle blank
	$( "body" ).on( "change", "#twitter_handles_select", function(event) {
		if ($('#twitter_handles_select').val() != "") {
			$('#twitter_handle_input').val('');
		}
	});
	// on any input on the twitter handle reset the dropdown
	$( "#twitter_handle_input" ).keyup(function() {
	  	if ($('#twitter_handle_input').val() != "") {
			$('#twitter_handles_select').val('');
		}
	});

	// show tweets for the account that gets selected or handle that has input
	$( "body" ).on( "click", "#show_tweets_button, #load_more_tweets", function(event) {
		event.preventDefault();
		if ($('#twitter_handles_select').val() == '' && $('#twitter_handle_input').val() == '') {
			swal("Oops!", "Please select or enter a twitter handle first.", "error");
			return false;
		} else {
			if ($('#twitter_handles_select').val() != "") {
				var handle = $('#twitter_handles_select').val();
			} else if ($('#twitter_handle_input').val() != ""){
				var handle = $('#twitter_handle_input').val();
			}
		}
		if($(this).hasClass('load_more_tweets')) {
			var tweetId = $('.media_id').last().val();
		} else {
			var tweetId = false;
			$('.tweets').remove();
		}
		
		$('#loading').show();
		$('.no_tweets').hide();
		$.ajax({
		  type:"POST",
		  data: { handle: handle, tweet_id: tweetId}
		}).done(function(data) {
		  if (typeof(data) == 'object') {
			$('#loading').hide();
			if ($.isEmptyObject(data)) {
				$('.no_tweets').text('No tweeet with images is available. Please check the details.');
				$('.no_tweets').show();
				return false;
			}
		  	$.each( data, function( key, value ) {
		  		if (value.video_url) {
		  			var html = '<div class="row col-sm-12 mt-1 shadow-sm p-2 mb-2 bg-white rounded tweets">'
		  	  			 +'<input id="'+ value.image_id +'" class="media_id" name="media_id" type="hidden" value="'+ value.image_id +'">'
		  	  			 +'<input id="'+ value.image_id +'" class="tweet_id" name="tweet_id" type="hidden" value="'+ value.tweet_id +'">'
		  	  			 +'<div class="col-sm-3">'+ value.tweet_text + '</div>'
		  	  			 +'<div class="col-sm-2">'+ value.tweet_time + '</div>'
		  	  			 // +'<div class="col-sm-3 text-center"><a data-fancybox="gallery" href="'+ value.img_url + '"><img height="100px" src= '+ value.img_url + ' class="tweet-image" title="Click to enlarge"></a></div>'
		  	  			 +'<div class="col-sm-3 text-center"><video width="320px" height="240px" controls><source src="'+ value.video_url + '" type="video/mp4"><source src="'+ value.video_url + '" type="video/ogg">Your browser does not support the video tag.</video></div>'
		  	  			 +'<div class="col-sm-2 text-center"><a target="_blank" href="https://twitter.com/' + handle +'/status/' + value.tweet_id + '">Tweet Link</a></div>'
		  	  			 +'<div class="col-sm-2 text-center"><button class="btn btn-sm btn-success col-sm-5 initialize_tweet  mr-1">Upload</button><button class="btn btn-sm btn-danger col-sm-5 cancel_tweet">Cancel</button></div></div>';
		  		} else {
		  			var html = '<div class="row col-sm-12 mt-1 shadow-sm p-2 mb-2 bg-white rounded tweets">'
		  	  			 +'<input id="'+ value.image_id +'" class="media_id" name="media_id" type="hidden" value="'+ value.image_id +'">'
		  	  			 +'<input id="'+ value.image_id +'" class="tweet_id" name="tweet_id" type="hidden" value="'+ value.tweet_id +'">'
		  	  			 +'<div class="col-sm-3">'+ value.tweet_text + '</div>'
		  	  			 +'<div class="col-sm-2">'+ value.tweet_time + '</div>'
		  	  			 +'<div class="col-sm-3 text-center"><a data-fancybox="gallery" href="'+ value.img_url + '"><img height="100px" src= '+ value.img_url + ' class="tweet-image" title="Click to enlarge"></a></div>'
		  	  			 +'<div class="col-sm-2 text-center"><a target="_blank" href="https://twitter.com/' + handle +'/status/' + value.tweet_id + '">Tweet Link</a></div>'
		  	  			 +'<div class="col-sm-2 text-center"><button class="btn btn-sm btn-success col-sm-5 initialize_tweet  mr-1">Upload</button><button class="btn btn-sm btn-danger col-sm-5 cancel_tweet">Cancel</button></div></div>';
		  		}
		  	  	
		  	  	$('#tweet_div').append(html);
		  	});
		  	$('#tweet_div').show('slow');
			$('#load_more_tweets').show('slow');
			scroll();
		  }
		}).fail(function (jqXHR, textStatus) {
		    swal("Something went wrong!", " Please reload the page or contact the developer.", "error");
			return false;
		});
	});


	// show tweet details like image from a tweet link
	$( "body" ).on( "click", "#show_tweet_button", function(event) {
		event.preventDefault();
		if ($('#tweet_link_input').val() == '') {
			swal("Oops!", "Please paste a tweet link first.", "error");
			return false;
		} else {
			var tweetId = $('#tweet_link_input').val();
		}
		
		$('#loading').show();
		$('.tweets').remove();
		$('#load_more_tweets').hide('slow');
		$('.no_tweets').hide();

		$.ajax({
		  url: base_url + '/get-tweet',
		  type:"POST",
		  data: {tweet_id: tweetId}
		}).done(function(data) {
		  if (typeof(data) == 'object') {
			$('#loading').hide();
			if ($.isEmptyObject(data)) {
				$('.no_tweets').text('This tweet may not have any images.Please check the link');
				$('.no_tweets').show();
				return false;
			}
		  	$.each( data, function( key, value ) {
		  		if (value.video_url) {
		  			var html = '<div class="row col-sm-12 mt-1 shadow-sm p-2 mb-2 bg-white rounded tweets">'
		  	  			 +'<input id="'+ value.image_id +'" class="media_id" name="media_id" type="hidden" value="'+ value.image_id +'">'
		  	  			 +'<input id="'+ value.image_id +'" class="tweet_id" name="tweet_id" type="hidden" value="'+ value.tweet_id +'">'
		  	  			 +'<div class="col-sm-3">'+ value.tweet_text + '</div>'
		  	  			 +'<div class="col-sm-2">'+ value.tweet_time + '</div>'
		  	  			 // +'<div class="col-sm-3 text-center"><a data-fancybox="gallery" href="'+ value.img_url + '"><img height="100px" src= '+ value.img_url + ' class="tweet-image" title="Click to enlarge"></a></div>'
		  	  			 +'<div class="col-sm-3 text-center"><video width="320px" height="240px" controls><source src="'+ value.video_url + '" type="video/mp4"><source src="'+ value.video_url + '" type="video/ogg">Your browser does not support the video tag.</video></div>'
		  	  			 +'<div class="col-sm-2 text-center"><a target="_blank" href="https://twitter.com/' + value.handle +'/status/' + value.tweet_id + '">Tweet Link</a></div>'
		  	  			 +'<div class="col-sm-2 text-center"><button class="btn btn-sm btn-success col-sm-5 initialize_tweet  mr-1">Upload</button><button class="btn btn-sm btn-danger col-sm-5 cancel_tweet">Cancel</button></div></div>';
		  		} else {
			  	  	var html = '<div class="row col-sm-12 mt-1 shadow-sm p-2 mb-2 bg-white rounded tweets">'
			  	  			 +'<input id="'+ value.image_id +'" class="media_id" name="media_id" type="hidden" value="'+ value.image_id +'">'
			  	  			 +'<input id="'+ value.image_id +'" class="tweet_id" name="tweet_id" type="hidden" value="'+ value.tweet_id +'">'
			  	  			 +'<div class="col-sm-4">'+ value.tweet_text + '</div>'
			  	  			 +'<div class="col-sm-4 text-center"><a data-fancybox="gallery" href="'+ value.img_url + '"><img height="100px" src= '+ value.img_url + ' class="tweet-image" title="Click to enlarge"></a></div>'
			  	  			 +'<div class="col-sm-2 text-center"><a target="_blank" href="https://twitter.com/' + value.handle +'/status/' + value.tweet_id + '">Tweet Link</a></div>'
			  	  			 +'<div class="col-sm-2 text-center"><button class="btn btn-sm btn-success col-sm-5 initialize_tweet  mr-1">Upload</button><button class="btn btn-sm btn-danger col-sm-5 cancel_tweet">Cancel</button></div></div>';
		  	  	}
		  	  	$('#tweet_div').append(html);
		  	});
		  	$('#tweet_div').show('slow');
		  	scroll();
		  }
		}).fail(function (jqXHR, textStatus) {
		    swal("Something went wrong!", " Please enter correct details or reload the page or contact the developer.", "error");
			return false;
		});
	});


	$( "body" ).on( "click", ".initialize_tweet", function(event) {
		var media_id = $(this).parent().parent().find('.media_id').val();
		var tweet_id = $(this).parent().parent().find('.tweet_id').val();
		$('<div id="overlay"> </div>').appendTo('body');
		$.ajax({
		  type:"POST",
		  url:base_url + '/initialize-tweet',
		  data: { tweet_id: tweet_id,media_id: media_id}
		}).done(function(data) {
			$('#overlay').fadeOut('slow');
			$('#overlay').remove();
			$('.dynamic-category').remove();
			$('#name').val('');
		  	$('#other_information').val('');
		  	$('#permission').val('');
		  	$('.video-upload-message').hide();
		  	if (typeof(data) == 'object') {
		  		if (data.status === 'success') {
		  			// $('#name').val(data.handle + '-' + data.media_id);
		  			$('#description').val('Tweet Text: \n' + data.tweet_text);
		  			$('.static-category').text(data.static_category);
		  			$('#upload_media_id').val(data.media_id);
		  			$('#upload_tweet_id').val(data.tweet_id);
		  			$(".upload_tweet").show();
		  			$("#uploadModal .modal-body .form-group").siblings().show();
		  			$(".commons-link").hide();
		  			$('#name').removeClass('is-invalid');
		  			$('#name').removeClass('error');
		  			$("#uploadModal .modal-content").css('border', 'white 0px solid');
		  			$('.modal-message').hide();
		  			$("#uploadModal").modal({show: true, backdrop: 'static', keyboard: false});
		  			if (data.show_permission == 0) {
		  				$('.permission-div').hide();
		  			}
		  			if ($('#' + media_id).parent().find("video").length > 0 ) {
		  				$('.video-upload-message').show();
		  			}
		  		} else if (data.status === 'error') {
		  			swal("Oops!", "Please login first.", "error");
					return false;
		  		} else if (data.status === 'banned') {
		  			swal("Oops!", "You are banned from using this tool.", "error");
					return false;
		  		}
		  	} else {
		  		swal("Oops!", "Please login first.", "error");
				return false;
		  	}
		}).fail(function (jqXHR, textStatus) {
			$('#overlay').fadeOut('slow');
			$('#overlay').remove();
		    swal("Oops!", "Something went wrong.", "error");
			return false;
		});
	});
	$( "body" ).on( "click", ".upload_tweet", function(event) {
		if(!$('#upload_tweet_form').valid()) {
			return false;
		}
		$('<div id="overlay"> </div>').appendTo('#uploadModal .modal-content');
		var categories = new Array;
		$( ".badge" ).each(function( index ) {
			categories.push($(this).text().replace("×", ""));
		});
		$.ajax({
		  type:"POST",
		  url:base_url + '/upload-tweet',
		  data: $("#upload_tweet_form").serialize()+ "&categories=" + JSON.stringify(categories)
		}).done(function(data) {
			$('#overlay').fadeOut('slow');
			$('#overlay').remove();
			$('.modal-message').show();
	  		if (typeof(data) == 'object') {
	  			if (data.status === 'success') {
	  				$('.video-upload-message').hide();
	  				$('.modal-message').text(data.message);
	  				$('.modal-message').removeClass('alert-danger');
	  				$('.modal-message').addClass('alert-success');
	  				$(".upload_tweet").hide();
	  				$(".commons-link").attr('href',data.url);
	  				$(".commons-link").show();
	  				$(".modal-body .form-group").siblings().hide();
	  				$("#uploadModal .modal-content").css('border', 'green 2px solid');
	  				$('#' + $('#upload_media_id').val()).parent().html('<a target="_blink" href="' + data.url + '" class="btn btn-success btn-lg btn-block">Image uploaded. See on commons.</a>')
	  			} else if (data.status === 'error') {
	  				if (data.message) {
	  					$('.modal-message').text(data.message);
	  				} else {
	  					$('.modal-message').text(data.error);
	  				}
	  				$('.modal-message').removeClass('alert-success');
	  				$('.modal-message').addClass('alert-danger');
	  				if (data.error === 'exists' || data.error === 'was-deleted') {
	  					$('#name').addClass('is-invalid');
	  					$('#name').addClass('error');
	  				}
	  				$("#uploadModal .modal-content").css('border', 'red 2px solid');
	  			}
	  			$('.modal-message').show();
	  		}  else {
		  		swal("Oops!", "Something went wrong.", "error");
				return false;
		  	}
		}).fail(function (jqXHR, textStatus) {
			$('#overlay').fadeOut('slow');
			$('#overlay').remove();
		    swal("Oops!", "Something went wrong.", "error");
			return false;
		});
	});
	$( "body" ).on( "click", ".cancel_tweet", function(event) {
		if ($('.login').length == 1) {
			swal("Oops!", "Login First.", "error");
			return false;
		}

		var media_id = $(this).parent().parent().find('.media_id').val();
		var tweet_id = $(this).parent().parent().find('.tweet_id').val();
		$('#cancel_media_id').val(media_id);
		$('#cancel_tweet_id').val(tweet_id);
		$(".confirm_cancel").show();
		$(".cancel-modal-message").hide();
		$("#message").val('');
		$("#cancel_tweet_form").show();
		$("#cancelModal").modal({show: true, backdrop: 'static', keyboard: false});
	});

	$( "body" ).on( "click", ".confirm_cancel", function(event) {
		if(!$('#cancel_tweet_form').valid()) {
			return false;
		}
		$('<div id="overlay"> </div>').appendTo('#cancelModal .modal-content');
		$.ajax({
		  type:"POST",
		  url:base_url + '/cancel-tweet',
		  data: $("#cancel_tweet_form").serialize()
		}).done(function(data) {
			$('#overlay').fadeOut('slow');
			$('#overlay').remove();
	  		if (typeof(data) == 'object') {
	  			if (data.status === 'success') {
	  				$(".cancel-modal-message").show();
	  				$("#cancel_tweet_form").hide();
	  				$(".confirm_cancel").hide();
	  				$('#' + $('#cancel_media_id').val()).parent().html('<button class="btn btn-danger btn-lg btn-block">Tweet Canceled</button>')
	  			} else if (data.status === 'error') {
	  				$('#cancelModal').modal('hide');
	  				swal("Oops!", "Please login first.", "error");
					return false;
	  			}
	  		}  else {
		  		swal("Oops!", "Something went wrong.", "error");
				return false;
		  	}
		}).fail(function (jqXHR, textStatus) {
			$('#overlay').fadeOut('slow');
			$('#overlay').remove();
		    swal("Oops!", "Something went wrong.", "error");
			return false;
		});
	});

	$( "#category_search" ).autocomplete({
      source: function(request, response) {
          $.ajax({
            type: "GET",
            url: base_url+"/search",
            data: { q: request.term },
            success: function(data) {
              response(data);
            }
          });
        },
        select: function( event, ui ) {
			var value = ui.item.value;
			// alert(value);
			// if ($('.badge').text().indexOf(value) == -1) {
			// 	$('<span class="badge badge-success dynamic-category">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></span>').appendTo('#categories_div');
			// }
			var categoryPresent = 0;
			$( ".badge" ).each(function( index ) {
			  if($( this ).contents().not($(this).children()).text() === value) {
			  	categoryPresent = categoryPresent+1;
			  }
			});
			if (categoryPresent ==0) {
				$('<span class="badge badge-success dynamic-category">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></span>').appendTo('#categories_div');
			}

        	this.value = "";
        	return false;
        }
    });
    $( "body" ).on( "click", "#categories_div .close", function(event) {
		$(this).parent().remove();
	});
    $('#category_search').keypress(function(event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13'){
	    	var categoryPresent = 0;
	    	var value = $(this).val()
			$( ".badge" ).each(function( index ) {
			  if($( this ).contents().not($(this).children()).text() === value) {
			  	categoryPresent = categoryPresent+1;
			  }
			});
			if (categoryPresent == 0) {
				$('<span class="badge badge-danger dynamic-category">' + value + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></span>').appendTo('#categories_div');
			}
	    	this.value = "";
	    }
	});

	// $( "#twitter_handle_input" ).autocomplete({
 //      source: function(request, response) {
 //          $.ajax({
 //            type: "GET",
 //            url: base_url+"/search-twitter-user",
 //            data: { q: request.term },
 //            success: function(data) {
 //              response(data);
 //            }
 //          });
 //        },
 //    });
	function scroll() {
	 	$('html, body').animate({
		    scrollTop: ($("#tweet_div").offset().top)
		},500);
	}
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
