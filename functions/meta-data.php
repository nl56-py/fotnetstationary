<?php
/**
 * 
 */

$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator', 'author');




if( array_intersect($allowed_roles, $user->roles ) ) { 

   	// adding the scripts and css for the color picker
 //   	wp_enqueue_style( 'wp-color-picker');
	// wp_enqueue_script( 'wp-color-picker');
}


if ( ! function_exists( 'lzBackendScripts' ) ){
	function lzBackendScripts( $hook ) {
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');
	}
}
add_action( 'admin_enqueue_scripts', 'lzBackendScripts');

/**
 * ADDING THE COLOR PANEL TO POST AND PAGES 
 * 
 */
function lzAddColorOrImagePanel($post) {
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, '_listing_image_id', true );

	$custom = get_post_custom( $post->ID );
	$page_bg_color = ( isset( $custom['page_bg_color'][0] ) ) ? $custom['page_bg_color'][0] : '#c09';

    // Use nonce for verification
	wp_nonce_field( plugin_basename(__FILE__), 'lz_color_panel' );
	?>
	<div id="" class="inside">
		<input type="radio" id="useBgColor" name="useColor" value="1" <?php if(!empty($custom['useColor']) && $custom['useColor'][0]==1){?> checked="checked"<?php }?>>
		<label class="post-attributes-label" for="useBgColor"> Use color as a background.</label>
	</div>

	<div id="colorForBg" class="inside">
		<p><?php __('Choosse a color for your post backbround.', 'Luzuk Premium' ); ?></p>
		<input class="colorPickerField" type="text" name="page_bg_color" value="<?php esc_attr_e( $page_bg_color ); ?>"/>
	</div>
	<hr />
	<div id="imageForBg" class="inside">
		<input type="radio" id="useBgImg" name="useColor" value="0" <?php if(!empty($custom['useColor']) && $custom['useColor'][0]==0){?> checked="checked"<?php }?>>
		<label class="post-attributes-label" for="useBgImg"> Use Image as a background.</label>
	</div>
	<div id="noneForBg" class="inside">
		<input type="radio" id="usenoneBg" name="useColor" value="2" <?php if(!empty($custom['useColor']) && $custom['useColor'][0]==2){?> checked="checked"<?php }?>>
		<label class="post-attributes-label" for="usenoneBg"> None.</label>
	</div>
	<script>
		jQuery(document).ready(function($){
			$('.colorPickerField').each(function(){
				$(this).wpColorPicker();
			});
		});
	</script>
	
	<?php

	$old_content_width = $content_width;
	$content_width = 254;
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button" >' . esc_html__( 'Remove listing image', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="' . esc_attr( $image_id ) . '" />';
		}
		$content_width = $old_content_width;
	} else {
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set listing image', 'text-domain' ) . '" href="javascript:;" id="upload_listing_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set listing image', 'text-domain' ) . '">' . esc_html__( 'Set listing image', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_listing_image" name="_listing_cover_image" value="" />';
	}?>
	<div  id="" class="inside">
		<?php echo $content; ?>
	</div>
	<script>
		jQuery(document).ready(function($) {
			// Uploading files
			var file_frame;
			$.fn.upload_listing_image = function( button ) {
				var button_id = button.attr('id');
				var field_id = button_id.replace( '_button', '' );
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
				  file_frame.open();
				  return;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
				  // title: $( this ).data( 'uploader_title' ),
				  title: button.data( 'uploader_title' ),
				  button: {
				    text: button.data( 'uploader_button_text' ),
				  },
				  multiple: false
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
				  var attachment = file_frame.state().get('selection').first().toJSON();
				  $("#"+field_id).val(attachment.id);
				  $("#luzuk-page-color-palet img").attr('src',attachment.url);
				  $( '#luzuk-page-color-palet img' ).show();
				  $( '#' + button_id ).attr( 'id', 'remove_listing_image_button' );
				  $( '#remove_listing_image_button' ).text( 'Remove listing image' );
				});
				// Finally, open the modal
				file_frame.open();
			};
			$('#luzuk-page-color-palet').on( 'click', '#upload_listing_image_button', function( event ) {
				event.preventDefault();
				$.fn.upload_listing_image( $(this) );
			});
			$('#luzuk-page-color-palet').on( 'click', '#remove_listing_image_button', function( event ) {
				event.preventDefault();
				$( '#upload_listing_image' ).val( '' );
				$( '#luzuk-page-color-palet img' ).attr( 'src', '' );
				$( '#luzuk-page-color-palet img' ).hide();
				$( this ).attr( 'id', 'upload_listing_image_button' );
				$( '#upload_listing_image_button' ).text( 'Set listing image' );
			});
		});
	</script>
	<?php
}
// add_action( 'save_post', 'listing_image_save', 10, 1 );
// function listing_image_save ( $post_id ) {
// 	if( isset( $_POST['_listing_cover_image'] ) ) {
// 		$image_id = (int) $_POST['_listing_cover_image'];
// 		update_post_meta( $post_id, '_listing_image_id', $image_id );
// 	}
// }

/**
 * The methid that will lanhch the meta box html at add_meta_boxes web hook 
 * @author  <support@luzuk.com>
 */
function lzInitMetaBoxesForAdmin(){
	add_meta_box('luzuk-page-color-palet', __('Select Page Background color', 'Luzuk Premium'), 'lzAddColorOrImagePanel', 'page', 'side', 'default', null);
	add_meta_box('luzuk-page-color-palet', __('Select Page Background color', 'Luzuk Premium'), 'lzAddColorOrImagePanel', 'post', 'side', 'default', null);
}
add_action('add_meta_boxes', 'lzInitMetaBoxesForAdmin');


/**
 * Save the color palet value on save 
 * When the post is saved, saves our custom data 
 * @param integer $post_id - An id of the post 
 * @author Luzuk <support@luzuk.com>
 * @since V 1.1  03rd Nov 2017
 */
function lzSaveBgColorOfPage($post_id){
	// If it is our form has not been submitted, so we dont want to do anything
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	if(empty($_POST['page_bg_color']))
		return;
	if(!wp_verify_nonce($_POST['lz_color_panel'], plugin_basename(__FILE__)))
		return;
	$page_bg_color = $_POST['page_bg_color'];
	update_post_meta($post_id, 'page_bg_color', $page_bg_color);

	if( isset( $_POST['_listing_cover_image'] ) ) {
		$image_id = (int) $_POST['_listing_cover_image'];
		update_post_meta( $post_id, '_listing_image_id', $image_id );
	}

	if( isset( $_POST['useColor'] ) ) {
		update_post_meta( $post_id, 'useColor',  (int) $_POST['useColor'] );
	}

}
add_action('save_post', 'lzSaveBgColorOfPage');


