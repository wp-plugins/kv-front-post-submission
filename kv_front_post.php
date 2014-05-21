<?php
/*
Plugin Name: KV Front-end Post Submission
Plugin URI: http://wordpress.org/plugins/kv-front-post-submission/
Description: A simple wordpress plugin for front-end post submission
Version: 1.1
Author: Varadharaj	
Author URI: http://profiles.wordpress.org/kvvaradha
*/
define('KV_FRONT_POST_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('KV_SUBMIT_VERSION', '1.0');
global  $wpdb ; 
/*
function kv_admin_menu_post() { 		
	 add_menu_page('Kv Settings', 'Kv Settings', 'manage_options', basename(__FILE__) , 'kv_admin_settings', KV_PLUGIN_URL.'/images/kv_logo.png', 67);
	// add_submenu_page( 'Kv Settings', 'Settings', 'Settings', 'manage_options', 'initial_settings_callfn', 'kv_settings_page' );	
}
add_action('admin_menu', 'kv_admin_menu_post');
*/
if(!function_exists('kv_admin_menu')) {
	function kv_admin_menu() { 		
		add_menu_page('Kvcodes', 'Kvcodes', 'manage_options', 'kvcodes' , 'kv_codes_plugins', KV_FRONT_POST_PLUGIN_URL.'/images/kv_logo.png', 66);	
		add_submenu_page( 'kvcodes', 'Kv Front Post Settings', 'Kv Front Post Settings', 'manage_options', 'kv_front_post_settings', 'kv_admin_post_settings' );
	}
add_action('admin_menu', 'kv_admin_menu');


function kv_codes_plugins() {

?>
 <div class="wrap">
    <div class="icon32" id="icon-tools"><br/></div>
    <h2><?php _e('KvCodes', 'kvcodes') ?></h2>		
	<div class="welcome-panel">
		Thank you for using Kvcodes Plugins . Here is my few Plugins work .MY plugins are very light weight and Simple.  <p>
		<a href="http://www.kvcodes.com/" target="_blank" ><h3> Visit My Blog</h3></a></p> 
	</div> 
	
	<div id="poststuff" > 
		<div id="post-body" class="metabox-holder columns-2" >
			<div id="post-body-content" > 
				<div class="meta-box-sortables"> 
					<div id="dashboard_right_now" class="postbox">
						<div class="handlediv" > <br> </div>
						<h3 class="hndle"  ><img src="<?php echo KV_FRONT_POST_PLUGIN_URL.'/images/kv_logo.png'; ?>" >  My plugins </h3> 
						<div class="inside" style="padding: 10px; "> 								
							<?php $kv_wp =  kv_get_web_page('http://profiles.wordpress.org/kvvaradha'); 
									
									 $kv_first_pos = strpos($kv_wp['content'], '<div id="content-plugins" class="info-group plugin-theme main-plugins inactive">');
									
									$kv_first_trim = substr($kv_wp['content'] , $kv_first_pos ); 
										
									$kv_sec_pos = strpos($kv_first_trim, '</div>');
									
									$kv_sec_trim = substr($kv_first_trim ,0, $kv_sec_pos );  
									
									echo $kv_sec_trim; 	?> 
						</div>
					</div>
				</div>							
			</div>
		</div>
	</div> 			
	<div id="postbox-container-1" class="postbox-container" > 
		<div class="meta-box-sortables"> 
			<div id="postbox-container-2" class="postbox-container" >
				<div id="dashboard_right_now" class="postbox">
					<div class="handlediv" > <br> </div>
					<h3 class="hndle" ><img src="<?php echo KV_FRONT_POST_PLUGIN_URL.'/images/kv_logo.png'; ?>" >  Donate </h3> 
					<div class="inside" style="padding: 10px; " > 
						<b>If i helped you, you can buy me a coffee, just press the donation button :)</b> 
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_donations" />
							<input type="hidden" name="business" value="<?php echo 'kvvaradha@gmail.com'; ?>" />
							<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div> 
				</div> 
			</div>
			<div id="postbox-container-2" class="postbox-container" > 
				<div id="dashboard_quick_press" class="postbox">
					<div class="handlediv" > <br> </div>
					<h3 class="hndle" ><img src="<?php echo KV_FRONT_POST_PLUGIN_URL.'/images/kv_logo.png'; ?>" >  Support me from Facebook </h3> 
					<div class="inside" style="padding: 10px; "> 
						<p><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fkvcodes&amp;width=180&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false&amp;appId=117935585037426" style="border:none; overflow:hidden; width:250px; height:300px;"></iframe></p>
					</div> 
				</div> 
			</div>
		</div>
	</div> 				
</div> <!-- /wrap -->
<?php

}

function kv_get_web_page( $url )
{
	$options = array(
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle compressed
		CURLOPT_USERAGENT      => "spider", // who am i
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);

	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}

add_action( 'admin_print_styles', 'kv_admin_css' );
function kv_admin_css() {
	 wp_enqueue_style("kvcodes_admin", KV_FRONT_POST_PLUGIN_URL."/kv_admi_style.css", false, "1.0", "all");
}

} else {
	function kv_admin_submenu_kv_front_post() { 		
		add_submenu_page( 'kvcodes', 'Kv Front Post Settings', 'Kv Front Post Settings', 'manage_options', 'kv_front_post_settings', 'kv_admin_post_settings' );
	}
add_action('admin_menu', 'kv_admin_submenu_kv_front_post');
	
}

