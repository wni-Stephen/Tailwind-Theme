<?php
$args = array(
    'post_type' => 'locations',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

$serviceArgs = array(
    'post_type' => 'services',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

$i = 0;
?>

<section class="relative my-8 md:my-16 pb-16 locations bg-transparent">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
        <?php
        $service_query = new WP_Query($serviceArgs);
        if ($service_query->have_posts()) : ?>
            <div class="flex flex-row flex-wrap gap-2 md:gap-4 my-10">
                <button aria-label="View All" title="View all" class="location-block-filter rounded-[26px] bg-black text-white hover:bg-black hover:text-white px-4 py-4" data-slug="view-all">View All</button>
                <?php while ($service_query->have_posts()): $service_query->the_post(); ?>
                    <?php $slug = get_post_field('post_name', get_post()); ?>
                    <button class="location-block-filter rounded-[26px] hover:bg-black hover:text-white px-4 py-4" aria-label="<?php echo get_the_title() ?>" title="<?php echo get_the_title() ?>" data-slug="<?= $slug; ?>" value="<?php echo get_the_ID(); ?>"><?php echo get_the_title() ?></button>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php
        $query = new WP_Query($args);
        if ($query->have_posts()) : ?>
            <div id="locations-list">
                <div id="spinner" class="hidden mt-4">
                    <div class="w-12 h-12 border-4 border-deepgreen border-t-transparent rounded-full animate-spin"></div>
                </div>
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <?php $featured_posts = get_field('services'); ?>
                    <?php $safe_title="";
                    
                    
                    ?>
                    <div class="location-block rounded-[20px] bg-lightgreen text-deepgreen mb-10 py-12 px-10 hover:bg-black duration-500 ease-in-out <?php if ($featured_posts) : ?> <?php foreach ($featured_posts as $featured_post): ?>
                        <?php $service_slug = get_post_field('post_name', $featured_post); ?>
                            <?php $title = get_the_title($featured_post->ID); ?><?php echo esc_html($service_slug); ?> <?php endforeach; ?><?php endif; ?>
                            
                              <?php if (get_field('friendly_name')) : ?>
                                    <?php $safe_title = get_field('friendly_name'); ?>
                                <?php else : ?>
                                    <?php $safe_title = get_the_title() ?>
                                <?php endif; ?>

                                <?php $safe_title = strtolower($safe_title);
                                    $safe_title = strtolower(str_replace(' ', '-', $safe_title));
                                    $safe_title = strtolower(str_replace('+', '-', $safe_title));
                                    $safe_title = strtolower(str_replace('&', '-', $safe_title));
                                    $safe_title = strtolower(str_replace('/', '-', $safe_title));
                                    $safe_title = strtolower(str_replace('<br>', '-', $safe_title));
                                    $safe_title = strtolower(str_replace('---', '-', $safe_title));
                                    $safe_title = strtolower(str_replace('--', '-', $safe_title));                             
                                ?>
                            
                            
                            
                            " id="<?php echo $safe_title;?>">
                        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-8 lg:grid-cols-4">
                            <p class="w-full xl:max-w-[80%] text-left font-sora lg:text-3xl font-medium mb-6 text-wrap pr-10">
                                <?php if (get_field('friendly_name')) : ?>
                                    <?php echo the_field('friendly_name'); ?>
                                <?php else : ?>
                                    <?php echo get_the_title() ?>
                                <?php endif; ?>
                            </p>
                            <div class="border-t pt-10 border-midgreen md:border-none md:pt-0">
                                <p class="font-sora font-medium text-lg mb-6">Contact Us</p>
                                <div class="flex flex-col gap-4 md:gap-6 mb-10 md:mb-0">
                                    <?php if (get_field('address')) : ?>
                                        <div class="text-base max-w-none font-normal text-left font-manrope"><?php echo the_field('address'); ?></div>
                                    <?php endif; ?>
                                    <?php if (get_field('phone_number')) : ?>
                                        <a href="tel:+44<?php echo the_field('phone_number'); ?>" title="Call us" class="text-base hover:underline hover:underline-offset-8 inline-flex duration-300 font-medium font-sora gap-2 items-center justify-start dark:text-white">
                                            <span class="font-medium font-sora"><?php echo the_field('phone_number'); ?></span>
                                            <arrow class="w-4 h-5 stroke-2"></arrow>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (get_field('email_address')) : ?>
                                        <a href="mailto:<?php echo the_field('email_address'); ?>" title="Email us" class="text-base hover:underline hover:underline-offset-8 inline-flex duration-300 font-medium font-sora gap-2 items-center justify-start dark:text-white">
                                            <span class="font-medium font-sora"><?php echo the_field('email_address'); ?></span>
                                            <arrow class="w-4 h-5 stroke-2"></arrow>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="border-t pt-10 border-midgreen md:border-none md:pt-0">
                                <p class="font-sora font-medium text-lg mb-6">Services</p>
                                <?php if ($featured_posts) : ?>
                                    <div class="flex flex-col gap-2 mb-10 md:mb-0">
                                        <?php foreach ($featured_posts as $featured_post): ?>
                                            <?php $title = get_the_title($featured_post->ID); ?>
                                            <p class="font-manrope font-normal"><?php echo esc_html($title); ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if (get_field('get_directions_link')) : ?>
                                <div class="border-t pt-10 border-midgreen md:border-none md:pt-0">
                                    <p class="font-sora font-medium text-lg mb-6">Quick Links</p>
                                    <div class="flex flex-col gap-4 md:gap-6 mb-10 md:mb-0">
                                        <?php
                                        $get_directions_link = get_field('get_directions_link');
                                        $link_url = $get_directions_link['url'];
                                        $link_title = $get_directions_link['title'];
                                        $link_target = $get_directions_link['target'] ? $get_directions_link['target'] : '_self';
                                        ?>
                                        <a href="<?php echo esc_url($link_url); ?>" target="_blank" title="Get Directions to <?php echo get_the_title(); ?> location" class="text-base hover:underline hover:underline-offset-8 inline-flex duration-300 font-medium font-sora gap-2 items-center justify-start dark:text-white">
                                            <span class="font-medium font-sora">Get Directions</span>
                                            <arrow class="w-4 h-5 stroke-2"></arrow>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php wp_reset_postdata();
        endif; ?>
    </div>
</section>