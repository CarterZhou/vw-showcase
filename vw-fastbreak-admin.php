<div class="wrap">  
    <?php echo "<h2>" . __( 'fastBREAK Event Info', 'vw_trdom' ) . "</h2>"; ?>  
    <?php echo "<h3>" . __( 'General Information', 'vw_trdom' ) . "</h4>"; ?>  
    <form id="vw_fb_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="vw_fb_hidden" value="y">  
        <p><?php _e("Theme: " ); ?><input placeholder="theme name" type="text" name="vw_fb_theme" value="<?php echo $db_theme; ?>" size="20"><?php _e(" example: YOUTH" ); ?></p>  
        <p><?php _e("Presented Date: " ); ?><input type="text" placeholder="event date" id="vw_fb_date" name="vw_fb_date" value="<?php echo $db_date; ?>" size="20"><?php _e(" example: 2012/12/22" ); ?></p>  
        <p><?php _e("Textual Review Link: " ); ?><input placeholder="http://" type="text" name="vw_fb_review" value="<?php echo $db_review; ?>" size="20"><?php _e(" example: http://vibewire.org/2012/07/fastbreak-lies-review/" ); ?></p>  
        <p><?php _e("Intro: " ); ?></p>
        <p><textarea name="vw_fb_intro" cols="50" rows="5" placeholder="Type the introduction of theme here..."></textarea></p>
        <hr>
        <?php echo "<h3>".__( 'Speakers Information', 'vw_trdom' )."</h4>"; ?>
        
        <p class="submit"> <input type="submit" name="Submit" value="<?php _e('Add/Update an Event', 'vw_trdom' ) ?>" /></p>  
    </form> 
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#vw_fb_date').datepicker({changeYear:true,changeMonth:true});

        $('#vw_fb_form').submit(function(event) {
            event.preventDefault();
            console.log("done!");
        });
    });
</script> 