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
    add_action( 'admin_menu', 'vw_showcase_menu' );

    add_filter( 'the_content', 'vw_showcase_html' );

    function vw_showcase_menu() {

        //create custom top-level menus
        add_menu_page( 'Showcase Settings Page', 'Video Showcase', 'manage_options', 'vw-showcase.php', 'vw_showcase_settings_display_page', plugins_url('vw-showcase/images/wp-logo.png'));
        
        //create submenu items
        add_submenu_page( 'vw-showcase.php', 'fastBREAK Settings', 'fastBREAK', 'manage_options', 'vw-showcase.php', 'vw_fastbreak_page' );
        add_submenu_page( 'vw-showcase.php', 'Change Media Settings', 'Change Media', 'manage_options', 'vw-changemedia-admin.php', 'vw_changemedia_page' );
    }

    function vw_showcase_html($text){
        if(get_the_title() == 'fastBREAK Showcase test'){
?>
    <div id="s_wrapper" class="clearfix">
        <div id="s_sidebar">
            <form id="s_form_subject">
            <input type="hidden" name="type" value="fb">
            <div class="s_subject_item">
            <ul id="s_menu">
            <li><label>fast<strong><em>BREAK</em></strong> 2012</label><span class="ui-icon"></span>
                <ul class="s_subjects">
                    <li>
                        <input type="radio" name="subject" value="u-turn" id="u-turn">
                        <label for="u-turn" class="subject_normal active">24 Feb : U-TURN</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="play" id="play">
                        <label for="play" class="subject_normal active">30 Mar : PLAY</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="rage" id="rage">
                        <label for="rage" class="subject_normal active">27 Apr : RAGE</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="epic" id="epic">
                        <label for="epic" class="subject_normal active">18 May : EPIC</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="stuffed" id="stuffed">
                        <label for="stuffed" class="subject_normal active">29 Jun : STUFFED</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="lies" id="lies">
                        <label for="lies" class="subject_normal active">27 Jul : LIES</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="danger" id="danger">
                        <label for="danger" class="subject_normal active">24 Aug : DANGER</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="cure" id="cure">
                        <label for="cure" class="subject_normal active">28 Sep : CURE</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="tasty" id="tasty">
                        <label for="tasty" class="subject_normal active">26 Oct : TASTY</label>
                    </li>
                    <li>
                        <input type="radio" name="subject" value="magic" id="magic">
                        <label for="magic" class="subject_normal active">30 Nov : MAGIC</label>
                    </li>
                </ul>
            </li>
        <li><label>fast<strong><em>BREAK</em></strong> 2011</label><span class="ui-icon"></span>
            <ul class="s_subjects">
            <li>
                <input type="radio" name="subject" value="back to basics" id="back to basics">
                <label for="back to basics" class="subject_normal active">25 Feb : BACK TO BASICS</label>
            </li>
            <li>
                <input type="radio" name="subject" value="what is stopping you" id="what is stopping you">
                <label for="what is stopping you" class="subject_normal active">25 Mar : WHAT'S STOPPING YOU</label>
            </li>
            <li>
                <input type="radio" name="subject" value="are we there yet" id="are we there yet">
                <label for="are we there yet" class="subject_normal active">29 Apr : ARE WE THERE YET</label>
            </li>
            <li>
                <input type="radio" name="subject" value="read much" id="read much">
                <label for="read much" class="subject_normal active">20 May : READ MUCH</label>
            </li>
            <li>
                <input type="radio" name="subject" value="what turns you on" id="what turns you on">
                <label for="what turns you on" class="subject_normal active">24 Jun : WHAT TURNS YOU ON</label>
            </li>
            <li>
                <input type="radio" name="subject" value="is old new again" id="is old new again">
                <label for="is old new again" class="subject_normal active">29 Jul : IS OLD NEW AGAIN</label>
            </li>
            <li>
                <input type="radio" name="subject" value="why do you care" id="why do you care">
                <label for="why do you care" class="subject_normal active">26 Aug : WHY DO YOU CARE</label>
            </li>
            <li>
                <input type="radio" name="subject" value="better together" id="better together">
                <label for="better together" class="subject_normal active">30 Sep : BETTER TOGETHER</label>
            </li>
            <li>
                <input type="radio" name="subject" value="what is broken" id="what is broken">
                <label for="what is broken" class="subject_normal active">28 Oct : WHAT'S BROKEN</label>
            </li>
            <li>
                <input type="radio" name="subject" value="do as you are told" id="do as you are told">
                <label for="do as you are told" class="subject_normal active">25 Nov :  DO AS YOU'RE TOLD</label>
            </li>
            </ul>
        </li>
        <li><label>fast<strong><em>BREAK</em></strong> 2010</label><span class="ui-icon"></span>
        <ul class="s_subjects">
            <li>
                <input type="radio" name="subject" value="what matters" id="what matters">
                <label for="what matters" class="subject_normal active">26 Feb : WHAT MATTERS</label>
            </li>
            <li>
                <input type="radio" name="subject" value="are you ready" id="are you ready">
                <label for="are you ready" class="subject_normal active">26 Mar : ARE YOU READY</label>
            </li>
            <li>
                <input type="radio" name="subject" value="are you alone" id="are you alone">
                <label for="are you alone" class="subject_normal active">30 Apr : ARE YOU ALONE</label>
            </li>
            <li>
                <input type="radio" name="subject" value="are you satisfied" id="are you satisfied">
                <label for="are you satisfied" class="subject_normal active">28 May : ARE YOU SATISFIED</label>
            </li>
            <li>
                <input type="radio" name="subject" value="what now" id="what now">
                <label for="what now" class="subject_normal active">25 Jun : WHAT NOW</label>
            </li>
            <li>
                <input type="radio" name="subject" value="what is your story" id="what is your story">
                <label for="what is your story" class="subject_normal active">30 Jul : WHAT'S YOUR STORY</label>
            </li>
            <li>
                <input type="radio" name="subject" value="things change" id="things change">
                <label for="things change" class="subject_normal active">27 Aug : THINGS CHANGE</label>
            </li>
            <li>
                <input type="radio" name="subject" value="power" id="power">
                <label for="power" class="subject_normal active">24 Sep : POWER</label>
            </li>
            <li>
                <input type="radio" name="subject" value="failure" id="failure">
                <label for="failure" class="subject_normal active">29 Oct : FAILURE</label>
            </li>
            <li>
                <input type="radio" name="subject" value="love" id="love">
                <label for="love" class="subject_normal active">30 Nov : LOVE</label>
            </li>
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
        </div>
        <div id="s_video_container" style="display:none">
            <div id="s_video_subject"><div id="s_vid_img"></div><div id="s_vid_sub"></div></div>
            <div class="s_video" style="left:0px;top:70px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="idea_img"></div><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:370px;top:70px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="idea_img"></div><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:0px;top:340px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="idea_img"></div><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:370px;top:340px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="idea_img"></div><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:0px;top:610px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="idea_img"></div><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div class="s_video" style="left:370px;top:610px;width:360px;height:260px;"><div class="s_speaker clearfix"><div class="idea_img"></div><div class="s_speaker_name"></div></div><div class="s_vid_content"></div></div>
            <div id="s_review"></div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="http://vibewire.org/wp-content/themes/new_vibewire_site/js/fastbreak-1.0.1.js"></script>
<?
        }else{
            return $text;
        }
    }

    function vw_showcase_settings_display_page(){
    }

    function vw_changemedia_page(){
        include("vw-changemedia-admin.php");
    }

     function vw_fastbreak_page(){
         include("vw-fastbreak-admin.php");
    }
?>