<?php

global $helper, $meta_data,$post,$super_options,$portfolio_slug,$portfolio_taxonomy;
$meta_data['item_per_rows'] = 3;
$meta_data['width'] = 353;
$meta_data['height'] = $super_options[SN.'_p3_height'];
$meta_data['column'] =  'one_third left';

$cl = "portfolio-columns  three-column";
if(isset($_GET['view']) && $_GET['view'] == "list"  ) $cl = "portfolio-list";


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


<div class="page-wrapper portfolio-template <?php echo $post->post_type.' '.$meta_data['thumb_resize'].'-resize'; ?>" itemscope itemtype="http://schema.org/CollectionPage">
	
	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap iso-parent <?php if($meta_data['layout']!="full") echo 'has-sidebar has-'.$meta_data['layout'].' has-sidebar';  ?>">
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
			
			
			<?php if(have_posts()) : ?>
			<div class="clearfix">
				<?php if($super_options[SN.'_portfolio_switch']!="false") get_template_part('templates/portfolio-view'); ?>
				<?php if($super_options[SN.'_portfolio_filter']!="false") get_template_part('templates/portfolio-filter'); ?>
			</div>
			<?php endif; ?>

			<div class=" <?php echo $cl ?> hoverable  clearfix">
				<ul class="clearfix portfolio_posts isotope" itemscope itemtype="http://schema.org/ItemList">
					 <?php 
					 

					 		
					 		$meta_data['i']=0; 

					 		$v = 'grid';
					 		if(isset($_GET['view']) && $_GET['view'] == "list"  ) $v = "list";

					 		if(have_posts()) :
					 		while (have_posts()) : the_post(); 	

					 		switch ($v) {
					 			case 'list': get_template_part('templates/portfolio-list');  break;
					 			case 'grid': default : get_template_part('templates/portfolio-cols');  break;
					 		}
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


		
		<?php get_sidebar(); ?>

	</div>
			<?php  wp_reset_query(); ?>
	
	<?php rad_area_init(); ?>
	
</div>

