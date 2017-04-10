<?php
global $helper, $meta_data,$post,$super_options;


$meta_data['item_per_rows'] = 2;
$meta_data['width'] = 330;
$meta_data['height'] = $super_options[SN.'_bt8_height'];
$meta_data['post_extras'] = get_post_meta(get_the_ID(),'blog_metadata',true);

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


<div class="page-wrapper <?php echo $post->post_type ?>" itemscope itemtype="http://schema.org/Blog">
	<div class="rad-holder clearfix" data-id="<?php echo get_the_ID(); ?>" >
				<?php get_template_part('templates/rad/construct'); ?>
	</div>
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
			?>
			

			<div class="blog-format10-posts hoverable clearfix">
					 <?php 
					 		
					 	get_template_part('templates/post-blog-timeline');  
						?>
			</div>

			
		

		</div>


		
		<?php get_sidebar();  wp_reset_query(); ?>
	</div>
	

</div>