add_action('admin_init', 'kv_admin_post_register_settings');

function kv_admin_post_register_settings() {
	//register_setting('kvcodes' , 'kv_post_types');
	register_setting('kvcodes' , 'kv_media_button');
	register_setting('kvcodes' , 'kv_richtext_editor');
	//register_setting('kvcodes' , 'kv_commentbox');
	register_setting('kvcodes' , 'kv_post_status');
}

function kv_admin_post_settings() { 	 ?>
 <div class="wrap">
        <div class="icon32" id="icon-tools"><br/></div>
        <h2><?php _e('Kv Front Post Settings', 'kvcodes') ?></h2>

		<div id="dashboard-widget-wrap" >
			<div id="dashboard-widgets" class="metabox-holder columns-2" >
				<div id="postbox-container-1" class="postbox-container" > 
					<div class="meta-box-sortables"> 
						<div id="dashboard_right_now" class="postbox">
							<div class="handlediv" > <br> </div>
							<h3 class="hndle" > General Settings </h3> 
							<div class="inside" style="padding: 10px; " > 
								
								<form method="post" action="options.php">
								    <?php settings_fields( 'kvcodes' ); ?>
								    <?php do_settings_sections( 'kvcodes' ); ?>
								    <table class="form-table">								                 
								        <tr valign="top">
								        <th scope="row">Use TinyMCE Rich Text Editor</th>
										<td> <select name="kv_richtext_editor" >
											<option value="Yes" <?php if(get_option('kv_richtext_editor') == 'Yes') echo 'selected' ; ?>> Yes </option>
											<option value="No" <?php if(get_option('kv_richtext_editor') == 'No') echo 'selected' ; ?>> No </option>
										</select> </td>
								        </tr>
								        
										<tr valign="top">
								        <th scope="row">Media Upload Support </th>
								        <td>
										<select name="kv_media_button" >
											<option value="true" <?php if(get_option('kv_media_button') == 'true') echo 'selected' ; ?>> Yes </option>
											<option value="false" <?php if(get_option('kv_media_button') == 'false') echo 'selected' ; ?>> No </option>
										</select> </td>
										</tr>	

										<tr valign="top">
								        <th scope="row">Default Post Status </th>
								        <td><select name="kv_post_status" >
											<option value="Publish" <?php if(get_option('kv_post_status') == 'Publish') echo 'selected' ; ?>> Publish </option>
											<option value="Pending Review" <?php if(get_option('kv_post_status') == 'Pending Review') echo 'selected' ; ?>> Pending Review </option>
											<option value="Draft" <?php if(get_option('kv_post_status') == 'Draft') echo 'selected' ; ?> > Draft </option>
										</select>
										</td>
								        </tr>
								    </table>								    
								    <?php submit_button(); ?>
								</form>
							</div> 
						</div> 
					</div>
				</div> 
			</div>
		</div> 
</div> <!-- /wrap -->
<?php
	
}
// Add the settings link to the plugins page
        function kv_front_post_plugin_settings_link($links)    { 
            $settings_link = '<a href="admin.php?page=kv_front_post_settings">Settings</a>'; 
            array_unshift($links, $settings_link); 
            return $links; 
        }

        $plugin = plugin_basename(__FILE__); 
        add_filter("plugin_action_links_$plugin", 'kv_front_post_plugin_settings_link');
		

		
		add_action('admin_init', 'kv_front_post_page_register');

function kv_front_post_page_register() {
	$page = get_page_by_title('Submit A Post'); 
	
	if(!$page) {
		$submit_page = array(	'slug' => 'submit-post',	'title' => 'Submit A Post'	);
		$page_id = wp_insert_post(array(
			'post_title' => $submit_page['title'],
			'post_type' =>'page',		
			'post_name' => $submit_page['slug'],
			'post_content' => '[kv_submit_post]',
			'post_status' => 'publish',
			'comment_status' => 'closed',
			'ping_status' => 'closed',
			
			'post_excerpt' => 'Custom page For Front end Post Publishing! '	
		));
	} 		
	//add_post_meta( $page_id, '_wp_page_template', 'pages/submit-project.php' );
}

add_shortcode( 'kv_submit_post', 'kv_front_post_creation' );

