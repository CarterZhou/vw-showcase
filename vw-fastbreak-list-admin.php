<?php 
	if(current_user_can('manage_showcase')){
        require_once(dirname(__FILE__).'/inc/showcase-manager.class.php');
    	$manager = new ShowcaseManager();
    	$page_now = 1;
    	if(isset($_GET['paged'])){
    		$page_now = intval($_GET['paged']);
    	}
    	$manager->fastbreak_get_some($page_now);
    }
?>
<div class="wrap">
	<h2><?php _e( 'fastBREAK Event List'); ?></h2>
	<form method="get" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<div class='tablenav'>
			<div class="tablenav-pages"><span class="displaying-num"><?php  _e($manager->pagination->get_num_of_records());?> events</span>
				<span class="pagination-links">
					<a class="first-page <?php  if($page_now == 1){echo 'disabled';}?>" title="Go to the first page" href="<?php echo $_SERVER['REQUEST_URI']; ?>&paged=1">«</a>
					<a class="prev-page <?php  if($page_now == 1){echo 'disabled';}?>" title="Go to the previous page" href="<?php echo $_SERVER['REQUEST_URI']; ?>">‹</a>
					<span class="paging-input"><input class="current-page" title="Current page" type="text" name="paged" value="1" size="1"> of 
					<span class="total-pages"><?php  _e($manager->pagination->get_pages());?> events</span>
					</span>
					<a class="next-page <?php  if($page_now == $manager->pagination->get_pages()){echo 'disabled';}?>" title="Go to the next page" href="<?php echo $_SERVER['REQUEST_URI']; ?>">›</a>
					<a class="last-page <?php  if($page_now == $manager->pagination->get_pages()){echo 'disabled';}?>" title="Go to the last page" href="<?php echo $_SERVER['REQUEST_URI']; ?>&paged=<?php echo $manager->pagination->get_pages()?>">»</a>
				</span>
			</div>
		</div>
	</form>
	<p></p>
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
				for ($i=0; $i <count($manager->data); $i++) { 
			?>
			<tr>
				<td><?php _e(strtoupper($manager->data[$i]['topic']));?></td>
				<td><?php _e($manager->data[$i]['presented_date']);?></td>
				<td><a href="<?php echo ($manager->data[$i]['review_link']);?>" title="Read the review"><?php echo ($manager->data[$i]['review_link']);?></a></td>
				<td><a href="<?php echo admin_url('admin.php').'?page=vw-fastbreak-admin.php&fb_id='.$manager->data[$i]['topic_id'];?>" title="Update">Update</a> | <a href="#" title="Delete">Delete</a></td>
			</tr>
			<?php 
				}
			?>
		</tbody>
	</table>
</div>