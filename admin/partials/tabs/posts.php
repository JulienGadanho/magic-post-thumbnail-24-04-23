<?php
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
		exit();
}

?>
<div class="wrap">

		<?php settings_errors(); ?>

    <form method="post" action="options.php" id="tabs">

        <?php
          settings_fields( 'MPT-plugin-posts-settings' );
          $options = wp_parse_args( get_option( 'MPT_plugin_posts_settings' ), $this->MPT_default_options_posts_settings( TRUE ) );
        ?>

        <div id="settings">
            <table id="general-options" class="form-table tabs-content">
                    <tbody>
											<tr>
		                    <td>
                            <?php esc_html_e( '"Save Post" Hook', 'mpt' ); ?>
		                    </td>
		                    <td>
		                      <label class="checkbox">
		                          <input data-switch="true" type="checkbox" name="MPT_plugin_posts_settings[enable_save_post_hook]" id="enable_save_post_hook" value="enable" <?php echo( !empty( $options['enable_save_post_hook']) && $options['enable_save_post_hook'] == 'enable' )? 'checked': ''; ?> />
		                      </label>
		                    </td>
		                     <td>
                            <p class="description">
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
                                        <?php _e( 'Enable the "save_post" hook. <br/><br/>What does it means Everytime you create or update a post, an image will be generated.<br/><br/>Warning: Use it precautionary. If you don\'t understand what it is, disable it.', 'mpt' ); ?>
                                    </div>
                                </div>
                            </p>
		                    </td>
		                  </tr>

                      <tr valign="top">
                          <td colspan="3" class="infos">
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
                                      <?php esc_html_e( 'Choose where the image will be created', 'mpt' ); ?>
                                  </div>
                              </div>
                          </td>
                      </tr>

                      <tr valign="top">
                              <th scope="row">
                                  <?php esc_html_e( 'Relevant post type', 'mpt' ); ?>
                              </th>
                              <td class="post-type checkbox-list">
                                      <label class="checkbox"><input type="checkbox" name="select-all-pt" id="select-all-pt"/><span></span> <?php esc_html_e( 'Select all', 'mpt' ); ?></label>
                                      <?php
                                              $post_types_default = get_post_types( '', 'objects' );
                                              unset( $post_types_default['attachment'], $post_types_default['revision'], $post_types_default['nav_menu_item'] );

                                              foreach ( $post_types_default  as $post_type ) {
                                                      if( post_type_supports( $post_type->name, 'thumbnail' ) == 'true' ) {
                                                              $checked= ( isset( $options['choosed_post_type'][$post_type->name ] ) )? 'checked' : '';
                                                              echo '<label class="checkbox">
                                                                      <input '. $checked .' name="MPT_plugin_posts_settings[choosed_post_type]['. $post_type->name .']" type="checkbox" value="'. $post_type->name .'"><span></span> '. $post_type->labels->name .'
                                                              </label>';
                                                      }
                                              }
                                      ?>
                              </td>
                      </tr>

                      <tr valign="top">
                              <th scope="row">
                                  <?php esc_html_e( 'Relevant categories', 'mpt' ); ?>
                              </th>
                              <td class="taxonomy checkbox-list">
                                      <label class="checkbox"><input type="checkbox" name="select-all-tx" id="select-all-tx"/><span></span> <?php esc_html_e( 'Select all', 'mpt' ); ?></label>
                                      <?php
                                              $categories_default = get_terms(
                                                      array(
                                                              'taxonomy'   => 'category',
                                                              'hide_empty' => false,
                                                      )
                                              );

                                              foreach ( $categories_default as $category ) {
                                                      $checked= ( isset( $options['choosed_categories'][$category->slug ] ) )? 'checked' : '';
                                                      echo '<label class="checkbox">
                                                              <input '. $checked .' name="MPT_plugin_posts_settings[choosed_categories]['. $category->slug .']" type="checkbox" value="'. $category->slug .'"><span></span> '. $category->name .'
                                                      </label>';
                                              }
                                      ?>
                              </td>
                      </tr>
                    </tbody>
            </table>
        </div>

        <?php submit_button(); ?>

    </form>
</div>
