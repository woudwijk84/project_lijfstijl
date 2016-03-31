<?php 
function wooshopping_shortcode( $args, $instance ) {

		$args = shortcode_atts( array(
			'title' => 'Woo Shopping Hours',
			'mondayfrom' => '10:00am',
			'mondayto' => '10:00pm',
			'tuesdayfrom' => '10:00am',
			'tuesdayto' => '10:00pm',
			'wednesdayfrom' => '10:00am',
			'wednesdayto' => '10:00pm',
			'thursdayfrom' => '10:00am',
			'thursdayto' => '10:00pm',
			'fridayfrom' => '10:00am',
			'fridayto' => '10:00pm',
			'saturdayfrom' => '10:00am',
			'saturdayto' => '10:00pm',
			'sundayfrom' => '10:00am',
			'sundayto' => '10:00pm',
			'wooshoppingbgcolor' => '#000000',
			'wooshoppingfontcolor' => '#ffffff'

		), $args );

		$wooshopping__currentday_style = 'style="background-color:'.$args["wooshoppingbgcolor"].';color:'.$args["wooshoppingfontcolor"].';"';
		$wooshopping_options = get_option( "wooshopping-options" );
		$timezone = $wooshopping_options["timezone"];
		if(empty($timezone))
			$timezone = 'UTC';
		
		$date = new DateTime('now', new DateTimeZone($timezone));
		$currentday = $date->format('w');

		$_monday_from = ($args["mondayfrom"] == 'Close') ? __("Close", "woo-shopping") : $args["mondayfrom"];
		$_monday_to = ($args["mondayto"] == 'Close') ? __("Close", "woo-shopping") : $args["mondayto"];
		$_tuesday_from = ($args["tuesdayfrom"] == 'Close') ? __("Close", "woo-shopping") : $args["tuesdayfrom"];
		$_tuesday_to = ($args["tuesdayto"] == 'Close') ? __("Close", "woo-shopping") : $args["tuesdayto"];
		$_wednesday_from = ($args["wednesdayfrom"] == 'Close') ? __("Close", "woo-shopping") : $args["wednesdayfrom"];
		$_wednesday_to = ($args["wednesdayto"] == 'Close') ? __("Close", "woo-shopping") : $args["wednesdayto"];
		$_thursday_from = ($args["thursdayfrom"] == 'Close') ? __("Close", "woo-shopping") : $args["thursdayfrom"];
		$_thursday_to = ($args["thursdayto"] == 'Close') ? __("Close", "woo-shopping") : $args["thursdayto"];
		$_friday_from = ($args["fridayfrom"] == 'Close') ? __("Close", "woo-shopping") : $args["fridayfrom"];
		$_friday_to = ($args["fridayto"] == 'Close') ? __("Close", "woo-shopping") : $args["fridayto"];
		$_saturday_from = ($args["saturdayfrom"] == 'Close') ? __("Close", "woo-shopping") : $args["saturdayfrom"];
		$_saturday_to = ($args["saturdayto"] == 'Close') ? __("Close", "woo-shopping") : $args["saturdayto"];
		$_sunday_from = ($args["sundayfrom"] == 'Close') ? __("Close", "woo-shopping") : $args["sundayfrom"];
		$_sunday_to = ($args["sundayto"] == 'Close') ? __("Close", "woo-shopping") : $args["sundayto"];
		
		$output = '';
		$output .=
		'<h2 style="text-align: center">'. $args["title"] .'</h2>
		<table class="wooshopping-table" width="100%">
			<thead>
				<tr><th>'. __("Dag", "woo-shopping") .'</th><th>'. __("Vanaf", "woo-shopping") .'</th><th>'. __("Tot", "woo-shopping") .'</th></tr>
			</thead>
			<tbody>
				<tr '; 
				if ($currentday == 1)
					$output .= $wooshopping__currentday_style;
				$output .= ' ><td>'. __("Maandag", "woo-shopping") .'</td><td colspan="2" style="text-align: center">'. $_monday_from .'</td></tr>
				<tr '; 
				if ($currentday == 2)
					$output .= $wooshopping__currentday_style;
				$output .= ' ><td>'. __("Dinsdag", "woo-shopping") .'</td><td>'. $_tuesday_from .'</td><td>'. $_tuesday_to .'</td></tr>
				<tr '; 
				if ($currentday == 3)
					$output .= $wooshopping__currentday_style;
				$output .= ' ><td>'. __("Woensdag", "woo-shopping") .'</td><td>'. $_wednesday_from .'</td><td>'. $_wednesday_to .'</td></tr>
				<tr '; 
				if ($currentday == 4)
					$output .= $wooshopping__currentday_style;
				$output .= ' ><td>'. __("Donderdag", "woo-shopping") .'</td><td>'. $_thursday_from .'</td><td>'. $_thursday_to .'</td></tr>
				<tr '; 
				if ($currentday == 5)
					$output .= $wooshopping__currentday_style;
				$output .= ' ><td>'. __("Vrijdag", "woo-shopping") .'</td><td>'. $_friday_from .'</td><td>'. $_friday_to .'</td></tr>
				<tr '; 
				if ($currentday == 6)
					$output .= $wooshopping__currentday_style;
				$output .= ' ><td>'. __("Zaterdag", "woo-shopping") .'</td><td>'. $_saturday_from .'</td><td>'. $_saturday_to .'</td></tr>
				<tr '; 
				if ($currentday == 0)
					$output .= $wooshopping__currentday_style;
				$output .= ' ><td>'. __("Zondag", "woo-shopping") .'</td><td colspan="2" style="text-align: center">'. $_sunday_from .'</td></tr>
		    </tbody>
		</table>';
	return $output;	
		
}

// Generate Shortcode
add_shortcode( 'wooshopping', 'wooshopping_shortcode' );
