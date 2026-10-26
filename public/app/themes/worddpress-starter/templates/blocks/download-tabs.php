<section class="relative my-8 md:my-16 pb-16 locations bg-transparent">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
        <div class="flex flex-row flex-wrap gap-2 md:gap-4 my-10">
            <button class="download-tab-filter font-sora font-medium rounded-[26px] bg-black text-white hover:bg-black hover:text-white px-4 py-4" data-slug="view-all">View All</button>
            <?php
            if (have_rows('tabs')):
                while (have_rows('tabs')) : the_row();
                    $heading = get_sub_field('heading');
                    $clean_heading = strtolower(str_replace(' ', '-', $heading));
                    $clean_heading = strtolower(str_replace('+', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('&', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('/', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('---', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('--', '-', $clean_heading));
            ?>
                    <?php if ($heading) : ?>
                        <button class="download-tab-filter rounded-[26px] hover:bg-black hover:text-white px-4 py-4" data-slug="<?= $clean_heading; ?>"><?php echo $heading; ?></button>
                    <?php endif; ?>
            <?php endwhile;
            endif;
            ?>

        </div>

        <div class="download-tabs">
            <div id="spinner" class="hidden mt-4">
                <div class="w-12 h-12 border-4 border-deepgreen border-t-transparent rounded-full animate-spin"></div>
            </div>
            <?php
            if (have_rows('tabs')):
                while (have_rows('tabs')) : the_row();
                    $heading = get_sub_field('heading');
                    $clean_heading = strtolower(str_replace(' ', '-', $heading));
                    $clean_heading = strtolower(str_replace('+', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('&', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('/', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('---', '-', $clean_heading));
                    $clean_heading = strtolower(str_replace('--', '-', $clean_heading));
            ?>
                    <div class="download-tab rounded-[20px] bg-white text-deepgreen mb-5 h-full duration-500 ease-in-out grid gap-5 <?php echo esc_html($clean_heading); ?>">
                        <?php
                        if (have_rows('downloads')):
                            while (have_rows('downloads')) : the_row();
                                $file = get_sub_field('file');
                                if ($file): ?>
                                    <div class="resource-item">
                                        <a class="bg-[#EEFFEA] text-deepgreen font-sora font-medium text-lg p-8 lg:p-10 h-full group hover:bg-deepgreen hover:text-white duration-300 ease-in-out rounded-[20px] w-full flex items-center justify-between" href="<?php echo $file['url']; ?>" target="_blank" title="Download file: <?php echo the_sub_field('name'); ?> (opens in new tab)">
                                            <span class="text-base lg:text-lg"><?php echo the_sub_field('name'); ?></span>
                                            <div class="flex items-center gap-6">
                                                <span class="hidden md:block text-base">Download PDF</span>
                                                <download-arrow></download-arrow>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                        <?php endwhile;
                        endif;?>
                    </div>
            <?php endwhile;
            endif;
            ?>
        </div>
    </div>
</section>