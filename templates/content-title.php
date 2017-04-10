<?php 
/**
 * Title Template
 */

global $helper, $super_options , $meta_data, $wp_session ; 

/**
 * Styling Code ===============================
 */

$show_title = $tc = $tc =$tco = $tbc = $stbc  = $tbco = $stc = $stco = $ttbc = $ttbgimage = $ta = $ts = $ttbgposition = $ttbgrepeat = $title_font_size = $title_font_weight = $bg_cover = $code = '';
$title_icon = '';
$ie_tbc= '' ; $ie_stbc = '';
$dbg = '' ;
if(is_page() || is_single()) :

$show_title =  get_post_meta( $post->ID, 'show_title', true );
$title_icon =  get_post_meta( $post->ID, 'title_icon', true );

$tc =  get_post_meta( $post->ID, 'ioa_custom_title_color', true );

$tbc =  get_post_meta( $post->ID, 'ioa_custom_title_bgcolor', true );
$tbco =  get_post_meta( $post->ID, 'ioa_custom_title_bgcolor-opacity', true );

$stc =  get_post_meta( $post->ID, 'ioa_custom_subtitle_color', true );

$stbc =  get_post_meta( $post->ID, 'ioa_custom_subtitle_bgcolor', true );
$stbco =  get_post_meta( $post->ID, 'ioa_custom_subtitle_bgcolor-opacity', true );

$ttbc =  get_post_meta( $post->ID, 'ioa_titlearea_bgcolor', true );
$ttbgimage =  get_post_meta( $post->ID, 'ioa_titlearea_bgimage', true );

if($ttbgimage!="") $ttbgimage = "url(".$ttbgimage.")";

$ttbgposition =  get_post_meta( $post->ID, 'ioa_titlearea_bgposition', true );
if( trim(get_post_meta( $post->ID, 'ioa_titlearea_bgpositionc', true ))!="")
$ttbgposition =  get_post_meta( $post->ID, 'ioa_titlearea_bgpositionc', true );
$ttbgrepeat =  get_post_meta( $post->ID, 'ioa_titlearea_bgrepeat', true );

$ie_tbc= $tbc ;
$tbc = hex2RGB($tbc);
$tbc = "rgba(".$tbc['red'].",".$tbc['green'].",".$tbc['blue'].",".$tbco.")";

$ie_stbc= $stbc ;

$stbc = hex2RGB($stbc);
$stbc = "rgba(".$stbc['red'].",".$stbc['green'].",".$stbc['blue'].",".$stbco.")";

$use_gr = get_post_meta( $post->ID, 'titlearea_gradient', true );

$title_font_size =  get_post_meta( $post->ID, 'title_font_size', true );
$title_font_weight =  get_post_meta( $post->ID, 'title_font_weight', true );



  if(get_post_meta(get_the_ID(),'dominant_bg_color',true)!="") $dbg =  get_post_meta(get_the_ID(),'dominant_bg_color',true);

$bg_cover ='';

if(  get_post_meta( $post->ID, 'background_cover', true ) !== "" )
$bg_cover = "background-size:".get_post_meta( $post->ID, 'background_cover', true ).";";

$code ='';
if($use_gr=="yes")
{
	$start_gr = get_post_meta( $post->ID, 'ioa_titlearea_grstart', true );
	$end_gr = get_post_meta( $post->ID, 'ioa_titlearea_grend', true );
	$dir_gr = get_post_meta( $post->ID, 'titlearea_gradient_dir', true );
	$iefix = 0;
	if( $dir_gr != "radial" ) :

	switch($dir_gr)
	{
		case "vertical" : $dir_gr = "top"; break;
		case "horizontal" : $dir_gr = "left"; $iefix = 1;  break;
		case "diagonaltl" : $dir_gr = "45deg"; $iefix = 1; break;
		case "diagonalbr" : $dir_gr = "-45deg"; $iefix = 1; break;
	}	
			
	$code = "background: -webkit-gradient(".$dir_gr.", 0% 0%, 0% 100%, from(".$end_gr."), to(".$start_gr."));background: -webkit-linear-gradient(".$dir_gr.", ".$start_gr.", ".$end_gr.");background: -moz-linear-gradient(".$dir_gr.", ".$start_gr.", ".$end_gr.");background: -ms-linear-gradient(".$dir_gr.", ".$start_gr.", ".$end_gr.");background: -o-linear-gradient(".$dir_gr.", ".$start_gr.", ".$end_gr.");filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='".$start_gr."', endColorstr='".$end_gr."',GradientType=".$iefix." );";

	endif;
}
else
{

	if($ttbc!="")
	$code .= "background-color:".$ttbc.';';

	if($ttbgimage!="")
	$code .= "background-image:".$ttbgimage.';';

	if($ttbgposition!="")
	$code .= "background-position:".$ttbgposition.';';

	if($ttbgrepeat!="")
	$code .= "background-repeat:".$ttbgrepeat.';';

}

