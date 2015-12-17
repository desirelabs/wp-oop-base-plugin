<?php
/**
 * @author : Franck LEBAS
 * @package: plugin-name
 */
?>
<div class="container">

    <div id="icon-themes" class="icon32"></div>
    <h2><?php __( 'Whatever title you want', PN_TEXT_DOMAIN ); ?></h2>
    <?php settings_errors(); ?>

    <?php
    /**
     * Set the current requested active tab
     */
    if ( !empty( $_GET[ 'tab' ] ) ) {
        if ( $_GET[ 'tab' ] == 'tab_one' ) {
            $active_tab = 'tab_one';
        } else {
            $active_tab = 'tab_one';
        }
    }
    else {
        $active_tab = 'tab_one';
    }
    ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=plugin_name&tab=tab_one"
           class="nav-tab <?php echo $active_tab == 'tab_one' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Tab 1', PN_TEXT_DOMAIN ); ?></a>
        <a href="?page=plugin_name&tab=tab_two"
           class="nav-tab <?php echo $active_tab == 'tab_one' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Tab 2', PN_TEXT_DOMAIN ); ?></a>
    </h2>

    <form method="post" action="options.php">
        <?php
        try {
            extract( $_GET );
            // Retrives post types
            if ( $active_tab == 'tab_one' ) {
                settings_fields('pn_option_page_tab_one');
                do_settings_sections('pn_option_page_tab_one');
            }
            else {
                settings_fields('pn_option_page_tab_one');
                do_settings_sections('pn_option_page_tab_one');
            }
        }
        catch ( Exception $e ) {
            throw new Exception("Error Processing Request", $e->getMessage());            
        }
        ?>
        <p class="submit">
            <?php submit_button( NULL, 'primary', 'submit', FALSE ); ?>
            <?php submit_button( __('Delete options', PN_TEXT_DOMAIN), 'delete', 'delete', FALSE ); ?>
        </p>
    </form>
</div>
