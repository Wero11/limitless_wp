<?php 
/**
 * Single Portfolio Post Related Section
 */
global $helper,$super_options,$portfolio_taxonomy,$portfolio_slug; 
/**
       * Related Posts Logic
       */
     $filter = wp_get_post_terms($post->ID, $portfolio_taxonomy );
     $f_c = array();
     foreach($filter as $f)
     $f_c[]  =  $f->name;
   
    if(count($filter) >0 ) : 


     $args = array(
        'post_type' => $portfolio_slug,
      'posts_per_page' => 4,
      'post__not_in' => array($post->ID),
      'tax_query' => array(
        array(
          'taxonomy' => $portfolio_taxonomy,
          'field' => 'slug',
          'terms' => $f_c
        )
       )
     );

   

    $rel = new WP_Query( $args ); ?>


<?php if($super_options[SN.'_single_portfolio_related_enable']!="" && $rel->have_posts()) : ?>

  <div class="related_posts portfolio_related_posts clearfix" itemscope itemtype="http://schema.org/ItemList">
          
     <div class="clearfix related_posts-title-area ">
        <h3 itemprop='name' class="single-related-posts-title custom-title"><?php echo stripslashes($super_options[SN.'_single_portfolio_related_title']) ?></h3> 
    </div>

<?php 



 ?>


<div class="related-posts-wrap clearfix">
    
    <ul class="clearfix active single-related-posts related" >
    
    <?php 
      
    $i=0;
    while ($rel->have_posts()) : $rel->the_post();   $i++; ?>

    <li class="clearfix <?php if($i==4) echo 'last'; ?>" itemscope itemtype="http://schema.org/Article">
    
      <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>

      <div class="image">
        <a class="hover" href="<?php the_permalink() ?>" style='background-color:<?php echo get_post_meta(get_the_ID(),'dominant_bg_color',true) ?>;color:<?php echo get_post_meta(get_the_ID(),'dominant_color',true) ?>;'>
          <h3 itemprop="name" style='color:<?php echo get_post_meta(get_the_ID(),'dominant_color',true) ?>;'><?php the_title(); ?></h3>
          <i style='color:<?php echo get_post_meta(get_the_ID(),'dominant_bg_color',true) ?>;background-color:<?php echo get_post_meta(get_the_ID(),'dominant_color',true) ?>;' class='link icon icon-link'></i>
        </a>
        <?php
          $id = get_post_thumbnail_id();
          $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
          echo $helper->imageDisplay( array( "src"=> $ar[0] ,"height" => 140 , "width" => 180 , "parent_wrap" => false, 'link' => get_permalink() ) );
          ?>
      </div> 
      <?php endif; ?>
    
    </li>

<?php endwhile; ?>

<?php wp_reset_query(); ?>

</ul>

</div>

</div>

<?php endif; endif; ?>