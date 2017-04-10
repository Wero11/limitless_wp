<?php
/**
 * The template used for generating Post Format Link
 *
 * @package WordPress
 * @subpackage ASI Themes
 * @since IOA Framework V1
 */


global $helper,$meta_data,$super_options;


 $dbg = '' ; $dc = '';

  if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);
  if(get_post_meta(get_the_ID(),'dominant_color',true)!="") $dc =  get_post_meta(get_the_ID(),'dominant_color',true);
 ?>
      
      <li itemscope itemtype='http://schema.org/BlogPosting' id="post-<?php the_ID(); ?>" class="iso-item clearfix  <?php echo join(' ',get_post_class()); ?> <?php $meta_data['i']++; if($meta_data['i']==1) echo 'first'; elseif($meta_data['i']==$meta_data['item_per_rows']) { echo 'last'; $meta_data['i']=0; } ?>">
            
            
             
               <i class="icon icon-music"></i> 
              <div class="desc" itemprop="description">
                
               <?php the_content(); ?>
             
              </div>

                 
               <div class="datearea">
                  <small class='date'><?php echo get_the_date('d'); ?></small>
                  <small class='month'><?php echo get_the_date('M'); ?></small>

                  <div class="proxy-datearea" style='background:<?php echo $dbg; ?>;color:<?php echo $dc; ?>'>
                    <small class='date' ><?php echo get_the_date('d'); ?></small>
                    <small class='month' ><?php echo get_the_date('M'); ?></small>
                  </div>



               </div>

               <span class="line"></span>

        </li>

