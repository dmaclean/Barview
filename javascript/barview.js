var interval = 0;
var timer = -1;
var base_url = '';
var fb_user = '';
var show_questionnaire = '';

$(document).ready(function(){
 
 	// Grab the base_url for the refreshSearchImages function (and any others that might need it).
 	base_url = $('#base_url').text();
 	
 	// Grab the fb_user flag so we know if a Facebook user is logged in.
 	fb_user = $.trim($('#fb_user').text());
 	
 	show_questionnaire = $.trim($('#show_questionnaire').text());
 
 	/**
 	 * Determine if we are on the search page by looking for entities with class="bar_image".  This
 	 * will be used for determining whether to turn on/off the refreshSearchImages interval.
 	 */
 	function onSearchPage() {
	 	if($('.bar_image').size() > 0)
	 		return true;
	 	
	 	return false;
 	}
 
 	/**
 	 * Iterates through all the class="bar_image" elements (which happen to be img tags) and refreshes
 	 * the image currently being displayed.
 	 *
 	 * This function will be used in conjunction with an interval.
 	 */
	function refreshSearchImages() {
		$('.bar_image').each(
			function(index) {
				var id = $(this).attr('id');
				var d = new Date();
				var newsrc = base_url + 'index.php?/getimage/index/' + id + '?'+d.getTime();
				$(this).attr('src', newsrc);
			}
		);
	}
	
	// Refresh images on the search page every 5 seconds.
	if(onSearchPage())
		timer = setInterval(refreshSearchImages, 10000);
 
 
	/////////////////////////////
	// FANCYBOX USER LOGIN
	/////////////////////////////
	$('.user_login').fancybox();
	
	/////////////////////////////
	// FANCYBOX BAR OWNER LOGIN
	/////////////////////////////
	$('#bar_login').fancybox();
	
	//////////////////////////
	// FB USER QUESTIONNAIRE
	//////////////////////////
	if(show_questionnaire == 'true')
		$('#fb_questionnaire_anchor').fancybox().trigger('click');
	
	
	$('#dob').keyup(function() {
		if($(this).val().length == 4 || $(this).val().length == 7)
			$(this).val($(this).val() + '-');
			
	});
 
 	function getCurrentImage(bar_id) {
		//alert('calling getCurrentImage('+bar_id+')');
		var $srcVal = '<?php echo base_url();?>broadcast_images/getimage.php?bar_id=' + bar_id;
		$('#broadcast_img').remove();
		$('<img id="broadcast_img" src="' + $srcVal + '" />').appendTo('#broadcast');
	}
	
	
});

$(window).unload(function() {
	if(onSearchPage()) {
		alert('closing timer ' + timer);
		clearInterval(timer);
	}
});

/**
 * Checks each of the questionnaire fields in the lightbox popup to make sure that the user has
 * chosen an answer for each of them.  If not then an error message is displayed.
 */
function submitFBQuestionnaire() {
	var good = true;
	$('select[name^="q"]').each(function() {
		if($(this).val() == '')
			good = false;
	});
	
	if(good) {
		$('#fb_questionnaire_form').submit();
	}
	else {
		$('#fbq_errors').children().remove();
		$('<div class="alert-message error"><p>Please answer all questions.</p></div>').appendTo('#fbq_errors');
	}
}

/**
 * An AJAX call that makes a POST request to the REST interface to add a favorite bar
 * for a user.  If successful, the link "Add to favorites" will be changed to "Remove from favorites"
 * and its onClick event will be changed to the removeFromFavorites() function.
 */
function addToFavorites(base_url, bar_id, user_id) {
	$.ajax({
		type: 'POST',
		url: base_url + 'index.php?/rest/favorite/' + bar_id,
		beforeSend: function(xhr) {
				xhr.setRequestHeader('USER_ID', user_id);
			},
		success: function() {
					var element = '#' + bar_id + '_favorite';
					$(element).text('Remove from favorites');
					$(element).removeClass("btn success").addClass("btn danger");
					$(element).click({'base_url' : base_url, 'bar_id' : bar_id, 'user_id' : user_id}, function(e) {
							removeFromFavorites(e.data.base_url, e.data.bar_id, e.data.user_id);
						}
					);
				}
	});
}

