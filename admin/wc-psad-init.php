<?php

/**
 * Register Activation Hook
 */
update_option('wc_psad_plugin', 'wc_psad');
function wc_psad_install()
{
    global $wpdb;

    // Set Settings Default from Admin Init
    global $wc_psad_admin_init;
    $wc_psad_admin_init->set_default_settings();

    // Build sass
    global $wc_psad_less;
    $wc_psad_less->plugin_build_sass();

    WC_PSAD_Functions::auto_create_order_keys_all_products();
    update_option('wc_psad_lite_version', '1.2.1');
    update_option('wc_psad_plugin', 'wc_psad');
    delete_transient("wc_psad_update_info");
    delete_metadata( 'user', 0, $wc_psad_admin_init->plugin_name . '-' . 'psad_plugin_framework_box' . '-' . 'opened', '', true );

    // Remove house keeping option of another version
    delete_option('psad_clean_on_deletion');

    update_option('wc_psad_just_installed', true);
}

function psad_init()
{
    if (get_option('wc_psad_just_installed')) {
        delete_option('wc_psad_just_installed');
        wp_redirect(admin_url('admin.php?page=wc-sort-display', 'relative'));
        exit;
    }
    load_plugin_textdomain('wc_psad', false, WC_PSAD_FOLDER . '/languages');
}

// Add language
add_action('init', 'psad_init');

// Add custom style to dashboard
add_action('admin_enqueue_scripts', array('WC_PSAD_Settings_Hook', 'a3_wp_admin'));

// Add text on right of Visit the plugin on Plugin manager page
add_filter('plugin_row_meta', array('WC_PSAD_Settings_Hook', 'plugin_extra_links'), 10, 2);

// Need to call Admin Init to show Admin UI
global $wc_psad_admin_init;
$wc_psad_admin_init->init();

// Add upgrade notice to Dashboard pages
add_filter($wc_psad_admin_init->plugin_name . '_plugin_extension_boxes', array('WC_PSAD_Settings_Hook', 'plugin_extension_box'));

$wc_psad_setting_hook = new WC_PSAD_Settings_Hook();

// Update Onsale order and Featured order value
add_action('save_post', array('WC_PSAD_Functions', 'update_orders_value'), 101, 2);

// Check upgrade functions
add_action('plugins_loaded', 'psad_upgrade_plugin');
function psad_upgrade_plugin()
{
    if (version_compare(get_option('wc_psad_lite_version'), '1.0.2') === -1) {
        update_option('wc_psad_lite_version', '1.0.2');
        WC_PSAD_Functions::upgrade_version_1_0_2();
    }

    if (version_compare(get_option('wc_psad_lite_version'), '1.1.0') === -1) {
        update_option('wc_psad_lite_version', '1.1.0');

        // Build sass
        global $wc_psad_less;
        $wc_psad_less->plugin_build_sass();
    }

    update_option('wc_psad_lite_version', '1.2.1');
}
?>
