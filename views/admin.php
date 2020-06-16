<?php
/**
 * Represents the view for the administration dashboard.
 *
 *
 * @package   Search_Keyword_Redirect
 * @author    Nick Pelton <nick@werkpress.com>
 * @license   GPL-2.0+
 * @link      http://werkpress.com/plugin
 * @copyright 2013 Nick Pelton or Werkpress
 */
?>
<div class="wrap">

	<?php // screen_icon(); ?>
	<h2>Search Keyword Redirects</h2>

	<div class="wrap ww-keyword-redirect">
		<h3>Overview</h3>

		<p>This plugin Matches search queries to keywords. On a match it redirects to specific URLs.
			<br>Note, this means any match for a non case-sensative string.</p>

		<p><strong>Example
				:</strong> The plugin will redirect with these sample search queries for the keyword <span class="hl">test</span>
			:</p>

		<ol>
			<li><span class="hl">test</span></li>
			<li><span class="hl">Test</span></li>
			<li>Search for <span class="hl">test</span> number 450</li>
			<li>dfsd<span class="hl">test</span>fsdfsd</li>
		</ol>


		<h3>Create Redirects</h3>
		<ul>
			<li>To create redirects, enter the keyword and the URL destination of the keyword and click save.</li>

		</ul>


		<h2>Current Redirects</h2>

		<form method="post" action="">
			<div class="redirects">
				<table class="redirect_table">
					<tr>
						<th>Keyword</th>
						<th>URL Destination</th>
						<th>Uses</th>
					</tr>
					<tr>
						<td>
							<small>example: <code>Keyword</code> </small>
						</td>
						<td>
							<small>example: <code><small><?php echo get_home_url('/about'); ?></small></code> </small>
						</td>
						<td></td>
					</tr>

					<?php echo $this->get_keyword_redirects(); ?>


				</table>
				<a href="#" class="add_redirect button" title="Add redirect">Add Redirect</a>
			</div>
			<br/>
			<script type="text/template" class="template" id="redirect">
				<tr>
					<td><input type="text" name="ww_keyword_redirects[request][]" value="" style="width:15em"/>&nbsp;&raquo;&nbsp;
					</td>
					<td><input type="text" name="ww_keyword_redirects[destination][]" value="" style="width:30em;"/>
						<!-- &nbsp;&raquo;&nbsp; --></td>
					<td><input type="text" name="ww_keyword_redirects[used][]" value="" style="width:4em;" readonly /></td>
					<td><a href="#" class="delete_redirect button"
					       title="Delete Redirect">Delete Redirect</a></td>
				</tr>
			</script>

			<p class="submit">
				<?php wp_nonce_field( 'ww_submit_save_form', 'ww_keyword_redirects_nonce' ); ?>
				<input type="submit" name="submit_keywords" class="button-primary"
				       value="Save Changes"/>
				<input type="button" name="cancel_changes" class="button cancel_changes"
				       value="Cancel"/>
			</p>
		</form>
	</div>

</div>
