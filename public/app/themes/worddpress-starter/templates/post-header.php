<?php
/**
 *Display block file name in dev mode
 */
get_template_part( 'templates/dev/block', 'info', [
  'file' => basename(__FILE__)
]);


?>
<section class="bg-[#013940] py-16 text-white relative">
  <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-br from-[#0c1f22]/75 via-[#0c1f22]/0"></div>
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="grid lg:grid-cols-2 gap-8 gap-x-16 items-center">
      <div>
        <div class="leading-none text-[#bcb1ff]">
          <h1
          data-aos="fade-left"
          data-aos-duration="500"
          data-aos-delay="10"
          class="fluid-4xl"
          ><?php the_title(); ?></h1>
        </div>
        <?php
          if(has_excerpt()): ?><div
           class="mt-4 max-w-2xl"
           data-aos="fade-left"
           data-aos-duration="500"
           data-aos-delay="100"
           ><?php the_excerpt(); ?></div><?php
        endif;
       ?>
      </div>

    </div>
  </div>
</section>
