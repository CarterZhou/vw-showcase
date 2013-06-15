<?php
/*
 * Author: Hao Zhou
 * Date: 23/01/2013 
 *
 */
class ShowcaseManager
{
    // An array used to notify users of errors if there are any. 
    public $errors;
    // An array used to save user input.
    public $user_input;
    // An array used to save a list of events/videos.
    public $data;
    // An instance of Pagination class that helps paginate event list.
    public $pagination;

    function __construct(){
        $errors = array();
        $user_input = array();
        $data = array();
    }

    function fastbreak_delete_speaker(){
        global $wpdb;
        $t_fb_speakers = $wpdb->prefix."showcase_fb_speakers";
        $id = intval($_POST['details_id']);
        $result= $wpdb->query($wpdb->prepare("DELETE FROM $t_fb_speakers WHERE details_id = %d",$id));
        return $result;
    }

    function fastbreak_get_some($current_page = 1){
        global $wpdb;
        $t_fb = $wpdb->prefix."showcase_fb";
        // Count how many records in the table.
        $sql = "SELECT count(`topic_id`) AS `how_many` FROM $t_fb";
        $results = $wpdb->get_row($sql,ARRAY_A);
        $num_of_records = $results['how_many'];
        // Initialise a pagination object.
        require_once(dirname(__FILE__).'/pagination.class.php');
        $this->pagination = new Pagination($current_page,$num_of_records);
        // Select a set of records according to current page.
        $sql = "SELECT `topic_id`,`review_link`,`topic`,`presented_date`
                FROM `$t_fb`
                ORDER BY `presented_date` DESC
                LIMIT {$this->pagination->get_offset()},{$this->pagination->get_records_per_page()}";
        $results = $wpdb->get_results($sql,ARRAY_A);
        if($wpdb->num_rows){
             for ($i=0; $i < $wpdb->num_rows; $i++) {
                $this->data[$i]['topic_id'] = $results[$i]['topic_id'];
                $this->data[$i]['topic'] = $results[$i]['topic'];
                $this->data[$i]['review_link'] = $results[$i]['review_link'];
                $this->data[$i]['presented_date'] = $results[$i]['presented_date'];
            }
        }
    }

    function fastbreak_get_one($id=0){
        $id = intval($_GET['fb_id']);
        if($id>0){
            global $wpdb;
            $t_fb = $wpdb->prefix."showcase_fb";
            $t_fb_speakers = $wpdb->prefix."showcase_fb_speakers";
           
            $data = array();
            $sql = "SELECT $t_fb.topic_id AS topic_id,`details_id`,`speaker`,`youtube_link`,`review_link`,`topic`,`intro`,`presented_date`
                    FROM `$t_fb`,`$t_fb_speakers`
                    WHERE $t_fb.topic_id = $t_fb_speakers.topic_id AND $t_fb.topic_id=$id";
            $results = $wpdb->get_results($sql,ARRAY_A);
            if($wpdb->num_rows){
                $data['vw_fb_id'] = $results[0]['topic_id'];
                $data['vw_fb_theme'] = $results[0]['topic'];
                $data['vw_fb_review'] = $results[0]['review_link'];
                $data['vw_fb_intro'] = $results[0]['intro'];
                $data['vw_fb_date'] = $results[0]['presented_date'];
                foreach ($results as $index => $value) {
                    $data['vw_fb_did'][$index] = $results[$index]['details_id'];
                    $data['vw_fb_link'][$index] = $results[$index]['youtube_link'];
                    $data['vw_fb_speaker'][$index] = $results[$index]['speaker'];
                }
            }
            $this->data = $data;
        }
    }

