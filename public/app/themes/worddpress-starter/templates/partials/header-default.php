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
<section data-aos="fade" class="header bg-secondary-900 text-white relative h-full overflow-hidden">
  <?php
  /*
  if(!is_front_page() && !is_404() && function_exists('yoast_breadcrumb') ) :
    yoast_breadcrumb( '<div class="absolute left-0 top-0 right-0 z-10 hidden md:block breadcrumbs py-4 text-sm"><div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto">','</div></div>' );
  endif;
  */
  ?>
  <?php if( $bg_video ): ?>
        <video class="inset-0 absolute z-0 flex object-center object-cover w-full h-full" autoplay loop muted playsinline preload="none" data-aos="parallax">
            <source src="<?= $bg_video; ?>" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    <?php else: ?>
      <?php if(has_post_thumbnail()):
        $image = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
      ?>
        <picture class="inset-0 absolute z-0 flex" data-aos="parallax">
            <img class="w-full h-full object-cover object-center block" src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
        </picture>


      <?php endif; ?>
  <?php endif; ?>

  <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-tl from-primary-400/50 via-primary-400/0"></div>
  <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-tr from-black/50 via-black/25 "></div>

  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative h-full">
      <div class="flex aspect-square md:aspect-video xl:aspect-[16/7] h-full">

        <div class="square aspect-square bg-secondary-500 h-1/4 absolute right-0 bottom-0 z-10 origin-top-left pointer-events-none"></div>
        <div class="square aspect-square bg-white h-1/4 absolute right-0 bottom-0 origin-top-left z-10 pointer-events-none"></div>
        <div class="square aspect-square bg-secondary-500 h-1/4 absolute left-0 top-0 z-10 origin-top-left pointer-events-none"></div>
        <div class="square aspect-square bg-white h-1/4 absolute left-0 top-0 z-10 origin-top-left pointer-events-none"></div>


  <?php if( $video_id): ?>
        <div @click="$refs.header_video.show()" class="square hover:bg-white hover:text-secondary-500 transition-colors duration-500 aspect-square bg-secondary-500 h-1/4 origin-top-left absolute right-0 top-0 z-0 flex items-center justify-center text-white cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20" class="w-12 h-12">
              <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
            </svg>
        </div>
  <?php endif; ?>


        <div class="py-16 leading-none flex items-end">
          <div class="leading-none max-w-4xl">
          <?php if( get_post_type() === 'sectors' ): ?>
          <?php $icon = 'icon-' . get_post_field( 'post_name', get_post()); ?>
          <component
            is="<?= $icon; ?>"
            class="w-24 h-24 -ml-4 block fill-current"
            data-aos="fade-up"
          ></component>
        <?php endif; ?>
          <h1
            data-aos="fade-up"
            data-delay="0.1"
            class="fluid-4xl font-normal"
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
<?php if( $video_id): ?>
<modal ref="header_video" variant="video">
  <video-player provider="<?= $provider; ?>" video_id="<?= $video_id; ?>" :autoplay="true"></video-player>
</modal>
<?php endif; ?>
