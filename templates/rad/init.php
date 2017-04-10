<?php
/**
 * This template intializes RAD Frontend Engine.
 * All Components are available in Templates -> rad folder
 * @since IOA Framework V1
 */

global $radunits,$wp_session;

require_once(HPATH.'/classes/ui.php');
require_once(HPATH.'/classes/class_radstyler.php');

$rad_styler = new RADStyler();
$ui = new GlassUI();

set_transient('rad_session','true',60);


 function addRadScripts() {
	  
	
	wp_enqueue_script('jquery');
	wp_print_scripts('jquery-ui-tabs');
	wp_print_scripts('jquery-ui-accordion');
	wp_print_scripts('jquery-ui-sortable');
	wp_print_scripts('jquery-ui-droppable');
	wp_enqueue_script('jquery-minicolorpicker',HURL.'/js/jquery.minicolors.js');
	wp_enqueue_script('jquery-ext',HURL.'/js/ext.js');
	wp_enqueue_media();
	

	

	}

	wp_dequeue_style('base');
	wp_dequeue_style('layout');	 
	wp_dequeue_style('widgets');	
	wp_dequeue_style('style');

	wp_dequeue_style('custom-font-0');
	wp_dequeue_style('custom-font-1');
	wp_dequeue_style('custom-font-2');

	add_action('rad_head','addRadScripts');

 	

?>

<!-- IFRAME for the Page -->


<!DOCTYPE html>

<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->

<html <?php language_attributes(); ?>>

<head> <!-- Start of head  -->

	<meta charset="utf-8">
    <?php 

    $id=get_option('page_on_front'); 
    $rad_url = get_permalink($id);
    if(isset($_GET['pid']) && $_GET['pid'] !=$id )
    {
    	$id = $_GET['pid']; 
    	$rad_url = appendableLink(get_permalink($id)); 
    } 

     ?>

	<title><?php _e('RAD MODE: ','ioa') ?> <?php echo get_the_title($_GET['pid']);  ?></title>
	
    <link rel='tag' id='listener_link' href='<?php echo  admin_url( 'admin-ajax.php' ); ?>' />
    <link rel='tag' id='backend_link' href='<?php echo  admin_url( 'admin-ajax.php' ); ?>' />
    <link rel='tag' id='shortcode_link' href='<?php echo HURL; ?>' />
    <link rel="stylesheet" href="<?php echo URL."/sprites/stylesheets/base.css"; ?>">
    <link rel="stylesheet" href="<?php echo URL."/sprites/stylesheets/rad.css"; ?>">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    <?php do_action('rad_head'); ?>
    <script>
    	var rad_url = "<?php echo URL."/templates/rad/rad_front_listener.php"; ?>";
    	var ioa_listener_url = "<?php echo  admin_url( 'admin-ajax.php' ); ?>";
    	var rad_source = "<?php echo $rad_url; ?>";
    </script>
  	
  	<script src="<?php echo HURL.'/js/global.js'; ?>"></script>    
  	<script src="<?php echo URL."/sprites/js/rad.js"; ?>"></script> 
	
</head> <!-- End of Head -->

 
<body> <!-- Start of body  -->
<div class="rad_overlay"> <div class="info-box"><?php _e('Drop Here','ioa') ?></div> </div> 
<?php 

