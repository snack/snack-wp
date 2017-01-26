<?php
/**
 * Snack_Gallery_Shortcode.
 *
 * Galeria customizada para inserir Slideshow flexslider
 * Isso altera a galeria padrão do WordPress
 *
 * @package  Snack
 * @category Snack_Gallery_Shortcode
 * @author   Snack
 * @version  2.1.5
 */

function snack_gallery_shortcode($attr) {
    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(
        shortcode_atts(
            array(
                'order'      => 'ASC',
                'orderby'    => 'menu_order ID',
                'id'         => $post->ID,
                'itemtag'    => 'li',
                'icontag'    => '',
                'captiontag' => '',
                'columns'    => 3,
                'size'       => 'thumb-700x480',
                'include'    => '',
                'exclude'    => ''
            ), $attr)
    );

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) )
        $itemtag = 'dl';
    if ( ! isset( $valid_tags[ $captiontag ] ) )
        $captiontag = 'dd';
    if ( ! isset( $valid_tags[ $icontag ] ) )
        $icontag = 'dt';

    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    if ( apply_filters( 'use_default_gallery_style', true ) )
        $size_class = sanitize_html_class( $size );
        $i = 0;

        $output .= '<div class="gallery loading"><div id="slideshow" class="flexslider slide-gallery">';
            $output .= '<ul class="slides">';

            foreach ( $attachments as $id => $attachment ) {
                //$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);
                $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, 'thumb-700x480') : wp_get_attachment_image($id, 'thumb-700x480');

                $meta = get_post_meta($id, 'credito_imagem', true);

                if ( $captiontag && trim($attachment->post_title) ) {

                    /*echo "<pre>";
                    print_r($attachment);
                    echo "</pre>";*/

                    $output .= '<li>';
                        $output .= '<span class="credits">'.$meta.'</span>';
                        $output .= $link;
                        $output .= '<div class="legend">'.wptexturize($attachment->post_excerpt).'</div>';
                    $output .= '</li>';

                }
            }
            $output .='</ul>';
        $output .='</div>';
        $output .='<div id="carousel" class="flexslider thumbs-gallery">';
            $output .='<ul class="slides">';

                foreach ( $attachments as $id => $attachment ) {
                    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, 'thumb-140x120') : wp_get_attachment_image($id, 'thumb-140x120');

                    if ( $captiontag && trim($attachment->post_title) ) {

                        $output .='<li>';
                           $output .= $link;
                        $output .='</li>';

                    }
                }

            $output .='</ul>';
        $output .='</div></div>';

        return $output;
}

add_shortcode('gallery', 'snack_gallery_shortcode');
