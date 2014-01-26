<?php
	add_shortcode('child_pages', 'list_child_pages');
	function list_child_pages() {
		// Initiate Child List, This string will be returned at the end. 
		$child_list = '';
		// Save current page's ID for later use
		$current_page_id = get_the_id();
		// Initiating argument for getting posts
		$args = array (
						'sort_column' => 'post_date',
						'sort_order' => 'DESC',
						'post_type' => 'page',
						'post_status' => 'publish',
						'parent' => $current_page_id
			);
		// Get pages from database
		$pages = get_pages($args);
		// Format the list and put each page as a link with title as anchor text. 
		$child_list .= '<ul>';
		foreach ($pages as $current_page) {
			$title = $current_page->post_title;
			$permalink = get_permalink($current_page->ID);
			$child_list .= '<li><a href = "' . $permalink . '">' . $title . '</a></li>';
		}
		$child_list .= '</ul>';
		// We're done. 
		return $child_list;
	}
?>