?>
<div id="rad_sidebar" class="clearfix">
	<div class="inner_rad_sidebar clearfix">
		<span class="save-loader"></span>
		<a class="refresh-rad-frame icon icon-repeat" href=""></a>
		<div id="parent_rad_tab">
			<?php 
				$link = appendableLink(home_url());
			 ?>
			<ul class="clearfix" id="rad_modes_control">
				<li class="<?php if(isset($mode) && $mode =="builder" ) echo 'active'; ?>" ><a href="#rad_mode"><?php _e('RAD Mode','ioa') ?></a></li>
				<li class="<?php if(isset($mode) && $mode =="styler" ) echo 'active'; ?>" ><a href="#rad_visual_mode"><?php _e('Visual Mode','ioa') ?></a></li>
			</ul>

			
			<div id="rad_mode">
						<div class="not-allowed">
							<h4><?php _e('Editing Not Possible on this Page !','ioa') ?></h4>
						</div>
						<div class="edit-page-panel clearfix">
							<a href="" class="save-button"><?php _e('Save','ioa') ?></a>
							<a href="" class="power-sort-button" data-state="off"><?php _e('Power Sort','ioa') ?> <span class=""><?php _e('OFF','ioa') ?></span></a>
							<a href="<?php echo admin_url(); ?>?rad_close=true" class="close-button"><?php _e('Close','ioa') ?></a>	
						</div>
						<div class="container_layout_selector clearfix">
								<?php 
							echo $ui->getInput(array( 
									"label" => "Select Container" , 
									"name" => "rad_container_layout",
									"length" => "small" , 
									"default" => "" , 
									"type" => "select",
									"description" => "" ,
									"options" => array(),
									"value" => "",
									"after_input"   => ""
							) );
							echo $ui->getInput(array( 
									"label" => __("Layout",'ioa') , 
									"name" => "container_layout" , 
									"default" => "" , 
									"type" => "select",
									"options" => array("full-width" => "Full Width","fluid" => "Fluid Width"),
									"description" => "",
									"length" => 'small',
									"value" => "full-width" 
									  
									));	
							 ?>
							 <a href='' class='delete-rad-container'><?php _e('Delete','ioa') ?></a>
							</div>
						

						<div class="widgets rad-holder-tab">
							<h6> <?php _e('Widgets','ioa') ?> </h6>
							
							<ul class='clearfix'>
								<li><a href="#rad_group_layouts"><?php _e('Layout','ioa') ?></a></li>
								<li><a href="#rad_group_basic"><?php _e('Basic','ioa') ?></a></li>
								<li><a href="#rad_group_post"><?php _e('Posts','ioa') ?></a></li>
								<li><a href="#rad_group_graph"><?php _e('Graphs','ioa') ?></a></li>
								<li><a href="#rad_group_widget"><?php _e('Widgets','ioa') ?></a></li>
							</ul>
							<div id="rad_group_layouts" class='clearfix rad_w_group'>
								<ul class="clearfix">
								
								<li class='widget container' data-type="Container">
									<span class="entypo landscape-doc licon"></span>
									<span class="label"><?php _e('Container','ioa') ?></span>
								</li>

								<?php	foreach ($radunits as $key => $unit) :
									if( $unit->getGroup() == "layout" ) :
								 ?>
									
								<li class='widget' data-type="<?php echo $key ?>">
									<span class="<?php echo $unit->getIcon() ?> licon"></span>
									<span class="label"><?php  echo str_replace("_"," ",$unit->getLabel()); ?></span>
								</li>
										
								<?php endif; endforeach;  ?>

							</ul>
							
							</div>	


							<div id="rad_group_basic" class='clearfix rad_w_group'>
								<ul class="clearfix">
							
								<?php	foreach ($radunits as $key => $unit) :
									if( $unit->getGroup() == "basic" ) :
								 ?>
									
								<li class='widget' data-type="<?php echo $key ?>">
									<span class="<?php echo $unit->getIcon() ?> licon"></span>
									<span class="label"><?php  echo str_replace("_"," ",$unit->getLabel()); ?></span>
								</li>
										
								<?php endif; endforeach;  ?>

							</ul>
							
							</div>	


							<div id="rad_group_post" class='clearfix rad_w_group'>
								<ul class="clearfix">
							
								<?php	foreach ($radunits as $key => $unit) :
									if( $unit->getGroup() == "post" ) :
								 ?>
									
								<li class='widget' data-type="<?php echo $key ?>">
									<span class="<?php echo $unit->getIcon() ?> licon"></span>
									<span class="label"><?php  echo str_replace("_"," ",$unit->getLabel()); ?></span>
								</li>
										
								<?php endif; endforeach;  ?>

							</ul>
							
							</div>

							<div id="rad_group_graph" class='clearfix rad_w_group'>
								<ul class="clearfix">
							
								<?php	foreach ($radunits as $key => $unit) :
									if( $unit->getGroup() == "graph" ) :
								 ?>
									
								<li class='widget' data-type="<?php echo $key ?>">
									<span class="<?php echo $unit->getIcon() ?> licon"></span>
									<span class="label"><?php  echo str_replace("_"," ",$unit->getLabel()); ?></span>
								</li>
										
								<?php endif; endforeach;  ?>

							</ul>
							
							</div>

							<div id="rad_group_widget" class='clearfix rad_w_group'>
								<ul class="clearfix">
							
								<?php	foreach ($radunits as $key => $unit) :
									if( $unit->getGroup() == "widget" ) :
								 ?>
									
								<li class='widget' data-type="<?php echo $key ?>">
									<span class="<?php echo $unit->getIcon() ?> licon"></span>
									<span class="label"><?php  echo str_replace("_"," ",$unit->getLabel()); ?></span>
								</li>
										
								<?php endif; endforeach;  ?>

							</ul>
							
							</div>


							
						</div>
						

						<div class="input_panel">
							
						<div class="inner_input_panel">
								<!-- Widgets for cloning -->
					
				<?php	foreach ($radunits as $unit) : ?>

									
										<div class="rad-component <?php echo $unit->getUniq();  ?> clearfix" data-name="<?php echo $unit->getUniq();  ?>">
											
												<?php echo $unit->getHTML();  ?>
										</div>
										
				<?php endforeach;  ?>
						</div>

		
						</div>	

			</div>
	
			<div id="rad_visual_mode">

				<div class="not-allowed">
							<h4><?php _e('Editing Not Possible on this Page !','ioa') ?></h4>
				</div>
				<div class="edit-page-panel clearfix">
							<a href="" class="style-save-button"><?php _e('Save Styles','ioa') ?></a>
							<a href="" class="reset-rad-styler"><?php _e('Reset','ioa') ?></a>
				</div>
				
				

				<div class=" styler-unit-Container" data-type="Container">
					<h4 class="section-title clearfix"> <i class="icon icon-plus"></i> <span><?php _e('Container Stylings','ioa'); ?></span> <a class='delete-style container-style-delete' href=''><?php _e('Reset Style','ioa') ?></a>  </h4>
					<div class="rad-styler-section clearfix">
						<?php 

						echo $rad_styler->registerbgColor('container','container');
						echo $rad_styler->registerBorder('container','container');
						echo $rad_styler->registerbgImage('container','container');
						echo $rad_styler->registerbgGradient('container','container');
						?>
						
						<h5 class="sub-styler-title"> <?php _e('Layout Properties','ioa') ?>
								<i class="icon icon-caret-down"></i>
						</h5>
						<div class="sub-styler-section clearfix">
						<?php echo $ui->getInput(array( 
							"label" => __("Vertical Space",'ioa') , 
							"name" => "target_v_space" , 
							"default" => "" , 
							"type" => "text",
							"description" => "",
							"length" => 'small',
							"class" => ' rad_style_property ',
							"value" => "0px" ,
							 "data" => array(

							 			"target" => "container" ,
							 			"property" => "padding" 

							 			)  
							));

							
						

					 ?>
					 </div>
					</div>
				</div>

				<?php	foreach ($radunits as $unit) : ?>
					
					<div class="rad_styler_unit styler-unit-<?php echo $unit->getUniq();  ?> clearfix" data-type="<?php echo $unit->getUniq();  ?>">
						
							<?php echo $unit->getStyleHTML();  ?>
					</div>
										
				<?php endforeach;  ?>

		
			</div>
		
		</div>


	</div>	
</div>

<iframe src="" frameborder="0" height="100%" width="80%" id="rad_edit_frame" ></iframe>


<div class="sticky-save-message">
	<?php _e('Changes Saved !','ioa'); ?>
</div>

<?php do_action('rad_footer',true); ?>

<div id="ripple"></div>

<div class="cloneable-rad-components ">
	<?php global $meta_data; foreach($radunits as $widget) :  

			$l = str_replace(" ","_",trim(strtolower($widget->getLabel())));
			
			$w = array(); $i =array();
			$inps  = $widget->getInputKeys();
			$def = $widget->getInputDefaults();

			foreach($inps as $inp) $i[] = array("name" => $inp , "value" => $def[$inp]);

			$w['inputs'] = $i;
			$w['layout'] = "100%";
			$w['type'] = trim($widget->getLabel());
			$meta_data['rad_layout'] = "full-width";

			$meta_data['widget'] = $w;

			$meta_data['id'] = $l.uniqid();

			$meta_data['state'] = 'zombie';

			get_template_part('templates/rad/'.$l);
		

	 endforeach; ?>
</div>


<?php wp_footer(); ?>

<script>
	tinymce.PluginManager.load("button", "<?php echo HURL ?>/js/ioa_menu.js");
</script>


</body>
</html>