<?php
/*
Plugin Name: FB Button
Description: This FB button plugin allows you to put a Facebook icons on your page which can be linked with your facebook page.
Version: 0.1
Author: Rienk
Author URI:
License: GNU General Public License v3.0
License URI: http://www.opensource.org/licenses/gpl-license.php
NOTE: This plugin is released under the GPLv2 license. The icons used in this plugin are the property
of their respective owners, and do not, necessarily, inherit the GPLv2 license.
*/

//require_once('Assets/FB_button_admin.php');

add_action('admin_menu', 'SetupAdminPage');

function GetOptions(){
    $options = get_option('FBBtnOptions');
    return $options;
}

function SetupOptionsPage(){
    include 'Assets/FB_button_options_page.php';
}

function SetupAdminPage(){
    add_menu_page('FB Button','FB Button','manage_options', 'options_page_slug', 'SetupOptionsPage');
    wp_enqueue_style('Assets/css/font-awesome.min.css');


}
?>