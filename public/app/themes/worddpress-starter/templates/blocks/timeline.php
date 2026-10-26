<section class="process-cards relative text-block bg-white py-8 md:py-16 lg:py-0">
    <!-- Previous/Next Navigation Arrows -->
    <div class="hidden lg:flex flex-col items-center justify-between gap-0 sticky top-1/2 left-0 w-20 h-fit bg-red">
        <button
            id="prev-decade-btn"
            class="decade-arrow-btn w-full px-3 text-sm font-semibold text-white transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center hover:bg-darkred duration-300 ease-in-out bg-red py-6"
            aria-label="Previous decade">
            <arrow class="-rotate-45"></arrow>
        </button>
        <button
            id="next-decade-btn"
            class="decade-arrow-btn w-full px-3 text-sm font-semibold text-white transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center hover:bg-darkred duration-300 ease-in-out bg-red py-6"
            aria-label="Next decade">
            <arrow class="rotate-[135deg]"></arrow>
        </button>
    </div>
    <div class="lg:px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left ">
        <div class="lg:max-w-screen-2xl text-left lg:w-10/12 flex items-center justify-between mb-6 lg:mb-16">
            <p class="text-2xl lg:leading-[48px] font-sans font-semibold block px-6 lg:px-0">Timeline</p>
        </div>

        <div class="w-full">
            <div class="mt-8 timeline-container">
                <div class="flex flex-col md:grid lg:grid-cols-2 gap-0 lg:gap-16">
                    <!-- Left Column - Content -->
                    <div class="timeline-content">
                        <?php $i = 0; ?>
                        <?php while (have_rows('decades')) : the_row(); ?>
                            <?php
                            $i++;
                            $image = get_sub_field('image');
                            $decade_title = get_sub_field('decade_title');
                            $decade_intro = get_sub_field('decade_intro');
                            ?>
                            <div class="timeline-section" data-decade="<?php echo $i - 1; ?>">
                                <div class="mb-6 lg:mb-56">

                                    <?php if (!empty($image)) : ?>
                                        <img src="<?= esc_url($image['url']); ?>"
                                            alt="<?= esc_attr($image['alt']); ?>"
                                            class="w-full h-full object-cover mb-6 block lg:hidden max-h-[350px]" />
                                    <?php endif; ?>
                                    <?php if ($decade_title) : ?>
                                        <p class="text-5xl lg:text-7xl font-semibold font-sans pb-6 lg:pb-10 px-6 lg:px-0"><?php echo $decade_title; ?></p>
                                    <?php endif; ?>

                                    <?php if ($decade_intro) : ?>
                                        <div class="text-lg text-black font-sans pb-6 lg:pb-10 px-6 lg:px-0"><?php echo $decade_intro; ?></div>
                                    <?php endif; ?>


                                    <?php
                                    if (have_rows('items')):
                                        while (have_rows('items')) : the_row();
                                            $preheading = get_sub_field('preheading');
                                            $year = get_sub_field('year');
                                            $text = get_sub_field('text');
                                    ?>
                                            <div class="mb-10 timeline-item px-6 lg:px-0">
                                                <?php if ($preheading): ?>
                                                    <div class="text-sm uppercase tracking-wider font-semibold text-gray-600 mb-3">
                                                        <?= $preheading; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($year) : ?>
                                                    <p class="text-2xl lg:text-3xl font-sans font-semibold mb-3">
                                                        <?php echo $year; ?>
                                                    </p>
                                                <?php endif; ?>

                                                <?php if ($text) : ?>
                                                    <div class="text-base text-black font-sans font-normal">
                                                        <?php echo $text; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                    <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                    <!-- Right Column - Fixed Images via JavaScript -->
                    <div class="!hidden lg:!block timeline-images-column overflow-hidden h-fit">
                        <!-- <div class="w-full h-96 relative"> -->
                        <div class="w-full h-full relative -right-8">
                            <?php $i = 0; ?>
                            <?php while (have_rows('decades')) : the_row(); ?>
                                <?php
                                $i++;
                                $image = get_sub_field('image');
                                ?>
                                <div
                                    class="timeline-image-wrapper absolute inset-0 opacity-0 transition-opacity duration-500"
                                    data-decade="<?php echo $i - 1; ?>">
                                    <?php if (!empty($image)) : ?>
                                        <img src="<?= esc_url($image['url']); ?>"
                                            alt="<?= esc_attr($image['alt']); ?>"
                                            class="w-full h-full object-cover" />
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>