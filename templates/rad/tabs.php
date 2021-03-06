<?php 
/**
 * Text Template for RAD BUILDER
 */

global $helper, $super_options , $meta_data , $wpdb,$radunits;

$w = $meta_data['widget']['inputs']; 

$hidden_data = $helper->getAssocMap($w,'hidden');
$w = $helper->getAssocMap($w,'value'); // $helper->prettyPrint($w);



$col =$meta_data['widget']['layout'];

$layout_type = '';

if(isset($meta_data['rad_layout'])) 
{
	switch($col)
	{
		case '100%' : $layout_type = 'full_width left' ; break;
		case '75%' : $layout_type = 'three_fourth left' ; break;
		case '66%' : $layout_type = 'two_third left' ; break;
		case '50%' : $layout_type = 'one_half left' ; break;
		case '33%' : $layout_type = 'one_third left' ; break;
		case '25%' : $layout_type = 'one_fourth left' ; break;

	}


}

// Get keys ==== 
// $helper->prettyPrint( $meta_data['widget']);

$keys = implode(',',$radunits[$meta_data['widget']['type']]->getInputKeys());
$h = '';

$joint = strtolower( str_replace(" ","_",trim($meta_data['widget']['type']) ) );
$tab_data = array();
$tabs = array();

if( isset($w['rad_tab']) && $w['rad_tab']!="" ) :
	$tab_data = $w['rad_tab'];
	$tab_data = explode('<titan_module>',$tab_data);
	

	foreach ($tab_data as $key => $value) {
				
				if($value!="")
				{
					$inpval = array('id' => uniqid('titan_tab_'));
					$mods = explode('<inp>', $value);	
					
					foreach($mods as $m)
					{
						
						if($m!="")
						{
							$te = (explode(';',$m));  
							$inpval[$te[0]] =   $te[1]  ; 
							
						}

						
					}
					//$helper->prettyPrint($inpval);

					$tabs[] = $inpval;
				}	
		}
endif;			

if( ! isset($w['tab_orientation'])) $w['tab_orientation'] = "left";


$testable = get_transient('rad_session');
$titlecheck = true;
if(!$testable)
{
  if(trim($w['text_title'])=="") $titlecheck = false;
}  

$rad_attrs = array();

if(isset($meta_data['id'])) $rad_attrs[] = 'id="'.$meta_data['id'].'"';
//if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none")  $rad_attrs[] = 'data-waycheck="'.$w['visibility'].'"';
if(isset($w['delay'])) $rad_attrs[] = 'data-delay="'.$w['delay'].'"';

if($testable) {
$rad_attrs[] = 'data-type="'.$meta_data['widget']['type'].'"';
$rad_attrs[] = 'data-fields="'.$keys.'"';
}

$way = '';
//if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") $way = 'way-animated';
$rad_attrs[] = 'class="'.$joint.'-wrapper clearfix page-rad-component rad-component-spacing '.$layout_type.' '.$way.'"';

 ?>

<div <?php echo join(" ",$rad_attrs) ?>>
	<div class=" tabs-align-<?php echo $w['tab_orientation']; ?> <?php echo $joint ?>-inner-wrap" style='<?php if(isset($w['col_alignment'])) echo "text-align:".$w['col_alignment'] ?>'>
		
		<?php if(isset($w['text_title']) && $titlecheck) : ?>
		<div class="text-title-wrap">
			
			<div class="text-title-inner-wrap"  itemscope itemtype="http://schema.org/Thing">
				<h2 itemprop="name" class="text_title <?php if($hidden_data['text_title']) echo $hidden_data['text_title']; ?> custom-font1"><?php echo $helper->format($w['text_title'],true,false,false); ?></h2>
				<span class="spacer"></span>
			</div>	
			
		</div>
		<?php endif; ?>
		

		<div class="ioa_tabs clearfix ">
  		
		<?php if( $w['tab_orientation']!="bottom") : ?>
  			<ul class='clearfix'>
    
 				<?php $i=0; foreach ($tabs as  $tab) {
  				$icon = '';
  				if(isset($tab['tab_icon'])) 
  					$icon = "<i class='icon ".$tab['tab_icon']."'></i>";

 					echo '<li><a itemprop="name" href="#'.$tab['id'].'" style="color:'.$tab['tab_color'].';background-color:'.$tab['tab_bgcolor'].'">'.$icon.' '.stripslashes($tab['tab_title']).'</a></li>';
 				} ?>
 			</ul>
 		<?php endif; ?>
		
		<?php $i=0; foreach ($tabs as  $tab) {
 					echo '<div class="clearfix" id="'.$tab['id'].'" itemprop="description">'.$helper->format($tab['tab_text']).'</div>';
 				
 			} ?>

		<?php if( $w['tab_orientation']=="bottom") : ?>
  			<ul class='clearfix'>
    
 				<?php $i=0; foreach ($tabs as  $tab) {
 					echo '<li><a itemprop="name" href="#'.$tab['id'].'" style="color:'.$tab['tab_color'].';background-color:'.$tab['tab_bgcolor'].'">'.stripslashes($tab['tab_title']).'</a></li>';
 				} ?>
 			</ul>
 		<?php endif; ?>
  
		</div>

	
	</div>
	<?php  if(get_transient('rad_session')) : ?>
	<div class="curtain <?php  if(isset($meta_data['state']) && $meta_data['state'] == "live" ) echo 'hide'; ?>"> <h4><?php echo str_replace("_"," ",$meta_data['widget']['type']) ?>  <span><?php _e('(Drag to Arrange)','ioa') ?></span> </h4> </div> 
	
	<div class="meta-data">
		
		<input type="hidden" class='component_layout' value="<?php echo $col ?>" />	
		<?php foreach ($radunits[$meta_data['widget']['type']]->getMetaKeys() as $key) : ?>
			<input type="hidden" class='<?php echo $key; ?>' value="<?php if(isset($w[$key])) echo $w[$key] ?>" />	
		<?php endforeach; ?>
	
	</div>
	<?php endif; ?>
</div>

<?php if(  $w['clear_float']=="yes") echo '<div class="clearfix empty_element"></div>'; ?>