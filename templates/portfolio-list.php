<?php
/**
 * The template used for generating Portfolio 4 Columns
 *
 * @package WordPress
 * @subpackage ASI Themes
 * @since IOA Framework V1
 */


global $helper,$meta_data,$portfolio_taxonomy,$portfolio_slug;

  if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  $meta_data['hasFeaturedImage'] = true;  ?>
        
        <?php 

         $dbg = '' ; $dc = ''; $cl = array();

          if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
          if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);
          
           $terms = get_the_terms( get_the_ID(), $portfolio_taxonomy );
                    
                   if ( $terms && ! is_wp_error( $terms ) ) : 
                    
                   $links = array();
                   foreach ( $terms as $term ) { 
                      $links[] = '<a href="' .get_term_link($term->slug, $portfolio_taxonomy) .'">'.$term->name.'</a>'; 
                      $cl[] = "category-".$term->slug;
                    }
                   $terms = join( ", ", $links );
                   endif;

         ?>  
          
        <li  itemscope itemtype="http://schema.org/Article" data-dbg='<?php echo $dbg; ?>' data-dc='<?php echo $dc; ?>' id="post-<?php the_ID(); ?>"  class="iso-item clearfix <?php echo join(' ',$cl); ?>  <?php $meta_data['i']++; if($meta_data['i']==1) echo 'first'; elseif($meta_data['i']==$meta_data['item_per_rows']) { echo 'last'; $meta_data['i']=0; } ?>">
          <div class="inner-item-wrap">
            
             <div class="date clearfix">
               <div class="datearea">
                  <small class='date'><?php echo get_the_date('d'); ?></small>
                  <small class='month'><?php echo get_the_date('M'); ?></small>

                  <div class="proxy-datearea" style='background:<?php echo $dbg; ?>;color:<?php echo $dc; ?>'>
                    <small class='date' ><?php echo get_the_date('d'); ?></small>
                    <small class='month' ><?php echo get_the_date('M'); ?></small>
                  </div>

               </div>
             </div>

              <?php if ( $meta_data['hasFeaturedImage']) : ?>   
              
              <div class="image-wrap">
               <div class="image" >
                <?php
                    $id = get_post_thumbnail_id();
                    $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
                    
                    switch($meta_data['thumb_resize'])
                    {

                    case 'proportional' :   echo $helper->imageDisplay(array( "crop" => "hproportional", "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  break;
                    default :   echo $helper->imageDisplay(array( "src" => $ar[0] , "height" => 220 , "width" => 320 , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  break;

                    } 
               
                ?>

             
                 <?php if($meta_data['portfolio_enable_thumbnail']!="true"): ?>
                    <a class="hover" itemprop='url' <?php echo 'style="background-color:'.$dbg.'"' ?> href="<?php the_permalink(); ?>" >  <i  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-link icon icon-link"></i></a>  
                 <?php else: ?>  
                     <a class="hover" itemprop='url' <?php echo 'style="background-color:'.$dbg.'"' ?>  href="<?php echo $ar[0]; ?>"  rel='prettyPhoto[pp_gal]'> <i title="<?php the_title() ?>"  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-lightbox lightbox icon-resize-full icon"></i></a>
                 <?php endif; ?> 


               </div>
                 
              </div>
              
             <?php endif; ?>

             <div class="desc">
                     <h2 class="" itemprop='name'> <a itemprop='url' href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
                      <div class="clearfix excerpt" itemprop='description'>
                  <?php  if(  $meta_data['portfolio_excerpt'] != "true") : ?>  
                    <p>
                      <?php
                      if(!isset($meta_data['portfolio_excerpt_limit']) || $meta_data['portfolio_excerpt_limit']=="") 
                        $meta_data['portfolio_excerpt_limit'] = 200;
                      
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
