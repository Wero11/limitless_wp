<?php
/**
 * The Template for Tagged Posts.
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
 * Default Blog Values
 */
$meta_data['item_per_rows'] = 1;
$meta_data['width'] = 740;
$meta_data['height'] = $super_options[SN.'_bt1_height'];

/**
 * Force Right Sidebar other values are left-sidebar , full-width ,
 * sticky-right-sidebar , sticky-left-sidebar , below-title , above-footer.
 */
$meta_data['layout'] = "right-sidebar"; 
$meta_data['sidebar'] = $super_options[SN.'_search_sidebar'];
$meta_data['i'] = 0;

$meta_data['post_extras'] = "[post_comments/]";
$meta_data['blogmeta_enable'] = "false";
$meta_data['enable_thumbnail'] =  "false";


$meta_data['blog_excerpt'] =  "true";
$meta_data['more_label'] =  $super_options[SN.'_more_label'];
$meta_data['posts_excerpt_limit'] =  200;

$cl = 'blog-format1-posts';
 switch($super_options[SN.'_search_blog_layout'])
	 {
	 	case 'full-width' : $cl = 'blog-format4-posts';  break;
	 	case 'grid' : $cl = 'blog-format3-posts'; break;
	 	case 'single-column' : $cl = 'blog-format5-posts';  break;
	 	case 'thumb-list' : $cl = 'blog-format2-posts';  break;
	 	case 'classic' :  
	 	default : $cl = 'blog-format1-posts';  break;
	 }
?>   

<div class="page-wrapper" itemscope itemtype="http://schema.org/SearchResultsPage">
	
	<div class="skeleton clearfix auto_align">

		

		<div class="mutual-content-wrap <?php if($meta_data['layout']!="full") echo 'has-sidebar has-'.$meta_data['layout'];  ?>">
			

			
			<div class="<?php echo $cl ?> hoverable clearfix">
				<ul class="clearfix blog_posts">
					 <?php 
					 		while (have_posts()) : the_post(); 

   							 switch($super_options[SN.'_search_blog_layout'])
   							 {
   							 	
   							 	case 'full-width' : get_template_part('templates/post-blog-format4');  break;
   							 	case 'grid' : get_template_part('templates/post-blog-format3');  break;
   							 	case 'single-column' : get_template_part('templates/post-blog-format5');  break;
   							 	case 'thumb-list' : get_template_part('templates/post-blog-format2');  break;

   							 	case 'classic' :  
   							 	default : get_template_part('templates/post-blog-classic');  break;
   							 }



   							endwhile; ?>
				</ul>	
			</div>

			
				<div class="pagination_wrap clearfix">
					<?php wp_paginate(); ?>
					<?php wp_paginate_dropdown(); ?>
				</div>
			
		

		</div>


		
		<?php get_sidebar(); ?>

	</div>

</div><!-- .page-wrapper -->


<?php get_footer(); ?>
      