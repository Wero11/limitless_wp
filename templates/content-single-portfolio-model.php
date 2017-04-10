
<?php
global $meta_data,$super_options,$post,$portfolio_taxonomy,$portfolio_slug;

$meta_data['layout'] = "full";
$gallery_images = get_post_meta(get_the_ID(),'ioa_gallery_data',true);

?>   



<div class="page-wrapper single-portfolio-modelie <?php echo $post->post_type ?>"  itemscope itemtype='http://schema.org/WebPage'>
	

	<?php  if(isset($gallery_images) && trim($gallery_images) != "" && count($gallery_images) > 0  ) :  ?>

		<div class=" view-pane clearfix" data-id='<?php echo get_the_ID(); ?>' data-dc="<?php echo get_post_meta(get_the_ID(),"dominant_bg_color",true); ?>" >
				<span class="loader"></span>
				<div class="inner-view-pane">
					<ul class="clearfix portfolio_posts">
						<li class='span-class'><span class="loader"></span></li>
					</ul>
				
				</div>	

			</div>	
     <?php else : 
		$meta_data['featured_media_type'] = 'image';
	 	get_template_part('templates/content-featured-media');

	 endif; ?>   	 

	<div class="skeleton clearfix auto_align">

	
		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full" && $meta_data['layout']!="below-title" && $meta_data['layout']!="above-footer")  echo 'has-sidebar sidebar-layout  has-'.$meta_data['layout']; ?>">
         
				<?php  if(have_posts()): while(have_posts()) : the_post(); ?>
	
				<div class="single-portfolio-content page-content">
					
					<?php get_template_part( 'templates/single-portfolio-meta'); ?>

					<?php get_template_part( 'templates/content', get_post_format() ); ?>
					
					
				</div>
	
			<?php endwhile; endif; ?>
				

		</div>

	</div>

	<?php rad_area_init(); ?>
	
	
	<div class="skeleton clearfix auto_align">

		<div class="portfolio-navigation clearfix" itemscope itemtype='http://schema.org/SiteNavigationElement'>
			<?php next_post_link('<span class="next" itemprop="url"> %link &rarr; </span>'); ?>
			<?php previous_post_link('<span class="previous" itemprop="url"> &larr; %link </span>'); ?>  
		</div>

		<?php get_template_part('templates/single-related-portfolio'); ?>
	</div>		

</div>

