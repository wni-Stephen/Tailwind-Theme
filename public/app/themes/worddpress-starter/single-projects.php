<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>

<?php
$text = get_field('text');
$challenge = get_field('challenge');
$solution = get_field('solution');
$result = get_field('result');
$gallery = get_field('gallery');
$location = get_field('location');
$solution_category = get_field('solution_category');
$client = get_field('client');
$design_engineer = get_field('design_engineer');
$main_contractor = get_field('main_contractor');
$testimonial = get_field('testimonial');
$related_projects = get_field('related_projects');
$count =  $related_projects ? count($related_projects) : FALSE;
?>


<section class="relative my-4 md:my-8 lg:mb-0 text-block bg-white ">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative ">
    <div class="">
      <?php if (get_the_title()) : ?>
        <h1 class="text-xl lg:text-3xl font-extrabold font-sans mb-6 uppercase text-black"><?php echo the_title(); ?></h1>
      <?php endif; ?>
      <?php if ($text): ?>
        <div class="mb-6 font-sans text-black text-lg lg:mb-10 show-spaces"><?php echo wp_kses_post($text); ?></div>
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
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 mt-10 gap-10 md:gap-20 lg:mt-20 relative  items-start">
      <div class="lg:col-span-2 order-2 md:order-1">
        <?php if ($challenge): ?>
          <p class="text-xl lg:text-2xl font-extrabold font-sans mb-6 uppercase text-black pr-10">Challenge</p>
          <div class="mb-6 font-sans text-black text-lg lg:mb-10 show-spaces"><?php echo wp_kses_post($challenge); ?></div>
        <?php endif; ?>

        <?php if ($solution): ?>
          <p class="text-xl lg:text-2xl font-extrabold font-sans mb-6 uppercase text-black pr-10">Solution</p>
          <div class="mb-6 font-sans text-black text-lg lg:mb-10 show-spaces"><?php echo wp_kses_post($solution); ?></div>
        <?php endif; ?>

        <?php if ($result): ?>
          <p class="text-xl lg:text-2xl font-extrabold font-sans mb-6 uppercase text-black pr-10">Result</p>
          <div class="mb-6 font-sans text-black text-lg lg:mb-10 show-spaces"><?php echo wp_kses_post($result); ?></div>
        <?php endif; ?>

      </div>
      <div class="lg:col-span-1 order-1 md:order-2 bg-[#f5f5f5] p-10 h-auto max-h-[550px] flex flex-col justify-center sticky top-32 right-0 border-t-4 border-t-red" data-aos="fade">
        <?php if ($client): ?>
          <div data-aos="fade">
            <p class="text-lg font-bold font-sans mb-2 text-black">Client</p>
            <div class="mb-6 font-sans text-black text-lg"><?php echo wp_kses_post($client); ?></div>
          </div>
        <?php endif; ?>
        <?php if ($location): ?>
          <div data-aos="fade">
            <p class="text-lg font-bold font-sans mb-2 text-black">Location</p>
            <div class="mb-6 font-sans text-black text-lg"><?php echo wp_kses_post($location); ?></div>
          </div>
        <?php endif; ?>
        <?php if ($design_engineer): ?>
          <div data-aos="fade">
            <p class="text-lg font-bold font-sans mb-2 text-black">Design Engineer</p>
            <div class="mb-6 font-sans text-black text-lg"><?php echo wp_kses_post($design_engineer); ?></div>
          </div>
        <?php endif; ?>
        <?php if ($main_contractor): ?>
          <div data-aos="fade">
            <p class="text-lg font-bold font-sans mb-2 text-black">Main Contractor</p>
            <div class="font-sans text-black text-lg"><?php echo wp_kses_post($main_contractor); ?></div>
          </div>
        <?php endif; ?>
        <?php if ($solution_category): ?>
          <div data-aos="fade">
            <hr class="my-5 block">
            <a href="/projects" class="group flex items-center gap-6 font-semibold justify-between text-black text-base hover:text-red duration-200 ease-in-out transition-colors" title="View more <?php echo esc_html($solution_category->post_title); ?> Prokects">More <?php echo esc_html($solution_category->post_title); ?> Projects<span>
                <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
              </span></a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php if ($count) : ?>
    <section class="relative py-8 lg:py-16 bg-white font-sans">
      <div class="absolute w-1/3 h-full bg-white z-10 left-0 top-0 bottom-0 hidden lg:block"></div>
      <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
        <div class="flex flex-row items-center justify-end">
          <!-- <a href="/projects" title="View all projects" class="text-black underline font-semibold text-base hover:text-red transition-colors duration-200 ease-in-out hidden lg:block">View all projects</a> -->
        </div>
        <div class="grid lg:grid-cols-3 gap-6 lg:gap-20 mt-10 relative">
          <div class="absolute w-1/3 h-full bg-white z-10 left-0 top-0 bottom-0 hidden lg:block"></div>
          <div class="lg:col-span-1 border-l border-l-[#D4D2CC] pl-6 lg:pl-12 relative z-20">
            <div class="flex flex-col justify-center items-start h-full gap-6">

              <h3 class="font-extrabold text-xl  w-10 uppercase">Related Projects</h3>
              <div class="text-black text-lg pr-10">
                See how we've applied our approach to similar projects.
              </div>
              <a href="/projects" class="group flex items-center gap-6 font-semibold text-base hover:text-red duration-200 ease-in-out transition-colors">Find out more <span>
                  <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                </span></a>
            </div>
          </div>
          <div class="lg:col-span-2">
            <project-slider pagination class="mt-10 lg:mt-0">
              <?php $i = 0; ?>
              <?php foreach ($related_projects as $post): ?>
                <?php $i++;
                setup_postdata($post); ?>
                <?php get_template_part('templates/partials/post-card-project-slide'); ?>
              <?php endforeach; ?>
            </project-slider>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php get_template_part('templates/blocks/contact-form'); ?>

</section>

<?php
get_template_part('templates/dev/block-render'); ?>
<?php get_footer(); ?>