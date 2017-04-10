<?php
/**
 * The Content Header Template 
 *
 * @package WordPress
 * @subpackage ASI Themes
 * @since IOA Framework V1
 */
global $super_options , $helper, $meta_data;

$d = get_option(SN.'_header_construction_data');
$data = $d;

if( ! is_home() &&! is_404() && ! is_archive()  && get_post_meta(get_the_ID(),'ioaheader_data',true)!=""   ) 
  $data = get_post_meta($post->ID,'ioaheader_data',true);

$widgets = $data[1];

$default_filler_left = array( "val" => "logo" , "align" => "default" , "margin" => "0:0:0:0" , "name" => "Logo"  );
$default_filler_right = array( "val" => "main-menu" , "align" => "default" , "margin" => "8:0:0:0" , "name" => "Menu 1"  );
$default_filler_right1 = array( "val" => "search" , "align" => "default" , "margin" => "14:0:0:0" , "name" => "Search Bar"  );
$default_widgets = array(
      "menu-area" =>  array('eye' => 'on', 'height' => "17" , "position" =>"static","container" => "menu-area" , 'data' => array( array('align' => 'left', 'elements' => array( $default_filler_left) ),  array('align' => 'center', 'elements' => array() ) ,  array('align' => 'right', 'elements' => array( $default_filler_right1 , $default_filler_right) )) ),
  );

if(!isset($widgets) || count($widgets)==0)   
    $widgets =  $default_widgets ;
else
    foreach ($widgets as $w) {
        $temp_w[$w['container']] = $w;
      } 
 

?>

<?php if($super_options[SN.'_cmenu_enable']!="false") : ?>
 <div class="compact-bar clearfix">
    <div class="skeleton auto_align clearfix" itemscope itemtype='http://schema.org/SiteNavigationElement'>

      <a href="<?php echo home_url(); ?>" id="clogo" >
            <img src="<?php echo $super_options[SN."_clogo"]; ?>" alt="compact logo" />
      </a> 


      <div class="menu-wrapper" data-effect="<?php echo $super_options[SN.'_submenu_effect']; ?>" > 
             <div class="menu-bar">
               <div class="clearfix ">
                     <?php  
                       
                              if(function_exists("wp_nav_menu"))
                              {
                                  wp_nav_menu(array(
                                              'theme_location'=>'top_menu1_nav',
                                              'container'=>'',
                                              'depth' => 3,
                                              'menu_class' => 'menu clearfix',
                                              'menu_id' => 'compact-menu',
                                              'fallback_cb' => false,
                                              'walker' => new ioa_Menu_Frontend()
                                               )
                                              );
                              }
                              
                     ?>
              
             </div>
          </div>
      </div>


    </div>  
 </div>
<?php endif; ?>

<div class="mobile-head">
    
    <a href="" class="icon icon-reorder mobile-menu"></a>
    
    <a href="" <?php  if(isset($meta_data['layout']) && $meta_data['layout']!="full" ) echo "style:'display:none;'" ?> class="icon icon-sign-blank sidebar-mobile-menu"></a>
  

    <a href="<?php echo home_url(); ?>" id="mobile-logo" class='center' style='max-width:<?php echo $super_options[SN.'_logo_width'] ?>px'>
                <img src="<?php echo $super_options[SN."_clogo"]; ?>" alt="logo" />
    </a> 
   
                <a href="" class="majax-search-trigger icon icon-search" ></a>
</div>


<?php if(isset($meta_data['layout']) && $meta_data['layout']!="full" ) : 
  get_template_part('templates/flexi-sidebar'); 
 endif; ?>


<div data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>" class='majax-search ' >
                                      
                <div class="majax-search-pane">
                   <a href="" class="majax-search-close icon icon-remove"></a>
                    
                    <div class="form">
                       <form role="search" method="get"  action="<?php echo home_url( '/' ); ?>">
                          <div>
                              <input type="text"  autocomplete="off" name="s" class='live_search' value="<?php _e('Type something..','ioa') ?>" />
                              <input type="submit"  value="Search" />
                              <span class="msearch-loader"></span>
                          </div>
                      </form>
                    </div>
                    <div class="msearch-results clearfix">
                      <ul>
                       
                      </ul>
                    </div>
                </div>

       </div> 
