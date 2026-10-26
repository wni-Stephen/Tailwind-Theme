<section class="relative py-8 lg:py-12 image-gallery bg-transparent">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
        <?php
        $images = get_sub_field('gallery');
        if ($images):
        $i=0;
        ?>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-16">
                <?php foreach ($images as $image): ?>
                    <?php $i++; ?>
                    <div data-aos="fade-up" data-aos-delay="<?php echo $i * 100?>">
                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="rounded-[16px] object-cover h-full w-full" />
                        <p><?php echo esc_html($image['caption']); ?></p>
                    </div>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</section>