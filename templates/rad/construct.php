<?php 
/**
 * This template intializes RAD Frontend Engine.
 * All Components are available in Templates -> rad folder
 * @since Hades Framework V5
 */

global $helper, $super_options , $meta_data ,$radunits, $post;

if( ! isset($meta_data['rad_id'])) $meta_data['rad_id'] = 1; // if template ID not set point to Home Page


	 
$layout = get_post_meta($post->ID,"rad_data",true);


	
$meta_data['state'] = "live";
$predict = 0; $pflag = false;

if(isset($_GET['rad_edit']))
{
	$meta_data['state'] = "live";
}

 ?>


<?php if(isset($layout) && is_array($layout)) : foreach($layout as $container) : $cdata = $container['layout']; ?>

	<div class="rad-container clearfix " id="<?php if(isset($container["id"])) echo $container["id"]; ?>"  data-layout="<?php echo $cdata ?>">
		<div class="<?php if(isset($cdata) && $cdata=="full-width") echo 'skeleton'; ?> inner-rad-container-wrapper auto_align clearfix">
		<?php 
				$widgets = array();
				if(isset( $container['components'])) $widgets = $container['components'];
		?>

		<?php foreach($widgets as $widget) :  

				if(isset($radunits[$widget['type']])) :
			

			
			$meta_data['widget'] = $widget;
			if( isset($widget['id']) )
				$meta_data['id'] = $widget['id'];
			else
				$meta_data['id'] = '';

			$meta_data['rad_layout'] = $cdata;
			
			get_template_part('templates/rad/'.trim(strtolower($widget['type'])));

			


			 ?>
		<?php endif; endforeach; ?>
	</div></div>




<?php endforeach;
	else :
 ?>

<div class="rad-container clearfix" id="default_rad_layout"  data-layout="full-width">
		<div class="skeleton inner-rad-container-wrapper auto_align clearfix"></div>
</div>
<?php endif; ?>