<?php  
   if($super_options[SN.'_res_menu']!="side")
    {      if(function_exists("wp_nav_menu"))
          {
              wp_nav_menu(array(
                          'theme_location'=>'top_menu1_nav',
                          'container'=>'',
                          'depth' => 3,
                          'menu_class' => 'menu clearfix',
                          'menu_id' => 'mobile-menu',
                          'fallback_cb' => false
                           )
                          );
          }
     }
     else
     {
        ?> <div class="mobile-side-wrap"> <?php
        if(function_exists("wp_nav_menu"))
          {
              wp_nav_menu(array(
                          'theme_location'=>'top_menu1_nav',
                          'container'=>'',
                          'depth' => 3,
                          'menu_class' => 'menu clearfix',
                          'menu_id' => 'mobile-side-menu',
                          'fallback_cb' => false
                           )
                          );
          }
          ?> </div> <?php   
      } 
?>

<div class="theme-header "  itemscope itemtype="http://schema.org/WPHeader">
  <div class="header-cons-area">
<?php 
if(isset($widgets))
foreach($widgets as $widget)
        {
          $w = 'static'; if(isset( $widget['position'])) $w =  $widget['position']; 
          if(isset($widget['eye']) && $widget['eye']!="off")
          switch($widget['container'])
          {

            case 'top-area' : ?>
                
                <div id="top-bar" style="padding:<?php echo  $widget['height'] ?>px 0px;"  class="clearfix  <?php  echo 'header-cons-'.$w; ?> header-construtor">

                  <div class="<?php if($super_options[SN.'_menu_layout']!="fluid") echo 'skeleton'; ?> auto_align clearfix" itemscope itemtype='http://schema.org/SiteNavigationElement'>

                       <?php 
                            foreach($widget['data'] as $holder) 
                            {
                               $def = ' top_layers ';
                              if($holder['align']=="full") $def = 'full-area';
                              if($holder['align'] == "full" || $holder['align'] == "center") $def .= ' menu-centered';
                              
                                if(isset($holder['elements']) && count($holder['elements']) > 0 ) :
                              ?>

                              <div class="<?php echo $def.' '.$holder['align'] ?> clearfix">
                                <?php
                                  
                                    foreach($holder['elements'] as $el)
                                    {
                                      getComponent($el);
                                    }
                                     ?>
                              </div>

                              <?php
                                endif;
                            }
                             ?> 
                    </div>
                </div>

            <?php    break;
            case 'menu-area' : ?>
               <div  data-offset-top="0"  class="top-area-wrapper  <?php  echo 'header-cons-'.$w; ?>"  >
                <div class="top-area  header-construtor" style="padding:<?php echo  $widget['height'] ?>px 0px;">
                   <div class="clearfix <?php if($super_options[SN.'_menu_layout']!="fluid") echo 'skeleton'; ?>  auto_align" itemscope itemtype='http://schema.org/SiteNavigationElement'>
                     <?php 
                            foreach($widget['data'] as $holder) 
                            {
                              $def = ' menu_layers ';
                              if($holder['align']=="full") $def = 'full-area';
                              if($holder['align'] == "full" || $holder['align'] == "center") $def .= ' menu-centered';
                              
                                if(isset($holder['elements']) && count($holder['elements']) > 0 ) :
                              ?>
                              <div class="<?php echo $def.' '.$holder['align'] ?> clearfix">
                                <?php
                                    foreach($holder['elements'] as $el)
                                    {
                                       getComponent($el);
                                    }
                                     ?>
                              </div>

                              <?php
                                endif;

                            }
                             ?> 


                  </div>
                
                  </div>  
                


                </div>

            <?php   break;
            case 'top-full-area' : ?>
               <div  data-offset-top="0"  class=" bottom-area <?php  echo 'header-cons-'.$w; ?>"  >
                <div class="top-area  header-construtor" style="padding:<?php echo  $widget['height'] ?>px 0px;">
                   <div class="clearfix <?php if($super_options[SN.'_menu_layout']!="fluid") echo 'skeleton'; ?>  auto_align" itemscope itemtype='http://schema.org/SiteNavigationElement'>
                     <?php 
                            foreach($widget['data'] as $holder) 
                            {
                              $def = ' menu_layers ';
                              if($holder['align']=="full") $def = 'full-area';
                              if($holder['align'] == "full" || $holder['align'] == "center") $def .= ' menu-centered';
                              
                                if(isset($holder['elements']) && count($holder['elements']) > 0 ) :
                              ?>
                              <div class="<?php echo $def.' '.$holder['align'] ?> clearfix">
                                <?php
                                    foreach($holder['elements'] as $el)
                                    {
                                       getComponent($el);
                                    }
                                     ?>
                              </div>

                              <?php
                                endif;
                              
                            }
                             ?> 


                  </div>
                
                  </div>  
                


                </div>

            <?php   break;
          }
          ?>
          
       
           

          <?php
        }


      function getComponent($el)
      {
        global $helper,$super_options;
        $val = $el['val'];
        $m = $el['margin']; 
        $m = str_replace(":","px ",$m);
        $m .= "px;";

        switch($val)
              {
                case 'logo' : $logo = $super_options[SN."_logo"]; 

                       if(isset($_GET['enid']))
                      {
                        $ex_d = get_option(SN.'visualizer_hash');
                        $vdata = array();

                        if($ex_d)
                        foreach ($ex_d as  $value) {
                          $vdata[$value['key']] = array( "logo" => $value['logo'] , "thumb" => $value['thumb'] );
                        }
                        
                        if(isset($vdata[$_GET['enid']])) $logo = $vdata[$_GET['enid']]['logo'];
                        
                      }

                        ?>
                                  <a href="<?php echo home_url(); ?>" id="logo" class='<?php echo $el['align'] ?>' style='padding:<?php echo $m ?>;max-width:<?php echo $super_options[SN.'_logo_width'] ?>px'>
                                      <img src="<?php echo $logo; ?>" alt="logo"  />
                                  </a> 
                              <?php break;
                case 'text' : if(isset($el['text'])) : ?>
                               <div class="top-text <?php echo $el['align'] ?>" style='padding:<?php echo $m ?>'> <?php  echo stripslashes(do_shortcode($el['text'])); ?> </div>
                              
                              <?php endif; break;  
               case 'wpml' : if(function_exists('icl_get_languages') ) : ?>
                               <div class="wpml-selector <?php echo $el['align'] ?>" style='padding:<?php echo $m ?>'> 
                                    <a href="" class="wpml-lang-selector clearfix"> <i class="icon icon-globe"></i><span><?php _e('Select Language','ioa'); ?></span> </a>
                                    <ul>
                                      <i class="icon icon-caret-up"></i>
                                    <?php 
                                    $languages =icl_get_languages('skip_missing=0&orderby=KEY&order=DIR');
                                    $i=0; $cl = '';
                                    $langs = array();

                                      foreach($languages as $l){
                                       
                                          $cl = '';
                                            if($i==0) $cl = 'first-c';
                                            else if($i == count($languages)-1) $cl = 'last';
                                              $langs[] = '<li  class="'.$cl.'"><a href="'.$l['url'].'">  '.$l['translated_name'].'</a></li>';

                                     
                                        $i++; 
                                        
                                      }
                                      echo join('', $langs);
                                   
                                     ?>
                                     </ul>
                               </div>
                              
                              <?php endif; break;                
                case 'top-menu' : 
                                ?>  <div class="menu-wrapper <?php echo $el['align'] ?>" style='padding:<?php echo $m ?>' data-effect="<?php echo $super_options[SN.'_submenu_effect']; ?>"  > 
                                       <div class="menu-bar">
                                         <div class="clearfix ">
                                               <?php  
                                              
                                                        if(function_exists("wp_nav_menu"))
                                                        {
                                                            wp_nav_menu(array(
                                                                        'theme_location'=>'top_menu2_nav',
                                                                        'container'=>'',
                                                                        'depth' => 3,
                                                                        'menu_class' => 'menu clearfix',
                                                                        'menu_id' => 'menu2',
                                                                        'fallback_cb' => false,
                                                                        'walker' => new ioa_Menu_Frontend()
                                                                         )
                                                                        );
                                                        }
                                               ?>
                                        
                                       </div>
                                    </div>
                                    </div>
                                 <?php break; 
                case 'main-menu' : ?>
            
                                   <div class="menu-wrapper <?php echo $el['align'] ?>" data-effect="<?php echo $super_options[SN.'_submenu_effect']; ?>" style='padding:<?php echo $m ?>'> 
                                       <div class="menu-bar">
                                         <div class="clearfix ">
                                               <?php  
                                              
                                                        if(function_exists("wp_nav_menu"))
                                                        {
                                                            wp_nav_menu(array(
                                                                        'theme_location'=>'top_menu1_nav',
                                                                        'container'=>'',
                                                                        'depth' => 3,
                                                                        'menu_class' => 'menu clearfix',
                                                                        'menu_id' => 'menu1',
                                                                        'fallback_cb' => false,
                                                                        'walker' => new ioa_Menu_Frontend()
                                                                         )
                                                                        );
                                                        }
                                               ?>
                                        
                                       </div>
                                    </div>
                                    </div>
                                 <?php break;   
                case 'social' : ?>
                                
                                    <ul class="top-area-social-list clearfix <?php echo $el['align'] ?>" style='padding:<?php echo $m ?>'>
                                      <?php  
                                      if(isset($el['text'])) :

                                          $ls = explode( "<sc>" , stripslashes($el['text']) );
                                          foreach($ls as $item)
                                          {
                                            $te = explode("<vc>",$item);
                                            if($item!="")
                                            echo "<li><a class='".$te[0]."' href='".$te[1]."'> <span class='proxy-color'><img src='".URL.'/sprites/i/sc/'.$te[0].".png' alt='social icon'/></span> <img src='".URL.'/sprites/i/sc/inv/'.$te[0].".png' alt='social icon'/></a></li>";
                                          } 
                                      endif;
                                      ?>
                                    </ul>
                                 
                                 
                                  <?php break;
                case 'search' :  ?>
                                  <div style='padding:<?php echo $m ?>' data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>" class='ajax-search <?php echo $el['align'] ?>' >
                                      
                                      <a href="" class="ajax-search-trigger icon icon-search" ></a>
                                      <div class="ajax-search-pane">
                                         <a href="" class="ajax-search-close icon icon-remove"></a>
                                         <span href="" class="icon icon-caret-up tip"></span>
                                          
                                          <div class="form">
                                             <form role="search" method="get"  action="<?php echo home_url( '/' ); ?>">
                                                <div>
                                                    <input type="text"  autocomplete="off" name="s" class='live_search' value="<?php _e('Type something..','ioa') ?>" />
                                                    <input type="submit"  value="Search" />
                                                    <span class="search-loader"></span>
                                                </div>
                                            </form>
                                          </div>
                                          <div class="search-results clearfix">
                                            <ul>
                                             
                                            </ul>
                                          </div>
                                      </div>

                                  </div> 
                                  <?php break; 
                case 'tagline' : ?>
                                  <h6 class="custom-font tagline <?php echo $el['align'] ?>" style='padding:<?php echo $m ?>'><?php echo get_bloginfo('description'); ?></h6>
                                  <?php break;                                               
                                                                       
              }
      }  
 ?>

