<?php
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
		exit();
}
?>

<tr valign="top">
	<td colspan="2">
		<div class="update-nag">
			<?php _e('<b>It\'s required</b> to provide your own <b>api key</b>. You can register in OpenAI API website <a target="_blank" href="https://openai.com/">here</a> and get api key.', 'mpt' ); ?>
		</div>
		<div class="update-nag">
			<?php _e('<b>DALL-E API can take a long time</b> to generate: up to 10 seconds to get a 1024x1024 image.', 'mpt' ); ?>
		</div>
		<div class="update-nag">
			<?php _e('DALL-E API has some <b>restricted words</b> that will not generate any images. Please refer to the <a href="https://labs.openai.com/policies/content-policy">content policy</a> if you want more details.', 'mpt' ); ?>
		</div>
	</td>
</tr>

<tr valign="top">
	<th scope="row">
		<label for="hseparator"><?php esc_html_e( 'API Key', 'mpt' ); ?></label>
	</th>
	<td id="password-dalle" class="password">
		<input type="password" name="MPT_plugin_banks_settings[dallev1][apikey]" class="form-control" value="<?php echo( isset( $options['dallev1']['apikey'] ) && !empty( $options['dallev1']['apikey']) )? $options['dallev1']['apikey']: ''; ?>" >
		<i id="togglePassword"></i>
	</td>
</tr>


<tr valign="top">
	<th scope="row">
		<label for="hseparator"><?php esc_html_e( 'Image size', 'mpt' ); ?></label>
	</th>
	<td>
		<select name="MPT_plugin_banks_settings[dallev1][imgsize]" class="form-control form-control-lg" >
			<?php
			$selected = $options['dallev1']['imgsize'];

			$sizes = array(
				esc_html__( '256x256', 'mpt' )           => '256x256',
				esc_html__( '512x512', 'mpt' )           => '512x512',
				esc_html__( '1024x1024', 'mpt' )         => '1024x1024',
			);
			ksort( $filetype );

			foreach( $sizes as $name_size => $code_size ) {
				$choose=($selected == $code_size)?'selected="selected"': '';
				echo '<option '. $choose .' value="'. $code_size .'">'. $name_size .'</option>';
			}
			?>
		</select>
	</td>
</tr>
