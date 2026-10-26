<?php
$file = get_sub_field('mp4');
$layout = get_sub_field('layout');
?>

<section class="relative video <?php if ($layout == 'contained') : ?> my-8 md:my-16 <?php endif; ?>">
  <div class="w-full <?php if ($layout == 'contained') : ?> lg:w-10/12 max-w-screen-2xl mx-auto px-6 <?php endif; ?> relative">

    <?php if ($file): ?>
      <video class="z-0 flex object-center object-cover w-full h-full max-h-[600px] rounded-[32px]" autoplay loop muted playsinline
        preload="none">
        <source src="<?php echo $file['url']; ?>" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
    <?php else: ?>
      <!-- <video-player id="player" autoplay="true" provider="<?= get_sub_field('source'); ?>" autoplay loop muted playsinline progressive <?php if ($video_id = get_sub_field('video_id')): ?> video_id="<?= $video_id; ?>"<?php endif; ?>>
    </video-player> -->
      <?php $source = get_sub_field('source'); ?>
      <?php if ($source == 'vimeo') : ?>
        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?php echo get_sub_field('video_id'); ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&amp;autoplay=1&amp;muted=1&amp;controls=0&amp;background=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Wordpress Starter"></iframe></div>
        <!-- <script src="https://player.vimeo.com/api/player.js"></script> -->
      <?php else : ?>
          <iframe width="100%" height="100%" class="min-h-[600px]" autoplay muted src="https://www.youtube.com/embed/<?php echo get_sub_field('video_id'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      <?php endif; ?>
    <?php endif; ?>

  </div>
</section>