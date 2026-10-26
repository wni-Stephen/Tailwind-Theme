<?php

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
  return 'class="p-3"';
}

function numeric_pagination() {


  $link_anchor = 'p-3';
  $link_class = 'leading-none  flex hover:text-primary-500';
  $active_class = ' font-normal border-b border-primary-500';

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }



    echo '<ul class="flex justify-center items-center">';

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="mr-8">%s</li>', '<a class="'. $link_anchor.'" href="' . get_previous_posts_page_link() .'"><arrow class="rotate-180 w-10 h-5 stroke-2 hover:text-primary-500"></arrow></a>' );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? $active_class : '';

        printf( '<li class="'.$link_class.' %s"><a class="'. $link_anchor.'" href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li class="'.$link_class.'"><span class="'. $link_anchor.'">…</span></li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? $active_class : '';
        printf( '<li class="'. $link_class .' %s"><a class="'. $link_anchor.'" href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="'.$link_class.'"><span class="'. $link_anchor.'">…</span></li>';

        $class = $paged == $max ? $active_class : '';
        printf( '<li class="'.$link_class.' %s"><a class="'. $link_anchor.'" href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="ml-8">%s</li>' , '<a class="'. $link_anchor.'" href="' . get_next_posts_page_link() .'"><arrow class="mr-8 w-10 h-5 stroke-2 hover:text-primary-500"></arrow></a>' );

    echo '</ul>';

}
