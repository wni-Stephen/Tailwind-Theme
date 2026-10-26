<?php 
$heading = get_sub_field('heading');
$background_colour = get_sub_field('background_colour');
?>

<section class="py-8 lg:py-12 overflow-hidden <?php echo $background_colour; ?>">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto">
  <?php if($heading) : ?>
    <div class="lg:max-w-screen-2xl text-left lg:w-10/12" data-aos="fade">
      <h3 class="text-lg text-black font-sans text-left text-white font-dm-sans font-bold text-xl mb-6"><?php echo $heading; ?></h3>
    </div>
    <?php endif; ?>
    <div class="w-full lg:w-10/12 relative max-w-screen-2xl">
    <div data-aos="fade">
      <div class="text-lg text-black font-sans font-normal text-left font-dm-sans text-lg text-white">
        <?= get_sub_field('text'); ?>
      </div>
  </div>
  </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-16 lg:gap-y-32 mt-16 lg:mt-16 py-16 lg:py-0">
          <?php
          $i = 0;
          if (have_rows('items')) :while (have_rows('items')) : the_row();
          $i++;
          $icon = get_sub_field('icon');
          $link = get_sub_field('link');
          $text = get_sub_field('text');

          if( $link ): 
              $link_url = $link['url'];
              $link_title = $link['title'];
              $link_target = $link['target'] ? $link['target'] : '_self';
              ?>
            <?php endif; ?>

              <div data-aos="fade-up" data-delay="<?= $i * 0.1 ?>" class="flex flex-[0_0_20%] justify-center flex-col items-center text-white">
              <<?php echo $icon; ?>></<?php echo $icon; ?>>
              <p class="font-dm-sans font-bold mt-6"><?php echo $text; ?></p>
            
             </div>

         
          <?php endwhile; else : endif; ?>
        </div>
  </div>
</section>
