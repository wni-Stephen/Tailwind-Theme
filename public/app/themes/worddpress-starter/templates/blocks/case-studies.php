<?php $featured_posts = get_sub_field('case_studies'); ?>

<section class="relative py-16 md:py-16 text-block bg-transparent">
  <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
    <?php
    if ($featured_posts): ?>
      <?php $i = 0; ?>
      <div class="grid md:grid-cols-3 gap-8 mt-10 lg:mt-16">
        <?php foreach ($featured_posts as $featured_post):
          $i++;
          $permalink = get_permalink($featured_post->ID);
          $title = get_the_title($featured_post->ID);
          $excerpt = get_the_excerpt($featured_post->ID);
          $client = get_field('client', $featured_post->ID);
        ?>

          <a href="<?php echo esc_url($permalink); ?>" title="View <?php echo esc_html($featured_post->post_title); ?>" class="group rounded-[30px] h-full bg-lightneutral hover:duration-500 ease-in-out hover:bg-black duration-500" data-aos="fade-up" data-delay="<?= $i * 0.1 ?>">
            <div class="text-deepgreen rounded-[30px] px-8 py-10 h-full flex flex-col justify-between">
              <div class="flex justify-between gap-6 font-sora forn-medium text-base items-center mb-10 lg:mb-20 text-deepgreen group group-hover:text-deepgreen">
                <p>Case Study</p>
                <arrow class="h-8 w-8"></arrow>
              </div>
              <?php if ($excerpt) : ?>
                <div class="font-sora font-medium fluid-lg mb-10 lg:mb-20">
                  <?php echo $excerpt; ?>
                </div>
              <?php endif; ?>
              <?php if ($client) : ?>
                <div class="font-sora font-medium fluid-sm">
                  <?php echo $client; ?>
                </div>
              <?php endif; ?>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>