/**
 * An AJAX call that makes a DELETE request to the REST interface to delete a favorite bar
 * for a user.  If successful, the link "Remove from favorites" will be changed to "Add to favorites"
 * and its onClick event will be changed to the addToFavorites() function.
 */
function removeFromFavorites(base_url, bar_id, user_id) {
	$.ajax({
		type: 'DELETE',
		url: base_url + 'index.php?/rest/favorite/' + bar_id,
		beforeSend: function(xhr) {
				xhr.setRequestHeader('USER_ID', user_id);
			},
		success: function() {
					var element = '#' + bar_id + '_favorite';
					$(element).text('Add to favorites');
					$(element).removeClass("btn danger").addClass("btn success");
					$(element).click({'base_url' : base_url, 'bar_id' : bar_id, 'user_id' : user_id}, function(e) {
							addToFavorites(e.data.base_url, e.data.bar_id, e.data.user_id);
						}
					);
				}
	});
}

/**
 * An AJAX call that makes a POST request to the REST interface to add a new event/deal
 * for a bar.  If successful, the event text will be listed in the list of events along with
 * a delete link.
 */
function addEvent(base_url, event_detail, bar_id, bar_name, session_id) {
	$.ajax({
		type: 'POST',
		url: base_url + 'index.php?/rest/events/' + bar_id,
		data: {'detail' : $('#event_text').val()},
		beforeSend: function(xhr) {
						xhr.setRequestHeader('BAR_NAME', bar_name);
						xhr.setRequestHeader('SESSION_ID', session_id);
					},
		success: function(data, textStatus, jqXHR) {
					var newlistitem = '<dt id="event_' + data + '">' + event_detail + '</dt><dd><a class="btn small danger" id="event_' + data + '_a" >delete</a></dd>';
					//$('#bar_events_list').append(newlistitem).fadeIn();
					$(newlistitem).hide().appendTo('#bar_events_list').fadeIn();
					$('#event_' + data + '_a').click( {'base_url' : base_url, 'event_id' : data, 'bar_id' : bar_id, 'bar_name' : bar_name, 'session_id' : session_id}, function(e) {
							deleteEvent(e.data.base_url, e.data.event_id, e.data.bar_id, e.data.bar_name, e.data.session_id);
						}
					);
				}
		});
}

/**
 * An AJAX call that makes a DELETE request to the REST interface to delete an event/deal
 * for a bar.  If successful, the event will be delete from the database and the list on the page.
 */
function deleteEvent(base_url, event_id, bar_id, bar_name, session_id) {
	$.ajax({
		type: 'DELETE',
		url: base_url + 'index.php?/rest/events/' + event_id,
		beforeSend: function(xhr) {
						xhr.setRequestHeader('BAR_ID', bar_id);
						xhr.setRequestHeader('BAR_NAME', bar_name);
						xhr.setRequestHeader('SESSION_ID', session_id);
					},
		success: function() {
					$('#event_' + event_id).fadeOut();
					$('#event_' + event_id + '_a').fadeOut();
				}
	});
}

function getRealtimeUsers(base_url, bar_id, bar_name, session_id, seconds_back) {
	$.ajax({
		type: 'GET',
		url: base_url + 'index.php?/rest/viewers/' + seconds_back,
		beforeSend: function(xhr) {
						xhr.setRequestHeader('BAR_ID', bar_id);
						xhr.setRequestHeader('BAR_NAME', bar_name);
						xhr.setRequestHeader('SESSION_ID', session_id);
					},
		success: function(data, textStatus, jqXHR) {
					// Clear out existing entries since we just got a fresh list from the server.
					$('#realtime').children().remove()
					
					// Parse out the data and append to the list.
					var items = data.split("|");
					
					if(items == '') {
						$('#realtime').append('<div>No viewers currently</div>');
					}
					else {
						for(i in items)
							$('#realtime').append('<li>' + items[i] + '</li>');
					}
				}
	});
}