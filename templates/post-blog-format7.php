<?php
/**
 * The template used for generating blog template Format Full Width
 *
 * @package WordPress
 * @subpackage ASI Themes
 * @since IOA Framework V1
 */


global $helper,$meta_data;
$meta_data['hasFeaturedImage'] = false; 

  if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  $meta_data['hasFeaturedImage'] = true;  ?>
        
        <?php 

         $dbg = '' ; $dc = '';

          if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
          if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);


         ?>  
          
        <li itemscope itemtype="http://schema.org/Article" data-dbg='<?php echo $dbg; ?>' data-dc='<?php echo $dc; ?>' id="post-<?php the_ID(); ?>"  class="  clearfix <?php echo join(' ',get_post_class()); ?> <?php $meta_data['i']++; if($meta_data['i']==1) echo 'first'; elseif($meta_data['i']==$meta_data['item_per_rows']) { echo 'last'; $meta_data['i']=0; } ?>">
            <?php 
            $code = "background: $dbg";

             ?>
            <div class="overlay" style='<?php echo $code; ?>'></div>
            <div class="skeleton auto_align clearfix">
              

              <div class="desc">
                
                   <h2 class="" itemprop='name'> <a itemprop='url' href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
               <?php if(isset($meta_data['blogmeta_enable']) && $meta_data['blogmeta_enable']!="false") : ?>
                  <div class="extra clearfix">
                    <?php echo do_shortcode($meta_data['post_extras']); ?>
                  </div>        
           <?php endif; ?>
                 <span class="spacer"></span> 
                <div class="clearfix excerpt" itemprop='description'>
                  <?php  if(  $meta_data['blog_excerpt'] != "true") : ?>  
                    <p>
                      <?php
                      
                      $content = get_the_content();
                      $content = apply_filters('the_content', $content);
                      $content = str_replace(']]>', ']]&gt;', $content);
                      echo $helper->getShortenContent( $meta_data['posts_excerpt_limit'] ,   $content); ?>
                    </p>
                   <?php else:  the_excerpt(); endif; ?>

                  </div>
                       <a href="<?php the_permalink(); ?>" class="read-more"><?php echo stripslashes($meta_data['more_label']) ?></a>  
                      
                  
                  
                 
              </div>

           

            <?php 

              $mt =  get_post_meta( get_the_ID(), 'featured_media_type', true );

              switch($mt)
              {

                case "video" : ?>   
                               <div class="video">
                                   <?php $video =  get_post_meta( get_the_ID(),"featured_video",true); echo fixwmode_omembed(wp_oembed_get(trim($video),array( "width" => $meta_data['width'] , 'height' => $meta_data['height']) )) ; ?>
                               </div>
                              <?php break;
                case "gallery" : get_template_part("templates/post-featured-gallery"); break;
                case "slider" :get_template_part("templates/post-featured-slider"); break;
                case "image" : 
                default : ?>
      
            
              <?php if ( $meta_data['hasFeaturedImage']) : ?>   
              
             <div class="image-wrap">
               <div class="image" >
               <?php


              $id = get_post_thumbnail_id();
                    $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
              echo $helper->imageDisplay(array( "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  
            ?>

              <?php if($meta_data['enable_thumbnail']!="true"): ?>
                    <a class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?> href="<?php the_permalink(); ?>" >  <i  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-link icon icon-link"></i></a>  
                 <?php else: ?>  
                     <a class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?>  href="<?php echo $ar[0]; ?>"  rel='prettyPhoto[pp_gal]'> <i title="<?php the_title() ?>"  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-lightbox lightbox icon-resize-full icon"></i></a>
                 <?php endif; ?> 
                
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
        <?php $meta_data['j']++;  ?>
