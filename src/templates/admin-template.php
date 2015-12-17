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
        if ( $_GET[ 'tab' ] == 'step_one' ) {
            $active_tab = 'step_one';
        } else {
            $active_tab = 'step_one';
        }
    }
    ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=plugin_name&tab=step_one"
           class="nav-tab <?php echo $active_tab == 'step_one' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Post types', PN_TEXT_DOMAIN ); ?></a>
        <a href="?page=plugin_name&tab=step_two"
           class="nav-tab <?php echo $active_tab == 'step_one' ? 'nav-tab-active' : ''; ?>"><?php echo __( 'Post', PN_TEXT_DOMAIN ); ?></a>
    </h2>

    <form method="post" action="options.php">
        <?php
        try {
            extract( $_GET );
            // Retrives post types
            if ( $active_tab == 'step_one' ) {
                do_action( 'any_action' );
            }
            // Retrive posts (all or single)
            elseif ( $active_tab == 'step_two' ) {
                if ( !empty( $foo ) )
                    do_action( 'another_action', $foo );
                else
                    echo __( 'Missing arguments ' . $active_tab . '.', PN_TEXT_DOMAIN );
            }
            else {
                do_action( 'get_types' );
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
