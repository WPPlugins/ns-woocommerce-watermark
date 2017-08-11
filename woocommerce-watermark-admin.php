<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function woocommerce_watermark_options_group() {
	register_setting('woocommerce_watermark_options', 'woocommerce_watermark_enabled_plugin');
    register_setting('woocommerce_watermark_options', 'woocommerce_watermark_img');
}
 
add_action ('admin_init', 'woocommerce_watermark_options_group');

function ns_update_options_form() {
	$plugin_active = get_option('woocommerce_watermark_enabled_plugin');
	$immagine = get_option('woocommerce_watermark_img');
    ?>
       
	    <div class="verynsbigbox">
			<div class="nsbigbox">
				<div class="titlensbigbox">
					<h4>WATERMARK PREMIUM VERSION</h4>
				</div>
				<div class="contentnsbigbox">
					<p>	ALL FREE VERSION FEATURES and:<br/><br/>
						- Choose the watermark position<br/>
						- Add a margin to your watermark<br/>
						- Repeat a watermark<br/>
						- Add background layer to watermark<br/>
						- Choose background watermark color<br/>
						- Choose background watermark opacity<br/>
						- Add a colored layer in all photo<br/>
						- Choose background layer color<br/>
						- Choose background layer opacity<br/>
						- You can add a different watermark image for only thumbnail images (NEW FEATURES!)</p>
					<a href="http://www.nsthemes.com/product/woocommerce-watermark/?ref-ns=3&campaign=sidebar" class="linkBigBoxNS">
						<div class="buttonNsbigbox">
							UPGRADE!
						</div>
					</a>
				</div>
			</div>
			
			<div class="nsbigboxtheme">
				<div class="titlensbigbox">
					<h4>SUBSCRIBE TO OUR NEWSLETTER</h4>
				</div>
				<div class="contentnsbigbox">
					<!-- Begin MailChimp Signup Form -->
					<form action="//nsthemes.us12.list-manage.com/subscribe/post?u=07ab11a197e784f0a8f6214a4&amp;id=d48f6e6eaa" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<label for="mce-EMAIL">STAY TUNED!<br/><span>Thanks to use BTTA plugin! Submit your email to keep in touch!</span></label>
						<input type="email" value="" name="EMAIL" class="buttonNsEmail" id="mce-EMAIL" placeholder="email address" required>
						<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_07ab11a197e784f0a8f6214a4_d48f6e6eaa" tabindex="-1" value=""></div>
						<div class="buttonNsbigbox" onclick="document.getElementById('mc-embedded-subscribe-form').submit(); return false;">
							SUBSCRIBE!
						</div>
					</form>
					<!--End mc_embed_signup-->
				</div>
			</div>

			<div class="nsbigboxtheme">
				<div class="titlensbigbox">
					<h4>FULLEAT FREE THEME</h4>
				</div>
				<div class="contentnsbigbox">
					<a href="http://www.nsthemes.com/product/fulleat-free-html-theme/?utm_source=Fulleat%20WooCommerce%20Watermark%20Sidebar&utm_medium=Sidebar%20Fulleat%20dentro%20settings&utm_campaign=Fulleat%20WooCommerce%20Watermark%20Sidebar%20premium"><img src="<? echo WATERMARK_NS_WW_PLUGIN_DIR; ?>/img/fulleat-theme.jpg" class="imgnsbigbox"></a>
					<p> - Responsive<br/>
						- Form Mail Ready with documentation<br/>
						- Simple customization<br/>
						- Light weight code<br/>
						- Google Font included<br/>
						- Mail.php included<br/>
						- Well documented and well commented</p>
					<a href="http://www.nsthemes.com/product/fulleat-free-html-theme/?utm_source=Fulleat%20WooCommerce%20Watermark%20Sidebar&utm_medium=Sidebar%20Fulleat%20dentro%20settings&utm_campaign=Fulleat%20WooCommerce%20Watermark%20Sidebar%20premium" class="linkBigBoxNS">
						<div class="buttonNsbigbox">
							DISCOVER MORE
						</div>
					</a>
				</div>
			</div>
		</div>
	   
	   
		<div class="verynsbigboxcontainer">
			<div class="icon32" id="icon-options-general"><br /></div>
			<h2>NS WooCommerce Watermark settings</h2>
			<p>&nbsp;</p>
			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('woocommerce_watermark_options'); ?>
				<table>
					<tbody>
						<tr valign="top">
						<th scope="row"><label for="woocommerce_watermark_enabled_plugin"><?php _e('Enabled Plugin', 'ns-woocommerce-watermark'); ?>:</label></th>
							<td>
								<?php
									$woocommerce_watermark_enabled_plugin0 = (get_option('woocommerce_watermark_enabled_plugin') AND get_option('woocommerce_watermark_enabled_plugin') == 0) ? ' selected="selected"' : '';
									$woocommerce_watermark_enabled_plugin1 = (get_option('woocommerce_watermark_enabled_plugin') AND get_option('woocommerce_watermark_enabled_plugin') == 1) ? ' selected="selected"' : '';
									$woocommerce_watermark_enabled_plugin2 = (get_option('woocommerce_watermark_enabled_plugin') AND get_option('woocommerce_watermark_enabled_plugin') == 2) ? ' selected="selected"' : '';
								?>
								<select name="woocommerce_watermark_enabled_plugin" id="woocommerce_watermark_enabled_plugin">
									<option value="0" <?=$woocommerce_watermark_enabled_plugin0?>><?php _e('Enable', 'ns-woocommerce-watermark'); ?></option>
									<option value="1" <?=$woocommerce_watermark_enabled_plugin1?>><?php _e('Disable', 'ns-woocommerce-watermark'); ?></option>
									<option value="2" <?=$woocommerce_watermark_enabled_plugin2?>><?php _e('Enable only for not registred user', 'ns-woocommerce-watermark'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="top">
						<th scope="row"><label for="woocommerce_watermark_img"><?php _e('Select a Watermark', 'ns-woocommerce-watermark'); ?>:</label></th>
							<td>
								<img src="<?php echo get_option('woocommerce_watermark_img'); ?>" ><br>
								<input id="woocommerce_watermark_img" name="woocommerce_watermark_img" type="text" size="36" value="<?php echo isset($immagine) ? $immagine : ''; ?>" />
								<input id="woocommerce_watermark_img_button" class="button-primary" name="woocommerce_watermark_img_button" type="button" value="<?php _e( 'Upload Image', 'nst' ); ?>" /> 
								<span class="description"></span>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"></th>
								<td>
									<p>
										<input type="submit" class="button-primary" id="submit" name="submit" value="<?php _e('Save Changes') ?>" />
									</p>
								</td>
						</tr>
						<tr>
							<td colspan="2">
								<p><a href="http://www.nsthemes.com/product/woocommerce-watermark/?ref-ns=3&campaign=bannerino"><img src="<?=WATERMARK_NS_WW_PLUGIN_DIR?>/img/woo-watermark-banneriiino.png" style="width: 100%; height: auto;"></a></p>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
  
    <?php
}

?>