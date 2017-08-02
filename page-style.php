<?php
/*
Plugin Name: Page Style
Plugin URI: http://vinicius.borriello.com.br/page-style.php
Version: 1.0
Author: Vinícius Borriello
Author URI: http://vinicius.borriello.com.br
Description: Allow pages/categories to have different styles by adding a CSS Class (Page/Category Slug) to the BODY tag
*/

// Init function
function pageStyle_init() {
	wp_enqueue_script("jquery");
	add_action("wp_footer", "pageStyle_addStyle");
}

// Function Add Style
function pageStyle_addStyle() {
	global $post;
	
	if (!is_page()) :
		$category = get_the_category($post->ID);
		$class = $category[0]->slug;
	else :
		$postObject = get_post($post->ID);
		$class = $postObject->post_name;
	endif;
	
	if (!is_home()) :
?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("BODY").addClass("<?php echo $class; ?>");
		});
	</script>
<?php
	endif;
}
add_action("get_footer", "pageStyle_addStyle");

// Init
add_action('init', "pageStyle_init");
?>