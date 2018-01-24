<?php

/**
 * Plugin Name: HotJar for WordPress
 * Version: 1.1
 * Description: This plugin will install the HotJar script into your website using the provided HotJar Site ID.
 * Author: Stoute.co
 * Author URI: https://www.stoute.co/
 * Plugin URI: https://www.stoute.co/plugins/hotjar-for-wordpress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: sws_hotjar
 */


add_action( 'wp_head', 'sws_hotjar_script' );

function sws_hotjar_script() {
  $hotJarSiteID = get_option( 'sws_hotjar_settings' );
  ?>
  <!-- START HotJar for WordPress Script -->
  <script>
      (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:<?php echo $hotJarSiteID['sws_hotjar_text_field_0']; ?>,hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
  </script>
  <!-- END HotJar for WordPress Script -->
  <?
}

add_action( 'admin_menu', 'sws_hotjar_add_admin_menu' );
add_action( 'admin_init', 'sws_hotjar_settings_init' );


function sws_hotjar_add_admin_menu(  ) {

	add_submenu_page( 'tools.php', 'Hotjar for WordPress', 'Hotjar for WordPress', 'manage_options', 'hotjar_for_wordpress', 'sws_hotjar_options_page' );

}


function sws_hotjar_settings_init(  ) {

	register_setting( 'pluginPage', 'sws_hotjar_settings' );

	add_settings_section(
		'sws_hotjar_pluginPage_section',
		__( 'Add your HotJar Site ID', 'sws-hotjar' ),
		'sws_hotjar_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'sws_hotjar_text_field_0',
		__( 'Site ID:', 'sws-hotjar' ),
		'sws_hotjar_text_field_0_render',
		'pluginPage',
		'sws_hotjar_pluginPage_section'
	);


}


function sws_hotjar_text_field_0_render(  ) {

	$options = get_option( 'sws_hotjar_settings' );
	?>
	<input type='text' name='sws_hotjar_settings[sws_hotjar_text_field_0]' value='<?php echo $options['sws_hotjar_text_field_0']; ?>'>
	<?php

}


function sws_hotjar_settings_section_callback(  ) {

	echo __( 'Add the HotJar SiteID for your newly created site.', 'sws-hotjar' );

}


function sws_hotjar_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>Hotjar for WordPress</h2>
    <img src="<?php plugin_dir_path( __FILE__ );?>images/hotjar-screenshot.gif" alt="Hotjar Screenshot"/>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}


 ?>
