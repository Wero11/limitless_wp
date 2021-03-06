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

// Default Values 
// 
$meta_data['height'] = 50;
$meta_data['width'] = 50;


// Get keys ==== 
 //$helper->prettyPrint($w);

$keys = implode(',',$radunits[$meta_data['widget']['type']]->getInputKeys());
$h = '';

$joint = strtolower( str_replace(" ","_",trim($meta_data['widget']['type']) ) );

$testable = get_transient('rad_session');
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
  <div class="<?php echo $joint ?>-inner-wrap" >

    
 

    <div  itemscope itemtype="http://schema.org/review" class="testimonial-bubble  <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'way-animated'; ?>" <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'data-waycheck="'.$w['visibility'].'"'; ?>>
       <?php  if(isset($w['t_id'])) : $tpost = get_post($w['t_id']); $dbg = '' ; $dc = '';
 
          if(get_post_meta($w['t_id'],'dominant_bg_color',true)!="") $dbg =  get_post_meta($w['t_id'],'dominant_bg_color',true);
          if(get_post_meta($w['t_id'],'dominant_color',true)!="") $dc =  get_post_meta($w['t_id'],'dominant_color',true);
          ?> 
           
           <div class="testimonial-bubble-content" itemprop='description' style='color:<?php echo $dc; ?>;background-color:<?php echo $dbg; ?>'>
              <?php echo $tpost->post_content  ?>
                 <i class="icon icon-sort-down" style='color:<?php echo $dbg; ?>'></i>
           </div> 

           <div class="testimonial-bubble-meta clearfix">
             
                <?php   if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail($w['t_id'])))  : ?>   
              
                <div class="image">
                  
                  <?php
                  $id = get_post_thumbnail_id($w['t_id']);
                  $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
           
                  echo $helper->imageDisplay(array( "src" => $ar[0] , "height" =>$meta_data['height'] , "width" => $meta_data['width'] , "parent_wrap" => false ,"imageAttr" => "data-link='".get_permalink()."' alt='".get_the_title()."'"));  
                  ?>
              </div>

            <?php endif;
              ?>

              <div class="info">
                      <h2 class="name" itemprop="name"> <?php echo get_the_title($w['t_id']); ?></h2> 
                      <?php  if(get_post_meta($w['t_id'],'design',true)!="")  echo "<span class='designation'>".get_post_meta($w['t_id'],'design',true)."</span>" ?>
                    </div>
                    
              </div>

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