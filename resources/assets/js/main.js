/*jslint browser: true*/
/*global $, jQuery, alert*/
'use strict';

$(document).ready(function () {
	$('.error').hide();
	$('#password1').keyup(function (){
		if($(this).val().length < 8){
			$('.error').text("Password must be atleast 8 characters.");
			$('.error').show();
		} else if($(this).val() !== $('#password2').val() && $('#password2').val() !== ''){
			$('.error').text("Passwords don't match.");
			$('.error').show();
		} else {
			$('.error').text("");
			$('.error').hide();
		}
	});
	$('#password2').keyup(function (){
		if($(this).val() === $('#password1').val()){
			$('.error').text("");
			$('.error').hide();
		} else {
			$('.error').text("Passwords don't match.");
			$('.error').show();
		}
	});

	 $('a').hover(function() {
		$('p', this).css('color', '#008066');
		}, function() {
		// on mouseout, reset the background colour
		$('p', this).css('color', '');
	});

	$('#post-form, #message-form').on('submit', function(){
		if ($.trim($('textarea').val()) === '') {
			event.preventDefault();
		}
	});

    $('.msg-content').scrollTop($('.msg-content')[0].scrollHeight);
});
