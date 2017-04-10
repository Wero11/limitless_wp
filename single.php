<?php
 /**
 * The Template for displaying Single Posts / Single Portfolio / Single Custom Post.
 *
 * @package WordPress
 * @subpackage ASI Theme
 * @since IOA Framework V 1.0
 */

/**
 * Prepare Page Variables before HEADER Template.
 */

$helper->preparePage();

get_header(); 

/**
 * Condition To Check If Single Portfolio is there switch Template.
 * code for Single Portfolio can be found in content-single-portfolio.php
 * in templates folder.
 */

if($post->post_type==$portfolio_slug) :
	 get_template_part('templates/content-single-portfolio');
else :
?>   



<div class="page-wrapper <?php echo $post->post_type ?>"> <!-- Parent Wrapper -->
	
	<?php  if(! post_password_required()) : 
		/**
		 * Full Width Featured Media Items will appear here. 
		 * Note the switches are for condition checking on featured media Full or Contained. 
		 */
		if($super_options[SN.'_featured_image']!="false")
	 	switch($meta_data['featured_media_type'])
	 	{
	 		case "slider-full" :
	 		case "slider-contained" :
	 		case "slideshow-contained" :
	 		case "none-full" :
	 		case 'image-parallex' : 
	 		case 'image-full' : get_template_part('templates/content-featured-media'); break;
	 	}
	 	endif;
	?>

	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full" && $meta_data['layout']!="below-title" && $meta_data['layout']!="above-footer") echo 'has-sidebar sidebar-layout has-'.$meta_data['layout'];  ?>">
      
			
			<?php  
				if(! post_password_required()) : 
				/**
				 * Featured Media Items contained by parent width will appear here. 
				 */
			if($super_options[SN.'_featured_image']!="false")
			 	switch($meta_data['featured_media_type'])
			 	{
			 		case 'slider' :
			 		case 'slideshow' :
			 		case 'video' :
			 		case 'proportional' :
			 		case 'none-contained' :
			 		case 'image' :
			 		case '' : get_template_part('templates/content-featured-media'); break;
			 	}
			 	endif;
			?>
			
			<!-- Single Post Content Begins Here -->
			<?php  if(have_posts()): while(have_posts()) : the_post(); ?>
	
				<div class="post-content clearfix">
					
					<?php  if(! post_password_required()  ) : ?>

					<div class="meta-info clearfix">
						<div class="clearfix inner-meta-info">
							<?php echo do_shortcode($super_options[SN.'_single_meta']); ?>
							<!--
								<div class="comments"><?php echo do_shortcode('[post_comments/]'); ?></div>
								<div class="date"><?php echo do_shortcode('[post_date format="d, M Y"/]'); ?></div>
								<div class="categories"><?php echo do_shortcode('[post_categories/]'); ?></div>
								<div class="author"><?php echo do_shortcode('by [post_author_posts_link/]'); ?></div>
							-->

						</div>
						<?php if($super_options[SN."_social_share"]!="false") : 
								$id = get_post_thumbnail_id(get_the_ID());
                   				$thumb = wp_get_attachment_image_src($id,'medium'); 
						  ?>
						<div class="social clearfix">
							<a href="https://twitter.com/share/?url=<?php echo urlencode(get_permalink());  ?>&amp;text=<?php echo $helper->getShortenContent(100,get_the_title()) ?>" target="_BLANK" class='icon icon-twitter'></a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink());  ?>" target="_BLANK" class='icon icon-facebook'></a>
							<a href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink());  ?>" target="_BLANK" class='icon icon-google-plus'></a>
							<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink());  ?>&amp;media=<?php echo urlencode($thumb[0]); ?>&amp;description=<?php echo $helper->getShortenContent(100,get_the_excerpt()) ?>" target="_BLANK" class='icon icon-pinterest'></a>
						</div>
						<?php endif ?>
					</div>
				<?php  endif; ?>
					

					<?php
						/**
						 * Single Post Content. Additionally you can create separate template
						 * for post format in the format content-audio.php in templates folder.
						 */
						get_template_part( 'templates/content', get_post_format() ); 
					?>
					
					
				</div>
	
			<?php endwhile; endif; ?>
	

	<?php  if(! post_password_required()) : ?>
			
			<?php 
			/**
			 * RAD Builder Area. All Rad Widgets are Generated Here. DO NOT change anything.
			 */
			rad_area_init();
			 ?>
		
			
			<?php  $posttags = get_the_tags($post->ID);

			  if (isset($posttags) && !is_singular() ) { ?>
			<div class="post-tags clearfix">
				<?php echo do_shortcode('[post_tags sep="" icon="" /]'); ?>
			</div>
			<?php } ?>
			     
			<?php if($super_options[SN."_author_bio"]!="false") : ?>
			
		    <div id="authorbox" class="clearfix " >  
		      	<div class="author-avatar">
		      	      <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>  
		      	</div>
		      	<div class="authortext">   
		      		<h3 class="custom-font"><?php _e('About ','ioa'); the_author_meta('first_name'); ?></h3>
		      		<p><?php the_author_meta('description'); ?></p>  
		      	</div>  
		    </div>
		<?php endif; ?>
		

			<?php if($super_options[SN."_popular"]!="false")  get_template_part('templates/single-related-posts'); ?>

			
			<?php if($super_options[SN."_fb_comments"]!="false") : ?>
				<div class="fb_comments_template">

					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=165111413574616";
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>

					<div class="fb-comments" data-href="<?php the_permalink();?>" data-num-posts="2" data-width="740" data-height="120" ></div>

				</div>
     		<?php endif; ?>

			<?php comments_template(); ?>
			
		</div>

		<?php get_sidebar(); ?>
<?php endif; ?>
		

	</div>

</div> <!-- .page-wrapper -->
<?php endif; ?>

<?php get_footer(); ?>
      