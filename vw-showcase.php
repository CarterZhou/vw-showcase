<?php
/*
Plugin Name: Video Showcase for Vibewire
Plugin URI: 
Description: This is the video showcase plug-in for vibewire.org
Version: 1.0
Author: Hao Zhou
Author URI: 
License: GPLv2
*/
?>
<?php
    add_action( 'admin_init', 'showcase_admin_init' );
    add_action( 'admin_menu', 'vw_showcase_menu' );
    add_filter( 'the_content', 'vw_showcase_html' );

    function showcase_admin_init(){
        $absolute = plugins_url('',__FILE__);
        // Register jquery-ui script
        wp_register_script( 'jquery-ui-script', $absolute.'/js/jquery-ui-1.10.3.custom.min.js');
        // Register jquery-ui style sheet
        wp_register_style( 'jquery-ui-style', $absolute.'/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
    }

    function vw_showcase_menu() {

        //create custom top-level menus
        add_menu_page( 'Showcase Settings Page', 'Video Showcase', 'manage_options', 'vw-showcase.php', 'vw_showcase_settings_display_page', plugins_url('vw-showcase/images/wp-logo.png'),81);
        
        //create submenu items
        $page_hook_fastbreak = add_submenu_page( 'vw-showcase.php', 'fastBREAK Settings', 'fastBREAK', 'manage_options', 'vw-showcase.php', 'vw_fastbreak_page' );
        $page_hook_changemedia =add_submenu_page( 'vw-showcase.php', 'Change Media Settings', 'Change Media', 'manage_options', 'vw-changemedia-admin.php', 'vw_changemedia_page' );

        // Hook jquery-ui script to admin screens
        add_action( 'admin_print_scripts-'.$page_hook_fastbreak,'showcase_admin_scripts' );
        add_action( 'admin_print_scripts-'.$page_hook_changemedia,'showcase_admin_scripts' );
        // Hook jquery-ui style sheet to admin screens
        add_action( 'admin_print_styles-' . $page_hook_fastbreak, 'showcase_admin_styles' );
        add_action( 'admin_print_styles-' . $page_hook_changemedia, 'showcase_admin_styles' );
    }

    function showcase_admin_scripts(){
        //Link jquery-ui script to a page
        wp_enqueue_script('jquery-ui-script');
    }

     function showcase_admin_styles(){
        //Link jquery-ui style sheet to a page
        wp_enqueue_style( 'jquery-ui-style' );
    }

    function vw_showcase_settings_display_page(){
    }

    function vw_changemedia_page(){
        include("vw-changemedia-admin.php");
    }

     function vw_fastbreak_page(){
         include("vw-fastbreak-admin.php");
    }

    /* Build front-end pages*/ 
    function vw_showcase_html($text){
        if(get_the_title() == 'fastBREAK Showcase Test'){
          
        }else{
            return $text;
        }
    }

?>