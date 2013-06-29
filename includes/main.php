<?php

if (!class_exists("WW_keyword_redirect")) {
	class WW_keyword_redirect {

		// Setup Query var for template redirect
		public function __construct()
	    {
	        add_action('template_redirect', array($this, 'check_redirect'));
   
			
			// Setup required styles
			function ww_keyword_redirect_admin_styles() {


				wp_register_style('ww_keyword_redirect',plugins_url( '/css/admin.css', __FILE__ ),array(),1,'all');
				wp_enqueue_style('ww_keyword_redirect');
			}

			// Setup required styles
			function ww_keyword_redirect_admin_scripts() {


				wp_register_script('ww_keyword_redirect',plugins_url( '/js/app.js', __FILE__ ),array(),1,'all');
				wp_enqueue_script('jquery');
				wp_enqueue_script('underscore');
				wp_enqueue_script('ww_keyword_redirect');
			}
			
			
			add_action('admin_print_styles', 'ww_keyword_redirect_admin_styles');
			add_action('admin_print_scripts', 'ww_keyword_redirect_admin_scripts');

	        
	    }
		
		
		/*
			Read the list of keywords and if keyword  
			is found in the query, redirect the visitor. 
		*/
		function check_redirect()
		{
			
			if(!is_search()) return; // not search
			
			
					
				// get options
				$redirects = get_option('ww_keyword_redirects');
				
				// check if options exist
				if (!empty($redirects)) {
				
					
					foreach ($redirects as $keyword => $redirect) {
							

							

							// compare user request to each code stored in the db
							//if(urldecode($userrequest) == rtrim($redirect,'/') || urldecode($userrequest_lower) == strtolower(rtrim($redirect,'/'))) {
							if (preg_match("/$keyword/i", get_search_query()) == TRUE){ 

									wp_redirect($redirect[0]);

									//header ('HTTP/1.1 302 Found');
									//header ('Location: ' . $data[0]);
									exit();
									



							}
									
					} // end foreach
					
					// no codes matched
					unset($redirects);
					return;
				
				}else{

					return; // no redirects
				
				}

		} // end funcion redirect

		
		
		
		
		
		
		
		/*
			generate the link to the options page under settings
		*/
		function create_menu()
		{
		 //  add_options_page('301 Redirects', '301 Redirects', 10, '301options', array($this,'options_page'));
		  
		  // Add Menu Page
		  add_menu_page( 'Search Keywords', "Search Keywords", 'manage_options', __FILE__, array($this,'options_page'), WW_PLUGIN_URL.'/images/icon.png' , 30 );
		  
		}
		
		
		
		/*
			generate the options page in the wordpress admin
		*/
		function options_page()
		{
					
			
		
		?>
		<div class="wrap ww-keyword-redirect">
			<h2>Search Keywords Redirect</h2>
			<h3>Overview</h3>
			<p>This plugin is designed to intercept and match keywords to WordPress searches and redirect to specific pages if a match is made. <br>Note, this means any match for the case insensative string.</p>
			<p><strong>Example:</strong> The plugin will redirect with these sample search queries for the keyword "test":</p>

			<ol>
				<li>test</li>
				<li>Test</li>
				<li>Search for test number 450</li>
				<li>dfsdtestfsdfsd</li>
			</ol>

			
			<h3>Create Redirects</h3>
			<ul>
				<li>To create redirects, enter the keyword and the URL destination of the keyword and click save.</li>
				<li>To remove an redirect, delete both values and click save.</li>
			</ul>
			
		
			<h2>Current Redirects</h2>
			<form method="post" action="admin.php?page=ww-keyword-redirect/includes/main.php">
			<div  class="redirects">
				<table class="redirect_table">
					<tr>
						<th>Keyword</th>
						<th>URL Destination</th>
						<!-- <th>Matches</th> -->
					</tr>
					<tr>
						<td><small>example: 30dayfree</small></td>
						<td><small>example: <?php echo get_option('home'); ?>/destination-url/</small></td>
						<!-- <td><small>How many times this redirect has occurred</small></td> -->
					</tr>
					<?php echo $this->expand_redirects(); ?>
					

				</table>
				<a href="#" class="add_redirect button" title="Add redirect">Add Redirect</a>
			</div>
			<br/>
			<script type="text/template" class="template" id="redirect">
					<tr>
						<td><input type="text" name="ww_keyword_redirects[request][]" value="" style="width:15em" />&nbsp;&raquo;&nbsp;</td>
						<td><input type="text" name="ww_keyword_redirects[destination][]" value="" style="width:30em;" /><!-- &nbsp;&raquo;&nbsp; --></td>
						<!-- <td><input type="text" name="ww_keyword_redirects[used][]" value="" style="width:10em;" readonly /></td> -->
						<td><a href="#" class="delete_redirect button" title="Delete Redirect">Delete Redirect<a/></td>
					</tr>
			</script>
			
			<p class="submit">
			<input type="submit" name="submit_codes" class="button-primary" value="<?php _e('Save Changes') ?>" /> 
			<input type="button" name="cancel_changes" class="button cancel_changes" value="<?php _e('Cancel') ?>" />
			</p>
			</form>
		</div>
		<?php
		
	
		} // end of function options_page
		
		/*
			utility function to return the current list of redirects as form fields
		*/
		function expand_redirects(){
			$redirects = get_option('ww_keyword_redirects');
			$output = '';
			if (!empty($redirects)) {
				foreach ($redirects as $request => $data) {
					$output .= '
					
					<tr>
						<td><input type="text" name="ww_keyword_redirects[request][]" value="'.$request.'" style="width:15em" />&nbsp;&raquo;&nbsp;</td>
						<td><input type="text" name="ww_keyword_redirects[destination][]" value="'.$data[0].'" style="width:30em;" /><!--&nbsp;&raquo;&nbsp;--></td>
						<!-- <td><input type="text" name="ww_keyword_redirects[used][]" value="'.$data[1].'" style="width:10em;" readonly/></td> -->
						<td><a href="#" class="delete_redirect button submitdelete" title="Delete Redirect">Delete Redirect<a/></td>
					</tr>
					
					';
				}
			} // end if
			return $output;
		}
		
		/*
			save the codes and urls from the options page to the database
		*/
		function save_codes($data)
		{
			$redirects = array();
			
			for($i = 0; $i < sizeof($data['request']); ++$i) {
				$request = trim($data['request'][$i]);
				$destination = trim($data['destination'][$i]);
				$date = trim($data['date'][$i]);
				$max = trim($data['max'][$i]);
				$used = trim($data['used'][$i]);
			
				if ($request == '' && $destination == '') { continue; }
				else { 
				
					$redirects[$request] = array($destination,$date,$max,$used);
					
					// echo '<pre style="white-space:no-wrap;">'.print_r($redirects,true).'</pre>'; 					
				}
			}

			update_option('ww_keyword_redirects', $redirects);
		}
		
				
		/*
			utility function to get the full address of the current request
			credit: http://www.phpro.org/examples/Get-Full-URL.html
		*/
		function getAddress()
		{
			/*** check for https ***/
			$protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
			/*** return the full address ***/
			return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
		
	} // end class Simple301Redirects
	
} // end check for existance of class

// instantiate
$offer_codes = new WW_keyword_redirect();

if (isset($offer_codes)) {
	// add the redirect action, high priority
	// add_action('init', array($offer_codes,'redirect'), 1);

	// create the menu
	add_action('admin_menu', array($offer_codes,'create_menu'));
	
		// if submitted, process the data
	if (isset($_POST['submit_codes'])) {
		$offer_codes->save_codes($_POST['ww_keyword_redirects']);
	}
	
	
}
