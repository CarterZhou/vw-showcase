<?php  
	 // Validate name of theme
    if(isset($_POST['vw_fb_theme']) && !empty($_POST['vw_fb_theme'])){
        if(preg_match('/[^a-z ]+/i', $_POST['vw_fb_theme']) === 1){
            $errors['theme'] = 'Name of theme does not match the specified format';
        }
    }else{
        $errors['theme'] = 'Theme name is empty';
    }
    // Validate date
    if(isset($_POST['vw_fb_date']) && !empty($_POST['vw_fb_date'])){
        if(preg_match('/^20[0-9]{2}-\d{2}-\d{2}$/', $_POST['vw_fb_date']) === 0){
            $errors['date'] = 'Date does not match the specified format';
        }
    }else{
        $errors['date'] = 'Date is empty';
    }
    // Validate date
    if(isset($_POST['vw_fb_review']) && !empty($_POST['vw_fb_review'])){
        if(preg_match('/^(http:\/\/vibewire\.org\/\d{4}\/\d{2}\/[a-z1-9-]+\/)$/', $_POST['vw_fb_review']) === 0){
            $errors['review'] = 'Review link does not match the specified format';
        }
    }else{
        $errors['review'] = 'Review link is empty';
    }
    //Validate names of speakers
    if(isset($_POST['vw_fb_speaker']) && !empty($_POST['vw_fb_speaker'])){
        foreach ($_POST['vw_fb_speaker'] as $index => $name) {
            if(empty($name)){
                $errors['name'][$index] = 'Speaker name '.($index+1).' is empty';
                continue;
            }
            if(preg_match('/[^a-z ]+/i', $name) === 1){
                $errors['name'][$index] = 'Speaker name can ONLY contain upper or lower case letters and white spaces';
            }
        }
    }
    // Validate Youtube links of fastbreak videos
    if(isset($_POST['vw_fb_link']) && !empty($_POST['vw_fb_link'])){
        foreach ($_POST['vw_fb_link'] as $index => $link) {
            if(empty($link)){
                $errors['link'][$index] = 'Youtube '.($index+1).' link is empty';
                continue;
            }
            if(preg_match('/^(http:\/\/www\.youtube.com\/embed\/[a-zA-Z0-9_-]{11})$/', $link) === 0){
                $errors['link'][$index] = 'Youtube link does not match the specified format';
            }
        }
    }
?>