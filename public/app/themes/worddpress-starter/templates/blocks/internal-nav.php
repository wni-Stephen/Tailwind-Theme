<section class="relative my-8 md:my-16 internal-nav bg-transparent">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
        <div class="bg-lightgrey flex rounded-[32px] w-full internal-nav-items flex-wrap font-sora relative">
            <ul class="flex flex-wrap">
                <?php
                if (wp_get_post_parent_id(get_the_ID()) == 0) {
                ?>
                    <li class="current_page_item"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></li>
                <?php
                    wp_list_pages(array(
                        'child_of' => $post->ID,
                        'title_li'     => __(''),
                        'sort_column'  => 'menu_order, post_title',
                    ));
                } else {
                ?>
                    <li><a href="<?php the_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></li>
                <?php
                    wp_list_pages(array(
                        'child_of' => $post->post_parent,
                        'title_li'     => __(''),
                        'sort_column'  => 'menu_order, post_title',
                    ));
                }
                ?>
            </ul>
        </div>
    </div>
</section>