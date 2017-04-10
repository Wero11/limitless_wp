<?php 
/**
 * Featured Media for Posts
 */
global $helper, $super_options , $meta_data ,$post; 

if(function_exists('rev_slider_shortcode') && $meta_data['layered_media_type']!="none"  && $meta_data['layered_media_type']!="")
	{
		?> <div class='top-layered-slider'> <?php
		putRevSlider($meta_data['layered_media_type']);
		?> </div> <?php 	
		 return;
	}


if(function_exists('lsSliders') && $meta_data['klayered_media_type']!="none"  && $meta_data['klayered_media_type']!="")
	{
		?> <div class='top-layered-slider'> <?php
		echo do_shortcode('[layerslider id="'.$meta_data['klayered_media_type'].'"]');
		?> </div> <?php 	
		 return;
	}



 switch($meta_data['featured_media_type'])
		    {
		    	
		    	case 'image' : ?> 
						<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
							
							<div class="single-image clearfix">
								<?php

								$id = get_post_thumbnail_id();
							    $ar = wp_get_attachment_image_src( $id, array(9999,9999) );

								echo $helper->imageDisplay( array( "src"=> $ar[0] ,"height" =>  $meta_data['height'] , "width" =>  $meta_data['width'] , "parent_wrap" => false ) );   
							 	?> 
							</div>
					 		
						<?php  endif;  ?>		
		


		    	<?php break;

		    	case 'image-full' : 
		    	   if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail(get_the_ID()))) :
		    	   	$pr ='';
		    		if($meta_data['adaptive_height']=='true') 
		    			{
		    				$meta_data['height'] = "auto";
		    				$pr ='adaptive_height'; 
		    			}
		    		else $meta_data['height'] = $meta_data['height'].'px;';
					$id = get_post_thumbnail_id();
				    $ar = wp_get_attachment_image_src( $id, array(9999,9999) );

				    if($meta_data['background_image']!="")
				    {
				    	$meta_data['background_image'] = 'background-image:url('.$meta_data['background_image'].')';
				    }

		    		echo "<div class='full-width-image-wrap $pr' style='".$meta_data['background_image'].";height:".$meta_data['height']."'  itemscope itemtype='http://schema.org/ImageObject'><img itemprop='url' src='".$ar[0]."' alt='featured image' /></div>";
		    		endif;
		    	   break;

		    	case 'image-parallex' :  
		    		if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail(get_the_ID()))) :
		    		$id = get_post_thumbnail_id();
				    $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
		    		echo "<div class='full-width-image-wrap image-parallex' style='height:".$meta_data['height']."px;background:url(".$ar[0].") left top no-repeat;background-attachment:fixed;background-size:cover'></div>";
		    		endif;
		    		break;	  
		    	
		    	case 'none-contained' :
		    		if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) :
					$id = get_post_thumbnail_id();
				    $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
		    		echo "<div class='contained-image-wrap' itemscope itemtype='http://schema.org/ImageObject'><img itemprop='image' src='".$ar[0]."' alt='featured image' /></div>";  
		    		endif;
					 break;

				case 'proportional' :	 ?> 
						<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) : ?>
							
							<div class="single-image clearfix">
								<?php

								$id = get_post_thumbnail_id();
							    $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
								echo $helper->imageDisplay( array( "crop" => "wproportional", "src"=> $ar[0] ,"height" =>  $meta_data['height'] , "width" =>  $meta_data['width'] , "parent_wrap" => false ) );   
							 	?> 
							</div>
					 		
						<?php  endif;  		
		 
						break;
		    	case  "none-full" : 
					
		    	    if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) :
					$id = get_post_thumbnail_id();
				    $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
		    		echo "<div class='top-image-wrap' style='background-image:url(".$meta_data['background_image'].");' itemscope itemtype='http://schema.org/ImageObject'><img itemprop='image' src='".$ar[0]."' alt='featured image' /></div>";  
					endif;	
					 break;

				case  "slideshow" : ?> <div class="featured-gallery"> <?php  get_template_part("templates/post-featured-gallery"); ?> </div> <?php break;
				case  "slideshow-contained" : ?> <div class="featured-gallery featured-gallery-contained"> <?php $meta_data['width'] = 1060;  get_template_part("templates/post-featured-gallery"); ?> </div> <?php break;

				case  "slider" : ?> <div class="featured-slider"> <?php  get_template_part("templates/post-featured-slider"); ?> </div> <?php break;
				case  "slider-contained" : ?> <div class="featured-slider featured-slider-contained"> <?php $meta_data['width'] = 1060;  get_template_part("templates/post-featured-slider"); ?> </div> <?php break;
				case  "slider-full" : ?> <div class="featured-slider featured-slider-full"  style='background-image:url(<?php echo $meta_data['background_image'] ?>);'> <?php $meta_data['full_width'] = true;  get_template_part("templates/post-featured-slider"); ?> </div> <?php break;


				case  "video" : ?>
					  <div class="video">
                                   <?php $video =  get_post_meta( get_the_ID(),"featured_video",true);  

                                   echo fixwmode_omembed(wp_oembed_get(trim($video),array( "width" => $meta_data['width'] , 'height' => $meta_data['height']) ) ); ?>
                               </div>  
					 <?php break;	 

		    	default : 
		    		if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) :
	  	    		    the_post_thumbnail(array(1030,450));
  	    		    endif;
  	    	       break;
		    }
		    


?>
