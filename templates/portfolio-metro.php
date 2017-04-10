<?php
/**
 * The template used for generating Portfolio Metro
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
          
        <li itemscope itemtype="http://schema.org/Article" class=" clearfix  <?php $meta_data['i']++;  ?>">
          <div class="inner-item-wrap" style='background-color:<?php echo $dbg; ?>;color:<?php echo $dc; ?>;' >
            
            


              <?php if ( $meta_data['hasFeaturedImage']) : ?>   
            	
              <div class="image-wrap clearfix">
             	 <div class="image" >
                <?php
					  	      $id = get_post_thumbnail_id();
	          		    $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
					          
                    echo $helper->imageDisplay(array( "crop" => "hproportional", "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  
                    
				       
                ?>

				     <?php if($meta_data['portfolio_enable_thumbnail']!="true"): ?>
                    <a class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?> href="<?php the_permalink(); ?>" >  <i  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-link icon icon-link"></i></a>  
                 <?php else: ?>  
                     <a class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?>  href="<?php echo $ar[0]; ?>"  rel='prettyPhoto[pp_gal]'> <i title="<?php the_title() ?>"  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-lightbox lightbox icon-resize-full icon"></i></a>
                 <?php endif; ?> 
                
                
               </div>
              </div>
              
             <?php endif; ?>
              
              <div class="desc clearfix">
                  <h2 class="" itemprop='name'> <a itemprop='url' href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
              <?php
                  $terms = get_the_terms( $post->ID, $portfolio_taxonomy );
                    
                   if ( $terms && ! is_wp_error( $terms ) ) : 

                   $links = array();
                   foreach ( $terms as $term ) { $links[] = '<a href="' .get_term_link($term->slug, $portfolio_taxonomy) .'">'.$term->name.'</a>'; }
                   $terms = join( ", ", $links );
                  ?>

                  <p class="tags" style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' >
                     <?php echo $terms; ?>
                  </p>

              <?php endif; ?>

             
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
                  
                  


              </div>

          </div>  
        </li>

  <?php if( ceil($meta_data['portfolio_item_limit']/2) == $meta_data['i'] ) echo "</ul><ul class='clearfix'>"; ?>