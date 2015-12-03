<?php
/*
Plugin Name: Extend Comment
Version: 1.0
Plugin URI: http://smartwebworker.com
Description: A plug-in to add additional fields in the comment form.
Author: Specky Geek
Author URI: http://www.speckygeek.com
*/

// Add custom meta (classs) fields to the default comment form
// Default comment form includes name, email and URL
// Default comment form elements are hidden when user is logged in

add_filter('comment_form_default_fields','custom_fields');
function custom_fields($fields) {

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields[ 'author' ] = '<p class="comment-form-author">'.
			'<label for="author" class="col-sm-3 control-label txtLeft">
			' . __( 'Parent Name ' ) . ( $req ? '<span class="required">*</span>' : '' ). '</label>'.
			
			'<div class="col-sm-9"><input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) . 
			'" class="form-control border-inpt"' . $aria_req . ' /></p></div>';
		
		$fields[ 'email' ] = '<p class="comment-form-email">'.
			'<label for="email" class="col-sm-3 control-label txtLeft">
			' . __( 'Email' ) . ( $req ? '<span class="required">*</span>' : '' ). '</label>'.
			
			'<div class="col-sm-9"> <input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) . 
			'" class="form-control border-inpt"' . $aria_req . ' /></p></div>';

	return $fields;
}

// Add fields after default fields above the comment box, always visible

add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );

function additional_fields () {
	echo '<p class="comment-form-childsname">'.
	'<label for="chidsname" class="col-sm-3 control-label txtLeft">
	' . __( 'Childs Name ' ) . '</label>'.
	'<div class="col-sm-9"><input id="chidsname" name="chidsname" type="text" " class="form-control border-inpt" /></p></div>';

	echo '<p class="comment-form-childsname">'.
	'<label for="classs" class="col-sm-3 control-label txtLeft">
	' . __( 'Classs' ) . '</label>'.
	'<div class="col-sm-9"><input id="classs" name="classs" type="text" class="form-control border-inpt"  /></p></div>';
}

// Save the comment meta data along with comment

add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
	/*if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') )
	$phone = wp_filter_nohtml_kses($_POST['phone']);
	add_comment_meta( $comment_id, 'phone', $phone );*/

	if ( ( isset( $_POST['childsname'] ) ) && ( $_POST['childsname'] != '') )
	$childsname = wp_filter_nohtml_kses($_POST['childsname']);
	add_comment_meta( $comment_id, 'childsname', $childsname );

	if ( ( isset( $_POST['classs'] ) ) && ( $_POST['classs'] != '') )
	$class = wp_filter_nohtml_kses($_POST['classs']);
	add_comment_meta( $comment_id, 'classs', $class );
}


// Add the filter to check if the comment meta data has been filled or not

add_filter( 'preprocess_comment', 'verify_comment_meta_data' );
function verify_comment_meta_data( $commentdata ) {
	if ( ! isset( $_POST['classs'] ) )
	wp_die( __( 'Error: You did not add your class. Hit the BACK button of your Web browser and resubmit your comment with class.' ) );
	return $commentdata;
}

//Add an edit option in comment edit screen  

add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box() {
    add_meta_box( 'childsname', __( 'Comment Metadata - Extend Comment' ), 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}
 
function extend_comment_meta_box ( $comment ) {
    /*$phone = get_comment_meta( $comment->comment_ID, 'phone', true );*/
    $childsname = get_comment_meta( $comment->comment_ID, 'childsname', true );
    $class = get_comment_meta( $comment->comment_ID, 'classs', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>
   <!--  <p>
       <label for="phone"><?php _e( 'Phone' ); ?></label>
       <input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
   </p> -->
    <p>
        <label for="childsname"><?php _e( 'Comment childsname' ); ?></label>
        <input type="text" name="childsname" value="<?php echo esc_attr( $childsname ); ?>" class="widefat" />
    </p>
    <p>
        <label for="classs"><?php _e( 'class: ' ); ?></label>
			<span class="commentclassbox">
			<?php for( $i=1; $i <= 5; $i++ ) {
				echo '<span class="commentclasss"><input type="radio" name="classs" id="classs" value="'. $i .'"';
				if ( $class == $i ) echo ' checked="checked"';
				echo ' />'. $i .' </span>'; 
				}
			?>
			</span>
    </p>
    <?php
}

// Update comment meta data from comment edit screen 

add_action( 'edit_comment', 'extend_comment_edit_metafields' );
function extend_comment_edit_metafields( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;

	/*if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') ) : 
	$phone = wp_filter_nohtml_kses($_POST['phone']);
	update_comment_meta( $comment_id, 'phone', $phone );
	else :
	delete_comment_meta( $comment_id, 'phone');
	endif;*/
		
	if ( ( isset( $_POST['childsname'] ) ) && ( $_POST['childsname'] != '') ):
	$childsname = wp_filter_nohtml_kses($_POST['childsname']);
	update_comment_meta( $comment_id, 'childsname', $childsname );
	else :
	delete_comment_meta( $comment_id, 'childsname');
	endif;

	if ( ( isset( $_POST['classs'] ) ) && ( $_POST['classs'] != '') ):
	$class = wp_filter_nohtml_kses($_POST['classs']);
	update_comment_meta( $comment_id, 'classs', $class );
	else :
	delete_comment_meta( $comment_id, 'classs');
	endif;
	
}

// Add the comment meta (saved earlier) to the comment text 
// You can also output the comment meta values directly in comments template  

add_filter( 'comment_text', 'modify_comment');
function modify_comment( $text ){

	$plugin_url_path = WP_PLUGIN_URL;

	if( $commentchildsname = get_comment_meta( get_comment_ID(), 'childsname', true ) ) {
		$commentchildsname = '<strong>' . esc_attr( $commentchildsname ) . '</strong><br/>';
		$text = $commentchildsname . $text;
	} 

	if( $commentclass = get_comment_meta( get_comment_ID(), 'classs', true ) ) {
		$commentclass = '<p class="comment-classs">	<img src="'. $plugin_url_path .
		'/ExtendComment/images/'. $commentclass . 'star.gif"/><br/>class: <strong>'. $commentclass .' / 5</strong></p>';
		$text = $text . $commentclass;
		return $text;		
	} else {
		return $text;		
	}	 
}