    function fastbreak_add_or_update(){
        global $wpdb;
        $id = intval($_POST['vw_fb_id']);
        $success = false;
        // echo $success?'1':'0';
        $table_fb = $wpdb->prefix."showcase_fb";
        // Sanitize the introduction of event
        $intro = htmlentities(wp_strip_all_tags($_POST['vw_fb_intro']));
        $values = array( 
                    'topic' => strtolower($_POST['vw_fb_theme']), 
                    'review_link' => $_POST['vw_fb_review'],
                    'intro' => $_POST['vw_fb_intro'],
                    'presented_date'=> $_POST['vw_fb_date']
                );
        if($id == 0){
            $success = $wpdb->insert($table_fb,$values);
            if($success !== false){
                $inserted_id = $wpdb->insert_id;
                $table_fb = $wpdb->prefix."showcase_fb_speakers";
                for ($i=0; $i < count($_POST['vw_fb_speaker']); $i++) { 
                     $values = array( 
                        'topic_id' => $inserted_id, 
                        'youtube_link' => $_POST['vw_fb_link'][$i],
                        'speaker' => $_POST['vw_fb_speaker'][$i]
                    );
                    $success = $wpdb->insert($table_fb,$values);
                }
            }
        }else if($id > 0){
            $success = $wpdb->update($table_fb,$values,array('topic_id'=>$id));
            if($success !== false){
                $table_fb = $wpdb->prefix."showcase_fb_speakers";
                for ($i=0; $i < count($_POST['vw_fb_speaker']); $i++) { 
                     $values = array(
                        'youtube_link' => $_POST['vw_fb_link'][$i],
                        'speaker' => $_POST['vw_fb_speaker'][$i]
                    );
                    if(isset($_POST['vw_fb_did'][$i]) && !empty($_POST['vw_fb_did'][$i])){
                        $did = intval($_POST['vw_fb_did'][$i]);
                        $success = $wpdb->update($table_fb,$values,array('topic_id'=>$id,'details_id'=>$did));
                    }else{
                        $values['topic_id'] = $id;
                         $success = $wpdb->insert($table_fb,$values);
                    }
                  
                }
            }
        }
        if($success !== false){
            return true;
        }else{
            return false;
        }
    }

    function validate(){
        $input = $this->user_input;
        // Validate theme name
        if(isset($input['vw_fb_theme']) && !empty($input['vw_fb_theme'])){
            if(preg_match('/[^a-z -]+/i', $input['vw_fb_theme']) === 1){
                $this->errors['theme'] = 'Name of theme does not match the specified format';
            }
        }else{
            $this->errors['theme'] = 'Theme name is empty';
        }
        // Validate date
        if(isset($input['vw_fb_date']) && !empty($input['vw_fb_date'])){
            if(preg_match('/^20[0-9]{2}-\d{2}-\d{2}$/', $input['vw_fb_date']) === 0){
                $this->errors['date'] = 'Date does not match the specified format';
            }
        }else{
            $this->errors['date'] = 'Date is empty';
        }
        // Validate review link
        if(isset($input['vw_fb_review']) && !empty($input['vw_fb_review'])){
            if(preg_match('/^(http:\/\/vibewire\.org\/(\d{4}\/\d{2}\/)?[a-z1-9-]+\/)$/', $input['vw_fb_review']) === 0){
                $this->errors['review'] = 'Review link does not match the specified format';
            }
        }
        //Validate names of speakers
        if(isset($input['vw_fb_speaker']) && !empty($input['vw_fb_speaker'])){
            foreach ($input['vw_fb_speaker'] as $index => $name) {
                if(empty($name)){
                    $this->errors['name'][$index] = 'Speaker name '.($index+1).' is empty';
                    continue;
                }
                if(preg_match('/[^a-z ]+/i', $name) === 1){
                    $this->errors['name'][$index] = 'Speaker name can ONLY contain upper or lower case letters and white spaces';
                }
            }
        }
        // Validate Youtube links of fastbreak videos
        if(isset($input['vw_fb_link']) && !empty($input['vw_fb_link'])){
            foreach ($input['vw_fb_link'] as $index => $link) {
                if(empty($link)){
                    $this->errors['link'][$index] = 'Youtube '.($index+1).' link is empty';
                    continue;
                }
                if(preg_match('/^(http:\/\/www\.youtube.com\/embed\/[a-zA-Z0-9_-]{11})$/', $link) === 0){
                    $this->errors['link'][$index] = 'Youtube link does not match the specified format';
                }
            }
        }
    }
}
	
?>