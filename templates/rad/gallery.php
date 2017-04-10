<?php 
/**
 * gallery Template for RAD BUILDER
 */

global $helper, $super_options , $meta_data , $wpdb,$radunits;

$w = $meta_data['widget']['inputs']; 

$hidden_data = $helper->getAssocMap($w,'hidden');
$w = $helper->getAssocMap($w,'value'); // $helper->prettyPrint($w);



$col =$meta_data['widget']['layout'];

$layout_type = '';

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

// Get keys ==== 
 //$helper->prettyPrint($w);

$keys = implode(',',$radunits['Gallery']->getInputKeys());
$h = '';


$testable = get_transient('rad_session');
$titlecheck = true;
if(!$testable)
{
  if(trim($w['text_title'])=="") $titlecheck = false;
}  

$rad_attrs = array();

if(isset($meta_data['id'])) $rad_attrs[] = 'id="'.$meta_data['id'].'"';
//if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none")  $rad_attrs[] = 'data-waycheck="'.$w['visibility'].'"';
if(isset($w['delay'])) $rad_attrs[] = 'data-delay="'.$w['delay'].'"';

if($testable) {
$rad_attrs[] = 'data-type="'.$meta_data['widget']['type'].'"';
$rad_attrs[] = 'data-fields="'.$keys.'"';
}
$joint = strtolower( str_replace(" ","_",trim($meta_data['widget']['type']) ) );

$way = '';
//if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") $way = 'way-animated';
$rad_attrs[] = 'class="'.$joint.'-wrapper clearfix page-rad-component rad-component-spacing '.$layout_type.' '.$way.'"';

 ?>

<div <?php echo join(" ",$rad_attrs) ?>>

	<div class="gallery-inner-wrap inner-common <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'way-animated'; ?>"  <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'data-waycheck="'.$w['visibility'].'"'; ?>>
		
		<?php if(isset($w['text_title']) && $titlecheck) : ?>
		<div class="text-title-wrap" itemscope itemtype="http://schema.org/Thing">
			<h2 itemprop="name" class="text_title <?php if($hidden_data['text_title']) echo $hidden_data['text_title']; ?> custom-font1"><?php echo $helper->format($w['text_title'],true,false,false); ?></h2>
			<span class="spacer"></span>
		</div>
		<?php endif; ?>
	
		
		<div class="gallery-data "  itemscope itemtype="http://schema.org/ImageGallery" >

			<div class="ioa-gallery seleneGallery " data-effect_type="fade" data-thumbnails="<?php echo $w['bullets'] ?>" data-autoplay="<?php echo $w['autoplay'] ?>" data-caption="<?php echo $w['captions'] ?>" data-arrow_control="<?php echo $w['arrow_control'] ?>" data-duration="<?php echo $w['duration'] ?>" data-height="<?php if(isset($w['height'])) echo $w['height']; else '300'; ?>"  data-width="<?php if(isset($w['width'])) echo $w['width']; else '450'; ?>" > 
                <div class="gallery-holder">
					<?php if(isset($w['gallery_images']) && trim($w['gallery_images']) != "" ) : $ar = explode(";",stripslashes($w['gallery_images']));
						
						foreach( $ar as $image) :
							if($image!="") :
								$g_opts = explode("<<",$image)
						 ?>
						 <div class="gallery-item" data-thumbnail="<?php echo $g_opts[1]; ?>">
                      		<?php echo $helper->imageDisplay(array( "src" =>$g_opts[0] , 'imageAttr' =>  $g_opts[2], "parent_wrap" => false , "width" => $w['width'] , "height" => $w['height'] )); ?> 
                     		 <div class="gallery-desc">
                         	 	<h2 itemprop="name"><?php echo $g_opts[3] ?></h2>
                         	 	<div class="caption" itemprop="description"><?php echo $g_opts[4] ?></div>
                         	 </div>  
                  		 </div>	
					<?php 
						endif;
					endforeach; endif; ?>
				</div>
			</div>

		</div>	
		
	</div>
	<?php  if(get_transient('rad_session')) : ?>
	<div class="curtain <?php  if(isset($meta_data['state']) && $meta_data['state'] == "live" ) echo 'hide'; ?>"> <h4><?php echo str_replace("_"," ",$meta_data['widget']['type']) ?>  <span><?php _e('(Drag to Arrange)','ioa') ?></span> </h4> </div> 
	
	<div class="meta-data">
		
		<input type="hidden" class='component_layout' value="<?php echo $col ?>" />	
		<?php foreach ($radunits[$meta_data['widget']['type']]->getMetaKeys() as $key) : ?>
			<input type="hidden" class='<?php echo $key; ?>' value="<?php if(isset($w[$key])) echo $w[$key] ?>" />	
		<?php endforeach; ?>
	
	</div>
	<?php endif; ?>
</div>

<?php if(  $w['clear_float']=="yes") echo '<div class="clearfix empty_element"></div>'; ?>