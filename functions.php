<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

# DEVELOPMENT OPTIONS :: START

# REQUIRED
require_once(get_template_directory() . '/gsdh/classes/class.tgm.php');
require_once(get_template_directory() . '/gsdh/classes/class.check.php');
require_once(get_template_directory() . '/gsdh/classes/class.menu.walker.php');
require_once(get_template_directory() . '/gsdh/classes/class.backend.php');
require_once(get_template_directory() . '/gsdh/classes/class.frontend.php');
require_once(get_template_directory() . '/gsdh/classes/class.ajax.php');
require_once(get_template_directory() . '/gsdh/classes/class.content.php');
require_once(get_template_directory() . '/gsdh/classes/class.shortcodes.php');
require_once(get_template_directory() . '/gsdh/classes/class.box.php');
require_once(get_template_directory() . '/gsdh/classes/class.types.php');

if ( defined( 'WPB_VC_VERSION' ) ) {
    require_once(get_template_directory() . '/gsdh/classes/class.composer.php');
}

# INSTANTIATE
$gsdh_backend = new gsdh_backend();
$gsdh_frontend = new gsdh_frontend();
$gsdh_ajax = new gsdh_ajax($gsdh_backend, $gsdh_frontend);
$gsdh_shortcodes = new gsdh_shortcodes();

$gsdh_box = new \GSDH\gsdh_box();
$gsdh_types = new \GSDH\gsdh_types();

# ADMIN SCRIPTS
function gsdh_add_admin_scripts(){

    # GET CURRENT SCREEN
    $screen = get_current_screen();

    # ADD ADMIN STYLES
    if(is_admin()){

        # CSS
        //wp_enqueue_style( 'gsdh-styles', get_template_directory_uri().'/dist/styles/admin.css' );

    }

}

# ADMIN ACTION
add_action( 'admin_enqueue_scripts', 'gsdh_add_admin_scripts' );

# TGM FUNCTION
function gsdh_register_required_plugins() {
    $plugins = array(
        array(
            'name'               => esc_html__('Visual Composer', 'gsdh'), // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/gsdh/plugins/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '5.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
        array(
            'name'               => esc_html__('Meta-Box', 'gsdh'), // The plugin name.
            'slug'               => 'meta-box', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/gsdh/plugins/meta-box.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '4.12.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
    );
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
}

# TGM ACTION
add_action( 'tgmpa_register', 'gsdh_register_required_plugins' );

#DASHICONS
function load_dashicons_front_end() {
    wp_enqueue_style( 'dashicons' );
}

# ICONS ACTION
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );

# DEVELOPMENT OPTIONS :: END