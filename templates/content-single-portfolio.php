<?php
/**
 * Single Portfolio 
 */
global $meta_data,$super_options,$post,$portfolio_taxonomy,$portfolio_slug;

/**
 * Single Portfolio Template
 */
switch ($meta_data['single_portfolio_template']) {
	case 'full-screen': get_template_part('templates/content-single-portfolio-full-screen'); break;
	case 'full-screen-porportional': get_template_part('templates/content-single-portfolio-prop-screen'); break;
	case 'model': get_template_part('templates/content-single-portfolio-model'); break;
	case 'side': get_template_part('templates/content-single-portfolio-side'); break;
	case 'default' :
	default:
		

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

<div class="page-wrapper <?php echo $post->post_type ?>"  itemscope itemtype='http://schema.org/WebPage'>
	
	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full" && $meta_data['layout']!="below-title" && $meta_data['layout']!="above-footer") echo 'has-sidebar sidebar-layout  has-'.$meta_data['layout']; ?>">
         

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
	
				<div class="single-portfolio-content page-content">
					
					<?php get_template_part( 'templates/single-portfolio-meta'); ?>

					<?php get_template_part( 'templates/content', get_post_format() ); ?>
					
					
				</div>
	
			<?php endwhile; endif; ?>
	
			<?php rad_area_init(); ?>
			
			
			<div class="portfolio-navigation clearfix"  itemscope itemtype='http://schema.org/SiteNavigationElement'>
				<?php wp_reset_query(); next_post_link('<span class="next" itemprop="url"> %link &rarr; </span>'); ?>
				<?php previous_post_link('<span class="previous" itemprop="url"> &larr; %link </span>'); ?>  
			</div>

			<?php get_template_part('templates/single-related-portfolio'); ?>

			

		</div>


		
		<?php get_sidebar(); ?>

	</div>

</div>
      <?php
		break;
}