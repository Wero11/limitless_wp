<?php 
/**
 * Text Template for RAD BUILDER
 */

global $helper, $super_options , $meta_data , $wpdb,$radunits;

$w = $meta_data['widget']['inputs']; 

$hidden_data = $helper->getAssocMap($w,'hidden');
$w = $helper->getAssocMap($w,'value'); // $helper->prettyPrint($w);



$col =$meta_data['widget']['layout'];

$layout_type = 'full_width';
$float = 'left';

if( isset($w['float']) && $w['float']!="" ) $float = $w['float'];

if(isset($meta_data['rad_layout'])) 
{
	switch($col)
	{
		case '100%' : $layout_type = 'full_width '.$float ; break;
		case '75%' : $layout_type = 'three_fourth '.$float ; break;
		case '66%' : $layout_type = 'two_third '.$float ; break;
		case '50%' : $layout_type = 'one_half '.$float ; break;
		case '33%' : $layout_type = 'one_third '.$float ; break;
		case '25%' : $layout_type = 'one_fourth '.$float ; break;

	}


}


$inner_wrap_classes = '';


// Get keys ==== 
$keys = implode(',',$radunits[$meta_data['widget']['type']]->getInputKeys());
$h = '';

$joint = strtolower( str_replace(" ","_",trim($meta_data['widget']['type']) ) );


$inner_wrap_classes .= ' subtitle-state-'.$hidden_data['text_subtitle'];


$testable = get_transient('rad_session');
$titlecheck = true; $subtitlecheck= true;
if(!$testable)
  if(trim($w['text_title'])=="") $titlecheck = false;

if(!$testable)
  if(trim($w['text_title'])=="") $subtitlecheck = false;

$rad_attrs = array();

if(isset($meta_data['id'])) $rad_attrs[] = 'id="'.$meta_data['id'].'"';
if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none")  $rad_attrs[] = 'data-waycheck="'.$w['visibility'].'"';
if(isset($w['delay'])) $rad_attrs[] = 'data-delay="'.$w['delay'].'"';

if($testable) {
$rad_attrs[] = 'data-type="'.$meta_data['widget']['type'].'"';
$rad_attrs[] = 'data-fields="'.$keys.'"';
}

$way = '';
if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") $way = 'way-animated';
$rad_attrs[] = 'class="'.$joint.'-wrapper clearfix page-rad-component rad-component-spacing '.$layout_type.' '.$way.'"';


?> 


<div <?php echo join(" ",$rad_attrs) ?>>
	
	
	<div class="<?php echo $joint ?>-inner-wrap <?php echo $inner_wrap_classes; ?>  "  style='<?php if(isset($w['col_alignment'])) echo "text-align:".$w['col_alignment'] ?>' >
		
		<div class="text-title-wrap clearfix"   itemscope itemtype="http://schema.org/Thing">
			
			<div style="margin-top:<?php if(isset($w['icon_margin'])) echo $w['icon_margin']."px" ?>" <?php if(isset($w['icon_animation']) && trim($w['icon_animation'])!= "") echo 'data-icon_hover="animated '.$w['icon_animation'].'"'; ?>  class="icon  <?php echo "float-".$w['icon_alignment']." "; if(isset($hidden_data['icon'])) echo $hidden_data['icon']; else $h =  ' hide '; if($w['icon']=="") $h =  ' hide '; echo $h; ?> " >
					<?php if(isset($w['icon'])) echo stripslashes($w['icon']); ?>
			</div>
			
			<div class="text-title-inner-wrap">
				<?php if(isset($w['text_title']) && $titlecheck) : ?><h2 itemprop="name" class="text_title <?php if($hidden_data['text_title']) echo $hidden_data['text_title']; ?> custom-font1"><?php echo $helper->format($w['text_title'],true,false,false); ?></h2><?php endif; ?>
				<?php if(isset($w['text_subtitle']) && $subtitlecheck ) : ?><h4  class=" text_subtitle <?php if($hidden_data['text_subtitle']) echo $hidden_data['text_subtitle']; ?> custom-font1"><?php echo $helper->format($w['text_subtitle'],true,false,false); ?></h4><?php endif; ?>
			</div>	
			
		</div>
		
		<div itemprop="description" class="text text_data <?php if(isset($hidden_data['text_data'])) echo $hidden_data['text_data']; ?>">
			
			<?php echo $helper->format($w['text_data'],false,true); ?>
		</div>
	</div>
	
	<?php  if(get_transient('rad_session')) : ?>
	<div class="curtain <?php  if(isset($meta_data['state']) && $meta_data['state'] == "live" ) echo 'hide'; ?>"> <h4><?php echo str_replace("_"," ",$meta_data['widget']['type']) ?>  <span><?php _e('(Drag to Arrange)','ioa') ?></span> </h4> </div> 
	
		<div class="meta-data">
			<input type="hidden" class='component_layout' value="<?php echo $col ?>" />	
			<?php foreach ($radunits[$meta_data['widget']['type']]->getMetaKeys() as $key) : ?>
				<input type="hidden" class='<?php echo $key; ?>' value="<?php if(isset($w[$key])) echo $w[$key] ?>" />	
			<?php endforeach; ?>
			<textarea name="" id="" cols="30" rows="10" class="text_data <?php if(isset($hidden_data['text_data'])) echo $hidden_data['text_data']; ?>"><?php if(isset($w['text_data'])) echo stripslashes($w['text_data']); ?></textarea>
		</div>
	<?php endif; ?>

</div>

<?php if(  $w['clear_float']=="yes") echo '<div class="clearfix empty_element"></div>'; ?>