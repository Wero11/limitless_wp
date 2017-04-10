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
            $cl = array();
                   $links = array();
                   
          if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
          if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);
        
              $terms = get_the_terms( get_the_ID(), $portfolio_taxonomy );
                    
                   if ( $terms && ! is_wp_error( $terms ) ) : 
                 
                   foreach ( $terms as $term ) { 
                      $links[] = '<a href="' .get_term_link($term->slug, $portfolio_taxonomy) .'">'.$term->name.'</a>'; 
                      $cl[] = "category-".$term->slug;
                    }
                   $terms = join( ", ", $links );
                  endif; ?>  
          
        <li itemscope itemtype="http://schema.org/Article" data-dbg='<?php echo $dbg; ?>' data-dc='<?php echo $dc; ?>' id="post-<?php the_ID(); ?>"  class="iso-item clearfix <?php echo join(' ',$cl); ?>  <?php $meta_data['i']++;  ?>">
          <span class="loader"></span>
          <div class="inner-item-wrap">
            
            

            


              <?php 

              $mt =  get_post_meta( get_the_ID(), 'featured_media_type', true );

              switch($mt)
              {

                /*
                 * case "video" : ?>   
                               <div class="video">
                                   <?php $video =  get_post_meta( get_the_ID(),"featured_video",true);  echo wp_oembed_get(trim($video),array( "width" => $meta_data['width'] , 'height' => $meta_data['height']) ) ; ?>
                               </div>
                              <?php break;
                 
                case "gallery" : get_template_part("templates/post-featured-gallery"); break;
                case "slider" :get_template_part("templates/post-featured-slider"); break; */
                case "image" : 
                default : ?>
      
            
              <?php if ( $meta_data['hasFeaturedImage']) : ?>   
              
             <div class="image-wrap">
               <div class="image" >
               <?php



              $id = get_post_thumbnail_id();
                    $ar = wp_get_attachment_image_src( $id , array(9999,9999) );

              switch($meta_data['thumb_resize'])
              {
                  case "none" : echo "<img src='".$ar[0]."' alt='".get_the_title()."' />";  break;
                  case "proportional" :  echo $helper->imageDisplay(array( "crop" => "wproportional" , "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  break;
                  case "default" :
                  default :   echo $helper->imageDisplay(array( "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  
                 
              }
                    
            
            ?>

            <div class="hoverdir-wrap">
              <div class="hoverdir" <?php echo 'style="background-color:'.$dbg.'"' ?>>


                <div class="desc" <?php echo 'style="color:'.$dc.';"' ?>>
                 <h2 itemprop='name' class=""> <a itemprop='url' href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
                  <p class="tags">
                     <?php echo $terms; ?>
                  </p>

                   <?php if($meta_data['portfolio_enable_thumbnail']!="true"): ?>
                     <a href="<?php the_permalink(); ?>" itemprop='url' style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-link icon icon-link"></a>  
                 <?php else: ?>  
                     <a href="<?php echo $ar[0]; ?>" itemprop='url' rel='prettyPhoto[pp_gal]' title="<?php the_title() ?>"  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-lightbox lightbox icon-resize-full icon"></a>
                 <?php endif; ?>  
               </div>
                </div>

                
             </div>   

              </div>
             </div>
              
              <?php
              endif;
              ?>
            

            <?php
              }
               ?>
          </div>  
        </li>
