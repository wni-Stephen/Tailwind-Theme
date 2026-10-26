<section class="relative">
    <div
      class=""
      data-aos="fade-up"
      data-aos-duration="500"
    >
    <div class="leading-none mb-8">
      <h2 class="fluid-2xl"><?= get_sub_field('headline'); ?></h2>
    </div>
      <app-collapse>
        <?php if (have_rows('entries')) :while (have_rows('entries')) : the_row(); ?>
        <app-collapse-item title='<?= str_replace("'", "’", get_sub_field('title')); ?>' name='<?= str_replace("'", "’", get_sub_field('title')); ?>'>
          <div class="max-w-screen-md pb-4"><?= get_sub_field('content') ?></div>
        </app-collapse-item>
        <?php endwhile; else : endif; ?>
      </app-collapse>
    </div>
</section>
