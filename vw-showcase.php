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
    add_action( 'admin_menu', 'admin_vw_showcase_menu' );
    add_action( 'wp_enqueue_scripts', 'wp_fastbreak_enqueue' );
    add_action( 'wp_enqueue_scripts', 'wp_changemedia_enqueue' );
    // Handle Ajax calls from fastbreak showcase page
    add_action('wp_ajax_nopriv_fastbreak_speakers','fastbreak_speakers');
    add_action('wp_ajax_fastbreak_speakers','fastbreak_speakers');
    add_action('wp_ajax_nopriv_fastbreak_info','fastbreak_info');
    add_action('wp_ajax_fastbreak_info','fastbreak_info');
    // Handle Ajax calls from fastbreak showcase admin page
    add_action('wp_ajax_fastbreak_delete','fastbreak_delete');

    // Handle Ajax calls from change media showcase page
    add_action('wp_ajax_nopriv_changemedia_videos','changemedia_videos');
    add_action('wp_ajax_changemedia_videos','changemedia_videos');

    add_filter( 'the_content', 'wp_vw_fastbreak' );
    add_filter( 'the_content', 'wp_vw_changemedia' );

    function showcase_admin_init(){
        $plugin_url = plugins_url('',__FILE__);
        // Register jquery-ui script
        wp_register_script( 'jquery-ui-script', $plugin_url.'/js/jquery-ui-1.10.3.custom.min.js');
        wp_register_script( 'fastbreak-admin-script', $plugin_url.'/js/admin/fastbreak-admin.js');
        wp_localize_script( 'fastbreak-admin-script', 'plugin_object',array('plugin_url' => plugins_url('',__FILE__)));
        // Register jquery-ui style sheet
        wp_register_style( 'jquery-ui-style', $plugin_url.'/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
        wp_register_style('custom-ui-style',$plugin_url.'/css/custom.css');
    }

    function admin_vw_showcase_menu() {

        //create custom top-level menus
        add_menu_page( 'Showcase Settings Page', 'Video Showcase', 'manage_showcase', 'vw-showcase.php', 'vw_showcase_settings_display_page', plugins_url('vw-showcase/images/wp-logo.png'));
        
        //create submenu items
        $page_hook_fastbreak_add = add_submenu_page( 'vw-showcase.php', 'fastBREAK-Add/Update', 'fastBREAK - Add/Update', 'manage_showcase', 'vw-fastbreak-admin.php', 'vw_fastbreak_admin_add' );
        $page_hook_fastbreak_list = add_submenu_page( 'vw-showcase.php', 'fastBREAK-List', 'fastBREAK - List', 'manage_showcase', 'vw-fastbreak-list-admin.php', 'vw_fastbreak_admin_list' );
        $page_hook_changemedia_add =add_submenu_page( 'vw-showcase.php', 'Change Media-Add/Update', 'Change Media - Add/Update', 'manage_showcase', 'vw-changemedia-admin.php', 'vw_changemedia_admin' );

        // Hook jquery-ui script to admin screens
        add_action( 'admin_print_scripts-'.$page_hook_fastbreak_add,'showcase_admin_scripts' );
        add_action( 'admin_print_scripts-'.$page_hook_changemedia_add,'showcase_admin_scripts' );
        // Hook jquery-ui style sheet to admin screens
        add_action( 'admin_print_styles-' . $page_hook_fastbreak_add, 'showcase_admin_styles' );
        add_action( 'admin_print_styles-' . $page_hook_changemedia_add, 'showcase_admin_styles' );
        add_action( 'admin_print_styles-' . $page_hook_fastbreak_list, 'showcase_admin_styles' );
        
    }

    function showcase_admin_scripts(){
        //Link jquery-ui script to a page
        wp_enqueue_script('jquery-ui-script');
        wp_enqueue_script('jquery-ui-draggable');
        //Link fastbreak admin script to a page
        wp_enqueue_script('fastbreak-admin-script');
    }

     function showcase_admin_styles(){
        //Link jquery-ui style sheet to a page
        wp_enqueue_style( 'jquery-ui-style' );
        wp_enqueue_style( 'custom-ui-style' );
        wp_enqueue_style( 'colors-fresh' );
    }

    function vw_showcase_settings_display_page(){
    ?>
    <div class="wrap">
        <div id="icon-plugins" class="icon32"></div><h2><?php _e("fastBREAK/Change Media Showcase Editor" ); ?></h2>
        <span><h3><?php  _e('Edit fastBREAK Showcase :');?></h3></span>
        <span>
            <a class='button-primary' href='<?php echo admin_url('admin.php')."?page=vw-fastbreak-admin.php"; ?>' title='Add an Event'>Add an Event</a>
            <a class='button-primary' href='<?php echo admin_url('admin.php')."?page=vw-fastbreak-list-admin.php"; ?>' title='Update Existing Events'>Update Existing Events</a>
        </span>
         <span><h3><?php  _e('Edit Change Media Showcase :');?></h3></span>
        <span>
            <a class='button-primary' href='<?php echo admin_url('admin.php')."?page=vw-changemedia-admin.php"; ?>' title='Add a Video'>Add a Video</a>
            <a class='button-primary' href='#' title='Update Existing Videos'>Update Existing Videos</a>
        </span>
    </div>
    <?php

    }

    function vw_changemedia_admin(){
        include("vw-changemedia-admin.php");
    }

    function vw_fastbreak_admin_add(){
        include("vw-fastbreak-admin.php");
    }

    function vw_fastbreak_admin_list(){
        include("vw-fastbreak-list-admin.php");
    }

    function fastbreak_delete(){
        require_once(dirname(__FILE__).'/inc/showcase-manager.class.php');
        $manager = new ShowcaseManager();
        $data = array();
        $data['affected'] = $manager->fastbreak_delete_speaker();
        echo json_encode($data);
        die();
    }

     // Get information of a particular theme
    function fastbreak_info(){
        global $wpdb;
        $t_fb = $wpdb->prefix."showcase_fb";
        $t_fb_speakers = $wpdb->prefix."showcase_fb_speakers";
        $id = intval($_POST['theme_id']);
        $info = array();

        $sql = "SELECT `speaker`,`review_link`,`topic`,`intro`,`presented_date`
                FROM `$t_fb`,`$t_fb_speakers`
                WHERE $t_fb.topic_id = $t_fb_speakers.topic_id AND $t_fb.topic_id=$id"; 

        $results = $wpdb->get_results($sql,ARRAY_A);
        if($wpdb->num_rows){
            $info['topic'] = $results[0]['topic'];
            $info['review_link'] = $results[0]['review_link'];
            $info['intro'] = $results[0]['intro'];
            $info['presented_date'] = $results[0]['presented_date'];
            foreach ($results as $index => $value) {
                $info['speakers'][$index] = $results[$index]['speaker'];
            }
        }

        echo json_encode($info);
        die();
    }

    // Get all speakers and associated Youtube links of a particular theme
    function fastbreak_speakers(){
        global $wpdb;
        $t_fb = $wpdb->prefix."showcase_fb";
        $t_fb_speakers = $wpdb->prefix."showcase_fb_speakers";
        $id = intval($_POST['theme_id']);
        $data = array();

        $sql = "SELECT `speaker`,`youtube_link`,`review_link`
                FROM `$t_fb`,`$t_fb_speakers`
                WHERE $t_fb.topic_id = $t_fb_speakers.topic_id AND $t_fb.topic_id=$id"; 

        $results = $wpdb->get_results($sql,ARRAY_A);
        if($wpdb->num_rows){
            $data['review_link'] = $results[0]['review_link'];
            foreach ($results as $index => $value) {
                $data['urls'][$index] = $results[$index]['youtube_link'];
                $data['speakers'][$index] = $results[$index]['speaker'];
            }
        }

        echo json_encode($data);
        die();
    }

    // Get all video links of a particular topic
    function changemedia_videos(){
        global $wpdb;
        $t_fb = $wpdb->prefix."showcase_cm";
        $t_fb_videos = $wpdb->prefix."showcase_cm_videos";
        $id = intval($_POST['topic_id']);
        $videos = array();

        $sql = "SELECT `thumbnail`,`intro`,`youtube_link`
                FROM `$t_fb`,`$t_fb_videos`
                WHERE $t_fb.topic_id = $t_fb_videos.topic_id AND $t_fb.topic_id=$id"; 

        $results = $wpdb->get_results($sql,ARRAY_A);
        if($wpdb->num_rows){
            foreach ($results as $index => $value) {
                $videos['thumbnails'][$index] = $results[$index]['thumbnail'];
                $videos['urls'][$index] = $results[$index]['youtube_link'];
                $videos['intros'][$index] = $results[$index]['intro'];
            }
        }

        echo json_encode($videos);
        die();
    }

    function wp_fastbreak_enqueue(){
        if(get_the_title() === 'fastBREAK Showcase'){ 
            $plugin_url = plugins_url('',__FILE__);
            // Register css file
            wp_register_style( 'fastbreak-style', $plugin_url.'/css/showcase-1.0.2.css');
            wp_enqueue_style( 'fastbreak-style' );
            // Register javascript file
            wp_register_script( 'fastbreak-script', $plugin_url.'/js/fastbreak-1.0.3.js',array('jquery'),'1.0.3',true);
            // For fastbreak-1.0.2.js,
            // set a javascript object which contains ajax call url
            wp_localize_script( 'fastbreak-script', 'ajax_object',array('ajax_url' => admin_url('admin-ajax.php')));
            wp_enqueue_script( 'fastbreak-script');
        }
    }

    function wp_changemedia_enqueue(){
        if(get_the_title() === 'Change Media Showcase'){ 
            $plugin_url = plugins_url('',__FILE__);
            // Register css file
            wp_register_style( 'changemedia-style', $plugin_url.'/css/showcase-1.0.2.css');
            wp_enqueue_style( 'changemedia-style' );
            // Register javascript file
            wp_register_script( 'changemedia-script', $plugin_url.'/js/changemedia-1.0.3.js',array('jquery'),'1.0.3',true);
            // For changemedia-1.0.2.js,
            // set a javascript object which contains ajax call url
            wp_localize_script( 'changemedia-script', 'ajax_object',array('ajax_url' => admin_url('admin-ajax.php')));
            wp_enqueue_script( 'changemedia-script');
        }
    }



    /* Build front end pages*/
    function wp_vw_changemedia($text){
         if(get_the_title() === 'Change Media Showcase'){
            global $wpdb;
            $tablename = $wpdb->prefix."showcase_cm";
            $sql =
            "SELECT `topic_id`,`name` FROM `$tablename`";
            $results = $wpdb->get_results($sql,ARRAY_A);
    ?>
        <div id="s_wrapper" class="clearfix">
        <div id="s_cm_sidebar">
        <div class="s_subject_item">
        <ul id="s_menu">
        <li><label>Change Media</label>
            <ul class="s_subjects">
    <?php
            foreach ($results as $index => $topic) {
               $name = $topic['name'];
               $id=$topic['topic_id'];
    ?>
        <li>
            <input type="radio" name="topic" value="<?php echo $id; ?>" id="<?php echo $name;?>">
            <label for="<?php echo $name;s ?>" class="subject_normal active"><?php echo $name; ?></label>
        </li>
    <?php
            }
    ?>
            </ul>
        </li>
        </ul>
    </div>
    </div>
    <div id="s_cm_video_area">
    <div id="welcome" style="left:730px;top:0px;width:680px;height:400px">
    <h1>Welcome to Change Media Showcase!</h1>
    <p>Vibewire exists to ensure that all young people are able to have their voices heard and to provide a platform for young people to participate in the BIG conversations. Each month, we'll be delving into these discussions in our ‘Conversations that Matter’ video series.</p>
    <p>Vibewire’s team of Video Journalists will hit the streets to find out:  Why is the issue important?  What is being done? Who does the issue impact? And, most importantly, what do YOU think?</p>
    <p>Check out our past videos!</p>
    <p>Want us to tell your story? Email <a href="mailto:editor@vibewire.org">editor@vibewire.org</a></p>
    </div>
    <div id="s_video_container">
    <div id="s_video_subject"><div id="s_vid_sub"></div></div>
    <div id="s_cm_video"></div>
    </div>
    </div>
    </div>
    <?php
        }else{
            return $text;
        }
    }

    function wp_vw_fastbreak($text){
        if(get_the_title() === 'fastBREAK Showcase'){
            global $wpdb;
            $tablename = $wpdb->prefix."showcase_fb";
            $sql =
            "SELECT `topic_id`,`topic`,`presented_date` FROM `$tablename` ORDER BY `presented_date` DESC";
            $results = $wpdb->get_results($sql,ARRAY_A);
            $year = "";
    ?>
    <div id="s_wrapper" class="clearfix">
        <div id="s_sidebar">
            <div class="s_subject_item">
            <ul id="s_menu">
    <?php
            foreach ($results as $index => $theme) {
                $name = $theme['topic'];
                $id = $theme['topic_id'];
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
                    <input id="<?php echo $name; ?>" type="radio" class="active" name="theme_id" value="<?php echo $id; ?>" />
                    <label class="subject_normal active" for="<?php echo $name; ?>"><?php echo substr(date("d F Y",strtotime($theme['presented_date'])), 0,6);?> : <?php echo strtoupper($name); ?></label>
                </li>
    <?php

            }
    ?>  
        </ul>
        </li>
        </ul>
        </div>
    </div>
    <div id="s_video_area">
    <div id="welcome" style="left:730px;top:0px;width:700px;height:400px">
        <h1>Welcome to fastBREAK showcase!</h1>
        <p><em>Produced by</em> Vibewire and the Powerhouse Museum</p>
        <p>fast<strong><em>BREAK</strong></em> is a power breakfast of insights, innovation and inspiration - it’s food for thought.</p>
        <p>Since launching in 2010, the fast<strong><em>BREAK</strong></em> innovation series has sent a buzz through local creative and entrepreneurial communities, injecting life, inspiration and a flurry of fast<strong><em>BREAK</strong></em>ing conversation into the Powerhouse Museum. At each month fast<strong><em>BREAK</strong></em> session five sharp young industry leaders from various sectors tackle big questions and topics with five-minute responses around themes of creativity, commercialisation, collaboration, connections and conversation. Innovation is the staple of the fast<strong><em>BREAK</strong></em> menu.</p>
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