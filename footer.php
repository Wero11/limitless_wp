<?php 
/**
 * The Footer Template. 
 *
 * @package WordPress
 * @subpackage ASI Theme
 * @since IOA Framework V 1.0
 */

global $super_options,$helper,$meta_data ;        
?>


<?php 
 /**
  * This Code runs for Above Footer Sidebar Layout.
  */
 if(isset($meta_data['layout']) && $meta_data['layout']=="above-footer") : ?>

    <div class="sidebar <?php echo $meta_data['layout']; ?>" id="sidebar" itemscope itemtype="http://schema.org/WPSideBar"><!-- start of one-third column -->

        <div class="skeleton auto_align clearfix">
        <?php 
            if ($meta_data['layout']!="none" && trim($meta_data['layout'])!=""  ) {
              dynamic_sidebar ($meta_data['sidebar']); 
            }
           else  {
              dynamic_sidebar ("Blog Sidebar"); 
            }
        ?>  
        </div>
    </div>


<?php  endif; ?>


<div id="footer" itemscope itemtype="http://schema.org/WPFooter">
	<!-- Footer Widgets area -->
	<?php get_template_part('templates/content-footer-widgets'); ?>
	
	<!-- Footer Menu area -->
	<?php get_template_part('templates/content-footer-menu'); ?>

</div>

<?php get_template_part('templates/sticky-contact'); ?>

  </div>
</div>


<a href="" class="back-to-top icon icon-angle-up"></a>

<script type="text/javascript">
  <?php echo stripslashes($super_options[SN.'_tracking_code']); ?>
</script>

<?php  wp_footer();  ?>

</body>
</html>
