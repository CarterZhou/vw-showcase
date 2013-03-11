<?php
/*
Plugin Name: Video Showcase 4 Vibewire
Plugin URI: 
Description: This is the video showcase plug-in for vibewire.org
Version: 1.0
Author: Hao Zhou
Author URI: 
License: GPLv2
*/

/*  Copyright 2013  Hao Zhou  (email : zhou.hao.0112@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
    add_action( 'admin_menu', 'vw_showcase_menu' );
    function vw_showcase_menu() {

        //create custom top-level menu
        add_menu_page( 'Showcase Settings Page', 'Video Showcase', 'manage_options', __FILE__, 'vw_showcase_settings_display_page', plugins_url('vw-showcase/images/wp-logo.png'));
        
        //create submenu items
        add_submenu_page( __FILE__, 'Change Media Settings', 'Change Media', 'manage_options', __FILE__.'_changemedia', 'vw_changemedia_page' );
        add_submenu_page( __FILE__, 'fastBREAK Settings', 'fastBREAK', 'manage_options', __FILE__.'_fastBREAK', 'vw_fastbreak_page' );
    }

    function vw_showcase_settings_display_page(){
    }

    function vw_changemedia_page(){
    }

     function vw_fastbreak_page(){
    }
?>