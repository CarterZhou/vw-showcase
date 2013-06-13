<?php
    $errors = array();
    $user_input = array();
    // Retrieve data of a fastBREAK event based on the given ID.
    if(isset($_GET) && !empty($_GET['fb_id'])){
        if(current_user_can('manage_showcase')){
            global $wpdb;
            $t_fb = $wpdb->prefix."showcase_fb";
            $t_fb_speakers = $wpdb->prefix."showcase_fb_speakers";
            $id = intval($_GET['fb_id']);
            $data = array();
            $sql = "SELECT `speaker`,`youtube_link`,`review_link`,`topic`,`intro`,`presented_date`
                    FROM `$t_fb`,`$t_fb_speakers`
                    WHERE $t_fb.topic_id = $t_fb_speakers.topic_id AND $t_fb.topic_id=$id"; 
            $results = $wpdb->get_results($sql,ARRAY_A);
            if($wpdb->num_rows){
                $data['vw_fb_theme'] = $results[0]['topic'];
                $data['vw_fb_review'] = $results[0]['review_link'];
                $data['vw_fb_intro'] = $results[0]['intro'];
                $data['vw_fb_date'] = $results[0]['presented_date'];
                foreach ($results as $index => $value) {
                    $data['vw_fb_link'][$index] = $results[$index]['youtube_link'];
                    $data['vw_fb_speaker'][$index] = $results[$index]['speaker'];
                }
            }
            $user_input = $data;
        }
    }
    // Save a new fastBREAK event
    if(isset($_POST) && !empty($_POST)){
        $user_input = $_POST;
        require_once(dirname(__FILE__).'/inc/validation.php');
        // Check user's capability and make sure there are no errors in user input
        if(current_user_can('manage_showcase') && sizeof($errors)==0){
            global $wpdb;
            $table_fb = $wpdb->prefix."showcase_fb";
            // Sanitize the introduction of event
            $intro = htmlentities(wp_strip_all_tags($_POST['vw_fb_intro']));
            $values = array( 
                        'topic' => $_POST['vw_fb_theme'], 
                        'review_link' => $_POST['vw_fb_review'],
                        'intro' => $_POST['vw_fb_intro'],
                        'presented_date'=> $_POST['vw_fb_date']
                    );
            if($wpdb->insert($table_fb,$values)){
                $inserted_id = $wpdb->insert_id;
                $table_fb = $wpdb->prefix."showcase_fb_speakers";
                for ($i=0; $i < count($_POST['vw_fb_speaker']); $i++) { 
                     $values = array( 
                        'topic_id' => $inserted_id, 
                        'youtube_link' => $_POST['vw_fb_link'][$i],
                        'speaker' => $_POST['vw_fb_speaker'][$i]
                    );
                    $wpdb->insert($table_fb,$values);
                }
            }
            // Redirection
            echo '<div class="updated">';
            echo '</p>New Event Added!</p>';
            echo '</p>Redirected in 3 seconds</p>';
            echo '</div>';
            echo '<script type="text/javascript">';
            echo 'setTimeout(function(){window.location="'.admin_url( 'admin.php?page=vw-fastbreak-list-admin.php').'";},3000);s';
            echo '</script>';
            die();
        }
    }
