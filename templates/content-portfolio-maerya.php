<?php
/**
 * The template used for generating Portfolio 4 Columns
 *
 * @package WordPress
 * @subpackage ASI Themes
 * @since IOA Framework V1
 */


global $helper,$meta_data,$portfolio_taxonomy,$portfolio_slug;

	if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  $meta_data['hasFeaturedImage'] = true; 	?>
        
        <?php 

         $dbg = '' ; $dc = '';

          if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
          if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);
        

         ?>  
          
        <li  itemscope itemtype='http://schema.org/Article' data-id="<?php echo get_the_ID(); ?>" class=" clearfix  <?php $meta_data['i']++; if($meta_data['i']==1) echo 'first'; elseif($meta_data['i']==$meta_data['item_per_rows']) { echo 'last'; $meta_data['i']=0; } ?>">
          <div class="inner-item-wrap">
            
             


              <?php if ( $meta_data['hasFeaturedImage']) : ?>   
            	
              <div class="image-wrap">

                  <?php 
                  $tempc = '' ; if($dc!='') $tempc = "color:{$dc};"; 
                  $tempbg = '' ; if($dbg!='') $tempbg = "background-color:{$dbg};"; 
                  ?>
              	  <div class="meta-info" style="<?php echo $tempc.''.$tempbg ?>">
              	  	<a href="" class="close-section icon icon-remove"></a>
                   <h2 class="" itemprop='name'> <a itemprop='url' href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
                 	
              <span class="spacer" style='border-color:<?php echo $dc; ?>'></span>
                 <div class="clearfix excerpt" itemprop='description'>
                  <?php  if(  $meta_data['portfolio_excerpt'] != "true") : ?>  
                    <p>
                      <?php
                      
                      $content = get_the_content();
                      $content = apply_filters('the_content', $content);
                      $content = str_replace(']]>', ']]&gt;', $content);
                      echo $helper->getShortenContent( $meta_data['portfolio_excerpt_limit'] ,   $content); ?>
                    </p>
                   <?php else:  the_excerpt(); endif; ?>

                  </div>
                  
                  <a href="<?php the_permalink(); ?>"itemprop='url' style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-link"><?php echo stripslashes($meta_data['portfolio_more_label']) ?></a>  
                  
              </div>

             	 <div class="image" >
                <?php
					  	      $id = get_post_thumbnail_id();
	          		    $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
					          
                    echo $helper->imageDisplay(array(   "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));
                    
				       
                ?>
					<div class="stub clearfix">
						
						<h2 class=""> <a href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
								<?php
								$terms = get_the_terms( $post->ID, $portfolio_taxonomy );

								if ( $terms && ! is_wp_error( $terms ) ) : 

								$links = array();
								foreach ( $terms as $term ) { $links[] = '<a href="' .get_term_link($term->slug, $portfolio_taxonomy) .'">'.$term->name.'</a>'; }
								$terms = join( ",", $links );
								?>

								<p class="tags">
								<?php echo $terms; ?>
								</p>

							<?php endif; ?>

					</div>		

				      <div class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?>>
								<div class="hover-inner-wrap">
									<div class="proxy" <?php echo 'style="background-color:'.$dbg.';color:'.$dc.';"' ?>>
									<h2 style="border-color:<?php echo $dc; ?>"> <a href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
								<?php
								$terms = get_the_terms( $post->ID, $portfolio_taxonomy );

								if ( $terms && ! is_wp_error( $terms ) ) : 

								$links = array();
								foreach ( $terms as $term ) { $links[] = '<a href="' .get_term_link($term->slug, $portfolio_taxonomy) .'">'.$term->name.'</a>'; }
								$terms = join( ", ", $links );
								?>

								<p class="tags">
								<?php echo $terms; ?>
								</p>

								<?php endif; ?>
								</div>

								</div>
             		   </div>
                
               </div>
              </div>
              
             <?php endif; ?>
          </div>  
        </li>
