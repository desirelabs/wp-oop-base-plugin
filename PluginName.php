<?php
/**
 * Plugin Name: The plugin name
 * Plugin URI: http://wordpress.org/plugins/plugin-name/
 * Description: Plugin description
 * Author: Franck LEBAS
 * Author URI: http://desirelabs.fr
 * Version: 0.1
 * Licence: GPLv3
 * Text Domain: plugin-text-domain
 * Domaine Path: /lang
 */
define( 'PLUGIN_NAME', 'The plugin name' );
define( 'PN_TEXT_DOMAIN', 'plugin-name' );
define( 'PN_PLUGIN_DIR', __DIR__ );
define( 'PN_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'PN_OPTIONS', 'pn_options' );
require_once 'PnAutoload.php';

class Pn
{

    public $plugin_options;
    static $options;

    /**
     * Init hooks
     */
    static function init()
    {
        self::$options = [
            'step_one' => [
                'page_title'       => __( 'The plugin name', PN_PLUGIN_DIR ),
                'page_description' => __( 'Manage post types and taxonomies.', PN_PLUGIN_DIR ),
                'fields'           => [
                    'option_tab' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'checkbox', // type of input
                        'option_name' => 'label_name',
                        'default' => false, // default option
                        'options' => [] // options for selects
                    ]
                ]
            ]
        ];

        // Loads plugin text domain and scripts
        add_action( 'after_setup_theme', [__CLASS__, 'pn_theme_setup'] );
        add_action( 'admin_enqueue_scripts', [__CLASS__, 'pn_admin_scripts'] );

        // Custom action hooks
        // add_action( 'get_types', [new PnPostsManager, 'pn_step_one'], 10, 2 );

        // Ajax action hooks
        // add_action( 'wp_ajax_pn_ajax_get_post_taxonomies', array(new PnAjax, 'pn_ajax_get_post_taxonomies') );
    }

    static function pn_admin_scripts()
    {
        // loads admin script
        wp_register_script( 'pn-admin-scripts', PN_PLUGIN_DIR_URL . 'assets/js/PnAdminScripts.js', ['jquery'], '0.1', TRUE );
        wp_enqueue_script( 'pn-admin-scripts' );
        // Localize scripts
        wp_localize_script( 'pn-admin-scripts', 'ajaxscript', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
    }

    /**
     * Returns the options array
     */
    static function getOptions()
    {
        return self::$options;
    }

    /**
     * Loads the plugin text domain
     */
    static function pn_theme_setup()
    {
        load_theme_textdomain( PN_TEXT_DOMAIN, PN_PLUGIN_DIR . '/lang' );
    }
}
// Init the plugin
Pn::init();