<?php 
class AvartansliderAdmin {
	
    /**
     * Creates the menu and the admin panel
    */
    public static function avartansliderShowSettings() {
        add_action('admin_menu', 'AvartansliderAdmin::avartansliderPluginMenus');
    }

    /**
     * Add menu in left panel of admin panel
    */
    public static function avartansliderPluginMenus() {
        add_menu_page('Avartan Slider', 'Avartan Slider', 'manage_options', AVARTANSLIDER_TEXTDOMAIN, 'AvartansliderAdmin::avartansliderDisplayPage', AVARTAN_PLUGIN_URL.'/images/avartan.png');
    }
    
    /**
     * Display correct page 
    */
    public static function avartansliderDisplayPage() {
        if(!isset($_GET['view'])) {
            $index = 'home';
        }
        else {
            $index = $_GET['view'];
        }

        global $wpdb;

        // Check what the user is doing: is it adding or modifying a slider? 
        if(isset($_GET['view']) && $_GET['view'] == 'add') {
            $edit = false;
            $id = NULL;
        }
        else {
            $edit = true;
            $id = isset($_GET['id']) ? $_GET['id'] : NULL;
            if(isset($id))
            {
                $slider = $wpdb->get_row('SELECT name FROM ' . $wpdb->prefix . 'avartan_sliders WHERE id = ' . $id);

                //if id is not found
                if(!$slider){
                ?>   
                    <script>
                        window.location.href = '?page=avartanslider';
                    </script>
                <?php    
                }
            }    
        }

        ?>
        <div class="wrap as-admin">	

            <noscript class="as-no-js">
                <div class="as-message as-message-error" style="display: block;"><?php _e('JavaScript must be enabled to view this page correctly.', AVARTANSLIDER_TEXTDOMAIN); ?></div>
            </noscript>

            <?php if(! $edit): ?>
                <div class="as-message as-message-warning"><?php _e('When you\'ll click "Save Settings", you\'ll be able to add slides and elements.', AVARTANSLIDER_TEXTDOMAIN); ?></div>
            <?php endif; ?>

            <h1 class="as-logo" title="Avartan Animation Slider">
                <a href="?page=avartanslider" title="<?php _e('Avartan Slider', AVARTANSLIDER_TEXTDOMAIN); ?>">
                    <img src="<?php echo AVARTAN_PLUGIN_URL.'/images/logo.png' ?>" alt="<?php _e('Avartan Slider', AVARTANSLIDER_TEXTDOMAIN); ?>" />
                </a>
            </h1>
                
            <div class="as-plugin-asides">
                
                <span class="as-close-block as-plugin-close">x</span>

                <div class="as-plugin-aside">
                    <h2><?php _e('Buy Pro Extensions', AVARTANSLIDER_TEXTDOMAIN); ?></h2>
                    <p><?php _e('Buy the following extensions (more coming soon)', AVARTANSLIDER_TEXTDOMAIN); ?>:</p>
                    <ul>
                        <li>
                            <a href="http://www.solwininfotech.com/blog/wordpress/avartan-responsive-wordpress-slider-plugin/" target="_blank"><?php _e('Redirect on pro extension for get more feature', AVARTANSLIDER_TEXTDOMAIN); ?></a>
                        </li>
                    </ul>
                    <p><a href="http://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/" target="_blank" class="as-plugin-buy-now"><?php _e('Buy pro extensions now!', AVARTANSLIDER_TEXTDOMAIN); ?></a></p>
                </div>

                <div class="as-plugin-aside">
                    <h2><?php _e('Get Help', AVARTANSLIDER_TEXTDOMAIN); ?></h2>
                    <ul>
                        <li>
                            <a href="http://www.solwininfotech.com/blog/wordpress/avartan-responsive-wordpress-slider-plugin/" target="_blank"><?php _e('Read the documentation', AVARTANSLIDER_TEXTDOMAIN); ?></a>
                        </li>
                        <li>
                            <a href="http://support.solwininfotech.com/" target="_blank"><?php _e('Have any queries?', AVARTANSLIDER_TEXTDOMAIN); ?></a>
                        </li>
                    </ul>
                </div>
                <div class="as-plugin-aside">
                    <h2><?php _e('Support the plugin', AVARTANSLIDER_TEXTDOMAIN); ?></h2>
                    <div class="facebook-widget">
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-share-button" data-href="http://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/" data-layout="box_count"></div>
                    </div>
                    
                    <div class="twitter-widget">
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        <a class="twitter-share-button"
                            href="https://twitter.com/intent/tweet?url=http%3A%2F%2Fwww.solwininfotech.com%2Fproduct%2Fwordpress-plugins%2Favartan-slider%2F"
                            data-counturl="http://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/" data-count='vertical'>
                        </a>
                    </div>
                    
                    <div class="twitter-widget google_widget" style="text-indent: 0px; margin: 0px; padding: 0px; background: transparent none repeat scroll 0% 0%; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 32px; height: 20px;" id="___plusone_0">                   
                        <div class="social-gplus">
                            <div class="g-plusone" data-size="tall" data-href="http://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/"></div>
                            <script type="text/javascript">
                                (function () {
                                    var po = document.createElement('script');
                                    po.type = 'text/javascript';
                                    po.async = true;
                                    po.src = 'https://apis.google.com/js/platform.js';
                                    var s = document.getElementsByTagName('script')[0];
                                    s.parentNode.insertBefore(po, s);
                                })();
                            </script>
                        </div>
                    </div>
                    
                    <div class="twitter-widget social-linkedin">
                        <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                        <script type="IN/Share" data-url="http://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/" data-counter="top" data-showzero="true"></script>
                    </div>
                </div>
            </div>

            <!-- Display slider name and Back to list button -->        
            <?php if($edit && $index!='' && $index!='home'): ?>
                <div class="as-left as-slider-title-wrapper">
                    <h2 class="as-slider-title"><?php _e('Editing Slider: ', AVARTANSLIDER_TEXTDOMAIN); ?><?php echo $slider->name; ?></h2>
                    <a href="?page=avartanslider" class="as-ele-time-btn as-button as-is-primary as-slider-back-list">
                        <span class="dashicons dashicons-menu"></span>
                        <?php _e('Back to List', AVARTANSLIDER_TEXTDOMAIN); ?>
                    </a>
                </div>
            <?php
            endif;

            //Choose the page for display based on call
            switch($index) {
                    case 'home':
                            self::avartansliderDisplayHome();
                    break;

                    case 'add':
                    case 'edit':
                            self::avartansliderDisplaySlider();
                    break;
            }

            ?>
            <div class="clear"></div>
        </div>
        <?php
    }

