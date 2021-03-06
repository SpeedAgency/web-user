
<?php function contact_page_info() { ?>	
 <form action="options.php" method="post">
 <?php settings_fields( 'my-plugin-settings-group' ); ?>
 <?php do_settings_sections( 'my-plugin-settings-group' ); ?>
 		<div class="form-group">
    	    <span class="dashicons dashicons-email-alt"></span><label>User Email</label>
    	    <input type="text" name="contact_deets_email" id="contact_deets_email" class="form-control" value="<?php echo esc_attr( get_option('contact_deets_email') ); ?>" data-bv-notempty />
    	</div>
    	<div class="form-group">
    	    <span class="dashicons dashicons-admin-site"></span><label>User Address</label>
    	    <input type="text" name="contact_deets_address" id="contact_deets_addresss" class="form-control" value="<?php echo esc_attr( get_option('contact_deets_address') ); ?>" data-bv-notempty />
    	</div>
		<div class="form-group">
    	    <span class="dashicons dashicons-phone"></span><label>User Phone:</label>
    	    <input type="text" name="contact_deets_phone" id="contact_deets_phone" class="form-control" value="<?php echo esc_attr( get_option('contact_deets_phone') ); ?>" data-bv-notempty />
    	</div>
	<div class="form-group">
	    <div class="title-pg"><h2>Google map</h2></div>
        <label>Location</label>
        <?php 
            $location_opt = get_option('location');
        ?>
    </div>
    <div id="map-canvas"></div>
    <div id="panel">
      <input id="address" type="text" name="location[address]" value="<?php echo esc_attr($location_opt['address']); ?>" class="form-control" onkeyup="codeAddress();">
        
      <?php // Add Latitude and Longitide Form Fields. These will be saved to the $location array. ?>
      <input id="address_lat" type="hidden" name="location[lat]" value="<?php echo esc_attr($location_opt['lat']); ?>">
      <input id="address_lng" type="hidden" name="location[lng]" value="<?php echo esc_attr($location_opt['lng']); ?>">
      <input id="address_zoom" type="hidden" name="location[zoom]" value="<?php echo esc_attr($location_opt['zoom']); ?>">
     <!-- <input type="button" value="Geocode" onclick="codeAddress()" class="button-primary">-->
    </div>
    <input type="submit" name="submit" id="submit" class="button button-primary save-button" value="Save Changes"  />
 </form>
	

<?php } ?>

<?php 
/** Register ALL DATA **/
add_action( 'admin_init', 'my_plugin_settings' );

function my_plugin_settings() {
register_setting( 'my-plugin-settings-group', 'contact_deets_email' );
register_setting( 'my-plugin-settings-group', 'contact_deets_address' );
register_setting( 'my-plugin-settings-group', 'contact_deets_phone' );
register_setting( 'my-plugin-settings-group', 'location');
} 
/** Register ALL DATA END **/

/** DEFINE ALL DATA **/
  if( get_option('contact_deets_email')){
    $user_email = get_option('contact_deets_email');
    define('user_email', $user_email);
    } else {
	    define('user_email', 'email here');
   }
   if( get_option('contact_deets_phone')){
        $user_phone = get_option('contact_deets_phone');
        define('user_phone', $user_phone);
    } else {
	    define('user_phone', 'Phone number here');
   }
    if( get_option('contact_deets_address')){
        $user_address = get_option('contact_deets_address');
        define('user_address', $user_address);
    } else {
	    define('user_address', 'address here');
   }


    // Setup the defines for the $location array. Remember to add default fallbacks. 
    if( get_option('location')){
        $location = get_option('location');
        define('location_address', $location['address']);
        define('location_lat', $location['lat']);
        define('location_lng', $location['lng']);
        define('location_zoom', $location['zoom']);
    } else {
	    define('location_address', 'location here');
        define('location_lat', 0);
        define('location_lng', 0);
        define('location_zoom', 8);
   }
   
   /** DEFINE ALL DATA END **/
?>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(<?php echo location_lat.', '.location_lng; ?>);
  var mapOptions = {
    zoom: <?php echo location_zoom; ?>,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    
 <?php if(location_lat){
        echo 'var marker = new google.maps.Marker({
          map: map,
          position: latlng
      });'; 
   }?>
    
    google.maps.event.addListener(map, 'zoom_changed', function(){
   
    document.getElementById("address_zoom").value = map.getZoom();
    
});

}

function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
        
      <?php // Get the value of Lat and Lng for the form fields. ?>    
      document.getElementById("address_lat").value = results[0].geometry.location['A'];
      document.getElementById("address_lng").value = results[0].geometry.location['F'];
        
        
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      console.log('Geocode was not successful for the following reason: ' + status);
    }
  });
}


google.maps.event.addDomListener(window, 'load', initialize);


</script>

