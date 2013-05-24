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
    add_action( 'wp_enqueue_scripts', 'showcase_fb_enqueue' );
    add_filter( 'the_content', 'wp_vw_fastbreak' );
  
    function showcase_admin_init(){
        $absolute = plugins_url('',__FILE__);
        // Register jquery-ui script
        wp_register_script( 'jquery-ui-script', $absolute.'/js/jquery-ui-1.10.3.custom.min.js');
        // Register jquery-ui style sheet
        wp_register_style( 'jquery-ui-style', $absolute.'/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
    }

    function vw_showcase_menu() {

        //create custom top-level menus
        add_menu_page( 'Showcase Settings Page', 'Video Showcase', 'manage_options', 'vw-showcase.php', 'vw_showcase_settings_display_page', plugins_url('vw-showcase/images/wp-logo.png'));
        
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

    function showcase_fb_enqueue(){
        if(get_the_title() === 'fastBREAK Showcase Test'){ 
            $absolute = plugins_url('',__FILE__);
            wp_enqueue_script('jquery');
            wp_register_style( 'fastbreak-style', $absolute.'/css/showcase-1.0.1.css');
            wp_enqueue_style( 'fastbreak-style' );
            wp_register_script( 'fastbreak-script', $absolute.'/js/fastbreak-1.0.2.js');
            wp_enqueue_script( 'fastbreak-script' );
        }
    }

    function wp_vw_changemedia($text){
         if(get_the_title() === 'Change Media Showcase Test'){
           // TODO
        }
    }

    function wp_vw_fastbreak($text){
        if(get_the_title() === 'fastBREAK Showcase Test'){
            global $wpdb;
            $tablename = $wpdb->prefix."showcase_fb";
            $sql =
            "SELECT `topic`,`presented_date` FROM `$tablename` ORDER BY `presented_date` DESC";
            $data = $wpdb->get_results($sql,ARRAY_A);
            $year = "";
    ?>
    <div id="s_wrapper" class="clearfix">
        <div id="s_sidebar">
            <form id="s_form_subject">
            <input type="hidden" name="type" value="fb">
            <div class="s_subject_item">
            <ul id="s_menu">
    <?php
            foreach ($data as $index => $theme) {
                $name = $theme['topic'];
                if($year != substr($theme['presented_date'], 0,4)){
                    if($year != ""){
                        echo "</ul></li>";
                    }
                    $year = substr($theme['presented_date'], 0,4);
    ?>               
                     <li><label>fast<strong><em>BREAK</em></strong> <?php echo $year;?></label><span class="ui-icon"></span>          
                     <ul class="s_subjects">
    <?php    
                }
    ?>
                <li>
                    <input id="<?php echo $name; ?>" type="radio" class="active" name="subject" value="<?php echo $name; ?>" />
                    <label class="subject_normal active" for="<?php echo $name; ?>"><?php echo substr(date("d F Y",strtotime($theme['presented_date'])), 0,6);?> : <?php echo strtoupper($name); ?></label>
                </li>
    <?php

            }
    ?>  
        </ul>
        </li>
        </ul>
        </div>
        </form>
    </div>
    <div id="s_video_area">
    <div id="welcome" style="left:730px;top:0px;width:700px;height:400px">
        <h1>Welcome to fastBREAK showcase!</h1>
        <p><em>Produced by</em> Vibewire and the Powerhouse Museum</p>
        <p>fast<strong><em>BREAK</strong></em> is a power breakfast of insights, innovation and inspiration - it’s food for thought.</p>
        <p>Since launching in 2010, the fast<strong><em>BREAK</strong></em> innovation series has sent a buzz through local creative and entrepreneurial communities, injecting life, inspiration and a flurry of fast<strong><em>BREAK</strong></em>ing conversation into the Powerhouse Museum. At each monthly fast<strong><em>BREAK</strong></em> session five sharp young industry leaders from various sectors tackle big questions and topics with five-minute responses around themes of creativity, commercialisation, collaboration, connections and conversation. Innovation is the staple of the fast<strong><em>BREAK</strong></em> menu.</p>
        <p>The fast<strong><em>BREAK</strong></em> program showcases a diverse range of fresh perspectives from within the creative industries, including technology, design, media, science and education. Following the five back-to-back talks, participants are invited to share ideas over a delicious breakfast by Black Star Pastry, Newtown.</p>
        <p>With a focus on intergenerational exchange and dialogue, fast<strong><em>BREAK</strong></em> is a unique opportunity for conversations outside the ordinary - an opportunity for emerging young masterminds from a range of disciplines to be heard at to brush shoulders with decision-makers from corporate and non-profit organisations. </p>

    <div id="sponser_logo">
    <div id="spon_title">Sponsored By: </div>
        <ul>
            <li>
            <a href="http://thefetch.com/" target="_blank"><img src="http://vibewire.org/wp-content/uploads/2013/05/theFetch_logo_v.2.0.png" width=50 height=50></a>
            </li>
            <li>
            <a href="http://www.powerhousemuseum.com/" target="_blank"><img src="http://vibewire.org/wp-content/uploads/2013/05/powerhouse_musem_logo_v.3.01.png" width=160 height=45></a>
            </li>
            <li>
            <a href="http://blackstarpastry.com.au/" target="_blank"><img src="http://vibewire.org/wp-content/uploads/2013/05/blackstar_v.2.png" width=60 height=45></a>
            </li>
            <li>
            <a href="http://www.2ser.com/" target="_blank"><img src="http://vibewire.org/wp-content/uploads/2013/05/logo2.png" width=160 height=50></a>
            </li>
            <li>
            <a href="http://www.sdpublishing.com.au/" target="_blank"><img src="http://vibewire.org/wp-content/uploads/2013/05/sdp-logo.png" width=90 height=45></a>
            </li>
        </ul>
    </div>
    </div>
    <div id="s_video_container" style="display:none">
            <div id="s_video_subject"><div id="s_vid_sub"></div></div>
            <div class="s_video" style="left:0px;top:70px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:370px;top:70px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:0px;top:340px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:370px;top:340px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:0px;top:610px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:370px;top:610px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div id="s_review"></div>
    </div>
    </div>
    <?php
        }else{
            return $text;
        }
    }

?>