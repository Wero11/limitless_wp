<?php
/**
 * Featured Gallery for Pages & Posts
 */
global $helper,$meta_data,$super_options;

$gallery_images = get_post_meta(get_the_ID(),'ioa_gallery_data',true);
$cl = ''


?>

<div class="ioa-gallery seleneGallery " itemscope itemtype="http://schema.org/ImageGallery"  data-thumbnails="true" data-autoplay="false" data-effect_type="fade" data-caption="false" data-arrow_control="true" data-duration="5" data-height="<?php  echo $meta_data['height']; ?>"  data-width="<?php echo $meta_data['width']; ?>" > 
                <div class="gallery-holder" style="height:<?php echo $meta_data['height']; ?>px;">
					<?php if(isset($gallery_images) && trim($gallery_images) != "" ) : $ar = explode(";",stripslashes($gallery_images));
						
						foreach( $ar as $image) :
							if($image!="") :
								$g_opts = explode("<gl>",$image);

							
						 ?>
						 <div class="gallery-item" data-thumbnail="<?php echo $g_opts[1]; ?>">
                      		<?php echo $helper->imageDisplay(array( "src" =>$g_opts[0] , 'imageAttr' =>  $g_opts[2], "parent_wrap" => false , "width" => $meta_data['width'] , "height" => $meta_data['height'] )); ?> 
                     		 <div class="gallery-desc">
                         	 	<h2 itemprop='name'><?php echo $g_opts[3] ?></h2>
                         	 	<div itemprop='description' class="caption"><?php echo $g_opts[4] ?></div>
                         	 </div>  
                  		 </div>	
					<?php 
						endif;
					endforeach; endif; ?>
				</div>
			</div>