<?php

get_header();
get_template_part('templates/partials/header', 'simple');

?>
<section class="py-4 md:py-8 lg:py-16 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto">
    <div class="grid xl:grid-cols-3 gap-8 md:gap-16">
      <div class="xl:col-span-2">
        <?php if (has_post_thumbnail()): $image = wp_get_attachment_url(get_post_thumbnail_id(), 'full'); ?>
          <picture class="flex aspect-[16/11] mx-auto w-full overflow-hidden mb-8" data-aos="fade">
            <img src="<?= $image ?>" class="object-cover object-center block w-full" alt="<?php the_title(); ?>" />
          </picture>
        <?php endif; ?>


        <?php while (have_posts()) : the_post();
          get_template_part('templates/dev/post-block-render');
        endwhile; ?>

      </div>

      <div class="xl:col-span-1 self-start xl:sticky top-32">
        <div class="bg-gray-200 p-8">
          <div class="mb-8">
            <div class="uppercase mb-2">
              Share this article
            </div>
            <div>
              <social-share
                url="<?= get_the_permalink(); ?>"
                title="<?= get_the_title(); ?>"
                description="<?= get_the_excerpt(); ?>"></social-share>
            </div>
          </div>


          <div class="mb-8">
            <div class="uppercase mb-2">
              Categories
            </div>
            <?php

            $terms = get_categories();
            foreach ($terms as $term): ?>
              <a href="<?= get_term_link($term); ?>"><?= $term->name; ?></a>
            <?php
            endforeach;
            ?>

          </div>


          <div class="grid md:grid-cols-2 xl:grid-cols-1 gap-x-16">
            <?php
            $p = get_adjacent_post(false, '', true);
            if (!empty($p)) {
              echo '<a
              class="flex flex-col gap-4 mb-8"
              href="' . get_permalink($p->ID) . '" title="' . $p->post_title . '">
                <span class="uppercase mb-2">Previous Post</span>
                <span class="fluid-lg">' . $p->post_title . '</span>
              </a>';
            } else {
              //  echo '<div></div>';
            }
            ?>

            <?php
            $n = get_adjacent_post(false, '', false);
            if (!empty($n)) {
              echo '<a
                class="flex flex-col gap-4 mb-8"
                href="' . get_permalink($n->ID) . '" title="' . $n->post_title . '">
                  <span class="uppercase mb-2">Next Post</span>
                  <span class="fluid-lg">' . $n->post_title . '</span>
                </a>';
            } else {
              //    echo '<div></div>';
            }
            ?>
          </div>

        </div>
      </div>


    </div>
  </div>
</section>


<section class="py-4 md:py-8 lg:py-16 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto">

    <div class="col-span-3 grid md:grid-cols-2 gap-8">




      <?php
      $p = get_adjacent_post(false, '', true);
      if (!empty($p)) {
        echo '<a
        data-aos="fade-up"
        data-aos-duration="500"
        data-aos-delay="100"
        class="flex flex-col gap-4"
        href="' . get_permalink($p->ID) . '" title="' . $p->post_title . '">
          <span class="uppercase">Previous Post</span>
          <span class="leading-none"><span class="text-xl">' . $p->post_title . '</span></span>
        </a>';
      } else {
        echo '<div></div>';
      }
      ?>

      <?php
      $n = get_adjacent_post(false, '', false);
      if (!empty($n)) {
        echo '<a
          data-aos="fade-up"
          data-aos-duration="500"
          data-aos-delay="200"
          class="flex flex-col gap-4"
          href="' . get_permalink($n->ID) . '" title="' . $n->post_title . '">
            <span class="uppercase">Next Post</span>
            <span class="leading-none"><span class="text-xl">' . $n->post_title . '</span></span>
          </a>';
      } else {
        echo '<div></div>';
      }
      ?>

    </div>
  </div>
</section>

<?php

get_footer();
?>