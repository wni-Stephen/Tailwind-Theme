<?php $heading = get_sub_field('heading'); ?>

<section class="py-8 lg:py-12 overflow-hidden bg-white icon-slider">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
    <?php if ($heading) : ?>
      <div class="lg:max-w-screen-2xl text-left lg:w-10/12">
        <h3 class="text-2xl lg:text-4xl lg:leading-[55px] font-sans font-semibold mb-6 block"><?php echo $heading; ?></h3>
      </div>
    <?php endif; ?>
    <div>
      <div class="text-lg text-black font-sans max-w-none font-normal text-left">
        <?= get_sub_field('text'); ?>
      </div>
    </div>
    <div class="w-full max-w-screen-2xl mx-auto relative text-left overflow-x-hidden">
      <logo-slider arrows pagination class="mt-10 lg:mt-10 overflow-hidden">
        <?php
        $i = 0;
        if (have_rows('items')) : while (have_rows('items')) : the_row();
            $i++;
            $image = get_sub_field('icon');
            $link = get_sub_field('link');
            $heading = get_sub_field('heading');
            $text = get_sub_field('text');
        ?>

            <div data-aos="fade-up" data-delay="<?= $i * 0.1 ?>" class="embla__slide group bg-[#F5F5F5] p-8 lg:py-10 lg:px-8 hover:bg-red transition-colors ease-in-out duration-300 flex-[0_0_calc(100%-0.5rem)] md:flex-[0_0_calc(50%-0.5rem)] lg:flex-[0_0_calc(33%-0.5rem)] xl:flex-[0_0_calc(25%-0.75rem)]">
              <div class="flex flex-col justify-between h-full">
                <?php if (!empty($image)) : ?>
                  <img src="<?= esc_url($image['url']); ?>" height="<?= esc_attr($image['height']); ?>" width="<?= esc_attr($image['width']); ?>" alt="<?= esc_attr($image['alt']); ?>" class="object-contain object-center w-full max-w-[90px] mb-10" />
                <?php endif; ?>

                <?php if ($heading): ?>
                  <p class="mb-6 group-hover:text-white transition-colors ease-in-out duration-300 font-semibold font-sans uppercase"><?php echo $heading; ?></p>
                <?php endif; ?>

                <?php if ($text): ?>
                  <div class="group-hover:text-white transition-colors ease-in-out duration-300 font-sans text-base"><?php echo $text; ?></div>
                <?php endif; ?>

                <?php

                if ($link):
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                  <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="group flex items-center gap-4 font-semibold text-base duration-200 ease-in-out transition-colors mt-6 group-hover:text-white"><?php echo esc_html($link_title); ?><span>
                      <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                    </span>
                  </a>

                <?php endif; ?>
              </div>
            </div>
        <?php endwhile;
        else : endif; ?>
      </logo-slider>
    </div>
  </div>
</section>