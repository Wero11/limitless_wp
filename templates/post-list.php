<?php 
/**
 * Post List Template
 */
global $helper,$meta_data;

	if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))  $meta_data['hasFeaturedImage'] = true; 	?>
          
          
        <li itemscope itemtype="http://schema.org/ARticle" class="clearfix <?php $meta_data['i']++; if($meta_data['i']==1) echo 'first'; elseif($meta_data['i']==$meta_data['item_per_rows']) { echo 'last'; $meta_data['i']=0; } ?>">
            
            
            	
           		
              <div class="desc">
           			<h2 itemprop="name" class="custom-font"> <a itemprop="url" href="<?php the_permalink(); ?>" class="clearfix" ><?php the_title(); ?></a></h2> 
        	           <?php  if(isset($meta_data['meta_value']) && $meta_data['meta_value']!=""):  ?>   
                   <div class="extras clearfix"> 
                        <?php echo do_shortcode(stripslashes($meta_data['meta_value'])); ?> 
                    </div> 
                 <?php endif; ?> 

                  <?php if(isset($meta_data['excerpt']) && $meta_data['excerpt']!="no") : ?>
                  <div class="clearfix">
                    <p itemprop="description">
                      <?php
                       if(!isset($meta_data['excerpt_length'])) $meta_data['excerpt_length'] = 100;
                      $content = get_the_excerpt();
                      $content = apply_filters('the_content', $content);
                      $content = str_replace(']]>', ']]&gt;', $content);
                      echo $helper->getShortenContent( $meta_data['excerpt_length'] ,   $content); ?>
                    </p>
                  </div>
                  <?php endif ?>
           		</div>
                 
               
        </li>
