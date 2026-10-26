<?php
$logo = get_sub_field('logo');
$preheading = get_sub_field('preheading');
$heading = get_sub_field('heading');
$heading_size = get_sub_field('heading_size');
$subheading = get_sub_field('subheading');
?>



<section class="relative py-8 lg:py-12 text-block bg-transparent main-text-block">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
    <?php if (!empty($logo)): ?>
      <img class="object-contain max-w-[400px] w-full mb-12" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
    <?php endif; ?>
    <?php if ($preheading) : ?>
      <div class="text-lg text-black lg:w-3/4 font-medium font-sans mb-6">
        <?php echo $preheading; ?>
      </div>
    <?php endif; ?>
    <?php if ($heading) : ?>
      <div class="lg:max-w-screen-2xl text-left lg:w-10/12" data-aos="fade">
        <?php echo '<' . $heading_size ?> class="text-2xl lg:text-4xl lg:leading-[55px] font-sans font-semibold mb-6 block"><?php echo $heading; ?><?php echo '</' . $heading_size . '>' ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
    <div data-aos="fade">
      <?php if ($subheading) : ?>
        <div class="lg:max-w-screen-2xl text-left lg:w-10/12">
          <p class="font-sans font-medium mb-6 text-xl lg:mb-8 text-black"><?php echo $subheading; ?></p>
        </div>
      <?php endif; ?>
      <div class="text-lg text-black font-sans lg:w-3/4">
        <?= get_sub_field('text'); ?>
      </div>
      <?php
      if (have_rows('links')): $i = 0; ?>
        <div class="flex gap-6 justify-start mt-6">
          <?php while (have_rows('links')) : the_row();
            $i++; ?>
            <?php if (get_sub_field('link')): ?>
              <a href="<?= get_sub_field('link')['url']; ?>" <?php if (get_sub_field('link')['target']): ?> target="_blank" rel="nofollow noreferrer" <?php endif; ?> class="group flex items-center gap-6 font-semibold text-base hover:underline hover:underline-offset-8 duration-200 ease-in-out transition-colors"><?= get_sub_field('link')['title'] ? get_sub_field('link')['title'] : 'Find out more'; ?>
                <span>
                  <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                </span>
              </a>

            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>