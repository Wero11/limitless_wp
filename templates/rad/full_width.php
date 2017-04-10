<?php 
/**
 * Text Template for RAD BUILDER
 */

global $helper, $super_options , $meta_data , $wpdb,$radunits;

$w = $meta_data['widget']['inputs']; 

$hidden_data = $helper->getAssocMap($w,'hidden');
$w = $helper->getAssocMap($w,'value'); // $helper->prettyPrint($w);



$col =$meta_data['widget']['layout'];

$layout_type = 'full_width';

if(isset($meta_data['rad_layout'])) 
{
	switch($col)
	{
		case '100%' : $layout_type = 'full_width left' ; break;
		case '75%' : $layout_type = 'three_fourth left' ; break;
		case '66%' : $layout_type = 'two_third left' ; break;
		case '50%' : $layout_type = 'one_half left' ; break;
		case '33%' : $layout_type = 'one_third left' ; break;
		case '25%' : $layout_type = 'one_fourth left' ; break;

	}


}


$inner_wrap_classes = '';


// Get keys ==== 
$keys = implode(',',$radunits[$meta_data['widget']['type']]->getInputKeys());
$h = '';

$joint = strtolower( str_replace(" ","_",trim($meta_data['widget']['type']) ) );

 ?>


<div data-type="<?php echo $meta_data['widget']['type']; ?>" id="<?php if(isset($meta_data['id'])) echo $meta_data['id']; ?>" data-fields="<?php echo $keys; ?>" class="<?php echo $joint ?>-wrapper page-rad-component rad-component-spacing   clearfix">
	
	<div class="curtain <?php  if(isset($meta_data['state']) && $meta_data['state'] == "live" ) echo 'hide'; ?>"> <h4><?php echo str_replace("_"," ",$meta_data['widget']['type']) ?>  <span><?php _e('(Drag to Arrange)','ioa') ?></span> </h4> </div> 
	
	<div class="<?php echo $joint ?>-inner-wrap <?php echo $inner_wrap_classes; ?> " >
		
		<div class="text text_data <?php echo $hidden_data['text_data']; ?>">
			<?php echo $helper->format($w['text_data'],false,false); ?>
		</div>
	</div>

	<?php  if(get_transient('rad_session')) : ?>
	<div class="meta-data">
		
		<input type="hidden" class='component_layout' value="<?php echo $col ?>" />	
		<?php foreach ($radunits[$meta_data['widget']['type']]->getMetaKeys() as $key) : ?>
			<input type="hidden" class='<?php echo $key; ?>' value="<?php if(isset($w[$key])) echo $w[$key] ?>" />	
		<?php endforeach; ?>
	
	</div>
	<?php endif; ?>
</div>

<?php if(  $w['clear_float']=="yes") echo '<div class="clearfix empty_element"></div>'; ?>