<?php

/**
 * Template Name: Latest News
 */

get_header(); ?>

<?php
$slider_args = array(
  'post_type'      => 'news',
  'posts_per_page' => 5,
  'orderby'        => 'date',
  'order'          => 'DESC'
);
$slider_query = new WP_Query($slider_args);
?>

<?php $images = get_field('news_slider_images', 'option'); ?>

<section class="relative bg-black text-white h-[600px] overflow-hidden ">
  <div class="h-full w-full flex justify-between gap-4 xl:gap-8" data-arrows="true">

    <latest-news-slider arrows class="w-full">
       <template v-slot:background>
    <?php
    $images = get_field('news_slider_images', 'option');

    if ($images) {
        // Pick 5 random images (or fewer if gallery has less)
        $random_keys = array_rand($images, min(5, count($images)));
        $random_keys = (array) $random_keys;
        $random_images = array_intersect_key($images, array_flip($random_keys));
        shuffle($random_images); // optional — random order each load
        ?>

        <?php foreach ($random_images as $image): ?>
          <picture class="embla__slide flex flex-[0_0_100%] h-full w-full object-cover">
            <source type="image/webp" srcset="<?php echo esc_url($image['sizes']['large']); ?>">
            <img 
              class="w-full h-full object-cover object-top"
              src="<?php echo esc_url($image['sizes']['full']); ?>"
              alt="<?php echo esc_attr($image['alt']); ?>" />
          </picture>
        <?php endforeach; ?>

    <?php } else { ?>
        <p>No images found in ACF gallery.</p>
    <?php } ?>
  </template>

      <?php if ($slider_query->have_posts()) : ?>
        <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
          <a href="<?php the_permalink(); ?>"
            class="group flex flex-col justify-end flex-[0_0_100%] md:flex-[0_0_50%] xl:flex-[0_0_33.33334%] relative border-r border-white/25 h-full embla__slide pl-10">
            <div class="h-[0%] group-hover:h-[100%] bg-gradient-to-t from-black/75 absolute inset-x-0 bottom-0 transition-all duration-500 overlay"></div>
            <div class="p-16 relative pt-32 pb-8 pl-6">
              <h2 class="mb-8 text-2xl font-sans font-semibold uppercase pr-6 leading-normal">
                <?php the_title(); ?>
              </h2>
              <p class="mb-8 overflow-hidden max-h-0 translate-y-full opacity-0 group-hover:max-h-24 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 pr-10 excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
              </p>
              <div class="flex flex-row gap-6">
                <p class="opacity-0 w-0 group-hover:opacity-100 group-hover:w-auto cta">Read more</p>
                <arrow class="arrow group-hover:rotate-45 text-white group-hover:text-white"></arrow>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </latest-news-slider>

  </div>
</section>