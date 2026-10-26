<?php
$file = get_sub_field('mp4');
$layout = get_sub_field('layout');
$heading = get_sub_field('heading');
$heading_size = get_sub_field('heading_size');
$indent_text = get_sub_field('indent_text');
$dot_animation = get_sub_field('dot_animation');
$dot_animation_colour = get_sub_field('dot_animation_colour');
$show_full_video_link = get_sub_field('show_full_video_link');
$source = get_sub_field('source');
?>
<div class="hero-video">
  <section class="relative <?php if ($layout == 'contained') : ?> my-8 md:my-16 <?php endif; ?>">
    <div class="w-full <?php if ($layout == 'contained') : ?> lg:w-10/12 max-w-screen-2xl mx-auto px-6 <?php endif; ?> relative">
      <?php if ($file): ?>
        <video data-aos="parallax" class="z-0 flex object-center object-cover w-full h-screen" autoplay loop muted playsinline
          preload="none">
          <source src="<?php echo $file['url']; ?>" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      <?php else: ?>
        <?php if ($source == 'vimeo') : ?>
          <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?php echo get_sub_field('video_id'); ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&amp;autoplay=1&amp;muted=1&amp;controls=0&amp;background=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Wordpress Starter"></iframe></div>
          <!-- <script src="https://player.vimeo.com/api/player.js"></script> -->
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </section>

  <section class="relative py-8 lg:py-12 lg:py-32 text-block bg-transparent">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
      <?php if ($show_full_video_link) : ?>
        <?php if ($source == 'vimeo') : ?>
          <div class="gap-6 justify-start mb-6 md:justify-end hidden md:flex">
            <a title="Watch full video (opens in new tab)" data-aos="fade" data-aos-delay="<?php echo $i * 100; ?>" class="text-white hover:underline hover:underline-offset-8 mt-8 py-4 inline-flex duration-300 font-normal font-spacemono gap-6 text-base items-center justify-between dark:text-white" href="https://vimeo.com/<?php echo get_sub_field('video_id'); ?>" target="_blank" rel="nofollow noreferrer">
              <span class="font-normal font-spacemono text-base lg:text-xl text-deepgreen dark:text-white">Play full video</span>
              <play class="w-10 h-10 stroke-2 dark:text-black"></play>
            </a>
          </div>
          <!-- <script src="https://player.vimeo.com/api/player.js"></script> -->
        <?php endif; ?>
      <?php endif; ?>

      <?php if ($heading) : ?>
        <div class="lg:max-w-screen-2xl text-left lg:w-10/12" data-aos="fade">
          <?php echo '<' . $heading_size ?> class="hero-video-heading fluid-4xl font-sora font-medium mb-6 lg:max-w-[90%] block dark:text-white text-deepgreen"><?php echo $heading; ?><?php echo '</' . $heading_size . '>' ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
      <div data-aos="fade">
        <div class="text-lg text-black font-sans max-w-none font-normal lg:max-w-[80%] xl:max-w-[60%] text-left font-manrope dark:text-white text-deepgreen <?= $indent_text ? 'md:ml-20 lg:ml-40' : ''; ?>">
          <?= get_sub_field('text'); ?>
        </div>
        <?php
        if (have_rows('links')): $i = 0; ?>
          <div class="flex gap-6 justify-start  <?= $indent_text ? 'md:ml-20 lg:ml-40' : ''; ?>">
            <?php while (have_rows('links')) : the_row();
              $i++; ?>
              <?php if (get_sub_field('link')): ?>
                <a data-aos="fade" data-aos-delay="<?php echo $i * 100; ?>" class="text-deepgreen  hover:underline hover:underline-offset-8 mt-8 py-4 inline-flex duration-300 font-semiboldfont-sora gap-2 text-base items-center justify-between dark:text-white" href="<?= get_sub_field('link')['url']; ?>" <?php if (get_sub_field('link')['target']): ?> target="_blank" rel="nofollow noreferrer" <?php endif; ?>>
                  <span class="font-semibold font-sora"><?= get_sub_field('link')['title'] ? get_sub_field('link')['title'] : 'Read More'; ?></span>
                  <arrow class="w-10 h-5 stroke-2 dark:text-black"></arrow>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </section>
</div>