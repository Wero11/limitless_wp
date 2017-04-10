<?php
 /**
 * The Template for displaying sidebars.
 *
 * @package WordPress
 * @subpackage ASI Theme
 * @since IOA Framework V 1.0
 */
 global $meta_data;
?>

			
<?php  if(isset($meta_data['layout']) && $meta_data['layout']!="full" && $meta_data['layout']!="below-title" && $meta_data['layout']!="above-footer") : 

if($meta_data['layout']=="sticky-right-sidebar") $meta_data['layout'] .= " right-sidebar";
if($meta_data['layout']=="sticky-left-sidebar") $meta_data['layout'] .= " left-sidebar";
?>

 <div class="sidebar <?php echo $meta_data['layout']; ?> " id="sidebar"><!-- start of one-third column -->
	<?php 
	 	if ($meta_data['sidebar']!="none" && trim($meta_data['sidebar'])!=""  ) {
			dynamic_sidebar ($meta_data['sidebar']); 
		}
		else  {
		 	dynamic_sidebar ("Blog Sidebar"); 
		}

	
	?>  
</div><!-- #sidebar -->


<?php  endif; ?>





