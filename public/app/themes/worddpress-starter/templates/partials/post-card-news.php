<div data-aos="fade-up">
  <a href="<?= get_permalink() ?>" class="w-full flex flex-col group bg-black hover:shadow-lg transition-all duration-500">
    <div class="flex-shrink-0 relative overflow-hidden">
      <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-tr from-black/75 via-black/25"></div>
      <?php $image = wp_get_attachment_url(get_post_thumbnail_id(), 'large'); ?>
      <picture class="w-full flex h-[450px]">
        <img class="transition-all duration-500 object-cover object-center w-full group-hover:h-full" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
        <div class="absolute bottom-0 lg:bottom-auto lg:top-0 right-0 lg:w-20 h-[70px] bg-black flex items-center justify-center transition-all duration-500 ease-in-out w-full group-hover:bg-red" title="View <?php the_title(); ?>">
          <arrow class="hidden lg:block text-white absolute top-7 right-7 group-hover:rotate-45 transition-transform duration-200"></arrow>
        </div>
        <div class="lg:hidden absolute lg:top-0 right-0 w-20 h-20 bg-black flex items-center justify-center transition-all duration-500 ease-in-out lg:group-hover:w-full lg:group-hover:h-full" title="View <?php the_title(); ?>">
          <arrow class="text-white absolute top-8 right-8 group-hover:rotate-45 transition-transform duration-200"></arrow>
        </div>
      </picture>
    </div>
  </a>
  <div class="transition-all duration-500 absolute bottom-0 left-0 right-0 text-white group-hover:text-white flex flex-col p-6 xl:p-8 h-auto py-6">
        <div class="transition-all duration-500 absolute bottom-0 left-0 right-0 z-0 pointer-events-none bg-black group-hover:h-0 h-full"></div>
        <div class="relative flex flex-col h-full items-start justify-center">
          <p class="text-base lg:text-lg text-white font-sans group group-hover:text-white transition-all duration-500">
            <?php the_title() ?>
          </p>
          <?php
              $day = get_the_date('j'); // Day number (1–31)
              $month = get_the_date('F'); // Full month name
              $year  = get_the_date('Y');   // Full year

              // Add the proper suffix
              if (in_array(($day % 100), [11, 12, 13])) {
                $suffix = 'th';
              } else {
                switch ($day % 10) {
                  case 1:  $suffix = 'st'; break;
                  case 2:  $suffix = 'nd'; break;
                  case 3:  $suffix = 'rd'; break;
                  default: $suffix = 'th'; break;
                }
              }

            
              ?>
          <span class="text-white font-normal font-sans block text-sm mt-2"><?php   echo esc_html($day . $suffix . ' ' . $month . ' ' . $year); ?></span>
        </div>
      </div>
</div>