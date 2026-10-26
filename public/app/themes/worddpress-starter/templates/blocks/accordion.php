<?php $heading = get_sub_field('heading');

$accordion_heading = "bg-[#F5F5F5] hover:bg-midgrey";
$accordion_content = "bg-[#F5F5F5]";
?>

<section class="relative py-8 text-block text-black">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
        <?php if ($heading) : ?>
            <div class="lg:max-w-screen-2xl text-left lg:w-10/12">
                <p class="text-2xl lg:text-4xl lg:leading-[55px] font-sans font-semibold mb-6 block"><?php echo $heading; ?></p>
            </div>
        <?php endif; ?>
    </div>
    <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
        <div>
            <div class="text-lg text-black max-w-none font-normal lg:max-w-[80%] text-left font-sans">
                <?= get_sub_field('text'); ?>
            </div>
            <div class="accordion-container mt-10">
                <?php
                if (have_rows('items')):
                    $i = 0;
                    while (have_rows('items')) : the_row();
                        $i++;
                        if (get_sub_field('heading')) : ?>

                            <button aria-label="Toggle Open/Close" data-aos="fade-up" data-aos-delay="<?php $i * 100; ?>" class="accordion <?= $accordion_heading; ?> w-full duration-200 ease-in-out transition-all font-sans py-6 px-8 text-black font-normal text-left flex flex-row justify-between items-center text-lg mb-6 border-l-8 border-l-red">
                                <span class="font-semibold"><?= the_sub_field('heading'); ?></span>
                                <span><down-arrow></down-arrow></span>
                            </button>
                        <?php endif; ?>

                        <div class="panel hidden <?= $accordion_content; ?> py-8 px-10 font-sans text-lg text-black mb-6">
                            <?php if (get_sub_field('text')) : ?>
                                <?= the_sub_field('text'); ?>
                            <?php endif; ?>
                            <?php
                            if (get_sub_field('lists')) {
                                $lists_count = count(get_sub_field('lists'));
                                $list_styles = "md:grid md:grid-cols-2 md:gap-16";
                            }
                            if (have_rows('lists')) : ?>
                                
                                <div class="block mb-6 md:mb-0 mt-10 <?php if($lists_count > 1): echo 'md:grid md:grid-cols-2 md:gap-16'; endif;?>">
                                    <?php while (have_rows('lists')) : the_row(); ?>
                                        <?php $list_icon = get_sub_field('list_icon'); ?>
                                        <div class="block mb-6">
                                            <?php if (get_sub_field('heading')) : ?>
                                                <p class="font-sans font-semibold text-xl mb-6 md:mb-9"><?= the_sub_field('heading'); ?></p>
                                            <?php endif; ?>
                                            <?php
                                            if (have_rows('list_items')): ?>
                                                <?php while (have_rows('list_items')) : the_row(); ?>
                                                    <?php if (get_sub_field('list_item')) : ?>
                                                        <div class="flex justify-start gap-6 mb-2 lg:mb-4 text-base">
                                                            <?php if ($list_icon): ?>
                                                                <div class="size-7">
                                                                    <?php if ($list_icon == "tick") : ?>
                                                                        <tick></tick>
                                                                    <?php elseif ($list_icon == "x") : ?>
                                                                        <x></x>
                                                                    <?php elseif ($list_icon == "award") : ?>
                                                                        <award></award>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <p class="font-sans mb-2"><?= the_sub_field('list_item'); ?></p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (get_sub_field('list_note')) : ?>
                                                <div class="font-sans text-sm font-medium mt-6 lg:mt-10"><?= the_sub_field('list_note'); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>