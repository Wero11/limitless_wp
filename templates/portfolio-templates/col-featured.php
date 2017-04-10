<?php

global $helper, $meta_data,$post,$super_options,$portfolio_taxonomy,$portfolio_slug;
$meta_data['layout'] = 'full';
$meta_data['item_per_rows'] = 1;

$meta_data['column'] =  '';
$meta_data['thumb_resize'] =  get_post_meta($post->ID,'portfolio_image_resize',true);
?>   

<?php  
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

<div class="page-wrapper portfolio-template <?php echo $post->post_type ?>" itemscope itemtype="http://schema.org/CollectionPage">
	
	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full") echo 'has-sidebar has-'.$meta_data['layout'];  ?>">
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
			 	if(is_front_page()) $paged = (get_query_var('page')) ? get_query_var('page') : 1;
			 	$opts = array_merge(array( 'post_type' => $portfolio_slug,  'posts_per_page' => $meta_data['portfolio_item_limit'] , 'paged' => $paged) , $meta_data['portfolio_query_filter']);
				query_posts($opts); 
			?>
			
			

			

			<div class="portfolio-columns hoverable featured-column clearfix">
				
				<ul class="clearfix" itemscope itemtype="http://schema.org/ItemList">
					 <?php 
					 		
					 		
					 		$meta_data['i']=0; $meta_data['j']=0;
					 		if(have_posts()) :
					 		while (have_posts()) : the_post(); 

   							get_template_part('templates/portfolio-feature-cols'); 
   							 

   							endwhile;
   							else : 
   								echo ' <li class="no-posts-found"><h4>'.__('Sorry no posts found','ioa').'</h4></li> ';
   								
   							endif;
   							 ?>
				</ul>	
			</div>

				<?php if(have_posts()) : ?>
				<div class="pagination_wrap clearfix">
					<?php wp_paginate(); ?>
					<?php wp_paginate_dropdown(); ?>
				</div>
			<?php endif; ?>
			

		</div>


	</div>
	<?php  wp_reset_query(); ?>
	<?php rad_area_init(); ?>
	
</div>

