<?php
// Add anything to dashboard.
// @todo: Actually use this at some point.

// add_action( 'wp_dashboard_setup', 'ww_offer_codes_dashboard_widgets' ); 

function ww_offer_codes_dashboard_widgets() { 

	// create a custom dashboard widget 
	// wp_add_dashboard_widget( 'dashboard_custom_feed', 'Offer Codes', 'ww_offer_codes_dashboard_widgets_content' ); 

}

function ww_offer_codes_dashboard_widgets_content(){
	
	echo "Default Dashboard content";
	
}