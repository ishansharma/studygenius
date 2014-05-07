<?php
	/* Display all child pages for current page */
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

	/* Remove Unused Admin Menu Items */
	function remove_unused_menu_items() {
		remove_menu_page('edit.php'); // Posts
		remove_menu_page('edit-comments.php'); // Comments
		remove_menu_page('edit.php?post_type=testimonial'); // Testimonials
	}
	add_action('admin_menu', 'remove_unused_menu_items');

	/* Reordering the Admin Menu */
	function reorder_admin_menu($menu_ord) {
		if(!$menu_ord) return true;

		return array(
			'index.php', // Dashboard
			'separator1', // Seperator
			'edit.php?post_type=subject', // Subjects
			'edit.php?post_type=note', // Notes
			'edit.php?post_type=page', // Pages
			'upload.php', // Media Library
			);
	}

	add_filter('custom_menu_order', 'reorder_admin_menu');
	add_filter('menu_order', 'reorder_admin_menu');

	/* Removing Columns from Post Table */
	function remove_unused_fields($columns) {
		unset( $columns['wpseo-score'] );
		unset( $columns['wpseo-title'] );
		unset( $columns['wpseo-metadesc'] );
		unset( $columns['wpseo-focuskw'] );

		return $columns;
	}

	add_filter('manage_edit-note_columns', remove_unused_fields);
	add_filter('manage_edit-subject_columns', remove_unused_fields);
?>