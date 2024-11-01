<?php
if(!defined('ABSPATH')){exit;}
$api_key = get_option('supportai_apikey');
?>
<div class="wrap supportai-home">
	<input type="hidden" value="<?php echo esc_attr($api_key); ?>" id="api_key">
	<h1 style="margin-bottom:0"><?php esc_html_e("My Chatbots", "supportai"); ?></h1>
	<p><?php esc_html_e("Choose the chatbot you want to integrate on your site below.", "supportai"); ?></p>
	<div class="supportai-chatbots-list">
		<div class="supportai-chatbot loading">
			<img src="<?php echo esc_url( plugins_url('img/animation.gif', __FILE__) ); ?>">
		</div>
	</div>
</div>
<script>
const api_key = '<?php echo esc_js($api_key); ?>';
var active_chatbot_id = '<?php echo esc_js(get_option('supportai_active_chatbot_id')); ?>';
jQuery(function($){
	if(api_key){
		// call to SupportAI API to get chatbots
		$.ajax({
			type: "GET",
			dataType: "json",
			url: 'https://api.supportai.com/getMyChatbots?api_key='+api_key,
			data: {action: "load_supportai_chatbots"},
			success: function(msg){
				if(msg.error==null){
					if(msg.data.length > 0){
						var chatbots = msg.data;
						var chatbotsListDiv = $('.supportai-chatbots-list');
                        chatbotsListDiv.empty();

                        chatbots.forEach(function(chatbot){
                            var chatbotData = JSON.parse(chatbot.configuration);
							var integrateButton = '';
							if(active_chatbot_id != '' && active_chatbot_id==chatbot.id){
								integrateButton = '<button class="remove-button button button-primary button-supportai" data-id="'+chatbot.id+'">Remove</button>';
							}else{
								integrateButton = '<button class="integrate-button button button-primary button-supportai" data-id="'+chatbot.id+'">Integrate</button>';
							}
							var html = '<div class="supportai-chatbot"><div><img src="'+chatbotData['bot-avatar']+'"><h3>'+chatbot.name+'</h3></div><div>'+integrateButton+'</div></div>';
							
                            chatbotsListDiv.append(html);						
                        });
					}
				}else{
					swal("Error", "An error occurred when trying to get the list of your chatbots or you don't have created any chatbot yet.", "error");
				}
			}
		});
	}
});
</script>