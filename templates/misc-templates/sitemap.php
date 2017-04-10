<?php
global $helper, $meta_data,$post,$super_options;

    switch($meta_data['featured_media_type'])
    {
      case "slider-full" :
      case "slider-contained" :
      case "slideshow-contained" :
      case "none-full" :
      case 'image-parallex' : 
      case 'image-full' : get_template_part('templates/content-featured-media'); break;
    }
  ?>

<div class="page-wrapper <?php echo $post->post_type ?>"  itemscope itemtype="http://schema.org/WebPage">
  
  <div class="skeleton clearfix auto_align">

    

    <div class="mutual-content-wrap clearfix sitemap <?php if($meta_data['layout']!="full") echo 'has-sidebar has-'.$meta_data['layout'];  ?>">
      <?php  
        switch($meta_data['featured_media_type'])
        {
          case 'slider' :
          case 'slideshow' :
          case 'video' :
          case 'proportional' :
          case 'none-contained' :
          case 'image' : get_template_part('templates/content-featured-media'); break;
        }
      ?>

      <?php  if(have_posts()): while(have_posts()) : the_post(); ?>
      
        <?php if(get_the_content()!="") : ?>
          <div class="page-content clearfix">
            <?php  the_content(); ?>
          </div>
        <?php endif; ?>
    
      <?php endwhile; endif; ?>
        
      <div class="one_half left first">
     
         <h2>Pages</h2>
                <ul>
                  <?php
                     wp_list_pages(   array( 'exclude' => '', 'title_li' => '' ) );
                  ?>
                 </ul>
          </div>     
        
          <div class="one_half left last ">  
            
             <h2><?php _e('Posts','ioa'); ?></h2>
                <ul class="cats">
            <?php 
        
            $category_ids = get_all_category_ids();
            foreach($category_ids as $cat_id) {
            $cat_name = get_cat_name($cat_id);
            echo "<li> <h5 > $cat_name </h5><ul class='subcats'>";

            $query = new WP_Query();

            $query->query('cat='.$cat_id.'');
            while ($query->have_posts()) : $query->the_post();  
            echo " <li><a href=\"".get_permalink()."\">". get_the_title()  ."  </a></li>";
            endwhile; 

            echo "</ul></li>";

            }
              ?>
                  </ul> 
        </div>


      
      
    </div>


    
    <?php get_sidebar();  wp_reset_query(); ?>

  </div>
  <?php rad_area_init(); ?>
   

</div>