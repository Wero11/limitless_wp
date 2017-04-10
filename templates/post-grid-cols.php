<?php 
/**
 * Grid Generation for RAD Builder
 */
global $helper,$meta_data,$portfolio_taxonomy,$portfolio_slug;
$meta_data['hasFeaturedImage'] = false;
  if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  $meta_data['hasFeaturedImage'] = true;  ?>
          
           <?php 

          /**
           * Get Dominant background and color
           */
          $dbg = '' ; $dc = ''; $cl = '';

          if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
          if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);

          /**
           * Generate Terms for Portfolio
           */
          if($meta_data['post_type']==$portfolio_slug)  :
           $terms = get_the_terms( get_the_ID(), $portfolio_taxonomy );
                   $cl = array();
                   $links = array();
                     
                   if ( $terms && ! is_wp_error( $terms ) ) : 
                   
                   foreach ( $terms as $term ) { 
                      $links[] = '<a href="' .get_term_link($term->slug, $portfolio_taxonomy) .'">'.$term->name.'</a>'; 
                      $cl[] = "category-".$term->slug;
                    }
                   $terms = join( ", ", $links );
                   endif; 
           endif;

         ?>  

        <li itemscope itemtype="http://schema.org/Article" class="iso-item clearfix <?php if($meta_data['post_type']=="post") echo join(' ',get_post_class());  elseif($cl!="") echo join(' ',$cl); ?>  <?php $meta_data['i']++;  ?> ">
            
               <div class="inner-item-wrap chain-link">
                  

              <?php  if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  : ?>   
              
              <div class="image" >
               
                <?php
                $id = get_post_thumbnail_id();
                $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
           
                echo $helper->imageDisplay(array( "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  
                ?>

                <a class="hover" <?php echo 'style="background-color:'.$dbg.'"' ?> href="<?php the_permalink(); ?>" >  <i  style='color:<?php echo $dbg; ?>;background-color:<?php echo $dc; ?>' class="hover-link icon icon-link"></i></a>  
               


              </div>
              
              <?php
              endif;
              ?>
              
              <div class="desc">
                    <h2 itemprop="name" class="custom-font"> <a href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
                    
                    <?php if(isset($meta_data['meta_value']) && $meta_data['meta_value']!="")  : ?>
                    <div class="extras clearfix"> 
                        <?php  echo do_shortcode(stripslashes($meta_data['meta_value'])); ?> 
                    </div> 
                    <?php endif; ?>

                   <?php if(isset($meta_data['excerpt']) && $meta_data['excerpt']!="no") : ?>
                      
                  <div class="clearfix">
                    <p itemprop="description">
                      <?php
                      if(! isset( $meta_data['content_limit']) || trim($meta_data['content_limit'])=="")  $meta_data['content_limit'] = 100;

                      $content = get_the_excerpt();
                      $content = apply_filters('the_content', $content);
                      $content = str_replace(']]>', ']]&gt;', $content);
                      echo $helper->getShortenContent( $meta_data['content_limit'] ,   $content); ?>
                    </p>
                  </div>
                  <?php endif ?>
                 
              </div>
               </div>
                 
               
        </li>
