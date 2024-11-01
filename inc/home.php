<?php
if(!defined('ABSPATH')){exit;}
$api_key = get_option('supportai_apikey');
?>
<div class="wrap supportai-home">
	<svg style="width: 150px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 667.7 132.9" xml:space="preserve" fill="#1d2327"><path d="M139.8 20.5c-3.2-10.8-11-15.6-18.1-17.7C114.3.7 105.5.7 100.9.5c-21.2-.9-58-.4-67.3 0C14.3 1.4 7 12.3 4.4 19.1-4.4 47.5 1.7 95 7.7 105c8.5 17.4 24.9 15.4 24.9 15.4l18.9.2v11s45-8.2 63.3-12.1c15.3-1.4 22.7-8 24.9-13.1 6.4-17.6 6.6-63.8.1-85.9zm-16.4 58.9c-.2 15.5-6.6 20-15.1 21.7-7.4 1.5-18.7 3.6-18.7 3.6l-27.7 5.2V99.5s-8.4.2-20.5.6c-13.5 0-15.9-6.8-17.9-15.9-3-14.1-1.8-34 0-50.4 2.6-14.6 11.8-13.6 21.3-14.4 19.9-1.7 49.9-.3 54.7-.1 11.3.4 17.7 1 20.3 9s4.4 32.2 3.6 51.1z"></path><ellipse cx="55.2" cy="59.7" rx="11.5" ry="13.1"></ellipse><ellipse cx="90.8" cy="59.7" rx="11.5" ry="13.1"></ellipse><path d="M208.1 103.5c-8.2 0-15.1-1.8-20.6-5.5-5.6-3.7-9.5-8.6-11.8-14.9l13.9-8.1c3.2 8.4 9.6 12.6 19 12.6 4.6 0 7.9-.8 10-2.5s3.2-3.7 3.2-6.3c0-2.9-1.3-5.2-3.9-6.8-2.6-1.6-7.2-3.4-13.9-5.3-3.7-1.1-6.8-2.2-9.4-3.3-2.6-1.1-5.1-2.6-7.7-4.4-2.6-1.8-4.5-4.2-5.8-7s-2-6.1-2-9.9c0-7.5 2.7-13.4 8-17.9 5.3-4.4 11.7-6.7 19.2-6.7 6.7 0 12.6 1.6 17.6 4.9 5.1 3.3 9 7.8 11.9 13.6L222 44c-3.3-7.1-8.6-10.6-15.8-10.6-3.4 0-6 .8-8 2.3-1.9 1.5-2.9 3.5-2.9 6 0 2.6 1.1 4.7 3.2 6.3 2.2 1.6 6.3 3.4 12.4 5.3 2.5.8 4.4 1.4 5.7 1.8 1.3.4 3.1 1.1 5.3 2s4 1.8 5.2 2.5c1.2.8 2.6 1.8 4.2 3.2 1.6 1.3 2.8 2.7 3.6 4.1s1.5 3.1 2.1 5.1.9 4.2.9 6.5c0 7.6-2.8 13.7-8.3 18.2-5.4 4.6-12.6 6.8-21.5 6.8zM284 42.9h15.2v59H284v-6.6c-3.7 5.5-9.6 8.3-17.6 8.3-6.5 0-11.8-2.2-16-6.5s-6.3-10.3-6.3-17.9V42.9h15.2v34.3c0 3.9 1.1 6.9 3.2 9s5 3.1 8.5 3.1c3.9 0 7.1-1.2 9.4-3.7 2.4-2.4 3.5-6.1 3.5-11V42.9h.1zM344.5 41.2c7.9 0 14.7 3 20.4 9 5.6 6 8.4 13.4 8.4 22.1s-2.8 16.1-8.4 22.1-12.4 9-20.4 9c-8.3 0-14.6-2.9-19.1-8.6v30.6h-15.2V42.9h15.2v7c4.5-5.8 10.8-8.7 19.1-8.7zM330 84.3c3.1 3.1 7 4.7 11.7 4.7s8.6-1.6 11.7-4.7 4.7-7.1 4.7-12-1.6-8.9-4.7-12-7-4.7-11.7-4.7-8.6 1.6-11.7 4.7c-3.1 3.1-4.6 7.1-4.6 12s1.5 8.9 4.6 12zM415.4 41.2c7.9 0 14.7 3 20.4 9 5.6 6 8.4 13.4 8.4 22.1s-2.8 16.1-8.4 22.1-12.4 9-20.4 9c-8.3 0-14.6-2.9-19.1-8.6v30.6h-15.2V42.9h15.2v7c4.5-5.8 10.9-8.7 19.1-8.7zm-14.5 43.1c3.1 3.1 7 4.7 11.7 4.7s8.6-1.6 11.7-4.7 4.7-7.1 4.7-12-1.6-8.9-4.7-12-7-4.7-11.7-4.7-8.6 1.6-11.7 4.7c-3.1 3.1-4.6 7.1-4.6 12s1.5 8.9 4.6 12zM502.3 94.5c-6.1 6-13.5 9-22.2 9s-16.1-3-22.1-9-9-13.4-9-22.1 3-16.1 9-22.1 13.4-9 22.1-9 16.1 3 22.2 9 9.1 13.4 9.1 22.1c-.1 8.7-3.1 16.1-9.1 22.1zM468.7 84c3 3.1 6.8 4.6 11.4 4.6s8.4-1.5 11.4-4.6c3.1-3.1 4.6-7 4.6-11.7s-1.5-8.6-4.6-11.7c-3.1-3.1-6.9-4.6-11.4-4.6-4.6 0-8.4 1.5-11.4 4.6s-4.5 7-4.5 11.7 1.5 8.7 4.5 11.7zM534.4 53c1.4-3.8 3.8-6.6 7-8.5 3.3-1.9 6.9-2.8 10.9-2.8v17c-4.6-.5-8.8.4-12.4 2.8-3.7 2.4-5.5 6.5-5.5 12.2v28.2h-15.2v-59h15.2V53zM593.6 57.5h-13.3V82c0 2 .5 3.5 1.5 4.5 1 .9 2.5 1.5 4.5 1.6s4.4.1 7.3-.1v13.8c-10.5 1.2-17.8.2-22.1-3-4.3-3.1-6.4-8.8-6.4-16.9V57.5h-10.3V42.9H565v-12l15.2-4.6v16.5h13.3l.1 14.7zM645.9 76.5l-3-8.6h-19.6l-2.9 8.6h-10.1L627 28.9h11.6l16.8 47.6h-9.5zm-19.5-17.3h13.4l-6.9-19.4-6.5 19.4zM658.3 28.9h9.4v47.6h-9.4V28.9zM620.7 50.4h25.2z"></path></svg>
	<h1><?php esc_html_e("Connect your account", "supportai"); ?></h1>
	<form method="post" action="" novalidate="novalidate" id="supportai_key_submit">
		<div class="supportai-field">
			<input name="supportai_apikey" type="text" id="supportai_apikey" value="<?php echo esc_attr($api_key); ?>" class="regular-text" placeholder="API Key">
			<p class="description" id="apikey-description">
			<?php echo wp_kses_post(__("You can find your API key <a href=\"https://supportai.com/app/\" target=\"_blank\">here</a> under My Account > API Key.<br>Don't have an API key? Please create an account <a href=\"https://supportai.com/\" target=\"_blank\">here</a>.", "supportai")); ?>
			</p>
		</div>
		<p class="submit"><button type="button" id="submit-supportai-api-key" class="button button-primary button-supportai"><?php esc_html_e("Connect", "supportai"); ?></button></p>
	</form>
</div>