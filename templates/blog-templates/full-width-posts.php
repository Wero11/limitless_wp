<?php
global $helper, $meta_data,$post,$super_options;

$meta_data['item_per_rows'] = 1;
$meta_data['width'] = 1060;
$meta_data['height'] = $super_options[SN.'_bt7_height'];
?>   

<div class="page-wrapper <?php echo $post->post_type ?>">
	
	<div class=" clearfix auto_align">

		

		<div class="">
			<?php get_template_part('templates/content-featured-media'); ?>

			
			
			


			<div class="blog-format7-posts hoverable clearfix" itemscope itemtype="http://schema.org/Blog">
				<ul class="clearfix blog_posts">

					 

					 <?php 
							if(is_front_page()) $paged = (get_query_var('page')) ? get_query_var('page') : 1;
					 			
					 		
					 		$opts = array_merge(array('posts_per_page' => $meta_data['posts_item_limit'] , 'paged' => $paged ,  'tax_query' =>  array(
                 array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-quote','post-format-chat', 'post-format-image','post-format-audio','post-format-status','post-format-aside','post-format-video','post-format-gallery','post-format-link'),
                    'operator' => 'NOT IN'
                  )
              )) , $meta_data['query_filter']);
					 		query_posts($opts); 
					 		$meta_data['i']=0; $meta_data['j']=0; 
					 		if(have_posts()) :
					 		while (have_posts()) : the_post(); 

   							 get_template_part('templates/post-blog-format7');  

   							endwhile;
   							else : 
   								echo ' <li class="auto_align skeleton no-posts-found"><h4>'.__('Sorry no posts found','ioa').'</h4></li> ';
   								
   							endif;
   							
   							 ?>
				</ul>	
			</div>

			<?php if(have_posts()) : ?>
				<div class="pagination_wrap clearfix">
					<div class="skeleton auto_align">
						<?php wp_paginate();  wp_reset_query(); ?>
						<?php wp_paginate_dropdown(); ?>
					</div>
				</div>
			<?php endif; ?>
		

		</div>


		
		

	</div>

</div>
