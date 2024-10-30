<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD\Common;

class CWPDFrontController{

	public $enable_load;

	public function cwpd_register()
    {
    	$this->enable_load = cwpd_enable_comment_load();
    	if($this->enable_load == 1){
       	 	add_action( 'comment_form_before', array( $this, 'cwpd_add_comment_load_button' ) );
       	 	add_action( 'comment_form_after', array( $this, 'cwpd_add_error_result' ) );
       	 	add_action('wp_ajax_cwpd_ajax_comments_load', array( $this,'cwpd_comments_loadmore_handler'));
			add_action('wp_ajax_nopriv_cwpd_ajax_comments_load', array( $this,'cwpd_comments_loadmore_handler'));
			add_action( 'wp_ajax_cwdp_ajax_action', array( $this, 'cwpd_ajax_submit_comment_handler' ));
			add_action( 'wp_ajax_nopriv_cwdp_ajax_action', array( $this, 'cwpd_ajax_submit_comment_handler' ));
    	}
    }
	/**
	 * Load Button
	 * @return string
	 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
	 * Date       : 19.04.2020
	*/
	 public function cwpd_add_error_result(){
	 	$error = '<div id="erroreesult"></div>';
	 	echo $error;
	 }
	/**
	 * Load Button
	 * @return string
	 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
	 * Date       : 19.04.2020
	*/
    public function cwpd_add_comment_load_button(){
    	$cpage  = get_query_var('cpage') ? get_query_var('cpage') : 1;
    	$cwpd_comment_scroll  = cwpd_comment_scroll();
    	$cwpd_load_class = $cwpd_comment_scroll == 1 ? 'scroll_to_load' : 'click_to_load';
    	$comment_load_text  = cwpd_comment_load_text();
    	$comment_loading_text  = cwpd_comment_loading_text();
    	$load = '';
		if( $cpage  > 1 ) {

			$load .= '<div class="comment_loadmore_button"><div class="comment_loadmore  '.$cwpd_load_class.'">'. esc_attr($comment_load_text,'wpdesign').'</div></div>';
				$load .= '<script>
				var ajaxurl = \'' . site_url('wp-admin/admin-ajax.php') . '\',
				    	cwpd_post_id = ' . get_the_ID() . ',
			    	    cwpd_cpage  = ' . $cpage  . ',
			    	    cwpd_load_more_text = "'.$comment_load_text.'",
			    	    cwpd_loading_text = "'.$comment_loading_text.'",
			    	    cwpd_scroll_enable = "'.$cwpd_comment_scroll.'"
				</script>';
			}
	    echo $load;
	}

	/**
	 * Load Comment Ajax Handler
	 * @return string
	 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
	 * Date       : 19.04.2020
	*/
 
