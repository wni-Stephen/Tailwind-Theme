<?php
$rows = get_sub_field('entries' );

if($rows):

$total = count($rows) ;

$columns = [
  2 => 'lg:grid-cols-2',
  3 => 'lg:grid-cols-3',
  4 => 'lg:grid-cols-4'
];

?>

<section>
<?php if(get_sub_field('headline')): ?>
    <div
      class="leading-none"
      data-aos="fade-up"
      data-aos-duration="500"
    ><h2 class="text-xl mb-8"><?= get_sub_field('headline'); ?></h2></div>
<?php endif; ?>
    <div class="grid <?= $columns[$total]; ?> gap-8 xl:gap-16">
    <?php
    $i = 0;
    if (have_rows('entries')): while (have_rows('entries')) : the_row();
    ?>
      <?php if(get_sub_field('link')): ?>
        <a
          href="<?= get_sub_field('link')['url']; ?>"
          <?php if(get_sub_field('link')['target']): ?> target="_blank" rel="nofollow noreferrer"<?php endif; ?>
          class="flex flex-col h-full md:pr-8 xl:pr-16 pb-8 lg:pb-0<?php if($i<$total-1): ?> border-b lg:border-b-0 lg:border-r<?php endif; ?>"
          data-aos="fade-up"
          data-aos-duration="500"
          data-aos-delay="<?= $i * 100 ?>"
        >
          <div class="leading-none">
            <h2 class="fluid-2xl mb-8 mt-0"><?= get_sub_field('label'); ?></h2>
          </div>
          <div class=" mb-8"><?= get_sub_field('text'); ?></div>
          <div class="mt-auto">
            <div class="inline-flex gap-4 items-center">
              <span class="text-lg font-bold"><?= get_sub_field('link')['title'] ? get_sub_field('link')['title'] : 'Find out more'; ?></span>
              <icon-arrow class="w-10 h-5 text-primary-500"></icon-arrow>
            </div>
          </div>
        </a>
      <?php else: ?>
      <span
        class="flex flex-col h-full md:pr-8 xl:pr-16 pb-8 lg:pb-0<?php if($i<$total-1): ?> border-b lg:border-b-0 lg:border-r<?php endif; ?>"
        data-aos="fade-up"
        data-aos-duration="500"
        data-aos-delay="<?= $i * 100 ?>"
      >
        <div class="leading-none"><h2 class="fluid-2xl mt-0 mb-8"><?= get_sub_field('label'); ?></h2></div>
        <div class=""><?= get_sub_field('text'); ?></div>
      </span>
      <?php endif; ?>

    <?php

      $i++;
    endwhile; endif;?>
    </div>

</section>

<?php endif; ?>