/**
 * End of Styling Code
 */


/**
 * Title General Settings
 */

$ta =  get_post_meta( $post->ID, 'title_align', true );
$ts = '';



if( get_post_meta($post->ID,'title_vspace') !="" )
{
	$code .=  "padding:".get_post_meta( $post->ID, 'title_vspace', true )."px 0;";
}

endif;
?>
<?php 

if(is_archive()) 
{
	$meta_data['subtitle'] = '';
	$meta_data['title']="";
	if ( is_day() ) :
		$meta_data['title'] =  __( 'Daily Archives:', 'ioa' );
	elseif ( is_month() ) :
		$meta_data['title'] = __( 'Monthly Archives: ', 'ioa' );
	elseif ( is_year() ) :
		$meta_data['title'] = __( 'Yearly Archives: ', 'ioa' );
	elseif(is_tax()) : $meta_data['title'] =  single_term_title('',false);
	else :
		$meta_data['title'] = __( 'Archives', 'ioa' );

	endif;
	$show_title ="yes";
}
if(is_category())
{
	$meta_data['subtitle'] = '';
	$meta_data['title']= __('Category : ','ioa').single_cat_title( '', false );
} 
if(is_tag()) 
{
	$meta_data['subtitle'] = '';
	$meta_data['title']= __('Tag : ','ioa').single_tag_title( '', false );
}
if(is_search()) 
{
	$meta_data['subtitle'] = '';
	$meta_data['title'] =  __( 'Search Results for: ', 'ioa' ). '<span>' . get_search_query() . '</span>';
}
if(is_author())
{
	if ( have_posts() ) : the_post();
		$meta_data['title'] = __( 'Author Posts :', 'ioa' ).  get_the_author();
	endif;
	rewind_posts();
	
}

 ?>
<?php if($show_title !="no" && !is_home() && ! is_404() ) : ?>
<div class="supper-title-wrapper" >
	<div data-dbg='<?php echo $dbg; ?>' data-duration="<?php echo get_post_meta($post->ID,'background_animate_time',true) ?>" data-position="<?php echo get_post_meta($post->ID,'background_animate_position',true) ?>" class="title-wrap <?php echo get_post_meta($post->ID,'titlearea_effect',true) ?> <?php echo "title-text-algin-".$ta; ?>" data-effect="<?php echo get_post_meta($post->ID,'titlearea_effect',true) ?>"  style="<?php echo $code.''.$bg_cover;  ?>" data-delay="<?php echo get_post_meta($post->ID,'effect_delay',true) ?>" >
  	<div class="page-highlight"></div>
  	<div class="wrap">
		<?php if(!is_front_page() && $super_options[SN.'_breadcrumbs_enable']!="false" ) $helper->breadcrumbs(); ?>
    	<div class="skeleton auto_align clearfix"> 
        		<div class="title-block <?php echo get_post_meta($post->ID,'title_effect',true); if(get_post_meta($post->ID,'title_effect',true)!="none") echo " animate-block"; ?>" data-effect="<?php echo get_post_meta($post->ID,'title_effect',true) ?>" style='background:<?php echo $ie_tbc; ?>;background:<?php echo $tbc; ?>;'>
        			<h1 class="custom-title " style='color:<?php echo $tc; ?>;font-size:<?php echo $title_font_size ?>px;font-weight:<?php echo $title_font_weight ?>;' >  <?php if(isset($title_icon) && $title_icon!="") echo "<i class='icon $title_icon'></i>";  echo $meta_data['title']; ?></h1>
					
					<?php  if(get_transient('rad_session') &&  current_user_can('delete_pages')) : ?>
						<div class="title-editable-area">
							<input type="text" class='rad_editable_val' value="<?php echo $meta_data['title']; ?>" />
						</div>
					<?php endif; ?>

        		</div>
                <?php if($meta_data['subtitle']!="") :?>
				<div class="subtitle-block <?php echo get_post_meta($post->ID,'subtitle_effect',true); if(get_post_meta($post->ID,'subtitle_effect',true)!="none") echo " animate-block"; ?>"  data-effect="<?php echo get_post_meta($post->ID,'subtitle_effect',true) ?>" style='background:<?php echo $ie_stbc; ?>;background:<?php echo $stbc; ?>;'>
					<h3 class="page-subtitle" style='color:<?php echo $stc; ?>;'><?php echo $meta_data['subtitle']; ?></h3>

					<?php  if(get_transient('rad_session') &&  current_user_can('delete_pages')) : ?>	
						<div class="subtitle-editable-area">
							<input type="text" class='rad_editable_val' value="<?php echo $meta_data['subtitle']; ?>" />
						</div>
					<?php endif; ?>	

				</div>	
            	<?php endif; ?>
            	
         </div>
     </div>
	</div>
</div>



<?php endif; ?>

