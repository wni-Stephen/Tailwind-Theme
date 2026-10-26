<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>

<?php
$intro = get_field('intro');
$text = get_field('text');
$gallery = get_field('gallery');
// Get current Solution ID
$current_id = get_the_ID();
$parent_id  = wp_get_post_parent_id($current_id);



// Get children (if current Solution is a parent)
$children = get_children(array(
  'post_parent' => $current_id,
  'post_type'   => 'solutions',
  'post_status' => 'publish',
  'orderby'     => 'menu_order',
  'order'       => 'ASC',
));

// If it's a child, get siblings
$siblings = [];
if ($parent_id) {
  $siblings = get_children(array(
    'post_parent' => $parent_id,
    'post_type'   => 'solutions',
    'post_status' => 'publish',
    'orderby'     => 'menu_order',
    'order'       => 'ASC',
  ));
}
?>


<!-- Need two different layouts based on parent/child -->

<!-- Subpages  -->
<?php if ($siblings): ?>
  <section class="relative my-8 md:mt-16 lg:mb-0 text-block bg-white">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-20">
        <div class="lg:col-span-1 border-t border-t-[#D9D9D9] mt-6 lg:mt-20">
          <?php
          $parent_title = get_the_title($parent_id);
          $parent_link  = get_permalink($parent_id);
          ?>
          <section class="solution-children flex flex-col gap-6 pt-6 lg:pt-12 sticky top-20 pb-6">
            <div class="flex gap-6 justify-start flex-col xl:flex-row lg:gap-6">
              <a href="<?php echo $parent_link; ?>" class="group flex items-center gap-4 font-bold uppercase duration-200 ease-in-out transition-colors text-black hover:text-red mb-8 text-xl">
                <arrow class="h-4 w-4 group-hover:-rotate-[135deg] -rotate-90 transition-transform duration-200 text-red"></arrow>
                <?php echo esc_html($parent_title); ?><span>
                </span>
              </a>
            </div>
            <?php if ($siblings): ?>
              <ul class="solution-list flex flex-col gap-4">
                <?php foreach ($siblings as $sibling): ?>
                  <?php $active = ($sibling->ID === get_the_ID()) ? 'active' : ''; ?>
                  <li class="solution-item font-sans text-base bg-[#F5F5F5] px-6 py-2 border-l-8 border-l-[#F5F5F5] hover:border-l-red hover:font-bold transition-colors ease-in-out duration-200 <?php echo $active ? 'active border-l-red font-bold' : ''; ?>">
                    <a href="<?php echo get_permalink($sibling->ID); ?>">
                      <?php echo get_the_post_thumbnail($sibling->ID, 'medium'); ?>
                      <h3><?php echo esc_html($sibling->post_title); ?></h3>
                      <p><?php echo esc_html(get_the_excerpt($sibling->ID)); ?></p>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </section>

        </div>
        <div class="lg:col-span-2">
          <?php if (get_the_title()) : ?>
            <h1 class="text-xl lg:text-3xl font-extrabold font-sans mb-6 uppercase text-black"><?php echo the_title(); ?></h1>
          <?php endif; ?>
          <?php if ($intro): ?>
            <div class="mb-6 font-sans text-black text-lg lg:mb-10 show-spaces"><?php echo wp_kses_post($intro); ?></div>
          <?php endif; ?>

          <?php
          if ($gallery): ?>
            <image-slider arrows class="mt-10 lg:mt-10 overflow-hidden">
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



          <?php if ($text): ?>
            <div class="mb-6 mt-6 lg:mt-10 font-sans text-black text-lg lg:mb-10 show-spaces"><?php echo wp_kses_post($text); ?></div>
          <?php endif; ?>
        </div>
      </div>

      <!-- <div class="grid md:grid-cols-2 gap-8 lg:gap-20 text-left mt-4 lg:mt-20">
        <div class="flex justify-between flex-col">
          <div class="relative">
            <?php if ($key_email_contact) : ?>
              <p class="font-dm-sans font-bold   text-purple">Get in touch</p>
              <div class="mt-2">
                <a class="no-underline hover:underline hover:underline-offset-8 text-purple"
                  href="mailto:<?php echo $key_email_contact; ?>">
                  <?php echo $key_email_contact; ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div> -->
    </div>
  </section>

  <?php get_template_part('templates/dev/block-render'); ?>

  <?php
  if ($related_services):
    $i = 0;
  ?>
    <section class="py-4 md:pb-8 lg:pb-16 lg:pt-4 bg-white relative">
      <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
        <p class="font-dm-sans font-bold   text-purple mb-6">More services</p>
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
          <?php foreach ($related_services as $featured_post):
            $i++;
            $permalink = get_permalink($featured_post->ID);
            $title = get_the_title($featured_post->ID);
            $excerpt = get_the_excerpt($featured_post->ID);
            $featured_colour = get_field('featured_colour', $featured_post->ID);
            if ($featured_colour == 'bg-softpink' || $featured_colour == 'bg-lightpink') : ?>
              <?php $text_colour = 'text-purple'; ?>
            <?php else : ?>
              <?php $text_colour = 'text-white'; ?>
            <?php endif; ?>
            <a title="View <?php echo $title; ?>" href="<?php echo $permalink; ?>" class="group h-full w-full px-10 py-10 min-h-[500px] <?php echo $featured_colour; ?>">
              <div class="h-full flex justify-between flex-col">
                <p
                  class="inter font-bold mb-6 block italic fluid-2xl z-10 group transition-all duration-300 !leading-tight  <?php echo $text_colour; ?>">
                  <?php echo $title; ?>
                </p>
                <div class="flex justify-between items-start flex-col gap-10">
                  <?php if ($excerpt) : ?>
                    <div class="<?php echo $text_colour; ?> line-clamp-4">
                      <?php echo $excerpt; ?>
                    </div>
                  <?php endif; ?>
                  <div class="flex justify-between items-center flex-row w-full">
                    <span class="font-dm-sans font-bold z-10 transition-all duration-300 <?php echo $text_colour; ?>">View
                      Service</span>
                    <arrow class="<?php echo $text_colour; ?> transition-all duration-300 w-10 h-5 stroke-2 z-10"></arrow>
                  </div>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Top level pages e.g. Civil Engineering -->
