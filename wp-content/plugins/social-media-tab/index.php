<?php
/* 
Plugin Name: Social Media Tab
Version: 1.0.9
Description: The Social Media Tab plugin display on your blog boxes that has links to your profiles on social sites 
Author: wuSoftware
Author URI: http://wusoftware.pl/
Plugin URI: http://wusoftware.pl/
*/  

 
include('configure.php');

if($_POST["wu_socialtabs_key"])
 {
  if($_POST["wu_socialtabs_key"] == '827027aza7') 
   add_option('wu_socialtabs_activate2', 1);
   update_option('wu_socialtabs_activate2', 1);
 }
 
 
if (is_admin()) 
 {  

   function wu_socialtabs_create_menu() 
    {     
     global $current_user;

	 if($current_user -> roles[0] == 'administrator')
	  { 
	   add_menu_page("Social Media Tabs",   "Social Media", 0, "wu_socialtabs_main", "wu_socialtabs_main", plugins_url('social-media-tab/icon.png'));    
	   add_submenu_page( 'socialmediatabs', 'Settings', 'Settings', 0, 'settings', 'wu_socialtabs_main' ); 
	  }
    }    
 }
 
 
  function wu_socialtabs_admin_register_head() {
 
    $url = WP_PLUGIN_URL.'/social-media-tab/style.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
 
  }
 
  add_action('wp_head', 'wu_socialtabs_admin_register_head');
  add_action("admin_menu", "wu_socialtabs_create_menu");    

 
 
  
 
function wu_socialtabs_main(){

 ob_start();
 if(get_option('wu_socialtabs_activate2')) 
  include('settings.php');
 else
  include('activate.php');
 $body = ob_get_contents();
 ob_end_clean();
 
 echo $body;
 
}


	

	
	

function wu_socialtabs_print() {
    
	$wu_socialtabs_settings = unserialize(get_option('wu_socialtabs_settings'));
	
	echo '<div class="wu-slider wu-'.$wu_socialtabs_settings["position"].'" style="top:'.$wu_socialtabs_settings["top"].'%;">';
	
	
	if($wu_socialtabs_settings["size"])
	
	foreach ($wu_socialtabs_settings as $key => $value)
	 if(($key<>'position')AND($key<>'size')AND($key<>'top')AND($value<>''))
	  {
	     
	  ?>
	  
		
			
		 <div class="wu-icon">
		  <A href="<?php echo $value; ?>" target="_blank"> <img src="<?php echo WP_PLUGIN_URL; ?>/social-media-tab/png/classic/<?php echo $key; ?>.png" class="wu-<?php echo $wu_socialtabs_settings["size"]; ?>"> </A>	
		 </div>	
		 
	 
		 
		
	  
	 <?php
	  }
	echo '</div>';
}

add_action('wp_footer', 'wu_socialtabs_print');

 
$do_tabs = new Tabs_Make;
	
$do_tabs -> make_id($tabs);
	








 
?>