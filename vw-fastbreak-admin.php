<?php 
    if(isset($_POST) && !empty($_POST)){
        wp_redirect(plugins_url('',__FILE__).'/success.php?url='.$_SERVER['REQUEST_URI']);
        die();
    }
?>
<div class="wrap">  
    <h2><?php _e( 'fastBREAK Event Info'); ?></h2>
    <h3><?php _e( 'General Information'); ?></h3>
    <form id="vw_fb_form" method="post" action="<?php echo admin_url('admin.php?page=vw-fastbreak-admin.php&noheader=true'); ?>">  
         <div>
            <span class="required">* </span><?php _e("Theme: " ); ?><input type="text" id="vw_fb_theme" name="vw_fb_theme" value="" size="20"><?php _e(" example: YOUTH" ); ?>
        </div> 
        <div>
            <span class="required">* </span><?php _e("Presented Date: " ); ?><input type="text" placeholder="event date" id="vw_fb_date" name="vw_fb_date" value="" size="20"><?php _e(" example: 2012-12-22" ); ?>
        </div>  
        <div>
            <span class="required">* </span><?php _e("Textual Review Link: " ); ?><input placeholder="http://" type="text" id="vw_fb_review" name="vw_fb_review" value="" size="50"><?php _e(" example: http://vibewire.org/2012/07/fastbreak-lies-review/" ); ?> 
        </div>
        <p><?php _e("Intro: " ); ?></p>
        <div>
            <textarea name="vw_fb_intro" id="vw_fb_intro" cols="100" rows="5" placeholder="Type the introduction of theme here..."></textarea>
        </div>
        <hr>
        <span class="required">* </span><h3 style="display:inline"><?php _e( 'Speakers Information'); ?></h3>
        <div id="speakers">
            <div>
                <?php _e("Name: " ); ?><input type="text" name="vw_fb_speaker[]" value="" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" placeholder="http://www.youtube.com/embed/9bZkp7q19f0" class="youtube_link" name="vw_fb_link[]" value="" size="40">
                <a class="how" href='#' title='FAQ'>How to Get This?</a>
            </div>
            <div>
                <?php _e("Name: " ); ?><input type="text" name="vw_fb_speaker[]" value="" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="" size="40">
            </div>
            <div>
                <?php _e("Name: " ); ?><input type="text" name="vw_fb_speaker[]" value="" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="" size="40">
            </div>
            <div>
                <?php _e("Name: " ); ?><input type="text" name="vw_fb_speaker[]" value="" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="" size="40">
            </div>
        </div>
        <input type="button" id="add_speaker" class="button-secondary" value="<?php _e('Add a Speaker'); ?>" />
        <hr>
        <input type="submit" class="button-primary" name="add_event" value="Add an Event">
    </form> 
</div>
<div id="tutorial">
        <a id="close" href="#" title="Close"><img src="<?php echo plugins_url('',__FILE__); ?>/images/close.png" alt="Close"></a>
        <div id="image">
            <img src="<?php echo plugins_url('',__FILE__); ?>/images/123_new.png">
        </div>
        <div id="desc">
            <a id="prev" class="active" href="#">
                <img src="<?php echo plugins_url('',__FILE__); ?>/images/arrows.png">
            </a>
            <div id="steps">
                <p id="step1">Step 1 : Search for a particular video on Youtube.Click Share tab, then Embed tab.</p>
                <p id="step2">Step 2 : Copy the code provided to Stickies or any text editor.</p>
                <p id="step3">Step 3 : Copy ONLY the content,which starts with "http://www.youtube.com/...",of iframe src attribute. Paste it into a text box. You've made it!</p>
            </div>
            <a id="next" class="active" href="#">
                <img src="<?php echo plugins_url('',__FILE__); ?>/images/arrows.png">
            </a>
        </div>
    </div>
<div class="overlay"></div>