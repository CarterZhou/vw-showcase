<?php 
	if (isset($_GET['url']) && !empty($_GET['url'])) {
		$url = str_replace('admin','list-admin',$_GET['url']);
		echo $url;
		header('Refresh: 5; URL='.$url);
	}
?>
