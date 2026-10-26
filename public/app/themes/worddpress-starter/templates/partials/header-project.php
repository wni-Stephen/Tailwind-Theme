<?php
/**
 *Display block file name in dev mode
 */
get_template_part( 'templates/dev/block', 'info', [
  'type' => 'template',
  'file' => basename(__FILE__)
]);

$bg_video = get_field('background_video');
$video_id = get_field('video_id');
$provider = get_field('provider');
?>
<section class="header h-[30rem] lg:h-[40rem] text-white relative overflow-hidden" data-aos="fade">
  <?php
  /*
  if(!is_front_page() && !is_404() && function_exists('yoast_breadcrumb') ) :
    yoast_breadcrumb( '<div class="absolute left-0 top-0 right-0 z-10 hidden md:block breadcrumbs py-4 text-sm"><div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto">','</div></div>' );
  endif;
  */
  ?>
      <?php if(has_post_thumbnail()):
        $image = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
      ?>
        <picture class="inset-0 absolute z-0 flex" data-aos="parallax">
            <img class="w-full h-full object-cover object-center block" src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
        </picture>
      <?php endif; ?>

    <div class="absolute z-0 left-0 right-0 top-0 h-44 pointer-events-none bg-gradient-to-b from-darkgrey/50 via-darkgrey/25">
    </div>
    <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-tr from-darkgrey/50 via-darkgrey/25"></div>

    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative h-full">
        <div class="flex w-full h-full grow">
        <div class="py-16 leading-none flex items-end w-full max-w-screen-2xl">
          <div class="leading-none w-full">

        <?php
        $category = get_the_terms( get_the_ID() , 'solution' );
        if($category):
          $icon = 'icon-' . $category[0]->slug ;
          ?>
          
          <component is="<?= $icon; ?>" class="object-contain object-center min-h-[90px] max-h-[90px]"></component><?php
        endif;
        ?>
        <div class="flex items-center justify-between w-full">
          <h1
            data-aos="fade-up"
            data-delay="0.1"
            class="fluid-3xl font-normal mb-8 text-white max-w-[75%] !leading-snug"
          ><?php
              if ( is_post_type_archive() ){
                post_type_archive_title();
              }elseif(is_category()){
                single_cat_title();
              }else{
                the_title();
              }
              ?></h1>
            </div>
        </div>
    </div>
  </div>
</section>