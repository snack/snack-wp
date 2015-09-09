<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'Um comentário para &ldquo;%2$s&rdquo;', '%1$s comentários para &ldquo;%2$s&rdquo;', get_comments_number() ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
            <?php wp_list_comments( array( 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'twentytwelve' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>
    <?php
        $commenter      = wp_get_current_commenter();
        $req            = get_option( 'require_name_email' );
        $aria_req       = ( $req ? " aria-required='true'" : '' );
        $html_req       = ( $req ? " required='required'" : '' );
        $html5          = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : null;
        $comment_field  = '<div class="comment-form-comment form-group"><label class="control-label" for="comment">' . __( 'Comment', 'odin' ) . ' <span class="required text-danger">*</span></label> ' .
                         '<textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" required="required"></textarea></div>';
        $fields         =  array(
            'author' => '<div class="comment-form-author form-group">' . '<label for="author">' . __( 'Name', 'odin' ) . ( $req ? ' <span class="required text-danger">*</span>' : '' ) . '</label> ' .
                        '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></div>',
            'email'  => '<div class="comment-form-email form-group"><label for="email">' . __( 'E-mail', 'odin' ) . ( $req ? ' <span class="required text-danger">*</span>' : '' ) . '</label> ' .
                        '<input id="email" name="email" class="form-control" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
            'url'    => '<div class="comment-form-url form-group"><label for="url">' . __( 'Website', 'odin' ) . '</label> ' .
                        '<input id="url" name="url" class="form-control" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'
        );
        comment_form( array(
            'comment_notes_after'   => '',
            'comment_field'         => $comment_field,
            'fields'                => apply_filters( 'comment_form_default_fields', $fields ),
            'class_submit'          => 'submit btn btn-default'
        ));
    ?>

</div><!-- #comments .comments-area -->
