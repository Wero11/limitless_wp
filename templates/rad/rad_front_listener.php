<?php 
/**
 * This template intializes RAD Frontend Engine.
 * All Components are available in Templates -> rad folder
 * @since Hades Framework V5
 */

$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];
require_once( $wp_url.'/wp-load.php' );

global $helper, $super_options , $meta_data , $wpdb,$radunits;


 $predict = 0; $pflag = false;
 ?>


			<?php 
			$widget = array();
			$widget['inputs'] = $_POST['inputs'];
			$widget['layout'] = "100%";
			$widget['type'] = trim($_POST['name']);
			$meta_data['rad_layout'] = $_POST['layout'];

			$meta_data['widget'] = $widget;
			$meta_data['predict'] = $predict;

			$meta_data['id'] = $_POST['name'].uniqid();

			$meta_data['state'] = $_POST['state'];
			
			get_template_part('templates/rad/'.trim(strtolower($widget['type'])));

			 ?>
		
