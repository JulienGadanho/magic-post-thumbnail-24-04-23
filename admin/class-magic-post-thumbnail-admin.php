<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://magic-post-thumbnail.com/
 * @since      1.0.0
 *
 * @package    Magic_Post_Thumbnail
 * @subpackage Magic_Post_Thumbnail/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Magic_Post_Thumbnail
 * @subpackage Magic_Post_Thumbnail/admin
 * @author     Magic Post Thumbnail <contact@magic-post-thumbnail.com>
 */
class Magic_Post_Thumbnail_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    4.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    4.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    4.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $mpt_generation = $this->MPT_generation_features();
        // Freemius SDK Integration
        
        if ( function_exists( '\\Magic_Post_Thumbnail_Admin\\MPT_Freemius' ) ) {
            $this->MPT_freemius()->set_basename( true, __FILE__ );
        } else {
            if ( !function_exists( '\\Magic_Post_Thumbnail_Admin\\MPT_Freemius' ) ) {
                $this->MPT_freemius();
            }
        }
        
        // Crons for pro version
        $cron_options = wp_parse_args( get_option( 'MPT_plugin_cron_settings' ) );
        $compatibility = wp_parse_args( get_option( 'MPT_plugin_compatibility_settings' ), $this->MPT_default_options_compatibility_settings( TRUE ) );
    }
    
    public function MPT_trigger_wp_insert_post( $post_ID )
    {
        $log = $this->MPT_monolog_call();
        $log->info( 'wp_insert_post action' );
        $automatic_generation = new Magic_Post_Thumbnail_Generation( $this->plugin_name, $this->version );
        $automatic_generation->MPT_create_thumb(
            $post_ID,
            '0',
            '1',
            '1',
            '0'
        );
    }
    
    public function MPT_trigger_save_post()
    {
        $log = $this->MPT_monolog_call();
        $log->info( 'Launch Automatic plugin' );
        $automatic_generation = new Magic_Post_Thumbnail_Generation( $this->plugin_name, $this->version );
        add_action( 'save_post', array( $automatic_generation, 'MPT_create_thumb' ) );
    }
    
    public function MPT_trigger_wp_automatic( $post_data )
    {
        $log = $this->MPT_monolog_call();
        $log->info( 'Launch WordPress Automatic Plugin' );
        $automatic_generation = new Magic_Post_Thumbnail_Generation( $this->plugin_name, $this->version );
        $automatic_generation->MPT_create_thumb(
            $post_data['post_id'],
            '0',
            '1',
            '1',
            '0'
        );
    }
    
    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    4.0.0
     * @access   private
     */
    private function MPT_generation_features()
    {
        $mpt_generation = new Magic_Post_Thumbnail_Generation( $this->plugin_name, $this->version );
        return $mpt_generation;
    }
    
    /**
     * Register the stylesheets for the admin area.
     *
     * @since    4.0.0
     */
    public function enqueue_styles( $hook )
    {
        // Post Editor
        if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
            wp_enqueue_style(
                'mpt-post',
                plugin_dir_url( __FILE__ ) . 'css/magic-post-thumbnail-post.css',
                array(),
                $this->version,
                'all'
            );
        }
        // MPT Admin Dashboard
        
        if ( $hook == 'toplevel_page_magic-post-thumbnail-admin-display' ) {
            wp_enqueue_style(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'css/magic-post-thumbnail-admin.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'plugins-bundle',
                plugin_dir_url( __FILE__ ) . 'css/plugins.bundle.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'style.bundle',
                plugin_dir_url( __FILE__ ) . 'css/style.bundle.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'theme-base-light',
                plugin_dir_url( __FILE__ ) . 'css/themes/layout/header/base/light.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'theme-menu-light',
                plugin_dir_url( __FILE__ ) . 'css/themes/layout/header/menu/light.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'theme-brand-dark',
                plugin_dir_url( __FILE__ ) . 'css/themes/layout/brand/dark.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'theme-aside-dark',
                plugin_dir_url( __FILE__ ) . 'css/themes/layout/aside/dark.css',
                array(),
                $this->version,
                'all'
            );
        }
    
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    4.0.0
     */
    public function enqueue_scripts( $hook )
    {
        global  $pagenow ;
        $active_posts_types = wp_parse_args( get_option( 'MPT_plugin_posts_settings' ), $this->MPT_default_options_posts_settings( TRUE ) );
        $compatibility = wp_parse_args( get_option( 'MPT_plugin_compatibility_settings' ), $this->MPT_default_options_compatibility_settings( TRUE ) );
        
        if ( $hook == 'toplevel_page_magic-post-thumbnail-admin-display' ) {
            wp_enqueue_script(
                'prismjs-bundle',
                plugin_dir_url( __FILE__ ) . 'js/prismjs.bundle.js',
                array( 'jquery' ),
                $this->version,
                true
            );
            wp_enqueue_script(
                'scripts-bundle',
                plugin_dir_url( __FILE__ ) . 'js/scripts.bundle.js',
                array( 'jquery' ),
                $this->version,
                true
            );
            wp_enqueue_script(
                'common-mpt',
                plugin_dir_url( __FILE__ ) . 'js/common.js',
                array( 'jquery' ),
                $this->version,
                true
            );
        }
        
        // Bulk generation
        $module = ( isset( $_GET['module'] ) ? sanitize_text_field( $_GET['module'] ) : '' );
        $options = wp_parse_args( get_option( 'MPT_plugin_interval_settings' ), $this->MPT_default_options_interval_settings( TRUE ) );
        
        if ( $hook == 'toplevel_page_magic-post-thumbnail-admin-display' && 'bulk-generation' == $module ) {
            wp_enqueue_script( 'jquery-ui-progressbar', plugins_url( 'js/jquery-ui/jquery-ui.js', __FILE__ ), array( 'jquery-ui-core' ) );
            wp_enqueue_style( 'style-jquery-ui', plugins_url( 'js/jquery-ui/jquery-ui.css', __FILE__ ) );
            wp_enqueue_script( 'images-generation', plugins_url( 'js/generation.js', __FILE__ ), array( 'jquery-ui-progressbar' ) );
        }
        
        // JavaScript Variables for nonce, admin-jax.php path and translations
        $js_vars = array(
            'wp_ajax_url'  => admin_url( 'admin-ajax.php' ),
            'translations' => array(
            'successful'       => esc_html__( 'Successful generation !!', 'mpt' ),
            'error_generation' => esc_html__( 'Error with images generation', 'mpt' ),
            'error_plugin'     => esc_html__( 'Error with the plugin', 'mpt' ),
        ),
        );
        
        if ( !empty($_POST['mpt']) || !empty($_REQUEST['ids_mpt_generation']) || !empty($_REQUEST['cats']) ) {
            
            if ( !empty($_REQUEST['cats']) ) {
                $taxo_term = get_term( $_REQUEST['cats'] );
                if ( empty($taxo_term) ) {
                    return false;
                }
                $cpts = get_post_types( array(
                    'public' => true,
                ), 'names' );
                $post_ids = get_posts( array(
                    'numberposts' => -1,
                    'tax_query'   => array( array(
                    'taxonomy' => $taxo_term->taxonomy,
                    'field'    => 'slug',
                    'terms'    => $taxo_term->slug,
                ) ),
                    'post_type'   => array(),
                    'post_status' => array(
                    'publish',
                    'draft',
                    'pending',
                    'future',
                    'private'
                ),
                    'fields'      => 'ids',
                ) );
                $ids = '';
                foreach ( $post_ids as $post_id ) {
                    $ids .= $post_id . ',';
                }
                $_GET['ids'] = substr_replace( $ids, '', -1 );
                $_GET['ids_mpt_generation'] = $_GET['ids'];
            }
            
            $ids = esc_attr( $_GET['ids_mpt_generation'] );
            $ids = array_map( 'intval', explode( ',', trim( $ids, ',' ) ) );
            $count = count( $ids );
            $ids = json_encode( $ids );
            $ajax_nonce = wp_create_nonce( 'ajax_nonce_magic_post_thumbnail' );
            
            if ( isset( $options['bulk_generation_interval'] ) && (int) $options['bulk_generation_interval'] !== 0 ) {
                $remaining_seconds = $this->cron_scheduled();
            } else {
                $remaining_seconds = 0;
            }
            
            $js_vars['sendposts'] = array(
                'posts'    => $ids,
                'count'    => $count,
                'interval' => $remaining_seconds,
                'nonce'    => $ajax_nonce,
            );
        }
        
        //Include Main dashboard Js
        if ( $hook == 'toplevel_page_magic-post-thumbnail-admin-display' || ($pagenow == 'index.php' || $pagenow == 'post.php' || $pagenow == 'post-new.php') && in_array( get_post_type( get_the_ID() ), $active_posts_types['choosed_post_type'] ) ) {
            wp_enqueue_script(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'js/magic-post-thumbnail-admin.js',
                array( 'jquery' ),
                $this->version,
                false
            );
        }
        $current_post_ID = json_encode( array_map( 'intval', array( get_the_ID() ) ) );
        $post_nounce = wp_create_nonce( 'ajax_nonce_magic_post_thumbnail' );
        /* General settings */
        $post_vars['postgeneration'] = array(
            'fifu_on'       => filter_var( $compatibility['enable_FIFU'], FILTER_VALIDATE_BOOLEAN ),
            'wp_ajax_url'   => admin_url( 'admin-ajax.php' ),
            'postID'        => $current_post_ID,
            'generateImg'   => plugin_dir_url( __FILE__ ) . 'img/generate.png',
            'strGenerate'   => esc_html__( 'Generation', 'mpt' ),
            'strNoGenerate' => esc_html__( 'Click to generate', 'mpt' ),
            'strNoRewrite'  => esc_html__( 'Edit your rewriting settings if you want a new image', 'mpt' ),
            'nonce'         => $post_nounce,
        );
        // Do not include this file into unselected posts types
        if ( ($pagenow == 'index.php' || $pagenow == 'post.php' || $pagenow == 'post-new.php') && in_array( get_post_type( get_the_ID() ), $active_posts_types['choosed_post_type'] ) ) {
            wp_localize_script( $this->plugin_name, 'generationSpecificPostJsVars', $post_vars );
        }
        /* Translation for JS file */
        $translations_var['translations'] = array(
            'pro_version' => esc_html__( 'Only available with the pro version', 'mpt' ),
            'delete_logs' => esc_html__( 'Are you sure to delete all logs ?', 'mpt' ),
            'no_interval' => esc_html__( 'No interval', 'mpt' ),
            'per_minute'  => esc_html__( 'per minute', 'mpt' ),
            'per_hour'    => esc_html__( 'per hour', 'mpt' ),
        );
        wp_localize_script( $this->plugin_name, 'translationsJsVars', $translations_var );
        wp_localize_script( 'common-mpt', 'translationsJsVars', $translations_var );
        wp_localize_script( 'images-generation', 'generationJsVars', $js_vars );
    }
    
    public function cron_scheduled()
    {
        // interval delay
        $options = wp_parse_args( get_option( 'MPT_plugin_interval_settings' ) );
        $options_interval = $options['bulk_generation_interval'];
        // Switch interval options into seconds
        switch ( $options_interval ) {
            case '0':
                return false;
            case '1':
                $interval_seconds = 20;
                break;
            case '2':
                $interval_seconds = 30;
                break;
            case '3':
                $interval_seconds = 60;
                break;
            case '4':
                $interval_seconds = 120;
                break;
            case '5':
                $interval_seconds = 240;
                break;
            case '6':
                $interval_seconds = 600;
                break;
            case '7':
                $interval_seconds = 3600;
                break;
            default:
                return false;
        }
        return $interval_seconds;
    }
    
    /**
     * Show main menu item
     *
     * @since    4.0.0
     */
    public function MPT_main_settings()
    {
        add_menu_page(
            __( 'Magic Post Thumbnail Options', 'mpt' ),
            'Magic Post Thumbnail',
            'mpt_manage',
            'magic-post-thumbnail-admin-display',
            //'magic_post_thumbnail_settings',
            array( &$this, 'MPT_options' ),
            'dashicons-images-alt2',
            81
        );
        /* Bulk Generation link for posts & custom post type */
        $post_type_availables = get_option( 'MPT_plugin_posts_settings' );
        
        if ( isset( $post_type_availables['choosed_post_type'] ) ) {
            if ( false == $post_type_availables['choosed_post_type'] ) {
                $post_type_availables['choosed_post_type'] = array();
            }
        } else {
            $post_types_default = get_post_types( '', 'objects' );
            unset(
                $post_types_default['attachment'],
                $post_types_default['revision'],
                $post_types_default['nav_menu_item'],
                $post_types_default['custom_css'],
                $post_types_default['customize_changeset'],
                $post_types_default['oembed_cache'],
                $post_types_default['user_request'],
                $post_types_default['wp_block'],
                $post_types_default['wp_template'],
                $post_types_default['wp_template_part'],
                $post_types_default['wp_global_styles'],
                $post_types_default['wp_navigation']
            );
            $post_type_availables = array();
            $post_type_availables['choosed_post_type'] = array();
            foreach ( $post_types_default as $post_type ) {
                $post_type_availables['choosed_post_type'][$post_type->name] = $post_type->name;
            }
        }
        
        foreach ( $post_type_availables['choosed_post_type'] as $screen ) {
            add_filter( 'bulk_actions-edit-' . $screen, array( &$this, 'MPT_add_bulk_actions' ) );
            // Text on dropdown
            add_action( 'handle_bulk_actions-edit-' . $screen, array( &$this, 'MPT_bulk_action_handler' ) );
            // Redirection
        }
        // Genererate link for Categories
        add_filter(
            'category_row_actions',
            array( &$this, 'MPT_add_bulk_action_category' ),
            10,
            2
        );
        // Loop with each taxo for Genrate link
        $args_taxo = array(
            'public' => true,
        );
        $taxonomies = get_taxonomies( $args_taxo );
        $taxonomies = array_diff( $taxonomies, [ 'post_tag', 'post_format' ] );
        foreach ( $taxonomies as $taxonomy ) {
            add_filter(
                $taxonomy . '_row_actions',
                array( &$this, 'MPT_add_bulk_action_category' ),
                10,
                2
            );
        }
    }
    
    /**
     * Main actions
     *
     * @since    4.0.0
     */
    public function MPT_main_actions()
    {
        if ( !current_user_can( 'mpt_manage' ) ) {
            wp_die( esc_html__( 'You do not have sufficient permissions.', 'mpt' ) );
        }
        register_setting( 'MPT-plugin-posts-settings', 'MPT_plugin_posts_settings' );
        register_setting( 'MPT-plugin-main-settings', 'MPT_plugin_main_settings' );
        register_setting( 'MPT-plugin-banks-settings', 'MPT_plugin_banks_settings' );
        register_setting( 'MPT-plugin-interval-settings', 'MPT_plugin_interval_settings' );
        register_setting( 'MPT-plugin-cron-settings', 'MPT_plugin_cron_settings' );
        register_setting( 'MPT-plugin-proxy-settings', 'MPT_plugin_proxy_settings' );
        register_setting( 'MPT-plugin-compatibility-settings', 'MPT_plugin_compatibility_settings' );
        register_setting( 'MPT-plugin-logs-settings', 'MPT_plugin_logs_settings' );
        require_once dirname( __FILE__ ) . '/partials/download_log.php';
        require_once dirname( __FILE__ ) . '/partials/delete_log.php';
    }
    
    /**
     * Main settings page
     *
     * @since    4.0.0
     */
    public function MPT_options()
    {
        if ( !current_user_can( 'mpt_manage' ) ) {
            wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'mpt' ) );
        }
        do_action( 'mpt_before_options_panel' );
        require_once dirname( __FILE__ ) . '/partials/magic-post-thumbnail-admin-display.php';
    }
    
    /**
     * Display submenus
     *
     * @since    4.0.0
     */
    public function MPT_submenu( $title = 'Submenu', $slug = 'dashboard', $icon = 'default.png' )
    {
        $url = explode( '?', esc_url_raw( add_query_arg( array() ) ) );
        $no_query_args = $url[0];
        $current_url = remove_query_arg( 'ids_mpt_generation', add_query_arg( 'module', $slug, $this->MPT_current_url() ) );
        
        if ( isset( $_GET['module'] ) ) {
            $current_module = sanitize_text_field( $_GET['module'] );
        } else {
            // Default Tab
            $current_module = 'dashboard';
        }
        
        $item_class = 'menu-item menu-item-submenu ';
        if ( $current_module == $slug ) {
            $item_class .= 'menu-item-open menu-item-here ';
        }
        // Exception with upgrade page
        if ( 'upgrade' == $slug ) {
            $current_url = get_admin_url() . 'admin.php?page=magic-post-thumbnail-admin-display-pricing';
        }
        ?>
		<li class="<?php 
        echo  $item_class ;
        ?>" data-menu-toggle="hover">
		    <a href="<?php 
        echo  $current_url ;
        ?>" class="menu-link">
		        <img src="<?php 
        echo  plugin_dir_url( __FILE__ ) . '/img/' . $icon ;
        ?>" class="icon-dashboard" width="24px" height="24px" />
		        <span class="menu-text"><?php 
        echo  $title ;
        ?></span>
		    </a>
		</li>
	<?php 
    }
    
    /**
     * Get current url
     *
     * @since    4.0.0
     */
    public function MPT_current_url()
    {
        $requested_url = ( is_ssl() ? 'https://' : 'http://' );
        $requested_url .= $_SERVER['HTTP_HOST'];
        $requested_url .= $_SERVER['REQUEST_URI'];
        return $requested_url;
    }
    
    /**
     * Launch Freemius
     *
     * @since    4.0.0
     */
    public function MPT_freemius()
    {
        $mpt_freemius = launch_freemius();
        return $mpt_freemius;
    }
    
    /**
     * Default values for Posts admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_posts_settings( $never_set = FALSE )
    {
        
        if ( $never_set == TRUE ) {
            $post_types_default = get_post_types( '', 'objects' );
            unset(
                $post_types_default['attachment'],
                $post_types_default['revision'],
                $post_types_default['nav_menu_item'],
                $post_types_default['custom_css'],
                $post_types_default['customize_changeset'],
                $post_types_default['oembed_cache'],
                $post_types_default['user_request'],
                $post_types_default['wp_block'],
                $post_types_default['wp_template'],
                $post_types_default['wp_template_part'],
                $post_types_default['wp_global_styles'],
                $post_types_default['wp_navigation']
            );
            foreach ( $post_types_default as $post_type ) {
                $default_post_types[$post_type->name] = $post_type->name;
            }
            $categories_default = get_terms( array(
                'taxonomy'   => 'category',
                'hide_empty' => false,
            ) );
            foreach ( $categories_default as $category ) {
                $default_categories[$category->slug] = $category->name;
            }
        } else {
            $default_post_types = array();
            $default_categories = array();
        }
        
        $default_options['enable_save_post_hook'] = '';
        $default_options['choosed_post_type'] = $default_post_types;
        $default_options['choosed_categories'] = $default_categories;
        return $default_options;
    }
    
    /**
     * Default values for Image admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_main_settings( $never_set = FALSE )
    {
        $default_options = array(
            'image_location'   => 'featured',
            'based_on'         => 'title',
            'translation_EN'   => '',
            'title_selection'  => 'full_title',
            'selected_image'   => 'first_result',
            'image_filename'   => 'title',
            'rewrite_featured' => '',
            'image_flip'       => '',
            'image_crop'       => '',
        );
        return $default_options;
    }
    
    /**
     * Default values for "Source" (Banks) admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_banks_settings( $never_set = FALSE )
    {
        $default_options = array(
            'api_chosen'      => 'google_scraping',
            'google_scraping' => array(
            'search_country'      => 'en',
            'img_color'           => '',
            'rights'              => '',
            'imgsz'               => '',
            'format'              => '',
            'imgtype'             => '',
            'safe'                => 'medium',
            'restricted_domains'  => '',
            'blacklisted_domains' => '',
        ),
            'googleimage'     => array(
            'cxid'           => '',
            'apikey'         => '',
            'search_country' => 'en',
            'img_color'      => '',
            'filetype'       => '',
            'imgsz'          => '',
            'imgtype'        => '',
            'safe'           => 'moderate',
        ),
            'dallev1'         => array(
            'apikey'  => '',
            'imgsize' => '1024x1024',
        ),
            'cc_search'       => array(
            'source'       => 1,
            'rights'       => '',
            'imgtype'      => '',
            'aspect_ratio' => 'tall',
        ),
            'flickr'          => array(
            'rights'  => '',
            'imgtype' => 7,
        ),
            'pixabay'         => array(
            'username'       => '',
            'apikey'         => '',
            'imgtype'        => 'all',
            'search_country' => 'en',
            'orientation'    => 'all',
            'min_width'      => 0,
            'min_height'     => 0,
            'safesearch'     => 'false',
        ),
        );
        return $default_options;
    }
    
    /**
     * Default values for Interval admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_interval_settings( $never_set = FALSE )
    {
        $default_options = array(
            'bulk_generation_interval' => 0,
        );
        return $default_options;
    }
    
    /**
     * Default values for Compatibility admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_compatibility_settings( $never_set = FALSE )
    {
        $default_options = array(
            'enable_FIFU' => false,
        );
        return $default_options;
    }
    
    /**
     * Default values for Cron admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_cron_settings( $never_set = FALSE )
    {
        $default_options = array(
            'enable_cron' => 'disable',
        );
        return $default_options;
    }
    
    /**
     * Default values for Proxy admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_proxy_settings( $never_set = FALSE )
    {
        $default_options = array(
            'enable_proxy' => 'disable',
        );
        return $default_options;
    }
    
    /**
     * Default values for logs admin tabs
     *
     * @since    4.0.0
     */
    public function MPT_default_options_logs_settings( $never_set = FALSE )
    {
        $default_options = array(
            'logs' => '',
        );
        return $default_options;
    }
    
    /**
     * Create file for logs
     *
     * @since    4.0.0
     */
    private function MPT_log_file( $check = false )
    {
        $filename = ABSPATH . 'wp-content/uploads/magic-post-thumbnail/logs/';
        $files = @scandir( $filename );
        $result = '';
        if ( !empty($files) ) {
            foreach ( $files as $key => $value ) {
                if ( !in_array( $value, array( '.', '..' ), true ) ) {
                    if ( !is_dir( $value ) && strstr( $value, '.log' ) ) {
                        $result = $value;
                    }
                }
            }
        }
        if ( true == $check && empty($result) ) {
            return false;
        }
        if ( empty($result) ) {
            $result = 'mpt-' . wp_generate_password( 14, false, false ) . '.log';
        }
        return $result;
    }
    
    /**
     * Create file for logs
     *
     * @since    4.0.0
     */
    public function MPT_monolog_call()
    {
        $main_settings = get_option( 'MPT_plugin_logs_settings' );
        // Check if logs enabled
        
        if ( !empty($main_settings['logs']) && true == $main_settings['logs'] ) {
            require_once dirname( __FILE__ ) . '/partials/monolog/vendor/autoload.php';
            $log = new Monolog\Logger( 'mpt_logger' );
            $logfile = $this->MPT_log_file();
            // Now add some handlers
            $log->pushHandler( new Monolog\Handler\StreamHandler( ABSPATH . 'wp-content/uploads/magic-post-thumbnail/logs/' . $logfile, Monolog\Logger::DEBUG ) );
            $log->pushHandler( new Monolog\Handler\FirePHPHandler() );
        } else {
            require_once dirname( __FILE__ ) . '/partials/monolog/nologs.php';
            $log = new Nolog();
        }
        
        return $log;
    }
    
    /**
     * Check if interval generation is enabled
     *
     * @since    4.0.0
     */
    public function MPT_check_interval()
    {
        $options = wp_parse_args( get_option( 'MPT_plugin_interval_settings' ), $this->MPT_default_options_interval_settings( TRUE ) );
        $value_bulk_generation_interval = ( isset( $options['bulk_generation_interval'] ) ? (int) $options['bulk_generation_interval'] : 0 );
        
        if ( 0 == $value_bulk_generation_interval ) {
            return false;
        } else {
            return true;
        }
    
    }
    
    /**
     * Check if interval generation is enabled
     *
     * @since    4.0.0
     */
    public function MPT_do_interval_cron( $new_ids_to_add = false )
    {
        // Get processing  ids
        $interval_posts_to_generate = get_transient( 'MPT_interval_generation' );
        // Check if last generation ids is done and clear it
        // Default status to "generation done"
        if ( !empty($interval_posts_to_generate) ) {
            $no_more_post_to_generate = true;
        }
        foreach ( $interval_posts_to_generate as $post => $post_val ) {
            $continue_loop = false;
            // Get the first post not already generated
            
            if ( FALSE == $interval_posts_to_generate[$post]['processed'] ) {
                // Change default status to "generation processing"
                $no_more_post_to_generate = false;
                // Generation
                $launch_MPT = new Magic_Post_Thumbnail_Generation( $this->plugin_name, $this->version );
                $MPT_return = $launch_MPT->MPT_create_thumb(
                    $interval_posts_to_generate[$post]['id'],
                    '0',
                    '0',
                    '0',
                    '0'
                );
                // Get the return status
                
                if ( $MPT_return == null ) {
                    // Settings
                    $main_settings = get_option( 'MPT_plugin_main_settings' );
                    // Image location
                    $image_location = ( !empty($main_settings['image_location']) ? $main_settings['image_location'] : 'featured' );
                    
                    if ( has_post_thumbnail( $interval_posts_to_generate[$post]['id'] ) && "featured" === $image_location ) {
                        $interval_posts_to_generate[$post]['processed'] = 'already-exist';
                        $continue_loop = true;
                    } else {
                        // Add the status to this speficic post : Problem
                        $interval_posts_to_generate[$post]['processed'] = 'error';
                    }
                
                } else {
                    // Add the status to theis speficic post : ok
                    $interval_posts_to_generate[$post]['processed'] = true;
                }
                
                // Limit only to the first post
                if ( TRUE !== $continue_loop ) {
                    break;
                }
            }
        
        }
        // Generation done and new ids to generate
        
        if ( TRUE == $no_more_post_to_generate && $new_ids_to_add ) {
            // Delete old posts
            delete_transient( 'MPT_interval_generation' );
            foreach ( $new_ids_to_add as $id ) {
                $new_posts_to_generate[] = array(
                    'id'        => (int) $id,
                    'processed' => false,
                );
            }
            // Add news posts
            set_transient( 'MPT_interval_generation', $new_posts_to_generate );
        } elseif ( TRUE == $no_more_post_to_generate && FALSE == $new_ids_to_add ) {
            // Generation done
            // Nothing to add/do
        } elseif ( FALSE == $no_more_post_to_generate && $new_ids_to_add ) {
            // Update avec les nouveaux ids (ajout à la fin)
            foreach ( $new_ids_to_add as $id ) {
                $interval_posts_to_generate[] = array(
                    'id'        => (int) $id,
                    'processed' => false,
                );
            }
            // Allow ids into the array only once. Avoid duplicate ids (Remove the last ones)
            foreach ( $interval_posts_to_generate as &$v ) {
                if ( !isset( $temp_generate_posts[$v['id']] ) ) {
                    $temp_generate_posts[$v['id']] =& $v;
                }
            }
            $interval_posts_to_generate = array_values( $temp_generate_posts );
            // Add news posts
            set_transient( 'MPT_interval_generation', $interval_posts_to_generate );
        } else {
            // Generation not finished : Updating transient
            set_transient( 'MPT_interval_generation', $interval_posts_to_generate );
        }
    
    }
    
    /**
     * Add "Generate featured images" into bulk menu for categories
     *
     * @since    4.0.0
     */
    public function MPT_add_bulk_action_category( $actions, $tag )
    {
        $actions['atp'] = '<a href="admin.php?page=magic-post-thumbnail-admin-display&module=bulk-generation&cats=' . $tag->term_id . '" class="aria-button-if-js">' . esc_html__( 'Generate featured images', 'mpt' ) . '</a>';
        return $actions;
    }
    
    /**
     * Redirection for bulk action
     *
     * @since    4.0.0
     */
    public function MPT_bulk_action_handler()
    {
        $ids = implode( ',', array_map( 'intval', $_REQUEST['post'] ) );
        wp_redirect( 'admin.php?page=magic-post-thumbnail-admin-display&module=bulk-generation&ids_mpt_generation=' . $ids, '301' );
        exit;
    }
    
    /**
     * Add "Generate featured images" into bulk menu for posts
     *
     * @since    4.0.0
     */
    public function MPT_add_bulk_actions( $actions )
    {
        ?>
	        <script type="text/javascript">
	                jQuery(document).ready(function($){
	                        $('select[name^="action"] option:last-child').before('<option value="bulk_regenerate_thumbnails"><?php 
        echo  esc_html__( 'Generate featured images', 'mpt' ) ;
        ?></option>');
	                });
	        </script>
	        <?php 
        return $actions;
    }

}