<?php
/**
 * The template used for generating Portfolio 4 Columns
 *
 * @package WordPress
 * @subpackage ASI Themes
 * @since IOA Framework V1
 */


global $helper,$meta_data,$paged,$super_options,$portfolio_taxonomy,$portfolio_slug;


if($meta_data['j']==0 && $paged == 0 ) : ?>

<li class="featured-block clearfix"  itemscope itemtype="http://schema.org/Article">
          
             <?php 
              
              $meta_data['width'] = 1060;
              $meta_data['height'] = $super_options[SN.'_ff_height'];

              get_template_part('templates/content-portfolio-featured-block');  ?>
             
          
        </li>


<?php $meta_data['j']++; else : 
  
  $meta_data['width'] = 530;
  $meta_data['height'] = $super_options[SN.'_ffa_height'];
 


	if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  $meta_data['hasFeaturedImage'] = true; 	?>
        
        <?php 

         $dbg = '' ; $dc = '';

          if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
          if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);
        
         ?>  
          
        <li  itemscope itemtype="http://schema.org/Article" data-dc='<?php echo $dc; ?>' data-dbg='<?php echo $dbg; ?>'  class=" clearfix <?php if( $meta_data['j']%2==0) echo 'align-left'; else echo 'align-right'; ?> <?php echo $meta_data['column']; ?> <?php $meta_data['i']++; if($meta_data['i']==1) echo 'first'; elseif($meta_data['i']==$meta_data['item_per_rows']) { echo 'last'; $meta_data['i']=0; } ?>">
          
          
          <div class="inner-item-wrap clearfix">
            
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
                  case "proportional" :  echo $helper->imageDisplay(array( "crop" => "hproportional" , "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  break;
                  case "default" :
                  default :   echo $helper->imageDisplay(array( "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  
                 
              }
                    
            
            ?>

               <?php if($meta_data['portfolio_enable_thumbnail']!="true"): ?>
                    <a itemprop='url' class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?> href="<?php the_permalink(); ?>" >  <i  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-link icon icon-link"></i></a>  
                 <?php else: ?>  
                     <a itemprop='url' class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?>  href="<?php echo $ar[0]; ?>"  rel='prettyPhoto[pp_gal]'> <i title="<?php the_title() ?>"  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-lightbox lightbox icon-resize-full icon"></i></a>
                 <?php endif; ?> 
                
              </div>
             </div>
              
              <?php
              endif;
              ?>
            

            <?php
              }
               ?>
              
             <div class="desc clearfix">
                 
                  <div class="title-area clearfix">
              <span class="date"><small class='no'><?php echo get_the_date('d'); ?></small> <small class='rest'><?php echo get_the_date('M y'); ?></small></span>
              <div class="title-meta-info clearfix">
                   <h2 class="" itemprop='name'> <a href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
                 <?php
                    $terms = get_the_terms( $post->ID, $portfolio_taxonomy );
                    
                    if ( $terms && ! is_wp_error( $terms ) ) : 

                    $links = array();
                    foreach ( $terms as $term ) { $links[] = '<a href="' .get_term_link($term->slug, $portfolio_taxonomy) .'">'.$term->name.'</a>'; }
                    $terms = join( ", ", $links );
                    ?>

                    <p class="tags">
                     <?php echo 'in '. $terms; ?>
                    </p>

                 <?php endif; ?>
              </div>

          </div>
                
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
                  
                  <a href="<?php the_permalink(); ?>" itemprop='url' class="read-more"><?php echo stripslashes($meta_data['portfolio_more_label']) ?></a>   

             </div> 

          </div>  
        </li>
        <?php $meta_data['j']++;  endif;   ?>

