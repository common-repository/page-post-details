<?php
/*
Plugin Name:Page Post Details Widget
Plugin URI: http://www.tatwa.com/
Description:Easily display your WordPress Pages and Posts Details and also displays the comments details on frontend of your  wordpress website.
Version: 1.0
Author: Ashirbad Ray
Author URI: http://www.tatwa.com/
Text Domain: page_post_list_widget

*/
wp_register_style('pagepostdetailStylesheet', plugins_url('assets/css/style.css', __FILE__) );
	wp_enqueue_style('pagepostdetailStylesheet');
	
//Class For Creating Widget
class page_post_list_widget extends WP_Widget {

	// constructor
	function page_post_list_widget() {
		/* ... */
		  parent::WP_Widget(false, $name = __('Page Post Details Widget', 'page_post_list_widget') );
	}

	// widget form creation
function form($instance) {

// Check values
if( $instance) {
	
     $title = esc_attr($instance['title']);
     $text = esc_attr($instance['text']);
	  
	 
} else {
     $title = '';
     

}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'page_post_list_widget'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
<br><br>

</p>
 
<?php
}
	// widget update
	// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
	    return $instance;
}
	// widget display
	// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box">';

   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }
?>
     <?php
	 $blogusers = get_users( array( 'fields' => array( 'display_name' ) ) );
// Array of stdClass objects.
?>
<h3>Page Details</h3>
<span>Total No. Of Pages Publish: <?php  echo $count_pages = wp_count_posts('page')->publish; ?></span>
<span>Total No. Of Pages Trash: <?php  echo $count_pages = wp_count_posts('page')->trash; ?></span>
<h3>Post Details</h3>
<span>Total No. Of Posts Publish: <?php  echo $count_pages = wp_count_posts('post')->publish; ?></span>
<span>Total No. Of Posts Trash: <?php  echo $count_pages = wp_count_posts('post')->trash; ?></span>
<span>Total No. Of Posts Draft: <?php  echo $count_pages = wp_count_posts('post')->draft; ?></span>
<h3>Comments for site </h3>
<?php
$comments_count = wp_count_comments();
echo "Comments in moderation: " . $comments_count->moderated . "<br />"; 
echo "Comments approved: " . $comments_count->approved . "<br />";
echo "Comments in Spam: " . $comments_count->spam . "<br />";
echo "Comments in Trash: " . $comments_count->trash . "<br />";
echo "Total Comments: " . $comments_count->total_comments . "<br />";
echo "Total Comments: " . $comments_count->total_comments . "<br />";

?>
</div>
<?php
echo $after_widget;
}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("page_post_list_widget");'));