<?php 
/**
 * Testimonails Template for RAD BUILDER
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
 //$helper->prettyPrint($w);

$keys = implode(',',$radunits[$meta_data['widget']['type']]->getInputKeys());
$h = '';

$joint = strtolower( str_replace(" ","_",trim($meta_data['widget']['type']) ) );

$rad_attrs = array();
$testable = get_transient('rad_session');

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
  <div class="<?php echo $joint ?>-inner-wrap <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'way-animated'; ?>" <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'data-waycheck="'.$w['visibility'].'"'; ?> >

     
 
   <?php  $code ="[person photo='".$w['photo']."' name='".$w['mem_name']."' designation='".$w['mem_desig']."' info='".$w['mem_information']."' twitter='".$w['twitter_v']."' facebook='".$w['facebook_v']."' google='".$w['google_v']."' linkedin='".$w['linkedin_v']."' dribbble='".$w['dribbble_v']."' label_color='".$w['mem_color']."' width='100%' /]";
    echo do_shortcode($code);
     ?>

    
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