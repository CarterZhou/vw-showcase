<?php 
	/**
	* 
	*/
class Pagination{
	
	private $num_of_records;
	private $records_per_page = 15;
	private $current_page;
	private $pages;

	function __construct($current_page,$num_of_records){
		$this->num_of_records = (int)$num_of_records;
		$this->current_page = (int)$current_page;
		if($this->num_of_records%$this->records_per_page == 0){
			$this->pages = (int)($this->num_of_records/$this->records_per_page);
		}else{
			$this->pages = (int)($this->num_of_records/$this->records_per_page)+ 1;
		}
	}

	function get_current_page(){
		return $this->current_page;
	}

	function get_num_of_records(){
		return $this->num_of_records;
	}

	function get_pages(){
		return $this->pages;
	}

	function get_offset(){
		return ($this->current_page-1) * $this->records_per_page;
	}
	function get_records_per_page(){
 		return $this->records_per_page;
	}
}
?>