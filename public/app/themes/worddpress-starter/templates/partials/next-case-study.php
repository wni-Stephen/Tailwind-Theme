<?php
$post = get_adjacent_post(false, '', true);
if(!empty($post)):
  setup_postdata($post);
?>
<section class="py-8 lg:py-12 bg-black overflow-hidden">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">

    <a data-aos="fade" class="transition-colors text-white bg-secondary-500 grid md:grid-cols-3 overflow-hidden" href="<?= get_permalink(); ?>">

        <div class="relative col-span-2 md:order-last">

          <?php if(has_post_thumbnail()):
            $image = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
          ?>
            <picture class="flex w-full aspect-video">
              <img class="object-cover object-center w-full h-full" src="<?= $image; ?>" alt="<?= get_the_title() ?>">
            </picture>
          <?php else: ?>
            <div class="flex items-center justify-center w-full aspect-video bg-gray-200">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 stroke-1 text-gray-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
              </svg>
            </div>
          <?php endif; ?>
        </div>
        <div class="flex flex-col p-8 xl:p-16 justify-between">
          <div class="uppercase mb-4 text-sm tracking-wide">Next project</div>
          <span class="leading-tight mb-8">
            <span class="text-xl"><?= get_the_title() ?></span>
          </span>
          <span class="mt-auto inline-flex gap-4 items-center">
            <span>View project</span>
            <arrow class="w-10 h-5 stroke-2"></arrow>
          </span>

        </div>
      </a>

</section>
<?php
wp_reset_postdata();
endif;
?>
