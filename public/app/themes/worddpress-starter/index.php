<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package demo
 */

get_header();

$post = get_option( 'page_for_posts' );
setup_postdata( $post );
get_template_part( 'templates/partials/header', 'simple' );
wp_reset_postdata();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>
 <section class="py-8 lg:py-12 bg-white overflow-hidden">
       <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
          <?php
            if ( have_posts() ) :
          ?>
              <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-8">
              <?php
              while ( have_posts() ) : the_post();
              get_template_part( 'templates/partials/post-card');
              endwhile;
          ?>
          </div>
          <div class="mt-16">
               <?php numeric_pagination(); ?>
          </div>
        <?php else: ?>
             <p>No posts found. :(</p>
        <?php endif; ?>
 </section>

<?php
  // Check value exists.
  $post = get_option( 'page_for_posts' );
  setup_postdata( $post );
  get_template_part( 'templates/dev/block-render');
  wp_reset_postdata();
  get_footer();
?>
