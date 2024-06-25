<?php
/**
 * Plugin Name
 *
 * @package           PluginPackage
 * @author            behzad mahmudiazar
 * @copyright         2024 behzad mahmudiazar
 *
 * @wordpress-plugin
 * Plugin Name:       ارتباط با ما
 * Description:       با استفاده از این ماژول می توانید با مشتریان خود در ارتباط باشید
 * Version:           1.0.0
 * Requires PHP:      8.0
 * Author:             بهزاد محمودی آذر
 */



// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}



define("SHNO_CONFIG", plugin_dir_path(__FILE__) . "lib/config.php");
require_once (SHNO_CONFIG);
require_once (plugin_dir_path(__FILE__) . "admin/admin.php");
require_once (plugin_dir_path(__FILE__) . "public/ShnoPublic.php");

$shno_config = new config();
$shno_config->Check(__FILE__);
$shno_config->setRoute();




if (is_admin()) {
    $shno_Admin = new admin();
    $shno_Admin->load();
}


add_shortcode('SHNOPUBLIC', 'shno_load');
function shno_load($atts = [], $content = null)
{
    if (!is_admin()) {
        $shno_public = new ShnoPublic();
        $shno_public->load();
    }
}

























