<?php else : ?>

  <?php get_template_part('templates/partials/header', 'solutions'); ?>
  <?php
  $heading = get_field('heading');
  $text = get_field('text');
  $intro = get_field('intro');
  $taxonomy_link = get_the_title();
  $taxonomy_link = strtolower($taxonomy_link);
  $taxonomy_link = strtolower(preg_replace('/[^a-z0-9-]+/i', '-', $taxonomy_link));
  $taxonomy_link = preg_replace('/-+/', '-', $taxonomy_link); // Remove consecutive dashes
  $taxonomy_link = trim($taxonomy_link, '-'); // Remove leading/trailing dashes

  if($taxonomy_link == "steelwork") {
    $taxonomy_link = "steelworks";
  }
  ?>

  <section class="relative mt-6 mb-10 md:my-8 lg:my-16 fifty-fifty text-black">
    <div class="grid md:grid-cols-2 md:gap-8 lg:gap-16 fifty-fity-content bg-[#f5f5f5]">
      <div class="flex items-start flex-col justify-center py-10 lg:py-20 md:order-last px-10">
        <div class="text-left">
          <?php if ($heading) : ?>
            <h1 class="text-xl lg:text-3xl font-bold font-sans mb-6 uppercase text-black"> <?php echo the_title(); ?></h1>
          <?php endif; ?>
        </div>
        <div class="w-full">
          <div>
            <?php if ($intro) : ?>
              <div class="mb-6 font-sans text-black text-lg md:max-w-[80%]">
                <?php echo wp_kses_post($text); ?>
              </div>
            <?php endif; ?>

            <div class="flex gap-6 justify-start flex-col lg:flex-row lg:gap-12 mt-8">
              <a href="/contact" title="Contact us" class="group bg-black text-white px-8 py-4 flex items-center gap-4 font-semibold text-base duration-200 ease-in-out transition-colors hover:bg-red">Get in touch<span>
                  <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                </span>
              </a>
              <a href="/projects?solution=<?php echo $taxonomy_link; ?>" title="View <?php echo the_title(); ?> projects" class="group flex items-center gap-4 font-semibold text-base duration-200 ease-in-out transition-colors text-black underline underline-offset-8"><?php echo the_title(); ?> projects<span>
                  <!-- <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow> -->
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="order-first">
        <?php $image = wp_get_attachment_url(get_post_thumbnail_id(), 'large'); ?>
        <?php if (!empty($image)) : ?>
          <picture class="relative h-full flex w-full aspect-auto max-h-full">
            <img class="object-cover object-center w-full h-full" src="<?php echo $image; ?>" alt="" />
          </picture>
        <?php endif; ?>
      </div>
    </div>
    <div>
      <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto py-16">
        <h2 class="group flex items-center gap-4 font-bold duration-200 ease-in-out transition-colors text-black mb-8 text-xl lg:text-2xl"><?php echo the_title(); ?> Services</h2>
        <?php
        // If current is a parent
        if ($children): $i = 0; ?>
          <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-x-7 lg:gap-y-20 pt-8">
            <?php foreach ($children as $child): ?>
              <?php $icon = get_field('icon', $child->ID); ?>
              <a href="<?php echo get_permalink($child->ID); ?>" title="View <?php echo esc_attr($child->post_title); ?>" class="w-full flex flex-col group bg-lightestgrey transition-all duration-500 border-t-4 border-red hover:border-midred" data-aos="fade-up">
                <div class="relative group flex flex-col h-[250px] p-8 bg-lightestgrey hover:bg-red px-6 duration-300 ease-in-out transition-all justify-between">
                  <div class="flex flex-row justify-between">
                    <?php if (!empty($icon)): ?>
                      <div class="w-14 h-14 relative rounded-[100px] bg-red group-hover:bg-white">
                        <img class="size-7 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 object-contain" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                      </div>
                    <?php else:?>
                      <div class="w-14 h-14 relative rounded-[100px] bg-red group-hover:bg-white">
                       <logo class="size-7 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 object-contain"></logo>
                      </div>
                    <?php endif; ?>
                      <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200 text-black group-hover:text-white"></arrow>
                  </div>
                  <p class="font-sans text-black group-hover:text-white text-lg"><?php echo esc_html($child->post_title); ?></p>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php get_template_part('templates/dev/block-render'); ?>
<?php endif; ?>
<?php get_footer(); ?>