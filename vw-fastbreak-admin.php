<?php
    require_once(dirname(__FILE__).'/inc/showcase-manager.class.php');
    $manager = new ShowcaseManager();
    // Retrieve data of a fastBREAK event based on the given ID.
    if(isset($_GET) && !empty($_GET['fb_id'])){
        if(current_user_can('manage_showcase')){
            $manager->fastbreak_get_one($_GET['fb_id']);
            $manager->user_input = $manager->data;
        }
    }
    // Save a new fastBREAK event.
    if(isset($_POST) && !empty($_POST)){
        $manager->user_input = $_POST;
        $manager->validate();
        // Check user's capability and make sure there are no errors in user input.
        if(current_user_can('manage_showcase') && sizeof($manager->errors)==0){
            // Save event and notify whether it succceeds or not,
            if($manager->fastbreak_add_or_update()){
                echo '<div class="updated highlight">';
                echo '</p>Updated Successfully!</p>';
                echo '</p>You will be redirected in 3 seconds</p>';
                echo '</div>';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function(){window.location="'.admin_url( 'admin.php?page=vw-fastbreak-list-admin.php').'";},3000);s';
                echo '</script>';
            }else{
                echo '<div class="error highlight">';
                echo '</p>Failed to Update!</p>';
                echo '</p>Please make sure your input conforms to specified format.</p>';
                echo '</p>You will be redirected in 3 seconds</p>';
                echo '</div>';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function(){window.location="'.admin_url( 'admin.php?page=vw-fastbreak-list-admin.php').'";},3000);s';
                echo '</script>';
            }
            die();
        }
    }
?>
<div class="wrap">  
    <h2><?php _e( 'Add/Update fastBREAK Event'); ?></h2>
    <h3><?php _e( 'General Information'); ?></h3>
    <form id="vw_fb_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
         <input type="hidden" id="vw_fb_id" name="vw_fb_id" value="<?php echo $manager->user_input['vw_fb_id']?>">  
         <div>
            <span class="vw_error"><?php if(isset($manager->errors['theme'])){echo 'Error : '.$manager->errors['theme'];}?></span>
            <span class="required">* </span><?php _e("Theme: " ); ?><input type="text" id="vw_fb_theme" name="vw_fb_theme" value="<?php echo $manager->user_input['vw_fb_theme']; ?>" size="20"><?php _e(" example: YOUTH" ); ?>
        </div> 
        <div>
            <span class="vw_error"><?php if(isset($manager->errors['date'])){echo 'Error : '.$manager->errors['date'];}?></span>
            <span class="required">* </span><?php _e("Presented Date: " ); ?><input type="text" placeholder="event date" id="vw_fb_date" readonly="readonly" name="vw_fb_date" value="<?php echo $manager->user_input['vw_fb_date']; ?>" size="20"><?php _e(" example: 2012-12-22" ); ?>
        </div>  
        <div>
            <span class="vw_error"><?php if(isset($manager->errors['review'])){echo 'Error : '.$manager->errors['review'];}?></span>
            <?php _e("Textual Review Link: " ); ?><input placeholder="http://" type="text" id="vw_fb_review" name="vw_fb_review" value="<?php echo $manager->user_input['vw_fb_review']; ?>" size="50"><?php _e(" example: http://vibewire.org/2012/07/fastbreak-lies-review/" ); ?> 
        </div>
        <div>
            <span class="vw_error"><?php if(isset($manager->errors['cover'])){echo 'Error : '.$manager->errors['cover'];}?></span>
            <?php _e("Cover Photo Link: " ); ?><input placeholder="http://" type="text" id="vw_fb_cover" name="vw_fb_cover" value="<?php echo $manager->user_input['vw_fb_cover']; ?>" size="60"><?php _e(" example: http://vibewire.org/wp-content/uploads/2013/06/coverphoto_april.png" ); ?> 
        </div>
        <p><?php _e("Intro: " ); ?></p>
        <div>
            <textarea name="vw_fb_intro" id="vw_fb_intro" cols="100" rows="5" placeholder="Type the introduction of theme here..."><?php echo $manager->user_input['vw_fb_intro']; ?></textarea>
        </div>
        <hr>
        <span class="required">* </span><h3 style="display:inline"><?php _e( 'Speakers Information'); ?></h3>
        <div><h3><a class="how" href='#' title='FAQ'>How to Get Youtube Links?</a></h3></div>
        <div id="speakers">
            <?php  
                if(isset($manager->user_input['vw_fb_speaker']) && sizeof($manager->user_input['vw_fb_speaker'])>0){
                    $loop_count = sizeof($manager->user_input['vw_fb_speaker']);
                }else{
                    $loop_count = 5;
                }
                for ($i=0; $i < $loop_count; $i++) {
                
            ?>
             <div>
                <span class="vw_error"><?php if(isset($manager->errors['name'][$i])){echo 'Error : '.$manager->errors['name'][$i];}?></span>
                <span class="vw_error"><?php if(isset($manager->errors['link'][$i])){echo 'Error : '.$manager->errors['link'][$i];}?></span>
                <input type="hidden" name="vw_fb_did[]" value="<?php if(isset($manager->user_input['vw_fb_did'][$i])){echo $manager->user_input['vw_fb_did'][$i];}?>">
                <?php _e("Name: " ); ?><input type="text" class="vw_fb_speaker" name="vw_fb_speaker[]" value="<?php if(isset($manager->user_input['vw_fb_speaker'][$i])){echo $manager->user_input['vw_fb_speaker'][$i];} ?>" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="<?php if(isset($manager->user_input['vw_fb_link'][$i])){echo $manager->user_input['vw_fb_link'][$i];} ?>" size="40">
            <?php  
                    if(isset($manager->data['vw_fb_speaker'][$i])){
            ?>
                <a href="#" title="Delete" class="delete"><?php _e("Delete permanently" );?></a>
            
            <?php 
                    }
                    echo "</div>";
                }
            ?>
        </div>
        <input type="button" id="add_speaker" class="button-secondary" value="<?php _e('Add'); ?>" />
        <input type="button" id="remove_speaker" class="button-secondary" value="<?php _e('Remove'); ?>" />
        <hr>
        <input type="submit" class="button-primary" name="add_event" value="Add / Update">
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
<div class="vw_loading"></div>
<div class="overlay"></div>