function kv_front_post_creation() { 
	 $sub_success ='FAILURE' ;
	global $wpdb; 
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {
		$errors = new WP_Error();
		// Do some minor form validation to make sure there is content
		if (isset ($_POST['title'])) {
			$title =  $_POST['title'];
		} else {
			$errors->add('empty_title', __('<strong>Notice</strong>: Please enter a title for your post.', 'kvcodes'));
		}
		if (isset ($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			$errors->add('empty_content', __('<strong>Notice</strong>: Please enter the contents of your post.', 'kvcodes'));
		}

		$tags = $_POST['post_tags'];

		// ADD THE FORM INPUT TO $new_post ARRAY
		$new_post = array(
		'post_title'	=>	$title,
		'post_content'	=>	$description,
		'post_category'	=>	array($_POST['cat']),  // Usable for custom taxonomies too
		'tags_input'	=>	array($tags),
		'post_status'	=>	 get_option('kv_post_status'),           // Choose: publish, preview, future, draft, etc.
		'post_type'	=>	'post'  //'post',page' or use a custom post type if you want to
		);

		//SAVE THE POST
		$query = $wpdb->prepare('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_title = %s', $title  );
		$wpdb->query( $query );
		if (!$wpdb->num_rows ) {	
			 if ( !$errors->get_error_code() ) { 
				$pid = wp_insert_post($new_post);

	             //SET OUR TAGS UP PROPERLY
				wp_set_post_tags($pid, $_POST['post_tags']);
		
				if ( $pid ) 
	            	 $sub_success ='Success' ;
			}
		}
		//REDIRECT TO THE NEW POST ON SAVE
		//$link = site_url('submit-post');
		//wp_redirect( $link );
			if ($sub_success == 'Success' ) {
				unset($title, $description, $post_cat, $tags,  $new_post);
				
			}
	} // END THE IF STATEMENT THAT STARTED THE WHOLE FORM

	if($sub_success == 'Success') {
		echo '<div class="kv-success">' . __( 'Project Posted succesfully.', 'post_new' ) . '</div>';
		$sub_success = null;
	} 
	if (isset($errors) && sizeof($errors)>0 && $errors->get_error_code()) :
		echo '<ul class="kv-errors">';
		foreach ($errors->errors as $error) {
			echo '<li>'.$error[0].'</li>';
		}
	echo '</ul>';
	endif; 	?>
	<style> 
	
ul.kv-errors {
	padding: 0;
	margin: 1.54em 0 1.54em !important;
	list-style: none !important;
	border: 1px solid #DE5749;
	background: #FFE8E6;
	padding: 10px 20px;
}
ul.kv-errors li {
	list-style: none;
	color: #AA4433;
}

.kv-errors {
	padding: 0;
	margin: 1.54em 0 1.54em !important;
	list-style: none !important;
	border: 1px solid #DE5749;
	background: #FFE8E6;
	padding: 10px 20px;
}

.kv-success {
	padding: 0;
	margin: 1.54em 0 1.54em !important;
	list-style: none !important;
	border: 1px solid #026E02;
	background: #BEF7C5;
	padding: 10px 20px;
	text-color: #2DB4E5 ; 
}

</style>
<form id="new_post" name="new_post" method="post" action=""  enctype="multipart/form-data">
			<!-- post name -->
			<fieldset name="name">
				<label for="title">Post Name:</label>
				<input type="text" id="title" value="" tabindex="5" name="title" />
			</fieldset>

			<!-- post Category -->
			<fieldset class="category">
				<label for="cat">Type:</label>
				<?php wp_dropdown_categories( 'tab_index=10&taxonomy=category&hide_empty=0' ); ?>
			</fieldset>

			<!-- post Content -->
			<fieldset class="content">
				<label for="description">Description and Notes:</label>
				
				<?php  if(get_option('kv_richtext_editor') == 'Yes' ) { $editor_id = 'description' ;
							$kv_media_button = get_option('kv_media_button'); 
							$kv_editor_settings= array('media_buttons' => $kv_media_button, 
												'textarea_name' => 'description' ,
												'teeny' => true, 
												'dfw' => true);
							wp_editor('',$editor_id, $kv_editor_settings );
						} else echo '<textarea name="description" id="description" value="" > </textarea> ' ; 
					?>
			</fieldset>

			<!-- post tags -->
			<fieldset class="tags">
				<label for="post_tags">Additional Keywords (comma separated):</label>
				<input type="text" value="" tabindex="35" name="post_tags" id="post_tags" />
			</fieldset>

			<fieldset class="submit">
				<input type="submit" value="Post Review" tabindex="40" id="submit" name="submit" />
			</fieldset>

			<input type="hidden" name="action" value="new_post" />
			<?php wp_nonce_field( 'new-post' ); ?>
		</form>

<?php
}
?>