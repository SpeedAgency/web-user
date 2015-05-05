
<?php function social_page_info() { ?>	
<form method="post" action="options.php">
 <?php settings_fields( 'social-settings-fam' ); ?>
 <?php do_settings_sections( 'social-settings-fam' ); ?>
    
<?php
    $socialmedia = get_option('socialmedia');
    $smi = 0;
    echo '<div class="social-group">';
    if($socialmedia){
        foreach($socialmedia as $sm){
         echo   '<div class="form-group sm-group">
                <span class="dashicons dashicons-'.$sm['site'].'"></span>
                <select name="socialmedia['.$smi.'][site]">

                    <option value="">Select One</option>
                    <option value="twitter" '.($sm['site']=="twitter" ? "selected='selected'" : "").'>Twitter</option>
                    <option value="facebook" '.($sm['site']=="facebook" ? "selected='selected'" : "").'>Facebook</option>
                    <option value="instagram" '.($sm['site']=="instagram" ? "selected='selected'" : "").'>Instagram</option>
                    <option value="linked-in" '.($sm['site']=="linked-in" ? "selected='selected'": "").'>LinkedIn</option>

                </select>
                <input type="url" name="socialmedia['.$smi.'][url]" class="form-control" value="'.$sm['url'].'" data-bv-notempty />
            </div>';
        }
    }else{
        
        echo '<div class="form-group sm-group">
                <span class="dashicons dashicons-smiley"></span>
                <select name="socialmedia['.$smi.'][site]">

                    <option value="">Select One</option>
                    <option value="twitter">Twitter</option>
                    <option value="facebook">Facebook</option>
                    <option value="instagram">Instagram</option>
                    <option value="linked-in">LinkedIn</option>

                </select>
                <input type="url" name="socialmedia['.$smi.'][url]" class="form-control" value="" data-bv-notempty />
            </div>';
            
            
    }
                                   echo '</div>';
 		?>
    
    <button class="add_social">Add more!</button>
    
    <script type="text/javascript">
        jQuery(function($){
           
            var smi = <?php echo $smi; ?>;
            
            $(".add_social").click(function(){
                smi++;
                var fieldset = '<div class="form-group sm-group">'+
                                '<span class="dashicons dashicons-smiley"></span>'+
                                '<select name="socialmedia['+smi+'][site]">'+
                                    '<option value="">Select One</option>'+
                                    '<option value="twitter">Twitter</option>'+
                                    '<option value="facebook">Facebook</option>'+
                                    '<option value="instagram">Instagram</option>'+
                                    '<option value="linked-in">LinkedIn</option>'+
                                '</select>'+
                                '<input type="url" name="socialmedia['+smi+'][url]" class="form-control" value="" data-bv-notempty /></div>';
                
                $(".social-group").append(fieldset);
                
                return false;
                
            });
            
        });
    </script>
    <!--<div class="form-group">
    	    <span class="dashicons dashicons-facebook-alt"></span><label>Facebook</label>
    	    <input type="url" name="social_fb" id="social_fb" placeholder="https://www.facebook.com" class="form-control" value="<?php echo esc_attr( get_option('social_fb') ); ?>" data-bv-notempty />
    	</div>
    	<div class="form-group">
    	    <span class="dashicons dashicons-share-alt2"></span><label>Linkedin</label>
    	    <input type="url" name="social_linkedin" id="social_linkedin" placeholder="https://www.linkedin.com" class="form-control" value="<?php echo esc_attr( get_option('social_linkedin') ); ?>" data-bv-notempty />
    	</div>
    	<div class="form-group">
    	    <span class="dashicons dashicons-share-alt2"></span><label>Youtube</label>
    	    <input type="url" name="social_youtube" id="social_youtube" placeholder="https://www.youtube.com" class="form-control" value="<?php echo esc_attr( get_option('social_youtube') ); ?>" data-bv-notempty />
    	</div>-->
    	<input type="submit" name="submit" id="submit" class="button button-primary save-button" value="Save Changes"  />
 </form>
 
 
<?php } ?>

<?php
/** Register ALL DATA **/
add_action( 'admin_init', 'social_settings' );

function social_settings() {
    register_setting('social-settings-fam', 'socialmedia');
register_setting( 'social-settings-fam', 'social_tweet' );
register_setting( 'social-settings-fam', 'social_fb' );
register_setting( 'social-settings-fam', 'social_linkedin' );
register_setting( 'social-settings-fam', 'social_youtube' );

} 
/** Register ALL DATA END **/

/** DEFINE ALL DATA **/
  if( get_option('social_tweet')){
    $social_tweet = get_option('social_tweet');
    define('social_tweet', $social_tweet);
    } else {
	    define('social_tweet', 'Twitter url here');
   }
   if( get_option('social_fb')){
    $social_fb = get_option('social_fb');
    define('social_fb', $social_fb);
    } else {
	    define('social_fb', 'Facebook url here');
   }
   if( get_option('social_linkedin')){
    $social_linkedin = get_option('social_linkedin');
    define('social_linkedin', $social_linkedin);
    } else {
	    define('social_linkedin', 'Linkedin url here');
   }
   if( get_option('social_youtube')){
    $social_youtube = get_option('social_youtube');
    define('social_youtube', $social_youtube);
    } else {
	    define('social_youtube', 'Youtube url here');
   }
   
   /** DEFINE ALL DATA END **/
   
  
?>