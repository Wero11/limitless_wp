<?php global $helper,$meta_data,$portfolio_taxonomy,$portfolio_slug;

if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  $meta_data['hasFeaturedImage'] = true; 	?>
        
        <?php 

         $dbg = '' ; $dc = '';

          if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
          if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);
        
         ?>  
          
       	
            
              <?php if ( $meta_data['hasFeaturedImage']) :

               $id = get_post_thumbnail_id();
             $ar = wp_get_attachment_image_src( $id , array(9999,9999) );

               ?>   
              
               <div  itemscope itemtype='http://schema.org/Article' class="gallery-item <?php echo $meta_data['thumb_resize']; ?>" data-thumbnail="<?php $th = wp_get_attachment_image_src($id); echo $th[0]; ?>">

                <?php

                  switch ($meta_data['thumb_resize']) {
                    
                    case 'default': echo $helper->imageDisplay(array( "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  break;
                    case 'proportional': echo $helper->imageDisplay(array( "crop" => "hproportional", "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "link" => get_permalink() ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  break;
                    case 'none' : 
                    default: echo "<img src='". $ar[0]."' />"; break;
                  }
                   
             // 
          
        ?>

          
          <div class="gallery-desc" >
              <h4 itemprop='name' class="" <?php echo 'style="background-color:'.$dbg.'"' ?>> <a href="<?php the_permalink(); ?>" style='color:<?php echo $dc ?>'class="clearfix" ><?php the_title(); ?></a></h4>
              <div itemprop='description' class="caption" <?php echo 'style="color:'.$dc.';background-color:'.$dbg.'"' ?>>
          
          
                  <?php  if(  $meta_data['portfolio_excerpt'] != "true") : ?>  
                    <p>
                      <?php
                      
                      $content = get_the_content();
                      $content = apply_filters('the_content', $content);
                      $content = str_replace(']]>', ']]&gt;', $content);
                      echo $helper->getShortenContent( $meta_data['portfolio_excerpt_limit'] ,   $content); ?>
                    </p>
                   <?php else:  the_excerpt(); endif; ?>

                 
                  
                     <a href="<?php the_permalink(); ?>" itemprop='url' style='color:<?php echo $dbg; ?>;background:<?php echo $dc; ?>' class="hover-link icon icon-external-link"></a>  

              </div> 
              </div>
                
              
              </div>
              
             <?php endif; ?>