<?php
 /**
 * The Template for displaying Pages and registered Custom Templates.
 * Theme uses concept of Flexi Templates not dependent on custom type
 * slug to select template.
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
 * Select Template or fallback to page.
 */
switch($meta_data['ioa_custom_template'])
{
	case 'ioa-template-portfolio-one-column' : get_template_part('templates/portfolio-templates/col-1'); break;
	case 'ioa-template-portfolio-two-column' : get_template_part('templates/portfolio-templates/col-2'); break;
	case 'ioa-template-portfolio-three-column' : get_template_part('templates/portfolio-templates/col-3'); break;
	case 'ioa-template-portfolio-four-column' : get_template_part('templates/portfolio-templates/col-4'); break;
	case 'ioa-template-portfolio-five-column' : get_template_part('templates/portfolio-templates/col-5'); break;
	case 'ioa-template-portfolio-featured'  : get_template_part('templates/portfolio-templates/col-featured'); break;
	case 'ioa-template-portfolio-full-screen-gallery' : get_template_part('templates/portfolio-templates/full-screen'); break;
	case 'ioa-template-portfolio-product-gallery' : get_template_part('templates/portfolio-templates/product-gallery'); break;
	case 'ioa-template-portfolio-modelie'  : get_template_part('templates/portfolio-templates/modelie'); break;
	case 'ioa-template-portfolio-masonry'  : get_template_part('templates/portfolio-templates/masonary'); break;
	case 'ioa-template-portfolio-metro' : get_template_part('templates/portfolio-templates/metro'); break;
	case 'ioa-template-portfolio-maerya' : get_template_part('templates/portfolio-templates/maerya'); break;

	case 'ioa-template-contact-variation-1' : get_template_part('templates/misc-templates/contact-1'); break;
	case 'ioa-template-contact-variation-2' : get_template_part('templates/misc-templates/contact-2'); break;
	case 'ioa-template-sitemap' : get_template_part('templates/misc-templates/sitemap'); break;
	case 'ioa-template-blog-classic' : get_template_part('templates/blog-templates/classic'); break;
	case 'ioa-template-blog-grid' : get_template_part('templates/blog-templates/grid'); break;
	case 'ioa-template-blog-featured-post' : get_template_part('templates/blog-templates/single-column'); break;
	case 'ioa-template-blog-full-posts' : get_template_part('templates/blog-templates/full-width'); break;
	case 'ioa-template-blog-timeline'  : get_template_part('templates/blog-templates/timeline'); break;
	case 'ioa-template-blog-full-width-side-posts'   : get_template_part('templates/blog-templates/full-side-posts'); break;
	case 'ioa-template-blog-full-width-posts'  : get_template_part('templates/blog-templates/full-width-posts'); break;
	case 'ioa-template-blog-thumb-list' : get_template_part('templates/blog-templates/thumb-list'); break;
	case 'ioa-template-custom-post-template' : get_template_part('templates/custom-post-template'); break;
	case 'default' :
	default :
?>   


<?php
		/**
		 * Full Width Featured Media Items will appear here. 
		 * Note the switches are for condition checking on featured media Full or Contained. 
		 */
		if(! post_password_required())  // Check if Page is password protected
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

<div class="page-wrapper <?php echo get_post_type() ?>">
	
	

	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full" && $meta_data['layout']!="below-title" && $meta_data['layout']!="above-footer") echo 'sidebar-layout has-sidebar has-'.$meta_data['layout'];  ?>">
			<?php  
				/**
				 * Featured Media Items contained by parent width will appear here. 
				 */
				if(! post_password_required()) // Check if Page is password protected
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
			
				<?php if(get_the_content()!="") : ?>
					<div class="page-content clearfix">
						<?php  the_content(); ?>
					</div>
				<?php endif; ?>
		
			<?php endwhile; endif; ?>

			
			<?php if( $super_options[SN.'_page_comments'] =="true" ) comments_template(); ?>
			
		</div>


		
		<?php get_sidebar(); ?>

	</div>

	<?php 
	/**
	 * RAD Builder Area. All Rad Widgets are Generated Here. DO NOT change anything.
	 */
	if(! post_password_required()) :
	rad_area_init();
	 endif; ?>

</div>
<?php } ?>

<?php get_footer(); ?>
