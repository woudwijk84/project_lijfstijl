<?php
/*
	Plugin Name: Woo Shopping Hours Lite
	Plugin URI: http://www.wpfruits.com
	Description: Woo Shopping Hours Lite is a multipurpose wordpress plugin that enables woocommerce sites to specify shopping time, hot deals, shop opening hours, limited period deals and other offers limited within hours. This plugin is built on 100% woocommerce framework which gives extra convenience to every user. With Woo-Commerce shoppings hours plugin, you can select time zone, set time format, set different times for each day of the week and even coloured highlight for current day. With easy shortcodes for widget, this plugin is perfectly developed for multiplying business on your woocommerce site.
	Version: 1.0.0
	Author: WPfruits
	Author URI: http://www.wpfruits.com
*/

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function wooshopping_load_textdomain() {
  load_plugin_textdomain( 'woo-shopping', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'wooshopping_load_textdomain' );

class WooShoppingSettingPage
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'wooshopping_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'wooshopping_page_init' ) );
	}

	/**
	 * Add plugin page
	 */
	public function wooshopping_plugin_page()
	{
		// This page will be in "Dashboard Menu"
		add_menu_page(
			__('Settings Admin', 'woo-shopping'), 
			__('Woo Shop Hours', 'woo-shopping'), 
			'manage_options', 
			'wooshopping-setting-admin', 
			array( $this, 'wooshopping_admin_page' ),
			plugins_url( '/images/icon.png',__FILE__)
		);
	}

	/**
	 * Plugin page callback
	 */
	public function wooshopping_admin_page()
	{
		// Set class property
		$this->options = get_option( 'wooshopping-options' );
?>
		<div class="wrap">
			<h2><?php _e('Woo Shopping Hours', 'woo-shopping'); ?></h2>
			<div id="wooshopping_setting">
			<form method="post" action="options.php">
			<?php
				// This printts out all hidden setting fields          
				settings_fields( 'wooshopping_option_group' );   
				do_settings_sections( 'wooshopping-setting-admin' );
				?>
				<hr/>
				<?php
				submit_button();
			?>
			</form>
			</div>
		</div>
<?php
	}

	/**
	 * Register and add settings
	 */
	public function wooshopping_page_init()
	{
		register_setting(
			'wooshopping_option_group', // Option group
			'wooshopping-options', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'setting_section_id', // ID
			'', // Title
			array( $this, 'wooshopping_print_section_info' ), // Callback
			'wooshopping-setting-admin' // Page
		);  

		add_settings_field(
			'time_zone', // ID
			__('Select Timezone','woo-shopping'), // Title 
			array( $this, 'wooshopping_time_zone_callback' ), // Callback
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section           
		);

		add_settings_field(
			'time_format', // ID
			__('Time Format','woo-shopping'), // Title 
			array( $this, 'wooshopping_time_format_callback' ), // Callback
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section           
		);

		add_settings_field(
			'monday', // ID
			__('Monday','woo-shopping'), // Title 
			array( $this, 'wooshopping_monday_callback' ), // Callback
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section           
		);    

		add_settings_field(
			'tuesday', // ID
			__('Tuesday','woo-shopping'), // Title
			array( $this, 'wooshopping_tuesday_callback' ), // Callback
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'wednesday', // ID
			__('Wednesday','woo-shopping'), // Title
			array( $this, 'wooshopping_wednesday_callback' ), // Callback
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'thursday', // ID
			__('Thursday','woo-shopping'), // Title
			array( $this, 'wooshopping_thursday_callback' ), // Callback 
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'friday', // ID
			__('Friday','woo-shopping'), // Title
			array( $this, 'wooshopping_friday_callback' ), // Callback
			'wooshopping-setting-admin', // Page
			'setting_section_id' //Section
		);

		add_settings_field(
			'saturday', // ID
			__('Saturday','woo-shopping'), // Title
			array( $this, 'wooshopping_saturday_callback' ), // Callback
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'sunday', // ID
			__('Sunday','woo-shopping'), // Title
			array( $this, 'wooshopping_sunday_callback' ), // Callback 
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);


		add_settings_field(
			'highlight_color', // ID
			__('Highlight Current Day','woo-shopping'), // Title
			array( $this, 'wooshopping_highlight_bgcolor_callback' ), // Callback 
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'highlight_font_color', // ID
			'', // Title
			array( $this, 'wooshopping_highlight_color_callback' ), // Callback 
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'genrated_shortcode', // ID
			__('Genrated Shortcode','woo-shopping'), // Title
			array( $this, 'wooshopping_genrated_shortcode_callback' ), // Callback 
			'wooshopping-setting-admin', // Page
			'setting_section_id' // Section
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input )
	{
		$new_input = array();

		if( isset( $input['timeformat'] ) )
			$new_input['timeformat'] = sanitize_text_field( $input['timeformat'] );

		if( isset( $input['timezone'] ) )
			$new_input['timezone'] = sanitize_text_field( $input['timezone'] );

		if( isset( $input['mondayfrom'] ) )
			$new_input['mondayfrom'] = sanitize_text_field( $input['mondayfrom'] );
		if( isset( $input['mondayto'] ) )
			$new_input['mondayto'] = sanitize_text_field( $input['mondayto'] );
		    
		if( isset( $input['tuesdayfrom'] ) )
			$new_input['tuesdayfrom'] = sanitize_text_field( $input['tuesdayfrom'] );
		if( isset( $input['tuesdayto'] ) )
			$new_input['tuesdayto'] = sanitize_text_field( $input['tuesdayto'] );

		if( isset( $input['wednesdayfrom'] ) )
			$new_input['wednesdayfrom'] = sanitize_text_field( $input['wednesdayfrom'] );
		if( isset( $input['wednesdayto'] ) )
			$new_input['wednesdayto'] = sanitize_text_field( $input['wednesdayto'] );

		if( isset( $input['thursdayfrom'] ) )
			$new_input['thursdayfrom'] = sanitize_text_field( $input['thursdayfrom'] );
		if( isset( $input['thursdayto'] ) )
			$new_input['thursdayto'] = sanitize_text_field( $input['thursdayto'] );

		if( isset( $input['fridayfrom'] ) )
			$new_input['fridayfrom'] = sanitize_text_field( $input['fridayfrom'] );
		if( isset( $input['fridayto'] ) )
			$new_input['fridayto'] = sanitize_text_field( $input['fridayto'] );

		if( isset( $input['saturdayfrom'] ) )
			$new_input['saturdayfrom'] = sanitize_text_field( $input['saturdayfrom'] );
		if( isset( $input['saturdayto'] ) )
			$new_input['saturdayto'] = sanitize_text_field( $input['saturdayto'] );

		if( isset( $input['sundayfrom'] ) )
			$new_input['sundayfrom'] = sanitize_text_field( $input['sundayfrom'] );
		if( isset( $input['sundayto'] ) )
			$new_input['sundayto'] = sanitize_text_field( $input['sundayto'] );

		if( isset( $input['wooshoppingbgcolor'] ) )
			$new_input['wooshoppingbgcolor'] = sanitize_text_field( $input['wooshoppingbgcolor'] );

		if( isset( $input['wooshoppingfontcolor'] ) )
			$new_input['wooshoppingfontcolor'] = sanitize_text_field( $input['wooshoppingfontcolor'] );

		return $new_input;
	}

	/** 
	 * Print the Section text
	 */
	public function wooshopping_print_section_info()
	{
		echo '<div id="wooshopping-setting-note"><p><br/>'.__("The saved settings will work in the Woo Shopping Hours Widget.You can also use Genrated Shortcode in the page or post.", "woo-shopping").'</p></div><hr/>';
	}

	/** 
	 * Get the settings option array and print one of its values
	 */

	public function wooshopping_time_zone_callback()
	{
		$timezone = $this->options["timezone"];
		if(empty($timezone))
			$timezone = 'UTC';
		$date = new DateTime('now', new DateTimeZone($timezone));
		$localtime = $date->format('h:i:s a');
		echo '<select id="timezone" name="wooshopping-options[timezone]">'.wp_timezone_choice($timezone).'</select><br>';
		echo "Local time is $localtime.";

	}

	public function wooshopping_time_format_callback()
	{
		
		echo '<select id="timeformat" name="wooshopping-options[timeformat]"><option value="12 hours"';
			if($this->options["timeformat"]=="12 hours") { echo 'selected'; }
			echo '>12 hours</option><option value="24 hours"';
			if($this->options["timeformat"]=="24 hours") { echo 'selected'; }
			echo '>24 hours</option>
		</select>';
	}

	public function wooshopping_monday_callback()
	{
		printf(
			'<input type="text" id="mondayfrom" class="wooshopping-input" name="wooshopping-options[mondayfrom]" value="%s" />
			 <input type="text" id="mondayto" class="wooshopping-input" name="wooshopping-options[mondayto]" value="%s" />',
			isset( $this->options['mondayfrom'] ) ? esc_attr( $this->options['mondayfrom']) : '',
			isset( $this->options['mondayto'] ) ? esc_attr( $this->options['mondayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function wooshopping_tuesday_callback()
	{
		printf(
			'<input type="text" id="tuesdayfrom" class="wooshopping-input" name="wooshopping-options[tuesdayfrom]" value="%s" />
			 <input type="text" id="tuesdayto" class="wooshopping-input" name="wooshopping-options[tuesdayto]" value="%s" />',
			isset( $this->options['tuesdayfrom'] ) ? esc_attr( $this->options['tuesdayfrom']) : '',
			isset( $this->options['tuesdayto'] ) ? esc_attr( $this->options['tuesdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function wooshopping_wednesday_callback()
	{
		printf(
			'<input type="text" id="wednesdayfrom" class="wooshopping-input" name="wooshopping-options[wednesdayfrom]" value="%s" />
			 <input type="text" id="wednesdayto" class="wooshopping-input" name="wooshopping-options[wednesdayto]" value="%s" />',
			isset( $this->options['wednesdayfrom'] ) ? esc_attr( $this->options['wednesdayfrom']) : '',
			isset( $this->options['wednesdayto'] ) ? esc_attr( $this->options['wednesdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function wooshopping_thursday_callback()
	{
		printf(
			'<input type="text" id="thursdayfrom" class="wooshopping-input" name="wooshopping-options[thursdayfrom]" value="%s" />
			 <input type="text" id="thursdayto" class="wooshopping-input" name="wooshopping-options[thursdayto]" value="%s" />',
			isset( $this->options['thursdayfrom'] ) ? esc_attr( $this->options['thursdayfrom']) : '',
			isset( $this->options['thursdayto'] ) ? esc_attr( $this->options['thursdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function wooshopping_friday_callback()
	{
		printf(
			'<input type="text" id="fridayfrom" class="wooshopping-input" name="wooshopping-options[fridayfrom]" value="%s" />
			 <input type="text" id="fridayto" class="wooshopping-input" name="wooshopping-options[fridayto]" value="%s" />',
			isset( $this->options['fridayfrom'] ) ? esc_attr( $this->options['fridayfrom']) : '',
			isset( $this->options['fridayto'] ) ? esc_attr( $this->options['fridayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function wooshopping_saturday_callback()
	{
		printf(
			'<input type="text" id="saturdayfrom" class="wooshopping-input" name="wooshopping-options[saturdayfrom]" value="%s" />
			 <input type="text" id="saturdayto" class="wooshopping-input" name="wooshopping-options[saturdayto]" value="%s" />',
			isset( $this->options['saturdayfrom'] ) ? esc_attr( $this->options['saturdayfrom']) : '',
			isset( $this->options['saturdayto'] ) ? esc_attr( $this->options['saturdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function wooshopping_sunday_callback()
	{
		printf(
			'<input type="text" id="sundayfrom" class="wooshopping-input" name="wooshopping-options[sundayfrom]" value="%s" />
			 <input type="text" id="sundayto" class="wooshopping-input" name="wooshopping-options[sundayto]" value="%s" />',
			isset( $this->options['sundayfrom'] ) ? esc_attr( $this->options['sundayfrom']) : '',
			isset( $this->options['sundayto'] ) ? esc_attr( $this->options['sundayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function wooshopping_genrated_shortcode_callback()
	{
		echo '<textarea id="genrated-shortcode" onclick="this.focus();this.select()" name="genrated-shortcode" rows="8" cols="50" readonly></textarea>
			<p id="boh-message">Copy and Paste above shortcode. You can change title attribute as you wish.</p>';
	}

	public function wooshopping_highlight_bgcolor_callback()
	{
		printf('<p><label>Select Background Color&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></p><p><input type="text" id="wooshoppingbgcolor" name="wooshopping-options[wooshoppingbgcolor]" value="%s" class="wooshopping-highlight-color" data-default-color="#000000" /></p>',
			isset( $this->options['wooshoppingbgcolor'] ) ? esc_attr( $this->options['wooshoppingbgcolor']) : '#000000'
		);
	}

	public function wooshopping_highlight_color_callback()
	{
		printf('<p><label>Select Font Color&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></p><p><input type="text" id="wooshoppingfontcolor" name="wooshopping-options[wooshoppingfontcolor]" value="%s" class="wooshopping-highlight-font-color" data-default-color="#ffffff" /></p>',
			isset( $this->options['wooshoppingfontcolor'] ) ? esc_attr( $this->options['wooshoppingfontcolor']) : '#ffffff'
		);
	}
}

/**** Instantiate Class ****/
if( is_admin() )
	$wooshopping_settings_page = new WooShoppingSettingPage();

/**** Include Admin Style ****/
function wooshopping_admin_style() {
	// Color Picker JS
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
	// Timepicker JS
	wp_enqueue_script('wooshopping-timepicker-js', plugins_url('js/jquery.timepicker.min.js',__FILE__), true );
	// Admin Custom CSS
	wp_enqueue_style('wooshopping-admin-style', plugins_url('css/wooshopping-hours-admin.css',__FILE__), false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'wooshopping_admin_style' );

function wooshopping_admin_custom_script() {
	
	if(isset($_REQUEST['page']) && $_REQUEST['page']=="wooshopping-setting-admin")
		include('js/admin-custom-js.php'); // Admin Custom JS
}
add_action( 'wp_before_admin_bar_render', 'wooshopping_admin_custom_script' );

/**** Include WooShopping Hours Widget ****/
include ('include/wooshopping-hours-widget.php');
include ('include/wooshopping-hours-shortcode.php');
include ('include/wooshopping-add-item.php');
?>