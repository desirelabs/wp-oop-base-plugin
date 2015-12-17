<?php

/**
 * @Author: Franck LEBAS
 * @package: plugin-name
 */
class PnOptions
{
    public $options;

    public function __construct()
    {
        add_action('admin_menu', array(&$this, 'pn_add_admin_page'));
        add_action('admin_init', array(&$this, 'pn_settings_init'));
    }

    public function pn_add_admin_page()
    {
        add_menu_page(
            'Plugin Nice Name',
            'Plugin Nice Name',
            'manage_options',
            'plugin_name',
            array(&$this, 'plugin_name_options_page')
        );
    }

    /**
     * Initiate options from options array
     */
    public function pn_settings_init()
    {
        $this->options = Pn::getOptions();

        /**
         * TODO set default values
         * $options = get_option('pn_settings');
         * */
        foreach ( $this->options as $step => $props ) {
            register_setting('pn_option_page_'.$step, 'pn_settings');
            add_settings_section(
                strtolower( str_replace( ' ', '_', $props['page_title'] ) ),
                $props['page_description'],
                $this->pn_settings_section_callback(),
                'pn_option_page_'.$step
            );

            /**
             * Use options array to build PN options
             */
            foreach( $props['fields'] as $key => $value ) {

                /**
                 * TODO set default values
                 * if ( !isset( $options[$value['option_name']] ) )
                 * add_option( $value['option_name'], $value['default']);
                 * */
                add_settings_field(
                    $key,
                    $value['label'],
                    array(&$this, 'pn_'.$value['field_type'].'_field_render'), // returns the right filed rendering callback (checkbox, text...)
                    'pn_option_page_'.$step,
                    strtolower( str_replace( ' ', '_', $props['page_title'] ) ),
                    array(
                        'option_name' => $value['option_name'],
                        'options' => $value['options']
                    )
                );
            }
        }
    }

    /**
     * Render checkbox field
     * @param $args
     * @return checkbox field
     */
    public function pn_checkbox_field_render($args)
    {
        $options = get_option('pn_settings');
        ?>
        <input type='checkbox'
               name='pn_settings[<?php echo $args['option_name'] ?>]' <?php echo isset($options[$args['option_name']]) ? checked($options[$args['option_name']], 1) : "" ?>
               value='1'>
        <?php
    }

    /**
     * Render text field
     * @param $args
     * @return text field
     */
    public function pn_text_field_render($args)
    {
        $options = get_option('pn_settings');
        ?>
        <input type='text' name='pn_settings[<?php echo $args['option_name'] ?>]'
               value='<?php echo isset($options[$args['option_name']]) ? $options[$args['option_name']] : ""; ?>'>
        <?php
    }

    /**
     * Render textarea field
     * @param $args
     * @return textarea field
     */
    public function pn_textarea_field_render($args)
    {
        $options = get_option('pn_settings');
        ?>
        <textarea name='pn_settings[<?php echo $args['option_name'] ?>]' value=''>
            <?php echo isset($options[$args['option_name']]) ? $options[$args['option_name']] : ""; ?>
        </textarea>
        <?php
    }

    /**
     * Render select field
     * @param $args
     * @return select field
     */
    public function pn_select_field_render($args)
    {
        $options = get_option('pn_settings');
        ?>
        <select name='pn_settings[<?php echo $args['option_name'] ?>]'>
            <?php foreach ( $args['options'] as $key => $val ): ?>
                <option <?php selected($options[$args['option_name']], $val, 1); ?> value="<?php echo $val; ?>"><?php echo $val ?></option>
            <?php endforeach; ?>>
        </select>
        <?php
    }

    /**
     * TODO section message handeling
     */
    public function pn_settings_section_callback()
    {
        __('This section description', PN_TEXT_DOMAIN);
    }


    public function plugin_name_options_page()
    {
        include_once('templates/admin-template.php');
    }
}