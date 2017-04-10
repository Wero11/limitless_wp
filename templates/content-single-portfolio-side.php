
<?php
global $meta_data,$super_options,$post,$portfolio_taxonomy,$portfolio_slug;

$meta_data['layout'] = "full";

?>   



<div class="page-wrapper  <?php echo $post->post_type ?>"  itemscope itemtype='http://schema.org/WebPage'>
	
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
         

	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full" && $meta_data['layout']!="below-title" && $meta_data['layout']!="above-footer") echo 'has-'.$meta_data['layout'];  ?>">
         
			
			<div class="clearfix">
				<div class="one_half side-featured-media left">
					 <?php  
					 $meta_data['width'] = 520;
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
					<?php get_template_part( 'templates/single-portfolio-meta'); ?>
		
				</div>
			<?php  if(have_posts()): while(have_posts()) : the_post(); ?>
	
				<div class="single-portfolio-content page-content side-single-portfolio-content one_half left">
					

					<?php get_template_part( 'templates/content', get_post_format() ); ?>
					
					
				</div>
	
			<?php endwhile; endif; ?>

			</div>
			

	<?php rad_area_init(); ?>
			
			
			<div class="portfolio-navigation clearfix" itemscope itemtype='http://schema.org/SiteNavigationElement'>
				<?php next_post_link('<span class="next" itemprop="url"> %link &rarr; </span>'); ?>
				<?php previous_post_link('<span class="previous" itemprop="url"> &larr; %link </span>'); ?>  
			</div>

			<?php get_template_part('templates/single-related-portfolio'); ?>

			

		</div>


	

	</div>

</div>

