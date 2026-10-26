<?php
$items = get_sub_field('images');
$count =  $items ? count($items) : FALSE;
$indent = get_sub_field('indent');
?>
<?php if ($count) : ?>
    <section class="pb-10 slider overflow-x-hidden <?= $indent ? 'lg:ml-40' : ''; ?>">
        <div class="px-6 w-full lg:w-10/12 relative max-w-screen-2xl mx-auto">
            <div class="w-full">
                <div class="mt-8" data-aos="fade-up">
                    <multi-column-slider pagination>
                        <?php $i = 0; ?>
                        <?php while (have_rows('images')) : the_row(); ?>
                            <?php $i++; ?>
                            <?php $image = get_sub_field('image');?>
                            <div class="embla__slide relative group mx-4 flex flex-[0_0_100%] rounded-[32px]">
                                <div data-aos="fade-up" data-delay="<?= $i * 0.1 ?>" class="duration-300 group text-black w-full">
                                    <div class="group relative w-full h-full">
                                        <?php if (!empty($image)): ?>
                                            <img class="object-cover object-center w-full h-full duration-300 max-h-[400px] md:max-h-[600px] rounded-[32px]"
                                                src="<?php echo esc_url($image['url']); ?>"
                                                alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </multi-column-slider>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>