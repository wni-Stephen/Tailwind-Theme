<?php
$heading = get_sub_field('heading');
$testimonials = get_sub_field('items');
$bg = 'bg-' . get_sub_field('background_colour');

$text_colour = "text-deepgreen";

if ($bg) :
    switch ($bg) {
        case "bg-deepgreen":
            $accordion_heading = "bg-white text-deepgreen hover:bg-black hover:text-white";
            $accordion_content = "bg-lightneutral";
            $text_colour = "text-white";
            break;
        case "bg-white":
            $accordion_heading = "bg-lightgreen text-deepgreen hover:bg-black hover:text-white";
            $accordion_content = "bg-lightgreen";
            $text_colour = "text-deepgreen";
            break;
    }
endif;
?>


<section class="relative py-8 lg:py-12 testmonials <?php echo $bg; ?>">
<div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
        <?php if ($heading) : ?>
            <div class="lg:max-w-screen-2xl text-left lg:w-10/12" data-aos="fade">
                <p class="fluid-2xl font-sora font-medium mb-10 lg:max-w-[90%] block <?php echo $text_colour;?>"><?php echo $heading; ?></p>
            </div>
        <?php endif; ?>
    </div>
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
    <div class="duration-300 grid lg:grid-cols-1 lg:gap-16 relative">
      <?php if ($testimonials): ?>
        <div class="w-full relative overflow-hidden">
          <testimonial-slider pagination>
            <?php foreach ($testimonials as $post):
              setup_postdata($post); ?>
              <div class="embla__slide flex flex-[0_0_100%] justify-start px-1 items-start">
                <div class="flex flex-col-reverse md:flex-row gap-6 col-span-2">
                  <div class="bg-black rounded-[31px] flex flex-col items-start p-10 lg:px-12 lg:py-10 w-full ">
                    <div data-aos="fade" class="flex flex-col duration-300 font-medium font-sora gap-1 text-base items-start w-full mb-10">
                      <span class="font-semibold font-sora text-lg"><?php the_title() ?>, <?= the_field('job_role'); ?></span>
                    </div>
                    <div class="text-xl block text-deepgreen font-sora font-medium lg:max-w-[90%]">
                      <div class="flex flex-row">
                        <?= get_field('testimonial'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-1">
                    <?php if (has_post_thumbnail()) : ?>
                      <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>" class="rounded-[31px] object-center object-cover h-full lg:h-[400px] lg:w-[400px]">
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          </testimonial-slider>
        <?php endif; ?>
        </div>
    </div>
  </div>
</section>