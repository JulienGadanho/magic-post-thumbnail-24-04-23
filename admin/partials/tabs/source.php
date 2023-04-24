<?php

if ( !function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

?>
<div class="wrap">

		<?php 
settings_errors();
?>

    <form method="post" action="options.php" id="tabs">

            <?php 
settings_fields( 'MPT-plugin-banks-settings' );
$options = wp_parse_args( get_option( 'MPT_plugin_banks_settings' ), $this->MPT_default_options_banks_settings( FALSE ) );
?>

            <div class="alert alert-custom alert-default" role="alert">
                <div class="alert-icon"><span class="svg-icon svg-icon-primary svg-icon-xl"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                    </g>
                </svg><!--end::Svg Icon--></span>
                </div>
                <div class="alert-text">
                    <?php 
esc_html_e( 'Choose which database you want to search for pictures', 'mpt' );
?>
                </div>
            </div>

            <table id="general-options" class="form-table">
	            <tbody>
	              <tr valign="top">
	                <th scope="row">
	                        <label for="hseparator"><?php 
esc_html_e( 'Image Bank', 'mpt' );
?></label>
	                </th>
	                <td class="chosen_api">
	                  <div class="radio-list">
	                      <?php 
$list_api = array(
    esc_html__( 'Google Image (Scraping)', 'mpt' ) => array( 'google_scraping', true ),
    esc_html__( 'Google Image (API)', 'mpt' )      => array( 'google_image', true ),
    esc_html__( 'DALL·E API (v1)', 'mpt' )        => array( 'dallev1', true ),
    esc_html__( 'Creative Commons', 'mpt' )        => array( 'cc_search', true ),
    esc_html__( 'Flickr', 'mpt' )                  => array( 'flickr', true ),
    esc_html__( 'Pixabay', 'mpt' )                 => array( 'pixabay', true ),
    esc_html__( 'Youtube', 'mpt' )                 => array( 'youtube', false ),
    esc_html__( 'Shutterstock', 'mpt' )            => array( 'shutterstock', false ),
    esc_html__( 'Getty Images', 'mpt' )            => array( 'gettyimages', false ),
    esc_html__( 'Unsplash', 'mpt' )                => array( 'unsplash', false ),
    esc_html__( 'Pexels', 'mpt' )                  => array( 'pexels', false ),
    esc_html__( 'Envato Elements', 'mpt' )         => array( 'envato', false ),
);
foreach ( $list_api as $api => $api_code ) {
    $checked = ( isset( $options['api_chosen'] ) && !empty($options['api_chosen']) && $api_code[0] == $options['api_chosen'] ? 'checked' : '' );
    $disabled = 'disabled';
    $class_disabled = 'radio-disabled';
    
    if ( true === $api_code[1] ) {
        $disabled = '';
        $class_disabled = '';
    }
    
    echo  '<label class="radio ' . $class_disabled . '"><input type="radio" ' . $checked . ' ' . $disabled . ' value="' . $api_code[0] . '" name="MPT_plugin_banks_settings[api_chosen] "> <span></span> ' . $api . '</label>' ;
}
?>
	                  </div>
	                </td>
	              </tr>
	            </tbody>
            </table>

            <hr/>

            <?php 
foreach ( $list_api as $api => $api_code ) {
    $checked = ( isset( $options['api_chosen'] ) && !empty($options['api_chosen']) && $api_code[0] == $options['api_chosen'] ? '' : 'style="display: none;"' );
    echo  '<table id="' . $api_code[0] . '" class="form-table" ' . $checked . '>' ;
    echo  '<tbody>' ;
    if ( !in_array( $api_code[0], array(
        'youtube',
        'shutterstock',
        'gettyimages',
        'unsplash'
    ) ) ) {
        include_once 'banks/' . $api_code[0] . '.php';
    }
    echo  '</tbody>' ;
    echo  '</table>' ;
}
?>

            <?php 
submit_button();
?>

    </form>
</div>
