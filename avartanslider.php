<?php
/**
 * Plugin Name: Avartan Slider Lite
 * Plugin URI: 
 * Description: To make your home page more beautiful with Avaratan Slider. Avaratan Slider is a first free slider plugin with lots of nice features like beautiful, modern and configurable backend elements. It is multipurpose slider which comes with text, image and video elements.
 * Author: Solwin Infotech
 * Author URI: http://solwininfotech.com/
 * Copyright: Solwin Infotech
 * Version: 1.0.0
 * Requires at least: 3.8.0
 * Tested up to: 4.3.1
 * License: GPLv2 or later
 */ 
/*************/
/** GLOBALS **/
/*************/ 

if (!defined('AVARTANSLIDER_TEXTDOMAIN')) {
    define("AVARTANSLIDER_TEXTDOMAIN","avartanslider");
}
if (!defined('AVARTAN_PLUGIN_DIR')) {
    define('AVARTAN_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
if (!defined('AVARTAN_PLUGIN_URL')) {
    define('AVARTAN_PLUGIN_URL', plugins_url() . '/avartan-slider-lite');
}

/**
 * Convert hexdec color string to rgb(a) string
 * 
 * @param string $color color in hex or rgb format
 * 
 * @param boolean/integer $opacity value of opacity
*/
if(!function_exists('avartansliderHex2Rgba'))
{ 
    function avartansliderHex2Rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
         $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 100){
                $opacity = 100;
            }
            $output = 'rgba('.implode(",",$rgb).','.($opacity/100).')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }
}
require_once AVARTAN_PLUGIN_DIR . 'includes/tables.php';
require_once AVARTAN_PLUGIN_DIR . 'includes/shortcode.php';

// Create (or remove) 3 tables: the sliders settings, the slides settings and the elements proprieties. We will also store the current version of the plugin					
register_activation_hook(__FILE__, array('AvartansliderTables', 'avartansliderSetTables'));
register_uninstall_hook(__FILE__, array('AvartansliderTables', 'avartansliderDropTables'));

/**
 * plugin text domain
*/
add_action('plugins_loaded', 'avartansliderPluginTextDomain');
function avartansliderPluginTextDomain()
{
    $locale = apply_filters('plugin_locale', get_locale(), AVARTANSLIDER_TEXTDOMAIN);
    load_textdomain(AVARTANSLIDER_TEXTDOMAIN, WP_LANG_DIR . '/avartanslider-' . $locale . '.mo');
    load_plugin_textdomain(AVARTANSLIDER_TEXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
}

/**
 * admin enqueue script
*/
if(is_admin()) {
    require_once AVARTAN_PLUGIN_DIR . 'includes/admin.php';
    add_action('admin_enqueue_scripts', 'avartansliderAdminJS');
}

if(!function_exists('avartansliderAdminJS'))
{
    function avartansliderAdminJS()
    {
        ?>
        <script type="text/javascript">
            var avartanslider_is_wordpress_admin = true;
        </script>
        <?php
    }
}

/**
 * both side enqueue script and style
*/
add_action('wp_enqueue_scripts', 'enqueues');
add_action('admin_enqueue_scripts', 'enqueues');

if(!function_exists('enqueues'))
{
    function enqueues()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_style('slidercss', AVARTAN_PLUGIN_URL . '/css/avartanslider.css');
        wp_enqueue_style('Html5css', AVARTAN_PLUGIN_URL . '/videojs/video-js.min.css');
        wp_enqueue_script('froogaloop2js', AVARTAN_PLUGIN_URL. '/js/froogaloop2.min.js');
        wp_enqueue_script('Youtubejs', 'https://www.youtube.com/iframe_api'); 
        wp_enqueue_script('Html5js', AVARTAN_PLUGIN_URL. '/videojs/video.js');
        wp_localize_script('Html5js', 'avartansliderSliderHtml5JS', array('AvartanPluginUrl' => plugins_url().'/avartan-slider-lite'));
        wp_enqueue_script('sliderjs', AVARTAN_PLUGIN_URL . '/js/avartanslider.js');
    }
}

AvartansliderShortcode::avartansliderAddShortcode();

//admin enqueue script
if(is_admin()) {
    AvartansliderAdmin::setEnqueues();
    AvartansliderAdmin::avartansliderShowSettings();
    
    
    // Ajax functions
    require_once AVARTAN_PLUGIN_DIR . 'includes/ajax.php';	
    
    /**
    * Append the 'Add Slider' button to selected admin pages
    */
    add_filter( 'media_buttons_context', 'insert_avartanslider_button' );
    function insert_avartanslider_button( $context ) {

            global $pagenow;

            if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
                $context .= '<a href="#TB_inline?&inlineId=choose-avartan-slider" class="thickbox button" title="' .
                    __( "Select slideshow to insert into post", AVARTANSLIDER_TEXTDOMAIN ) .
                    '"><span class="wp-media-buttons-icon" style="background: url(' . AVARTAN_PLUGIN_URL .
                    '/images/avartan.png); background-repeat: no-repeat; background-position: left bottom;"></span> ' .
                    __( "Add Avartan slider", AVARTANSLIDER_TEXTDOMAIN ) . '</a>';
            }

            return $context;

        }

        /**
         * Append the 'Choose Avartan Slider' thickbox content to the bottom of selected admin pages
         */
        add_action( 'admin_footer','admin_footer_avartan', 11 );
        function admin_footer_avartan() {

            global $pagenow;

            // Only run in post/page creation and edit screens
            if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
                global $wpdb;
                //Get the slider information            
                $sliders = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'avartan_sliders');
                ?>

                <script type="text/javascript">
                    jQuery(document).ready(function() {                    
                      jQuery('#insertAvartanSlider').on('click', function() {                      
                        var id = jQuery('#avartanslider-select option:selected').val();
                        window.send_to_editor('[avartanslider alias=' + id + ']');
                        tb_remove();
                      });
                    });
                </script>

                <div id="choose-avartan-slider" style="display: none;">
                    <div class="wrap">
                        <?php
                            if ( count( $sliders ) ) {
                                echo "<h3 style='margin-bottom: 20px;'>" . __( "Insert Avartan Slider", AVARTANSLIDER_TEXTDOMAIN ) . "</h3>";
                                echo "<select id='avartanslider-select'>";
                                echo "<option disabled=disabled>" . __( "Choose slideshow", AVARTANSLIDER_TEXTDOMAIN ) . "</option>";
                                foreach ( $sliders as $slider ) {
                                    echo "<option value='{$slider->alias}'>{$slider->name}</option>";
                                }
                                echo "</select>";
                                echo "<button class='button primary' id='insertAvartanSlider'>" . __( "Insert slideshow", AVARTANSLIDER_TEXTDOMAIN ) . "</button>";
                            } else {
                                _e( "No sliders found", AVARTANSLIDER_TEXTDOMAIN );
                            }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
}
require_once AVARTAN_PLUGIN_DIR . 'includes/avartan_widget.php';
    function Avartansliderwidget_register() {
        register_widget('Avartanslider_Widget');
    }
    add_action( 'widgets_init', 'Avartansliderwidget_register' );
?>