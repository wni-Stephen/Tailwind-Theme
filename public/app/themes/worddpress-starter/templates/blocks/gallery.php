<?php 
$items = get_sub_field('items');
$count =  $items ? count($items) : FALSE;
$layout = get_sub_field('layout'); //contained or full-width
?>
<?php if ($count) : ?>
<section class="py-4 md:py-8 lg:pb-16 bg-white relative overflow-hidden">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
      <?php $i = 0; ?>
        <div class="flex flex-wrap gap-8 <?php if($layout == 'Horizontal'): echo 'justify-center'; else: echo 'justify-end'; endif;  ?>  <?php echo $layout; ?>">
        <?php while( have_rows('items') ) : the_row(); $i++; ?>

        <?php $image = get_sub_field('image');
        $video = get_sub_field('video'); 
        
        $styles = '';
        $image_styles = '';

        if($layout == 'Horizontal') {
          if ($i == 1) {
            $styles = 'flex-[0_0_20%] ';
            $image_styles = 'lg:top-10';
          } elseif ($i == 2) {
            $styles = 'flex-[0_0_40%] md:flex-[0_0_48%] xl:flex-[0_0_50%] lg:h-full';
          } elseif ($i == 3) {
            $styles = 'flex-[0_0_20%]';
            $image_styles = ' lg:top-14';
          } elseif ($i == 4) {
            $styles = '-top-2 flex-[0_0_20%] lg:-top-4 xl:-top-1';
          } elseif ($i == 5) {
            $styles = '-top-2 flex-[0_0_28%] lg:-top-4 lg:-left-1 xl:-top-1';
          }
        } else {
          if ($i == 1) {
            $styles = 'flex-[0_0_46%] lg:flex-[0_0_48%] lg:top-20';
            $image_styles = '';
          } elseif ($i == 2) {
            $styles = 'flex-[0_0_46%] lg:flex-[0_0_48%] pr-10 lg:pr-20 ';
          } elseif ($i == 3) {
            $styles = 'flex-[0_0_40%] lg:top-5 ';
            $image_styles = 'lg:top-14 !max-h-[800px]';
          } elseif ($i == 4) {
            $styles = 'flex-[0_0_46%] lg:flex-[0_0_48%] lg:top-0';
          } elseif ($i == 5) {
            $styles = 'flex-[0_0_40%] -top-16 md:-top-24 lg:-top-20 xl:-top-24 2xl:-top-40 pr-10 lg:pr-20';
            $image_styles = '!max-h-[500px] ';
          }
        }
        ?>
         <?php if($video): ?>
          <div class="max-w-full overflow-hidden relative <?php echo $styles; ?>" data-aos="fade-up" data-delay="<?= $i * 0.1 ?>">
            <video class="object-cover object-center h-full w-full duration-300 max-h-[600px] relative <?php echo $image_styles;?>" autoplay loop muted playsinline preload="none">
              <source src="<?php echo $video['url']; ?>" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
         </div>
        <?php elseif( !empty( $image ) ): ?>
          <div class="max-w-full overflow-hidden relative h-full <?php echo $styles; ?>" data-aos="fade-up" data-delay="<?= $i * 0.1 ?>">
            <img class="object-cover object-center w-full duration-300 max-h-[600px] h-full relative <?php echo $image_styles;?> " src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        </div>
        <?php endif; ?>
        <?php endwhile; ?>
        </div>
  </div>
</section>
<?php endif; ?>