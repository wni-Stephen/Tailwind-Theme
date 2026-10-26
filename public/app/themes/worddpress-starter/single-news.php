<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>

<?php
$solution_category = get_field('solution_category');
$client = get_field('client');
$design_engineer = get_field('design_engineer');
$main_contractor = get_field('main_contractor');
$testimonial = get_field('testimonial');
$related_projects = get_field('related_projects');
$count =  $related_projects ? count($related_projects) : FALSE;
?>


<section class="relative mb-0 my-4 md:my-8 text-block bg-white ">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative ">
    <div class="">
      <?php if (get_the_title()) : ?>
        <h1 class="text-xl lg:text-3xl font-extrabold font-sans mb-4 uppercase text-black"><?php echo the_title(); ?></h1>
      <?php endif; ?>
      <?php
      $day = get_the_date('j'); // Day number (1–31)
      $month = get_the_date('F'); // Full month name
      $year  = get_the_date('Y');   // Full year

      // Add the proper suffix
      if (in_array(($day % 100), [11, 12, 13])) {
        $suffix = 'th';
      } else {
        switch ($day % 10) {
          case 1:
            $suffix = 'st';
            break;
          case 2:
            $suffix = 'nd';
            break;
          case 3:
            $suffix = 'rd';
            break;
          default:
            $suffix = 'th';
            break;
        }
      }


      ?>
      <span class="text-black font-normal font-sans block text-sm mb-4"><?php echo esc_html($day . $suffix . ' ' . $month . ' ' . $year); ?></span>
    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 mt-10 gap-10 relative items-start">
      <div class="md:col-span-2 order-1">
      <?php
      if ($gallery): ?>
        <image-slider arrows class="my-10 overflow-hidden">
          <?php foreach ($gallery as $image): ?>
            <div data-aos="fade-up" data-delay="<?= $i * 0.1 ?>" class="embla__slide group flex-[0_0_100%]">
              <div class="flex flex-col justify-between h-full">
                <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="object-cover h-full max-h-[600px]" />
              </div>
            </div>
          <?php endforeach; ?>
        </image-slider>
      <?php else : ?>
        <?php if (has_post_thumbnail()):
          $image = wp_get_attachment_url(get_post_thumbnail_id(), 'full');
        ?>
          <picture>
            <img class="object-cover object-center w-full h-[500px]" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
          </picture>
        <?php endif; ?>
      <?php endif; ?>
      </div>
      <div class="lg:col-span-1 self-start xl:sticky order-1 lg:order-2 bg-[#f5f5f5] rounded-md p-10 h-auto max-h-[550px] flex flex-col justify-center sticky top-32 right-0 mb-4">
        <div class="mb-8">
          <div class="uppercase mb-2 font-bold font-sans text-base">
            Share this article
          </div>
          <div class="">
            <social-share
              url="<?= get_the_permalink(); ?>"
              title="<?= get_the_title(); ?>"
              description="<?= get_the_excerpt(); ?>"></social-share>
          </div>
        </div>


        <div class="mb-8">
          <?php

          $terms = get_categories();
          foreach ($terms as $term): ?>
            <a href="<?= get_term_link($term); ?>"><?= $term->name; ?></a>
          <?php
          endforeach;
          ?>

        </div>


        <div class="grid lg:grid-cols-2 xl:grid-cols-1 gap-x-16">
          <?php
          $p = get_adjacent_post(false, '', true);
          if (!empty($p)) {
            echo '<a
              class="flex flex-col gap-4 mb-8"
              href="' . get_permalink($p->ID) . '" title="' . $p->post_title . '">
                <span class="uppercase mb-2 font-bold font-sans text-base">Previous Post</span>
                <span class="mb-2 font-normal font-sans text-base">' . $p->post_title . '</span>
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
                  <span class="uppercase mb-2 font-bold font-sans text-base">Next Post</span>
                  <span class="mb-2 font-normal font-sans text-base">' . $n->post_title . '</span>
                </a>';
          } else {
            //    echo '<div></div>';
          }
          ?>
        </div>

      </div>
    </div>
  </div>




</section>

<?php
get_template_part('templates/dev/block-render'); ?>
<?php get_footer(); ?>