<?php
/**
 * The Main Template. By Default shows Blog Posts.
 *
 * @package WordPress
 * @subpackage ASI Theme
 * @since IOA Framework V 1.0
 */

?>
<?php

/**
 * Prepare Page Variables before HEADER Template.
 */
$helper->preparePage();
get_header(); 

/**
 * Default Blog Values
 */
$meta_data['item_per_rows'] = 1;
$meta_data['width'] = 740;
$meta_data['height'] = 360;
$meta_data['post_extras'] = "[post_comments/]";
$meta_data['blog_excerpt'] = "true";
$meta_data['more_label'] = "more";
$meta_data['enable_thumbnail']="true";

$meta_data['layout'] = "right-sidebar"; 
$meta_data['sidebar'] = "Blog Sidebar";
?>   

<div class="page-wrapper <?php echo get_post_type() ?>">
	
	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full") echo 'has-sidebar has-'.$meta_data['layout'];  ?>">
			

			<div class="clearfix">
				<?php get_template_part('templates/blog-filter'); ?>
			</div>


			<div class="blog-format1-posts hoverable clearfix">
				<ul class="clearfix blog_posts">
					 <?php 
					 		

					 		$opts = array( 'paged' => $paged);
					 		query_posts($opts); 
					 		$meta_data['i']=0; 
					 		while (have_posts()) : the_post(); 

   							 		get_template_part('templates/post-blog-classic');  

   							endwhile; ?>
				</ul>	
			</div>

			
				<div class="pagination_wrap clearfix">
					<div class="pagination">
						<?php
							global $wp_query;

							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages
							) );
							wp_link_pages();
							?>
					</div>
					<?php wp_paginate_dropdown(); ?>
				</div>
		

		</div>
		
		<?php get_sidebar(); ?>

	</div>

</div>


<?php get_footer(); ?>
      