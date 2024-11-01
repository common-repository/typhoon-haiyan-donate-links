<?php
/*
Plugin Name: Typhoon Haiyan Donate Links
Plugin URI: http://www.khushapps.com
Description: Use this plug-in to donate to organizations providing relief in the aftermath of Typhoon Haiyan.
Version: 0.1
Author: KhushApps
Author URI: http://www.khushapps.com
License: GPL2
*/

	add_action( 'widgets_init', 'typhoon_haiyan_widget'); 
	function typhoon_haiyan_widget() {
		register_widget( 'typhoon_haiyan_widget_info' );
	}

class typhoon_haiyan_widget_info extends WP_Widget {

// Name the widget, here typhoon_haiyan Widget will be displayed as widget name, 
	function typhoon_haiyan_widget_info () {	
	     $widget_options = array(
	     		'classname' => 'typhoon_haiyan_widget_info',
	     		'description' => 'Typhoon Haiyan Donation links' );
	     parent::WP_Widget(false, "Typhoon Haiyan Links", $widget_options);
	}
	
//form widget, which will be displayed in the admin dashboard widget location.
			public function form( $instance ) {
				if ( isset( $instance[ 'title' ]) ) {
					$title = $instance[ 'title' ];
				}
				else {
					$title = __( 'Support Typhoon Haiyan Relief', 'Typhoon Haiyan Widget' );
				} 
?>
				<p>Title: <input name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title );?>" /></p>		
<?php	
	}
// update the new values in database
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	//Display the stored widget information in webpage.
	function widget($args, $instance) {
		extract($args);
		echo '<div style="border-style:solid;border-color:red;margin:5px;padding:5px;background:#ccc;-moz-border-radius:15px;border-radius:15px;">'.$before_widget; 
		//Widget starts to print information
		$title = apply_filters( 'widget_title', $instance['title'] );
		$donate_content = '<a href="http://www.redcross.org.ph/donate">The Philippine Red Cross</a><br /><br /><a href="https://donate.salvationarmyusa.org/TyphoonHaiyan">Salvation Army Typhoon Relief Efforts</a><br /><br /><a href="https://geekli.st/hackathon/52793a2660fb3f52d50001f8">Geeklist #Hack4Good</a><br /><br /><a href="https://www.doctorswithoutborders.org/donate/truenorth/onetime_philippines.cfm">Doctors Without Borders</a>';
			if ( !empty( $title ) ) { 
				 echo $before_title;
				 echo $title; 
				 echo $after_title;
			}
			if ( !empty( $donate_content ) ) {
				echo '<p>' . $donate_content . '</p>';
			}
			echo '</div>'.$after_widget; //Widget ends printing information
	}
}
	add_shortcode('typhoon_help', 'sc_donate_handler');
	function sc_donate_handler() {
		$sc_donate_output = sc_donate();
		return $sc_donate_output;
	}
	function sc_donate() {
			$donate_content = '<div style="border-style:solid;border-color:red;margin:5px;padding:5px;background:#ccc;-moz-border-radius:15px;border-radius:15px;">
			<h2>Support Typhoon Haiyan Relief</h2><a href="http://www.redcross.org.ph/donate">The Philippine Red Cross</a><br /><br />
			<a href="https://donate.salvationarmyusa.org/TyphoonHaiyan">Salvation Army Typhoon Relief Efforts</a> or Text TYPHOON to 80888 to Donate $10<br /><br />
			<a href="https://geekli.st/hackathon/52793a2660fb3f52d50001f8">Geeklist #Hack4Good</a><br /><br /><a href="https://www.doctorswithoutborders.org/donate/truenorth/onetime_philippines.cfm">Doctors Without Borders</a></div>';
			return $donate_content;
	}
?>