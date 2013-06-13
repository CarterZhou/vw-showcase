<?php 
	if(current_user_can('manage_showcase')){
        global $wpdb;
        $t_fb = $wpdb->prefix."showcase_fb";
        $data = array();
        $sql = "SELECT `review_link`,`topic`,`presented_date`
                FROM `$t_fb`"; 
        $results = $wpdb->get_results($sql,ARRAY_A);
        if($wpdb->num_rows){
        	for ($i=0; $i < $wpdb->num_rows; $i++) {
	        	$data[$i]['topic'] = $results['topic'];
	            $data[$i]['review_link'] = $results['review_link'];
	            $data[$i]['intro'] = $results['intro'];
	            $data[$i]['presented_date'] = $results['presented_date'];
        	}
           
        }
    }
?>
<div class="wrap">
	<table class="widefat">
		<tr>
			<th>Theme</th>
			<th>Date</th>
			<th>Review Link</th>
			<th>Action</th>
		</tr>
		<tr>
			<td>row 1, cell 1</td>
			<td>row 1, cell 2</td>
			<td>row 1, cell 3</td>
			<td>row 1, cell 4</td>
		</tr>
		<tr>
			<td>row 2, cell 1</td>
			<td>row 2, cell 2</td>
			<td>row 2, cell 3</td>
			<td>row 1, cell 4</td>
		</tr>
	</table>	
</div>