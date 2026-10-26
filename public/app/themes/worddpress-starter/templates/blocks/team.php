<?php $team = get_sub_field('members'); ?>

<div id="team"></div>
<section class="bg-white py-8 lg:py-16 overflow-hidden">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">

    <?php  $i = 0; if ( $team && count($team) > 0 ): ?>

    <div class="flex justify-between items-center mb-8 ">
      <?php if($link = get_sub_field('link')): ?>
      <a class="underline hover:no-underline" href="<?= $link['url']; ?>" <?php if($link['target']): ?> target="_blank"
        rel="nofollow noreferrer"
        <?php endif; ?>>
        <span>
          <?= $link['title'] ? $link['title'] : 'View full profiles'; ?>
        </span>
      </a>
      <?php endif; ?>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-16">
      <?php

    foreach( $team as $post ) :
      setup_postdata($post);
      $i++;
    ?>
      <button type="button" @click="$refs.team<?= get_the_ID() ?>.show()" title="Read <?php the_title();?>'s bio" type="button"> <div class="bg-white flex flex-row md:flex-col h-full" data-aos="fade-up" data-delay="<?= $i * 0.1 ?>">
        <div class="w-1/3 md:w-full flex-shrink-0 overflow-hidden">
          <?php if(has_post_thumbnail()):
            $image = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
          ?>
          <picture class="md:aspect-[4/6] flex w-full h-full relative">
            <img class="object-cover object-top w-full h-full rounded-[10px]" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
          </picture>
          <?php else: ?>
          <div class="md:aspect-[4/6] flex items-center justify-center w-full bg-black relative rounded-[10px] h-full px-6">
            <logo-letters-navy></logo-letters-navy>
          </div>
          <?php endif; ?>
        </div>
        <div class="px-4 md:px-0 py-4 md:py-8 md:w-full flex-shrink-0">
          <div class="leading-none">
            <h2 class="font-sora font-medium mt-2 fluid-lg block group transition-all duration-300 text-left">
              <?= the_title(); ?>
            </h2>
          </div>
          <div class="w-full text-[#000000] font-bold font-manrope block text-base mt-6 text-left">
            <?= get_field('role'); ?>
          </div>
        </div>
      </div></button>
      <modal-secondary variant="team" ref="team<?= get_the_ID() ?>">
        <div class="p-8 md:p-16">
          <h2 class="font-sora font-medium mt-6 text-xl block group transition-all duration-300 text-left mb-2"><?= the_title(); ?></h2>
          <div class=" mb-8"><?= get_field('role'); ?></div>
          <div class=" mb-8"><?= get_field('bio'); ?></div>
          <?php if($email = get_field('email')): ?>
            <div class="truncate"><a class="underline hover:no-underline" href="mailto:<?= $email ?>"><?= $email ?></a></div>
          <?php endif; ?>
        </div>
      </modal-secondary>
    <?php
      endforeach;
      wp_reset_postdata();?>
  </div>
  <?php endif; ?>
  </div>
</section>