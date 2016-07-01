<?php
/**
 * Get term meta fields
 *
 * Usage:
 * <?php echo snack_get_term_meta( $term_id, $field );?>
 *
 * @since  2.2.7
 *
 * @param  int    $term_id      Term ID
 * @param  string $field        Field slug
 *
 * @return string               Field value
 */
function snack_get_term_meta( $term_id, $field ) {
    $option = sprintf( 'snack_term_meta_%s_%s', $term_id, $field );
    return get_option( $option );
}

