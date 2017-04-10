<?php 
/**
 * Post List Template for RAD BUILDER
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
$meta_data['height'] = 90;
$meta_data['width'] = 90;
$meta_data['hasFeaturedImage'] = false; 
$meta_data['item_per_rows'] = 1;
$meta_data['excerpt'] = "yes";
$meta_data['meta_value'] = "";
$post_structure_class = 'post-list';

$opts = array('posts_per_page' => 3,'post_type'=>'post');
  $filter = array();
  $custom_tax = array();

  if(isset($w['meta_value'])) $meta_data['meta_value'] = $w['meta_value']; 
  if(isset($w['excerpt'])) $meta_data['excerpt'] = $w['excerpt']; 
  if(isset($w['no_of_posts'])) $opts['posts_per_page'] = $w['no_of_posts']; 
  if(isset($w['post_type']) && trim($w['post_type'])!="") $opts['post_type'] = $w['post_type']; 



  if(isset($w['posts_query']) && $w['posts_query'] !="" )
  {
     $qr = explode('&',$w['posts_query']);


     foreach($qr as $q)
     {
      if(trim($q)!="")
      {
        $temp = explode("=",$q);
        $filter[$temp[0]] = $temp[1];
        if($temp[0]=="tax_query")
        {
          $vals = explode("|",$temp[1]);  
          $custom_tax[] = array(
              'taxonomy' => $vals[0],
          'field' => 'id',
          'terms' => explode(",", $vals[1])

            );
        }
      }
     }


  }
  $custom_tax[] = array(
                      'taxonomy' => 'post_format',
                      'field' => 'slug',
                      'terms' => array('post-format-quote','post-format-aside','post-format-video','post-format-gallery','post-format-link','post-format-status','post-format-chat'),
                      'operator' => 'NOT IN'
                    );

  $opts = array_merge($opts,$filter);
  $opts['tax_query'] = $custom_tax;

  
 switch($w['post_structure'])
      {
        case 'post-list' : 
                      $meta_data['item_per_rows'] = 1;
                      $post_structure_class = 'plain-list';
                      break;
        default :                
        case 'post-thumbs' :
                      $meta_data['height'] = 50;
                      $meta_data['width'] = 50;
                      $meta_data['hasFeaturedImage'] = false; 
                      $meta_data['item_per_rows'] = 1;
                      $post_structure_class = 'thumb-list';
                      break;
        
      }

// Get keys ==== 
 //$helper->prettyPrint($w);

$keys = implode(',',$radunits[$meta_data['widget']['type']]->getInputKeys());
$h = '';

$joint = strtolower( str_replace(" ","_",trim($meta_data['widget']['type']) ) );
global $paged;
if(is_front_page()) $paged = (get_query_var('page')) ? get_query_var('page') : 1;

if($w['w_pagination']=="yes") $opts['paged'] = $paged;


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
  <div class="<?php echo $joint ?>-inner-wrap" style='<?php if(isset($w['col_alignment'])) echo "text-align:".$w['col_alignment'] ?>'>

    <?php if(isset($w['text_title']) && $titlecheck) : ?>
    <div class="text-title-wrap" itemscope itemtype="http://schema.org/Thing">
       <h2 itemprop="name" class="text_title <?php if($hidden_data['text_title']) echo $hidden_data['text_title']; ?> custom-font1"><?php echo $helper->format($w['text_title'],true,false,false); ?></h2>
       <span class="spacer"></span>
    </div>
    <?php endif; ?>

    <div class="updatable">
        <ul  itemscope itemtype="http://schema.org/ItemList" class="rad-posts-list posts <?php echo $post_structure_class; ?> clearfix <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'way-animated'; ?> <?php if(isset($w['chainability']) && trim($w['chainability'])!= "" && trim($w['chainability'])!= "none") echo 'chain-animated'; ?>" <?php if(isset($w['visibility']) && trim($w['visibility'])!= "" && trim($w['visibility'])!= "none") echo 'data-waycheck="'.$w['visibility'].'"'; ?> <?php if(isset($w['chainability']) && trim($w['chainability'])!= "" && trim($w['chainability'])!= "none") echo 'data-chain="'.$w['chainability'].'"'; ?>>          
        <?php $query = query_posts($opts); $meta_data['i']=0; while (have_posts()) : the_post();   ?> 
       <?php  
        if($w['excerpt_length']!="") $meta_data['excerpt_length'] =  $w['excerpt_length'];
         switch($w['post_structure'])
         {
           case 'post-list' :  get_template_part('templates/post-list'); break;
           case 'post-thumbs' : get_template_part('templates/post-thumbs'); break;
        
          }
        ?>
        <?php  endwhile; ?>
    </ul>
    <?php  if($w['w_pagination']=="yes")  wp_paginate(); wp_reset_query(); ?>

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