	public function cwpd_comments_loadmore_handler(){
		global $post;
		$perpage = cwpd_comment_perpage();
		$post_id = intval($_POST['post_id']);
		setup_postdata( $post );
		$comments = get_comments(array(
	        'post_id' => $post_id,
	        'number' => $perpage ));

		foreach ( $comments as $comment ) :
		$GLOBALS['comment'] = $comment;
		?>
		   <li id="comment-<?php echo esc_attr( $comment->comment_ID ); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php echo esc_attr( $comment->comment_ID ); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php 
						$comment_author_url = get_comment_author_url( $comment->comment_ID );
						$comment_author     = get_comment_author( $comment->comment_ID );
						$comment_av_size	= cwpd_avater_size();
						$comment_bud_icon	= cwpd_enable_comment_budget();
						$avatar             = get_avatar( $comment->comment_ID, $comment_av_size );
					
						if ( 0 != $comment_av_size ) {
							if ( empty( $comment_author_url ) ) {
								echo $avatar;
							} else {
								printf( '<a href="%s" rel="external nofollow" class="url">', $comment_author_url );
								echo $avatar;
							}
						}
						
						if($comment_bud_icon == 1){
							echo '<span class="post-author-badge" aria-hidden="true"><svg class="svg-icon" width="24" height="24" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg></span>';
						}

						printf(
							wp_kses(
								/* translators: %s: Comment author link. */
								__( '%s <span class="screen-reader-text says">says:</span>', 'wpdesign' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							'<b class="fn">' . $comment_author . '</b>'
						);

						if ( ! empty( $comment_author_url ) ) {
							echo '</a>';
						}
						 ?>
					</div>

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<?php
								/* translators: 1: Comment date, 2: Comment time. */
								$comment_timestamp = sprintf( __( '%1$s at %2$s', 'wpdesign' ), get_comment_date( '', $comment->comment_ID ), get_comment_time() );
							?>
							<time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo $comment_timestamp; ?>">
								<?php echo $comment_timestamp; ?>
							</time>
						</a>
						<?php
							$edit_comment_icon = '<svg class="svg-icon" width="16" height="16" aria-hidden="true" role="img" focusable="false" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
							edit_comment_link( __( 'Edit', 'wpdesign' ), '<span class="edit-link-sep">&mdash;</span> <span class="edit-link">' . $edit_comment_icon, '</span>' );
						?>
					</div>
				</footer>
				<div class="comment-content">
					<p><?php echo $comment->comment_content; ?></p>
				</div>
			</article>
			<div class="comment-reply"><a rel="nofollow" class="comment-reply-link" href="<?php echo get_permalink( $comment->comment_post_ID ); ?>?replytocom=<?php echo esc_attr( $comment->comment_ID ); ?>#respond" data-commentid="<?php echo esc_attr( $comment->comment_ID ); ?>" data-postid="<?php echo esc_attr( $comment->comment_post_ID ); ?>" data-belowelement="div-comment-<?php echo esc_attr( $comment->comment_ID ); ?>" data-respondelement="respond" aria-label="Reply to admin">Reply</a></div>
		</li>
		<?php endforeach;
			die;
	}
	/**
	 * Submit ajax Comment
	 * @return string
	 * Feature added by : Abu Sayed Russell <abusayedrussell@gmail.com>
	 * Date       : 19.04.2020
	*/
	public function cwpd_ajax_submit_comment_handler(){

	$comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
	if ( is_wp_error( $comment ) ) {
		$error_data = intval( $comment->get_error_data() );
		if ( ! empty( $error_data ) ) {
			wp_die( '<p>' . $comment->get_error_message() . '</p>', __( 'Comment Submission Failure' ), array( 'response' => $error_data, 'back_link' => true ) );
		} else {
			wp_die( 'Unknown error' );
		}
	}

	$user = wp_get_current_user();
	do_action('set_comment_cookies', $comment, $user);
 
	$comment_depth = 1;
	$comment_parent = $comment->comment_parent;
	while( $comment_parent ){
		$comment_depth++;
		$parent_comment = get_comment( $comment_parent );
		$comment_parent = $parent_comment->comment_parent;
	}
 
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $comment_depth;

	 ?>
	<li id="comment-<?php echo esc_attr( $comment->comment_ID ); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php echo esc_attr( $comment->comment_ID ); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php 
						$comment_author_url = get_comment_author_url( $comment->comment_ID );
						$comment_author     = get_comment_author( $comment->comment_ID );
						$comment_av_size	= cwpd_avater_size();
						$comment_bud_icon	= cwpd_enable_comment_budget();
						$avatar             = get_avatar( $comment->comment_ID, $comment_av_size );
					
						if ( 0 != $comment_av_size ) {
							if ( empty( $comment_author_url ) ) {
								echo $avatar;
							} else {
								printf( '<a href="%s" rel="external nofollow" class="url">', $comment_author_url );
								echo $avatar;
							}
						}
						
						if($comment_bud_icon == 1){
							echo '<span class="post-author-badge" aria-hidden="true"><svg class="svg-icon" width="24" height="24" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg></span>';
						}

						printf(
							wp_kses(
								/* translators: %s: Comment author link. */
								__( '%s <span class="screen-reader-text says">says:</span>', 'wpdesign' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							'<b class="fn">' . $comment_author . '</b>'
						);

						if ( ! empty( $comment_author_url ) ) {
							echo '</a>';
						}
						 ?>
					</div>

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<?php
								/* translators: 1: Comment date, 2: Comment time. */
								$comment_timestamp = sprintf( __( '%1$s at %2$s', 'wpdesign' ), get_comment_date( '', $comment->comment_ID ), get_comment_time() );
							?>
							<time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo $comment_timestamp; ?>">
								<?php echo $comment_timestamp; ?>
							</time>
						</a>
						<?php
							$edit_comment_icon = '<svg class="svg-icon" width="16" height="16" aria-hidden="true" role="img" focusable="false" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
							edit_comment_link( __( 'Edit', 'wpdesign' ), '<span class="edit-link-sep">&mdash;</span> <span class="edit-link">' . $edit_comment_icon, '</span>' );
						?>
					</div>
				</footer>
				<div class="comment-content">
					<p><?php echo $comment->comment_content; ?></p>
				</div>
			</article>
			<div class="comment-reply"><a rel="nofollow" class="comment-reply-link" href="<?php echo get_permalink( $comment->comment_post_ID ); ?>?replytocom=<?php echo esc_attr( $comment->comment_ID ); ?>#respond" data-commentid="<?php echo esc_attr( $comment->comment_ID ); ?>" data-postid="<?php echo esc_attr( $comment->comment_post_ID ); ?>" data-belowelement="div-comment-<?php echo esc_attr( $comment->comment_ID ); ?>" data-respondelement="respond" aria-label="Reply to admin">Reply</a></div>
		</li>
 <?php die(); }
}
