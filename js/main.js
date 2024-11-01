jQuery(function($){
	var loading_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" xml:space="preserve" style="width: 24px;"><path fill="rgba(255,255,255,.35)" d="M20.201 5.169c-8.254 0-14.946 6.692-14.946 14.946 0 8.255 6.692 14.946 14.946 14.946s14.946-6.691 14.946-14.946c-.001-8.254-6.692-14.946-14.946-14.946zm0 26.58c-6.425 0-11.634-5.208-11.634-11.634 0-6.425 5.209-11.634 11.634-11.634 6.425 0 11.633 5.209 11.633 11.634 0 6.426-5.208 11.634-11.633 11.634z"></path><path d="m26.013 10.047 1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012v3.312c2.119 0 4.1.576 5.812 1.566z" fill="#fff"><animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"></animateTransform></path></svg>';
    $('#submit-supportai-api-key').on('click', function(){
		var api_key = $('#supportai_apikey').val().trim();
		var _this = $(this);
		//$('.copymatic-alert').remove();
		_this.text('Verifying...');
		if(api_key!=''){
			$.ajax({
				type: "POST",
				dataType: "json",
				url: supportai_ajax_object.ajax_url,
				data: {action: "check_supportai_api", apikey: api_key, nonce: supportai_ajax_object.ajax_nonce},
				success: function(msg){
				  _this.text('Connect');
				  if(typeof msg.success !== 'undefined' && msg.success){
					Toastify({
						text: "Connected! Redirecting you...",
						className: "success-toast"
					}).showToast();
					setTimeout(function(){
						window.location.href = window.location.href;
					}, 1200);
				  }else{
					Toastify({
						text: "Invalid API key",
						className: "error-toast"
					}).showToast();
				  }
				}
			});
		}else{
			Toastify({
				text: "Invalid API key",
				className: "error-toast"
			}).showToast();
		}
	});
	$(document).on('click', '.integrate-button', function(){
		var id = $(this).data('id');
		var _this = $(this);
		_this.html(loading_icon).prop('disabled', true);
		if(id){
			$.ajax({
				type: "POST",
				dataType: "json",
				url: supportai_ajax_object.ajax_url,
				data: {action: "integrate_supportai_chatbot", id:id, nonce: supportai_ajax_object.ajax_nonce},
				success: function(msg){
					_this.removeClass('integrate-button').addClass('remove-button').text('Remove').prop('disabled', false);
				}
			});
		}
	});
	$(document).on('click', '.remove-button', function(){
		var _this = $(this);
		var id = $(this).data('id');
		_this.html(loading_icon).prop('disabled', true);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: supportai_ajax_object.ajax_url,
			data: {action: "delete_supportai_chatbot", id:id, nonce: supportai_ajax_object.ajax_nonce},
			success: function(msg){
				_this.removeClass('remove-button').addClass('integrate-button').text('Integrate').prop('disabled', false);
			}
		});
	});
});