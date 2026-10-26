<?php

if($sectors = get_posts(
  array(
    'post_type' 				=> 'sectors',
    'post_status' 			=> 'publish',
    'posts_per_page'    => -1,
    'sort_column'       => 'menu_order',
    'order'             => 'ASC',
  )
)):
?>


<section class="py-8 lg:py-12 bg-primary-500 text-white overflow-hidden">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">

        <div class="leading-snug mb-4">
          <h2 class="fluid-lg">Our Sectors</h2>
        </div>
        <div class="flex flex-wrap gap-16 items-center justify-center mb-4">
        <?php
        $i = 0;
        foreach( $sectors as $post ):
          setup_postdata($post);
          $i++;
        ?>
            <a
              href="<?= get_permalink() ?>"
              class="block lg:w-32 text-center transition-all duration-500 hover:-translate-y-2"

            >
              <div
                data-aos="fade-up"
                data-delay="<?= $i * 0.1 ?>"
              >
                <?php $icon = 'icon-' . get_post_field( 'post_name', get_post() ); ?>
                <component is="<?= $icon; ?>" class="w-24 h-24 mx-auto fill-current"></component>
                <div class="text-lg"><?= get_the_title(); ?></div>
              </div>
          </a>
        <?php
        endforeach;
        wp_reset_postdata();
        ?>
    </div>

  </div>
</section>
<?php
endif;
