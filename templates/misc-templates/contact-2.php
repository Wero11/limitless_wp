<?php
global $helper, $meta_data,$post,$super_options;

?>
<div class="map-wrapper">
  <div id="map"></div>
    <div class="overlay-address-area" style='background:<?php echo get_post_meta(get_the_ID(),'dominant_bg_color',true); ?>'>
        <div class="overlay-address"  style='color:<?php echo get_post_meta(get_the_ID(),'dominant_color',true); ?>;border-color:<?php echo get_post_meta(get_the_ID(),'dominant_color',true); ?>'>
           <div class="inner-overlay-address" style='border-color:<?php echo get_post_meta(get_the_ID(),'dominant_color',true); ?>' itemprop="address">
             <?php echo $helper->format( $super_options[SN.'_prop_address']); ?>
           </div>
        </div>
    </div>
</div>

<?php 
 switch($meta_data['featured_media_type'])
    {
      case "slider-full" :
      case "slider-contained" :
      case "slideshow-contained" :
      case "none-full" :
      case 'image-parallex' : 
      case 'image-full' : get_template_part('templates/content-featured-media'); break;
    }
 ?>
<div class="page-wrapper <?php echo $post->post_type ?>" itemscope itemtype="http://schema.org/ContactPage">
  
  <div class="skeleton clearfix auto_align">

    

    
    <div class="mutual-content-wrap <?php if($meta_data['layout']!="full") echo 'has-sidebar has-'.$meta_data['layout'];  ?>">
      
            <?php  
        switch($meta_data['featured_media_type'])
        {
          case 'slider' :
          case 'slideshow' :
          case 'video' :
          case 'proportional' :
          case 'none-contained' :
          case 'image' : get_template_part('templates/content-featured-media'); break;
        }
      ?>
      <?php if($super_options[SN.'_prop_address']!="") : ?>
 
      
  
       <?php endif; ?>

      <?php  if(have_posts()): while(have_posts()) : the_post(); ?>
  
        <div class="page-content">
          <?php the_content(); ?>
        </div>
  
      <?php endwhile; endif; ?>
  
      
    </div>

    
    <?php get_sidebar(); wp_reset_query(); ?>

  </div>
  <?php rad_area_init(); ?>
  

</div>

 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
 <script type="text/javascript">
 var geocoder,map;

 function initialize() {
    
    geocoder = new google.maps.Geocoder();
    var address  = '<?php echo stripslashes($super_options[SN.'_address']); ?>';
    var mapOptions = {
      
      zoom: <?php echo $super_options[SN.'_map_zoom'] ?>,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
  }
    };

    var styles = [
    {
      stylers: [
        { hue: "<?php echo $super_options[SN.'_map_color'] ?>" },
        { saturation:0 }
      ]
    },{
      featureType: "road",
      elementType: "geometry",
      stylers: [
        { lightness: 0 },
        { visibility: "simplified" }
      ]
    },{
      featureType: "road",
      elementType: "labels",
      stylers: [
        { visibility: "off" }
      ]
    }
  ];
        

    var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
    var image = '<?php echo URL ?>/sprites/i/map-pin.png';

    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        
        
        google.maps.visualRefresh = true;
    map = new google.maps.Map(document.getElementById("map"),  mapOptions);
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
    map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
             icon: image
        });
      } 
    

    });

   



}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php get_footer(); ?>
      