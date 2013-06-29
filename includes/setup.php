<?php

// Plugin Activation
register_activation_hook( __FILE__, 'ww_keyword_redirects_install' ); 
function ww_keyword_redirects_install() { 

	$ww_keyword_redirects_options = array( // Default Options
		
	); 
	
	
	update_option( 'ww_keyword_redirects', $ww_keyword_redirects_options );
	
	register_uninstall_hook(__FILE__,'ww_keyword_redirects_uninstall');
	
} // End Activation

// Deactivate
register_deactivation_hook(__FILE__,'ww_keyword_redirects_deactivate');
function ww_keyword_redirects_deactivate(){
	
	// Deactivation action
	// Nothing to deactivate
	
}

// Uninstall
function ww_keyword_redirects_uninstall(){
		
	// Delete option from options table 
	delete_option( 'ww_keyword_redirects' ); // remove
}
