<?php
/**
 * Pagination.
 *
 * @since  2.2.0
 *
 * @global array $wp_query   Current WP Query.
 * @global array $wp_rewrite URL rewrite rules.
 *
 * @param  int   $mid   Total of items that will show along with the current page.
 * @param  int   $end   Total of items displayed for the last few pages.
 * @param  bool  $show  Show all items.
 * @param  mixed $query Custom query.
 *
 * @return string       Return the pagination.
 */
function snack_pagination( $limit = null, $mid = 2, $end = 1, $show = false, $query = null ) {

    // Prevent show pagination number if Infinite Scroll of JetPack is active.
    if ( ! isset( $_GET[ 'infinity' ] ) ) {

        global $wp_query, $wp_rewrite;

        if ($wp_query->max_num_pages >= $limit) {
            $total_pages = $limit ? $limit : $wp_query->max_num_pages;
        } else {
            $total_pages = $wp_query->max_num_pages;
        }

        if ( is_object( $query ) && null != $query ) {
            if ($wp_query->max_num_pages >= $limit) {
                $total_pages = $limit ? $limit : $wp_query->max_num_pages;
            } else {
                $total_pages = $wp_query->max_num_pages;
            }
        }

        if ( $total_pages > 1 ) {
            $url_base = $wp_rewrite->pagination_base;
            $big = 999999999;

            // Sets the paginate_links arguments.
            $arguments = apply_filters( 'snack_pagination_args', array(
                    'base'      => esc_url_raw( str_replace( $big, '%#%', get_pagenum_link( $big, false ) ) ),
                    'format'    => '',
                    'current'   => max( 1, get_query_var( 'paged' ) ),
                    'total'     => $total_pages,
                    'show_all'  => $show,
                    'end_size'  => $end,
                    'mid_size'  => $mid,
                    'type'      => 'plain',
                    'prev_text' => __( '&laquo;', 'odin' ),
                    'next_text' => __( '&raquo;', 'odin' ),
                )
            );

            $pagination = '<div class="pagination">' . paginate_links( $arguments ) . '</div>';

            // Prevents duplicate bars in the middle of the url.
            if ( $url_base ) {
                $pagination = str_replace( '//' . $url_base . '/', '/' . $url_base . '/', $pagination );
            }

            return $pagination;
        }
    }
}
