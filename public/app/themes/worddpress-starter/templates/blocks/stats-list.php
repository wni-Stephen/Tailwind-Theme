<?php
$heading = get_sub_field('heading');
$indent = get_sub_field('indent');
$items = get_sub_field('items');
$total =  $items ? count($items) : FALSE;
$link = get_sub_field('link');
?>

<section class="relative text-white bg-red stats-list overflow-hidden">
    <div class="">
        <div class="border-b border-b-[#FFFFFF4D] py-8">
            <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
                <div class="flex flex-col md:flex-row justify-between gap-6 items-start md:items-center">
                    <?php if ($heading) : ?>
                        <div class="">
                            <p class="text-2xl font-sans font-semibold uppercase text-white"><?php echo $heading; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                     <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="group flex items-center gap-6 font-semibold text-base hover:underline hover:underline-offset-8 duration-200 ease-in-out transition-colors"><?php echo esc_html($link_title); ?><span>
                                <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl pb-12 lg:pb-0">
        <div class="block relative">
            <?php
           if ($total) : 
            // Default grid columns
            $gridCols = "grid-cols-1 md:grid-cols-2 lg:grid-cols-3";
       
            // Adjust grid columns based on total items
            if ($total === 1) {
                $gridCols = "grid-cols-1";
            } elseif ($total === 2) {
                $gridCols = "grid-cols-2";
            } elseif ($total === 3) {
                $gridCols = "grid-cols-1 md:grid-cols-2 lg:grid-cols-3";
            } elseif ($total === 4) {
                $gridCols = "grod-cols-1 md:grid-cols-2"; // 2x2 grid
            } elseif ($total === 5) {
                $gridCols = "grod-cols-1 md:grid-cols-2 lg:grid-cols-3"; // first row 3, second row 2
            } elseif ($total === 6) {
                $gridCols = "grid-cols-1 md:grid-cols-2 lg:grid-cols-3"; // 2 rows of 3
            }
        ?>
            <div class="grid <?php echo $gridCols; ?>">
                <?php while (have_rows('items')) : the_row(); ?>
                    <span class="flex flex-col h-full pb-8 py-12 lg:py-16 px-20 min-h-[200px] lg:min-h-[400px] justify-between border-x border-x-[#FFFFFF4D] border-b border-b-[#FFFFFF4D] hover:bg-[linear-gradient(181deg,rgba(245,42,46,0.6)_31.88%,rgba(133,22,25,0.6)_215.16%)] transition-colors duration-200 ease-in-out"
                        data-aos="fade-up"
                        data-delay="<?= $i * 0.2 ?>">
                        <?php 
                        $icon = get_sub_field('icon');
                        ?>
                        <div>
                            <?php if (!empty($icon)): ?>
                                <div class="h-[87px] w-[87px] mb-16 lg:mb-32">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="object-cover w-full" />
                                </div>
                            <?php endif; ?>
                            <lazy-component>
                                <animate-integer class="text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white font-sans duration-300" 
                                    suffix="<?= get_sub_field('suffix'); ?>" 
                                    prefix="<?= get_sub_field('prefix'); ?>" 
                                    :value="<?= get_sub_field('stat'); ?>">
                                </animate-integer>
                            </lazy-component>
                            <div class="text-white font-normal font-sans text-lg mt-4"><?= get_sub_field('text'); ?></div>
                        </div>
                    </span>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>