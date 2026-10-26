<?php
/**
 *Display block file name in dev mode
 */
get_template_part( 'templates/dev/block', 'info', [
  'type' => 'template',
  'file' => basename(__FILE__)
]);

?>

<section class="relative overflow-hidden bg-white my-8">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="lg:max-w-screen-2xl">
      <h1 class="text-xl lg:text-3xl font-bold font-sans mb-6 uppercase text-black">
      <?php if ( is_post_type_archive() ){
          post_type_archive_title();
        }elseif(is_category()){
          single_cat_title();
        }elseif ( is_tax() ) {
      		$queried_object = get_queried_object();
      		if ( $queried_object ) {
      			$tax = get_taxonomy( $queried_object->taxonomy );
      			single_term_title('');
      		}
    	  } else{
          the_title();
        } ?>
      </h1>
    </div>
  </div>
  <?php if(has_excerpt() && !is_post_type_archive()): ?>
  <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
    <div data-aos="fade">
      <div class="text-lg text-black font-sans pr-6 max-w-none font-normal lg:max-w-[75%]">
        <?php the_excerpt(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</section>