?>
<div class="wrap">  
    <h2><?php _e( 'fastBREAK Event Info'); ?></h2>
    <h3><?php _e( 'General Information'); ?></h3>
    <form id="vw_fb_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">  
         <div>
            <span class="vw_error"><?php if(isset($errors['theme'])){echo 'Error : '.$errors['theme'];}?></span>
            <span class="required">* </span><?php _e("Theme: " ); ?><input type="text" id="vw_fb_theme" name="vw_fb_theme" value="<?php echo $user_input['vw_fb_theme']; ?>" size="20"><?php _e(" example: YOUTH" ); ?>
        </div> 
        <div>
            <span class="vw_error"><?php if(isset($errors['date'])){echo 'Error : '.$errors['date'];}?></span>
            <span class="required">* </span><?php _e("Presented Date: " ); ?><input type="text" placeholder="event date" id="vw_fb_date" name="vw_fb_date" value="<?php echo $user_input['vw_fb_date']; ?>" size="20"><?php _e(" example: 2012-12-22" ); ?>
        </div>  
        <div>
            <span class="vw_error"><?php if(isset($errors['review'])){echo 'Error : '.$errors['review'];}?></span>
            <span class="required">* </span><?php _e("Textual Review Link: " ); ?><input placeholder="http://" type="text" id="vw_fb_review" name="vw_fb_review" value="<?php echo $user_input['vw_fb_review']; ?>" size="50"><?php _e(" example: http://vibewire.org/2012/07/fastbreak-lies-review/" ); ?> 
        </div>
        <p><?php _e("Intro: " ); ?></p>
        <div>
            <textarea name="vw_fb_intro" id="vw_fb_intro" cols="100" rows="5" placeholder="Type the introduction of theme here..."><?php echo $user_input['vw_fb_intro']; ?></textarea>
        </div>
        <hr>
        <span class="required">* </span><h3 style="display:inline"><?php _e( 'Speakers Information'); ?></h3>
        <div id="speakers">
            <div>
                <span class="vw_error"><?php if(isset($errors['name'][0])){echo 'Error : '.$errors['name'][0];}?></span>
                <span class="vw_error"><?php if(isset($errors['link'][0])){echo 'Error : '.$errors['link'][0];}?></span>
                <?php _e("Name: " ); ?><input type="text" class="vw_fb_speaker" name="vw_fb_speaker[]" value="<?php echo $user_input['vw_fb_speaker'][0]; ?>" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" placeholder="http://www.youtube.com/embed/9bZkp7q19f0" class="youtube_link" name="vw_fb_link[]" value="<?php echo $user_input['vw_fb_link'][0]; ?>" size="40">
                <a class="how" href='#' title='FAQ'>How to Get This?</a>
            </div>
            <div>
                <span class="vw_error"><?php if(isset($errors['name'][1])){echo 'Error : '.$errors['name'][1];}?></span>
                <span class="vw_error"><?php if(isset($errors['link'][1])){echo 'Error : '.$errors['link'][1];}?></span>
                <?php _e("Name: " ); ?><input type="text" class="vw_fb_speaker" name="vw_fb_speaker[]" value="<?php echo $user_input['vw_fb_speaker'][1]; ?>" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="<?php echo $user_input['vw_fb_link'][1]; ?>" size="40">
            </div>
            <div>
                <span class="vw_error"><?php if(isset($errors['name'][2])){echo 'Error : '.$errors['name'][2];}?></span>
                <span class="vw_error"><?php if(isset($errors['link'][2])){echo 'Error : '.$errors['link'][2];}?></span>
                <?php _e("Name: " ); ?><input type="text" class="vw_fb_speaker" name="vw_fb_speaker[]" value="<?php echo $user_input['vw_fb_speaker'][2]; ?>" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="<?php echo $user_input['vw_fb_link'][2]; ?>" size="40">
            </div>
            <div>
                <span class="vw_error"><?php if(isset($errors['name'][3])){echo 'Error : '.$errors['name'][3];}?></span>
                <span class="vw_error"><?php if(isset($errors['link'][3])){echo 'Error : '.$errors['link'][3];}?></span>
                <?php _e("Name: " ); ?><input type="text" class="vw_fb_speaker" name="vw_fb_speaker[]" value="<?php echo $user_input['vw_fb_speaker'][3]; ?>" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="<?php echo $user_input['vw_fb_link'][3]; ?>" size="40">
            </div>
             <div>
                <span class="vw_error"><?php if(isset($errors['name'][4])){echo 'Error : '.$errors['name'][4];}?></span>
                <span class="vw_error"><?php if(isset($errors['link'][4])){echo 'Error : '.$errors['link'][4];}?></span>
                <?php _e("Name: " ); ?><input type="text" class="vw_fb_speaker" name="vw_fb_speaker[]" value="<?php echo $user_input['vw_fb_speaker'][4]; ?>" size="20">&nbsp;&nbsp;&nbsp;
                <?php _e("Youtube Link: " ); ?><input type="text" class="youtube_link" name="vw_fb_link[]" value="<?php echo $user_input['vw_fb_link'][4]; ?>" size="40">
            </div>
        </div>
        <input type="button" id="add_speaker" class="button-secondary" value="<?php _e('Add a Speaker'); ?>" />
        <input type="button" id="remove_speaker" class="button-secondary" value="<?php _e('Remove a Speaker'); ?>" />
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