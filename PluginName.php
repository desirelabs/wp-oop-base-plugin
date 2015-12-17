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
require_once 'config.php';
require_once 'PnAutoload.php';

/**
 * Class Pn
 * This is the main class of the plugin
 */
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
            'tab_one' => [
                'page_title'       => __( 'The plugin name', PN_PLUGIN_DIR ),
                'page_description' => __( 'Manage post types and taxonomies.', PN_PLUGIN_DIR ),
                'fields'           => [
                    'field_name' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'text', // type of input
                        'option_name' => 'field_name',
                        'default' => false, // default option
                        'options' => [] // options for selects
                    ],
                    'field_name_2' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'textarea', // type of input
                        'option_name' => 'field_name_2',
                        'default' => false, // default option
                        'options' => [] // options for selects
                    ],
                    'field_name_3' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'checkbox', // type of input
                        'option_name' => 'field_name_3',
                        'default' => false, // default option
                        'options' => [] // options for selects
                    ],
                    'field_name_4' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'select', // type of input
                        'option_name' => 'field_name_4',
                        'default' => false, // default option
                        'options' => [
                            'foo',
                            'bar'
                        ] // options for selects
                    ]
                ]
            ],
            'tab_two' => [
                'page_title'       => __( 'The plugin name', PN_PLUGIN_DIR ),
                'page_description' => __( 'Manage post types and taxonomies.', PN_PLUGIN_DIR ),
                'fields'           => [
                    'field_name' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'text', // type of input
                        'option_name' => 'field_name',
                        'default' => false, // default option
                        'options' => [] // options for selects
                    ],
                    'field_name_2' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'textarea', // type of input
                        'option_name' => 'field_name_2',
                        'default' => false, // default option
                        'options' => [] // options for selects
                    ],
                    'field_name_3' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'checkbox', // type of input
                        'option_name' => 'field_name_3',
                        'default' => false, // default option
                        'options' => [] // options for selects
                    ],
                    'field_name_4' => [
                        'label' => __('Label nice name', PN_PLUGIN_DIR),
                        'field_type' => 'select', // type of input
                        'option_name' => 'field_name_4',
                        'default' => false, // default option
                        'options' => [
                            'foo',
                            'bar'
                        ] // options for selects
                    ]
                ]
            ]
        ];

        // Loads plugin text domain and scripts
        add_action( 'after_setup_theme', [__CLASS__, 'pn_theme_setup'] );
        add_action( 'admin_enqueue_scripts', [__CLASS__, 'pn_scripts'] );

        // Custom action hooks

        // Ajax action hooks
    }

    static function pn_scripts()
    {
        // loads admin script
        wp_register_script( 'pn-scripts', PN_PLUGIN_DIR_URL . 'assets/js/pn_scripts.js', ['jquery'], '0.1', TRUE );
        wp_enqueue_script( 'pn-scripts' );
        // Localize scripts
        wp_localize_script( 'pn-scripts', 'pn', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
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