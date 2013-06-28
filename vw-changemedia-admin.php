<?php
    require_once(dirname(__FILE__).'/inc/showcase-manager.class.php');
    $manager = new ShowcaseManager();
    // Retrieve data of related articles and videos based on the given ID.
    if(isset($_GET) && !empty($_GET['cm_id'])){
        if(current_user_can('manage_showcase')){
            $manager->changemedia_get_one($_GET['cm_id']);
            $manager->user_input = $manager->data;
        }
    }
    // Update articles and videos of a theme.
    if(isset($_POST) && !empty($_POST)){
        $manager->user_input = $_POST;
        $manager->changemedia_validate();
        // Check user's capability and make sure there are no errors in user input.
        if(current_user_can('manage_showcase') && sizeof($manager->errors)==0){
            // Save event and notify whether it succceeds or not,
            if($manager->changemedia_add_or_update()){
                echo '<div class="updated highlight">';
                echo '</p>Updated Successfully!</p>';
                echo '</p>You will be redirected in 3 seconds</p>';
                echo '</div>';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function(){window.location="'.admin_url( 'admin.php?page=vw-changemedia-list-admin.php').'";},3000);s';
                echo '</script>';
            }else{
                echo '<div class="error highlight">';
                echo '</p>Failed to Update!</p>';
                echo '</p>Please make sure your input conforms to specified format.</p>';
                echo '</p>You will be redirected in 3 seconds</p>';
                echo '</div>';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function(){window.location="'.admin_url( 'admin.php?page=vw-changemedia-list-admin.php').'";},3000);s';
                echo '</script>';
            }
            die();
        }
    }
?>
<div class="wrap">  
    <h2><?php _e( 'Add/Update Change Media Videos and Articles'); ?></h2>
    <h3><?php _e( 'General Information'); ?></h3>
    <form id="vw_cm_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
         <input type="hidden" id="vw_cm_id" name="vw_cm_id" value="<?php echo $manager->user_input['vw_cm_id']?>">  
         <div>
            <span class="vw_error"><?php if(isset($manager->errors['theme'])){echo 'Error : '.$manager->errors['theme'];}?></span>
            <span class="required">* </span><?php _e("Theme: " ); ?><input type="text" id="vw_cm_theme" name="vw_cm_theme" value="<?php echo $manager->user_input['vw_cm_theme']; ?>" size="20"><?php _e(" example: Religion" ); ?>
        </div> 
        <hr>
        <h3 style="display:inline"><?php _e( 'Videos and Articles'); ?></h3>
        <div><h3><a class="how" href='#' title='FAQ'>How to Get Youtube Links?</a></h3></div>
        <div id="vw_cm_videos">
            <?php  
                if(isset($manager->user_input['vw_cm_video']) && sizeof($manager->user_input['vw_cm_video'])>0){
                    $loop_count = sizeof($manager->user_input['vw_cm_video']);
                }else{
                    $loop_count = 4;
                }
                for ($i=0; $i < $loop_count; $i++) {
                
            ?>
             <div>
                <span class="vw_error"><?php if(isset($manager->errors['name'][$i])){echo 'Error : '.$manager->errors['article'][$i];}?></span>
                <span class="vw_error"><?php if(isset($manager->errors['link'][$i])){echo 'Error : '.$manager->errors['video'][$i];}?></span>
                <input type="hidden" name="vw_cm_vid[]" value="<?php if(isset($manager->user_input['vw_cm_vid'][$i])){echo $manager->user_input['vw_cm_vid'][$i];}?>">
                <span class="required">* </span><?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_cm_link[]" value="<?php if(isset($manager->user_input['vw_cm_link'][$i])){echo $manager->user_input['vw_cm_link'][$i];} ?>" size="40">
                <?php _e("Associated Article: " ); ?><input type="text" class="article_link" name="vw_cm_alink[]" value="<?php if(isset($manager->user_input['vw_cm_alink'][$i])){echo $manager->user_input['vw_cm_alink'][$i];} ?>" size="40">

            <?php  
                    if(isset($manager->data['vw_cm_video'][$i])){
            ?>
                <a href="#" title="Delete" class="delete"><?php _e("Delete permanently" );?></a>
            
            <?php 
                    }
                    echo "</div>";
                }
            ?>
        </div>
        <input type="button" id="add_cm" class="button-secondary" value="<?php _e('Add'); ?>" />
        <input type="button" id="remove_cm" class="button-secondary" value="<?php _e('Remove'); ?>" />
        <hr>
        <input type="submit" class="button-primary" name="add_update" value="Add / Update">
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