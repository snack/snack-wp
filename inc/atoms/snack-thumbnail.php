<?php
/**
 * Custom post thumbnail.
 *
 * @since  2.2.0
 *
 * @param  int     $width   Width of the image.
 * @param  int     $height  Height of the image.
 * @param  string  $class   Class attribute of the image.
 * @param  string  $alt     Alt attribute of the image.
 * @param  boolean $crop    Image crop.
 * @param  string  $class   Custom HTML classes.
 * @param  boolean $upscale Force the resize.
 *
 * @return string         Return the post thumbnail.
 */
function snack_thumbnail( $width, $height, $alt, $crop = true, $class = '', $upscale = false ) {
    if ( ! class_exists( 'Snack_Thumbnail_Resizer' ) ) {
        return;
    }

    $thumb = get_post_thumbnail_id();

    if ( $thumb ) {
        $image = snack_get_image_url( $thumb, $width, $height, $crop, $upscale );
        $html  = '<img class="wp-image-thumb img-responsive ' . sanitize_html_class( $class ) . '" src="' . $image . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" alt="' . esc_attr( $alt ) . '" />';

        return apply_filters( 'snack_thumbnail_html', $html );
    }
}


