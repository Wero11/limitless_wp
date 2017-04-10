<?php
global $helper, $meta_data,$post,$super_options,$portfolio_taxonomy,$portfolio_slug;

$meta_data['item_per_rows'] = 1;
$meta_data['width'] = $super_options[SN.'_pmetro_width'];
$meta_data['height'] = 300;
$meta_data['column'] =  'one_fourth left';
$meta_data['thumb_resize'] =  "wproportional";
?>   


<div class="page-wrapper portfolio-metro-template <?php echo $post->post_type ?>" itemscope itemtype="http://schema.org/CollectionPage">
	
	<div class=" clearfix ">

		<div class="mutual-content-wrap ">
			
			

			<div class="metro-wrapper">
				<div class="portfolio-metro hoverable  clearfix">
			
					<ul class="clearfix"  itemscope itemtype="http://schema.org/ItemList">
						 <?php 
						 	if(is_front_page()) $paged = (get_query_var('page')) ? get_query_var('page') : 1;	
					 		$opts = array_merge(array( 'post_type' => $portfolio_slug ,  'posts_per_page' => $meta_data['portfolio_item_limit'] , 'paged' => $paged) , $meta_data['portfolio_query_filter']);
						 		
						 		query_posts($opts); 
						 		$meta_data['i']=0; 
						 		if(have_posts()) :
						 		while (have_posts()) : the_post(); 

	   							get_template_part('templates/portfolio-metro'); 
	   							endwhile; 
	   							else : 
									echo '<li class="no-posts-found "><h4>'.__('Sorry no posts found','ioa').'</h4></li>';
				
								endif; ?>
						 
					</ul>	

				</div>
			</div>


		</div>
		<?php if(have_posts()) : ?>	
		<div class="pagination_wrap clearfix">
					<?php wp_paginate(); ?>
					<?php wp_paginate_dropdown(); ?>
		</div>
		<?php endif; ?>
		
		

	</div>
	<?php  wp_reset_query(); ?>
	<?php rad_area_init(); ?>
	
</div>