<?php
/**
 * Featured Slider for Posts and Posts
 */
global $helper,$meta_data,$super_options;

/**
 * Gets the images from media tab in Panel.
 */
$gallery_images = get_post_meta(get_the_ID(),'ioa_gallery_data',true);
$cl = "false";

/**
 * Check if Slider is Full Width
 */
if( isset($meta_data['full_width']) && $meta_data['full_width']  ) $cl = "true";
?>

<div itemscope itemtype="http://schema.org/ImageGallery" class="ioaslider quartz" <?php if(isset($meta_data['adaptive_height']) && $meta_data['adaptive_height']=="true") echo "data-adaptive='true'" ?>  data-bullets="false" data-autoplay="false" data-effect_type="scroll" data-full_width="<?php echo $cl; ?>" data-caption="false" data-arrow_control="true" data-duration="5" data-height="<?php  echo $meta_data['height']; ?>"  data-width="<?php echo $meta_data['width']; ?>" > 
                <div class="items-holder" style="height:<?php echo $meta_data['height']; ?>px;">
					<?php if(isset($gallery_images) && trim($gallery_images) != "" ) : $ar = explode(";",stripslashes($gallery_images));
						
						foreach( $ar as $image) :
							if($image!="") :
								$g_opts = explode("<gl>",$image);

							
						 ?>
						 <div class="slider-item" data-thumbnail="<?php echo $g_opts[1]; ?>">
                      		<?php 
                      		if($cl=="true")
                      			echo "<img src='".$g_opts[0]."' />";	
                      		else
                      			echo $helper->imageDisplay(array( "src" =>$g_opts[0] , 'imageAttr' =>  $g_opts[2], "parent_wrap" => false , "width" => $meta_data['width'] , "height" => $meta_data['height'] )); 
                      		?> 
                     		 <div class="slider-desc">
                         	 	<h2 itemprop='name'><?php echo $g_opts[3] ?></h2>
                         	 	<div itemprop='description' class="caption"><?php echo $g_opts[4] ?></div>
                         	 </div>  
                  		 </div>	
					<?php 
						endif;
					endforeach; endif; ?>
				</div>
			</div>