<?php 
       
      // Title for Posts/Pages  
    
    

                switch($super_options[SN.'_head_shadow'])
                {
                   case "Type 1" : ?> <div class="skeleton  header-shadow-area  auto_align"><span class="menu_shadow_type1"></span>  </div><?php break;
                   case "Type 2" : ?> <div class="skeleton  header-shadow-area auto_align"><span class="menu_shadow_type2"></span> </div> <?php break;
                   case "Type 3" : ?> <div class="skeleton  header-shadow-area auto_align"><span class="sh_left_wing"></span> </div> <?php break;
                   case "Type 4" : ?> <div class="skeleton  header-shadow-area auto_align"><span class="sh_right_wing"></span> </div> <?php break;
                   case "Type 5" : ?> <div class="skeleton  header-shadow-area auto_align"><span class="sh_left_wing"></span><span class="sh_right_wing"></span> </div> <?php break;
                }

                ?>

 
</div> 
<?php get_template_part('templates/content-title'); 
 if(is_author()|| is_search() || is_tag() || is_category() || is_archive()) $meta_data['layout'] = 'right-sidebar';
 ?>

<?php if( !is_tax() && isset($meta_data['layout']) && $meta_data['layout'] =="left-sidebar") echo "<div class='skeleton auto_align'><span class='left-tip'></span></div>"; ?>
<?php if( !is_tax() && isset($meta_data['layout']) && $meta_data['layout'] =="right-sidebar") echo "<div class='skeleton  auto_align'><span class='right-tip'></span></div>"; ?>

</div> <!-- END OF THEME HEADER ~~ Top Bar + Menu + Title -->


<!--
 Below Title Layout Sidebar
-->

<?php  if(isset($meta_data['layout']) && $meta_data['layout']=="below-title") : ?>

 <div itemscope itemtype='http://schema.org/WPSideBar' class="sidebar <?php echo $meta_data['layout']; ?>" id="sidebar"><!-- start of one-third column -->
  
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

<?php if( !is_home() && ! is_404() && get_post_meta( $post->ID, 'show_title', true ) !="no" ) : ?>
<div class="mobile-title">
    <h2 class="custom-title" ><?php echo $meta_data['title']; ?></h2>
</div>
<?php endif; ?>