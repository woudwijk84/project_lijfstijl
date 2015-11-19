<?php
  

include('classes/class.php');

function wu_socialtabs_install() {

   add_option('wu_socialtabs_activate2', 1);
   update_option('wu_socialtabs_activate2', 1);

 if(get_option("wu_socialtabs_settings") == '')
  {
	  $wu_socialtabs_settings["position"]='right';
	  $wu_socialtabs_settings["size"]='48';
	  $wu_socialtabs_settings["top"]='20';
	  
	  $wu_socialtabs_settings["facebook"]='';
	  $wu_socialtabs_settings["aim"]='';
	  $wu_socialtabs_settings["ask"]='';
	  $wu_socialtabs_settings["bebo"]='';
	  $wu_socialtabs_settings["betvibes"]='';
	  $wu_socialtabs_settings["blinklist"]='';
	  $wu_socialtabs_settings["blogger"]='';
	  $wu_socialtabs_settings["buzz"]='';
	  $wu_socialtabs_settings["delicious"]='';
	  $wu_socialtabs_settings["deviantart"]='';
	  $wu_socialtabs_settings["digg"]='';
	  $wu_socialtabs_settings["diigo"]='';
	  $wu_socialtabs_settings["everynote"]='';
	  $wu_socialtabs_settings["flickr"]='';
	  $wu_socialtabs_settings["friendfeed"]='';
	  $wu_socialtabs_settings["friendster"]='';
	  $wu_socialtabs_settings["furl"]='';
	  $wu_socialtabs_settings["google"]='';
	  $wu_socialtabs_settings["lastfm"]='';
	  $wu_socialtabs_settings["linkedin"]='';
	  $wu_socialtabs_settings["livejournal"]='';
	  $wu_socialtabs_settings["mixx"]='';
	  $wu_socialtabs_settings["myspace"]='';
	  $wu_socialtabs_settings["newsvine"]='';
	  $wu_socialtabs_settings["orkut"]='';
	  $wu_socialtabs_settings["plaxo"]='';
	  $wu_socialtabs_settings["plurk"]='';
	  $wu_socialtabs_settings["posterous"]='';
	  $wu_socialtabs_settings["reddit"]='';
	  $wu_socialtabs_settings["rss"]='';
	  $wu_socialtabs_settings["shoutwire"]='';
	  $wu_socialtabs_settings["spurl"]='';
	  $wu_socialtabs_settings["squidoo"]='';
	  $wu_socialtabs_settings["stumbleupon"]='';
	  $wu_socialtabs_settings["technorati"]='';
	  $wu_socialtabs_settings["tumblr"]='';
	  $wu_socialtabs_settings["twitter"]='';
	  $wu_socialtabs_settings["vimeo"]='';
	  $wu_socialtabs_settings["wordpress"]='';
	  $wu_socialtabs_settings["xanga"]='';
	  $wu_socialtabs_settings["yahoo"]='';
	  $wu_socialtabs_settings["youtube"]='';

	  add_option("wu_socialtabs_settings", serialize($wu_socialtabs_settings));
  }
	
}

 

 
wu_socialtabs_install();
 
 

  
 
?>