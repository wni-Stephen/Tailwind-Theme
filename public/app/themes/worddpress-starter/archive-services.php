<?php
get_header();
get_template_part( 'templates/partials/header', 'services' );
$image_one = get_field('image_one', 'option');
$image_two = get_field('image_two', 'option');
?>


<section class="py-4 md:pb-8 lg:pb-16 lg:pt-4 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">

    <?php
      $args = array(
        'type' => 'services',
        'taxonomy' => 'services',
        'orderby' => 'description',
        'order' => 'ASC'
      );

      $i = 0;
      $count = count($posts);
      if ( have_posts() ) :?>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
      <?php while ( have_posts() ) : the_post(); $i++;
        ?>
      <?php $featured_colour = get_field('featured_colour');
      if ($featured_colour == 'bg-softpink' || $featured_colour == 'bg-lightpink' ) : ?>
          <?php $text_colour = 'text-purple'; ?>
        <?php else :?>
          <?php $text_colour = 'text-white'; ?>
      <?php endif; ?>
      <a title="View <?php the_title();?>" href="<?php the_permalink(); ?>" data-aos="fade-up" data-delay="<?= $i * 0.1 ?>" class="group h-full w-full px-10 py-10 min-h-[500px] <?php echo $featured_colour; ?>">
        <div class="h-full flex justify-between flex-col">
          <p class="font-sans font-bold mb-6 block italic fluid-2xl z-10 group transition-all duration-300 !leading-tight  <?php echo $text_colour; ?>">
            <?php the_title(); ?>
          </p>
          <div class="flex justify-between items-start flex-col gap-10">
          <div class="<?php echo $text_colour; ?> line-clamp-4"><?php the_excerpt();?></div>
          <div class="flex justify-between items-center flex-row w-full">
            <span class="font-dm-sans font-bold z-10 transition-all duration-300 <?php echo $text_colour; ?>">View Service</span>
            <arrow class="<?php echo $text_colour; ?> transition-all duration-300 w-10 h-5 stroke-2 z-10"></arrow>
        </div>
          </div>
        </div>
      </a>
      <?php if ($i == 5): ?>
        <?php if( !empty( $image_one ) ): ?>
        <picture class="relative h-full flex w-full aspect-auto max-h-full" data-aos="fade-up" data-delay="<?= $i * 0.1 ?>">
          <img class="object-cover object-center w-full h-full" src="<?= esc_url($image_one['url']); ?>" height="<?= esc_attr($image_one['height']); ?>" width="<?= esc_attr($image_one['width']); ?>" alt="<?= esc_attr($image_one['alt']); ?>" />
        </picture>
        <?php endif; ?>
        
        <?php elseif ($i == 9): ?>
        <?php if( !empty( $image_two ) ): ?>
        <picture class="relative h-full flex w-full aspect-auto max-h-full" data-aos="fade-up" data-delay="<?= $i * 0.1 ?>">
          <img class="object-cover object-center w-full h-full" src="<?= esc_url($image_two['url']); ?>" height="<?= esc_attr($image_two['height']); ?>" width="<?= esc_attr($image_two['width']); ?>" alt="<?= esc_attr($image_two['alt']); ?>" />
        </picture>
        <?php endif; ?>



      <?php endif; ?>
      <?php endwhile; ?>
    </div>
    <div class="mt-16">
      <?php numeric_pagination(); ?>
    </div>
    <?php else: ?>
    <p>No posts found. :(</p>
    <?php endif; ?>
  <?php wp_reset_postdata(); ?>
  </div>
</section>



<?php
  get_footer();
?>