    /**
     * Display home page with slider list
    */
    public static function avartansliderDisplayHome() {		
        ?>
        <div class="as-home">
            <?php require_once AVARTAN_PLUGIN_DIR . 'includes/home.php'; ?>
        </div>
        <?php
    }
    
    /**
     * Displays the slider page in wich you can add or modify sliders, slides and elements
    */
    public static function avartansliderDisplaySlider() {
        global $wpdb;

        // Check what the user is doing: is it adding or modifying a slider? 
        if($_GET['view'] == 'add') {
            $edit = false;
            $id = NULL;	//This variable will be used in other files. It contains the ID of the SLIDER that the user is editing
        }
        else {
            $edit = true;
            $id = isset($_GET['id']) ? $_GET['id'] : NULL;
            $slider = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'avartan_sliders WHERE id = ' . $id);
            $slides = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'avartan_slides WHERE slider_parent = ' . $id . ' ORDER BY position');
            // The elements variable are updated in the foreachh() loop directly in the "slides.php" file
        }
        ?>

        <div class="as-slider <?php echo $edit ? 'as-edit-slider' : 'as-add-slider' ?>">
            <div class="as-tabs as-tabs-fade as-tabs-switch-interface">
                <?php if($edit): ?>
                    <ul class="as-slider-tabs">

                        <li>
                            <a class="as-button as-is-green as-is-active" href="#as-slider-settings">
                                <span class="dashicons dashicons-admin-generic"></span>
                                <?php _e('Settings', AVARTANSLIDER_TEXTDOMAIN); ?>
                            </a>
                        </li>
                        <li>
                            <a class="as-button as-is-green" href="#as-slides">
                                <span class="dashicons dashicons-edit"></span>
                                <?php _e('Edit Slides', AVARTANSLIDER_TEXTDOMAIN); ?>
                            </a>
                        </li>
                    </ul>

                <?php endif; ?>

                <?php require_once AVARTAN_PLUGIN_DIR . 'includes/slider.php'; ?>
                <?php
                if($edit) {
                    require_once AVARTAN_PLUGIN_DIR . 'includes/elements.php';
                    require_once AVARTAN_PLUGIN_DIR . 'includes/slides.php';
                }
                ?>
            </div>
        </div>

        <?php
    }

    /**
     * Include CSS and JavaScript
    */
    public static function enqueues() {
        global $wpdb;

        if(isset($_GET['page']) && $_GET['page'] == 'avartanslider')
        {
            wp_enqueue_script('jquery-ui-draggable');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_media();

            wp_register_script('avartanslider-admin-bootstrap', AVARTAN_PLUGIN_URL . '/js/bootstrap.min.js');		
            wp_register_script('avartanslider-admin-bootstrap-growl', AVARTAN_PLUGIN_URL . '/js/jquery.bootstrap-growl.min.js');		
            wp_register_script('avartanslider-admin', AVARTAN_PLUGIN_URL . '/js/admin.js', array('wp-color-picker','jquery-ui-tabs','jquery-ui-sortable','jquery-ui-draggable'));

            self::localization();

            wp_enqueue_style('avartanslider-admin-bootstrap', AVARTAN_PLUGIN_URL . '/css/bootstrap.min.css');
            wp_enqueue_style('avartanslider-admin', AVARTAN_PLUGIN_URL . '/css/admin.css', array());
            wp_enqueue_script('avartanslider-admin-bootstrap');
            wp_enqueue_script('avartanslider-admin-bootstrap-growl');
            wp_enqueue_script('avartanslider-admin');
            ?>
            <style type="text/css">
                    #adminmenu .toplevel_page_avartanslider div.wp-menu-image {
                            background-repeat: no-repeat;
                            background-position: 8px center;
                            opacity: .6;
                            filter: alpha(opacity=60);
                    }

                    #adminmenu .toplevel_page_avartanslider:hover div.wp-menu-image {
                            background-position: -20px center;
                            opacity: 1;
                            filter: alpha(opacity=100);
                    }

                    #adminmenu .toplevel_page_avartanslider.current div.wp-menu-image {
                            opacity: 1;
                            filter: alpha(opacity=100);
                    }

                    #adminmenu .current.toplevel_page_avartanslider:hover div.wp-menu-image {
                            background-position: 8px center;
                            opacity: 1;
                            filter: alpha(opacity=100);
                    }
            </style>
            <?php
        }
    }

    /**
     * add action for enqueue scripts
    */
    public static function setEnqueues() {
        add_action('admin_enqueue_scripts', 'AvartansliderAdmin::enqueues');
    }

    /**
     * Set localization which will be used in js file
    */
    public static function localization() {
        $avartanslider_translations = array(
                'slide' => __('Slide', AVARTANSLIDER_TEXTDOMAIN),
                'slider_name' => __('Slider name can not be empty.', AVARTANSLIDER_TEXTDOMAIN),
                'slider_generate' => __('Slider has been generated successfully.', AVARTANSLIDER_TEXTDOMAIN),
                'slider_save' => __('Slider has been saved successfully.', AVARTANSLIDER_TEXTDOMAIN),
                'slider_error' => __('Something went wrong during save slider!', AVARTANSLIDER_TEXTDOMAIN),
                'slider_already_find' => __('Some other slider with alias', AVARTANSLIDER_TEXTDOMAIN),
                'slider_exists' => __('already exists.', AVARTANSLIDER_TEXTDOMAIN),
                'slider_delete' => __('Slider has been deleted successfully.', AVARTANSLIDER_TEXTDOMAIN),
                'slider_delete_error' => __('Something went wrong during delete slider!', AVARTANSLIDER_TEXTDOMAIN),
                'slide_save' => __('Slide has been saved successfully.', AVARTANSLIDER_TEXTDOMAIN),
                'slide_error' => __('Something went wrong during save slide!', AVARTANSLIDER_TEXTDOMAIN),
                'slide_delete' => __('Slide has been deleted successfully.', AVARTANSLIDER_TEXTDOMAIN),
                'slide_delete_error' => __('Something went wrong during delete slide!', AVARTANSLIDER_TEXTDOMAIN),
                'slide_update_position_error' => __('Something went wrong during update slides position!', AVARTANSLIDER_TEXTDOMAIN),
                'slide_delete_confirm' => __('The slide will be deleted. Are you sure?', AVARTANSLIDER_TEXTDOMAIN),
                'slide_delete_just_one' => __('You can not delete this. You must have at least one slide.', AVARTANSLIDER_TEXTDOMAIN),
                'slider_delete_confirm' => __('The slider will be deleted. Are you sure?', AVARTANSLIDER_TEXTDOMAIN),
                'text_element_default_html' => __('Text element', AVARTANSLIDER_TEXTDOMAIN),
                'element_no_found_txt' => __('No element found.', AVARTANSLIDER_TEXTDOMAIN),
                'slide_stop_preview' => __('Stop Preview', AVARTANSLIDER_TEXTDOMAIN),
                'slider_pro_version' => __('This feature is available for pro version only.', AVARTANSLIDER_TEXTDOMAIN),
                'youtube_video_title' => __('Youtube Video', AVARTANSLIDER_TEXTDOMAIN),
                'html5_video_title' => __('Html5 Video', AVARTANSLIDER_TEXTDOMAIN),
                'AvartanPluginUrl' => plugins_url().'/avartan-slider-lite', 
        );
        wp_localize_script('avartanslider-admin', 'avartanslider_translations', $avartanslider_translations);
    }

}?>