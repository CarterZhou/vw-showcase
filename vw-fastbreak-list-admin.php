<?php 
	if(current_user_can('manage_showcase')){
        require_once(dirname(__FILE__).'/inc/showcase-manager.class.php');
    	$manager = new ShowcaseManager();
    	$manager->fastbreak_get_all();
    }
?>
<div class="wrap">
	<h2><?php _e( 'fastBREAK Event List'); ?></h2>
	<div class='tablenav-pages'></div>
	<table class="widefat">
		<thead>
			<tr>
				<th>Theme</th>
				<th>Date</th>
				<th>Review Link</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php  
				for ($i=0; $i <count($manager->list); $i++) { 
			?>
			<tr>
				<td><?php _e(strtoupper($manager->list[$i]['topic']));?></td>
				<td><?php _e($manager->list[$i]['presented_date']);?></td>
				<td><a href="<?php echo ($manager->list[$i]['review_link']);?>" title="Read the review"><?php echo ($manager->list[$i]['review_link']);?></a></td>
				<td><a href="<?php echo admin_url('admin.php').'?page=vw-fastbreak-admin.php&fb_id='.$manager->list[$i]['topic_id'];?>" title="Update">Update</a> | <a href="#" title="Delete">Delete</a></td>
			</tr>
			<?php 
				}
			?>
		</tbody>
	</table>
</div>