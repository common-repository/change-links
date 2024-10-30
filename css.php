<?php

// Adding options page
function font_menu() {
	add_menu_page('Change Links','Change Links','manage_options','fonts_options','fonts_options');
	}
add_action('admin_menu', 'font_menu');

function fonts_options(){
	//print_r($_REQUEST);
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	?>
	<!-- admin options for inserting Font Size and Font Family -->
	<?php ?>
	<form action="options.php" method="post">
	  <div class="wrap">
		<?php wp_nonce_field('update-options') ?>
		  <h2>Change Links <?php _e('Settings', 'custom_fonts') ?></h2>
		  <table border="0" cellspacing="6" cellpadding="6">
			<tr>
			  <td><?php _e('Font Size', 'custom_fonts') ?> <?php echo get_option('color'); ?></td>
			  <td><input name="font_size" type="text" id="font_size" value="<?php echo get_option('font_size'); ?>" size="1" />px</td>
			</tr>
			<tr>
			  <td><?php _e('Font color', 'font_color') ?></td>
			  <td>
			  <input type="text" id="font_color" name="font_color" value="<?php echo get_option('font_color'); ?>" /> Pick link color</label>
    			<div id="ilctabscolorpicker"></div>
			  <!--<input type="text" name="font_color" id="font_color" value="<?php echo get_option('font_color'); ?>" class="my-color-field font_color" data-default-color="<?php echo get_option('font_color'); ?>" />
			  
			  --></td>
			</tr>
			<tr>
			  <td><?php _e('Font Style', 'font_style') ?></td>
			  <td>
			  <select id="font_style" name="font_style" >
			  <option value="normal" <?php if(get_option('font_style')=='normal'){ echo 'selected';}?>>Normal</option>
			  <option value="italic" <?php if(get_option('font_style')=='italic'){ echo 'selected';}?> >Italic</option>
			  <option value="oblique" <?php if(get_option('font_style')=='oblique'){ echo 'selected';} ?>>Oblique</option>
			  </select>
			  </td>
			</tr>
			<tr>
			  <td><span class="submit">
			  <input type="hidden" name="action" value="update" />
			  <!-- Sending saved Data to wp_nonce fields -->
                <input type="hidden" name="page_options" value="font_size,font_color,font_style" />
				<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'custom_fonts') ?>" />
			  </span></td>
			  <td>&nbsp;</td>
			</tr>
		  </table>
		</div>
	</form>
	<script type="text/javascript">
 
  jQuery(document).ready(function() {
    jQuery('#ilctabscolorpicker').hide();
    jQuery('#ilctabscolorpicker').farbtastic("#font_color");
    jQuery("#font_color").click(function(){jQuery('#ilctabscolorpicker').slideToggle()});
  });
 
</script>
	<!--<script type="text/javascript">
	jQuery(document).ready(function(jQuery){
		jQuery('.my-color-field').wpColorPicker();
	});
    </script>
	--><?php
}
add_action('init', 'ilc_farbtastic_script');
function ilc_farbtastic_script() {
  wp_enqueue_style( 'farbtastic' );
  wp_enqueue_script( 'farbtastic' );
}

add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}


?>