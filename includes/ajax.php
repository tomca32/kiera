<?php
//AJAX
	function postaj(){
		//$detect = new Mobile_Detect();  //Detect mobilea
		$q = $_REQUEST['q'];
		$mojPage = get_page_by_path($q);
		/*if (!$mojPage) {
			$mojPage = get_page_by_path("food-drink/".$q);
			if (!$mojPage) {
				$mojPage = get_page_by_path("our-team/".$q);
			}
		}	
		$bg = get_post_meta($mojPage->ID, "bg", TRUE);*/
		$toReturn = array(
			"content" =>"<br/>".$mojPage->post_content,
			"guid" => $mojPage->guid
		);
		
		echo json_encode($toReturn);
		die();
	}
	
	
	add_action('wp_ajax_postaj', 'postaj');
	add_action('wp_ajax_nopriv_postaj', 'postaj');
?>