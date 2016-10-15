<?php
/**
 * Custom options
 */

// Register and define the settings
add_action('admin_init', 'bamboo_admin_init');
//add_action( 'admin_menu', 'bamboo_add_theme_options' );

function bamboo_admin_init(){
        register_setting(
        'general',              // settings page
        'bamboo_options',          // option name
        'bamboo_validate_options'  // validation callback
    );
}

/* theme options page */
add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
    register_setting( 'bamboo_options', 'bamboo_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
    add_theme_page( __( 'Theme Options', 'bamboo' ), __( 'Theme Options', 'bamboo' ), 'manage_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {
    global $select_options, $radio_options;

    if ( ! isset( $_REQUEST['settings-updated'] ) )
        $_REQUEST['settings-updated'] = false;

    ?>
    <div class="wrap">
        <?php screen_icon(); echo "<h2>" . __( ' Theme Options', 'bamboo' ) . "</h2>"; ?>

        <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
        <div class="updated fade"><p><strong><?php _e( 'Options saved', 'bamboo' ); ?></strong></p></div>
        <?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields( 'bamboo_options' ); ?>
            <?php $options = get_option( 'bamboo_theme_options' ); ?>

            <table class="form-table">

                <?php
                /**
                 * Google Analytics
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Google Analytics', 'bamboo' ); ?></th>
                    <td>
                        <input id="bamboo_theme_options[google_analytics]" class="regular-text" type="text" name="bamboo_theme_options[google_analytics]" value="<?php esc_attr_e( $options['google_analytics'] ); ?>" />
                        <label class="description" for="bamboo_theme_options[google_analytics]"><?php _e( 'Google Analytics ID', 'bamboo' ); ?></label>
                    </td>
                </tr>

                <?php
                /**
                 * Email
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Email', 'bamboo' ); ?></th>
                    <td>
                        <input id="bamboo_theme_options[email]" class="regular-text" type="text" name="bamboo_theme_options[email]" value="<?php esc_attr_e( $options['email'] ); ?>" />
                        <label class="description" for="bamboo_theme_options[email]"><?php _e( 'Email address', 'bamboo' ); ?></label>
                    </td>
                </tr>

                <?php
                /**
                 * Twitter
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Twitter', 'bamboo' ); ?></th>
                    <td>
                        <input id="bamboo_theme_options[twitter]" class="regular-text" type="text" name="bamboo_theme_options[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>" />
                        <label class="description" for="bamboo_theme_options[twitter]"><?php _e( 'Twitter profile URL', 'bamboo' ); ?></label>
                    </td>
                </tr>

                <?php
                /**
                 * LinkedIn
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'LinkedIn', 'bamboo' ); ?></th>
                    <td>
                        <input id="bamboo_theme_options[linkedin]" class="regular-text" type="text" name="bamboo_theme_options[linkedin]" value="<?php esc_attr_e( $options['linkedin'] ); ?>" />
                        <label class="description" for="bamboo_theme_options[linkedin]"><?php _e( 'LinkedIn profile URL', 'bamboo' ); ?></label>
                    </td>
                </tr>

                <?php
                /**
                 * Google Plus
                 */
                ?>
                <tr valign="top"><th scope="row"><?php _e( 'Google Plus', 'bamboo' ); ?></th>
                    <td>
                        <input id="bamboo_theme_options[gplus]" class="regular-text" type="text" name="bamboo_theme_options[gplus]" value="<?php esc_attr_e( $options['gplus'] ); ?>" />
                        <label class="description" for="bamboo_theme_options[gplus]"><?php _e( 'Google Plus profile URL', 'bamboo' ); ?></label>
                    </td>
                </tr>


            </table>

            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'bamboo' ); ?>" />
            </p>
        </form>
    </div>

    <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {

    //input filters
    $input['google_angoogle_analytics'] = wp_kses_post( $input['google_analytics'] );
    $input['email'] = wp_kses_post( $input['email'] );
    $input['twitter'] = wp_kses_post( $input['twitter'] );
    $input['linkedin'] = wp_kses_post( $input['linkedin'] );
    $input['gplus'] = wp_kses_post( $input['gplus'] );

    return $input;
}
