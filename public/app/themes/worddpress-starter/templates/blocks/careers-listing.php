<?php $heading = get_sub_field('heading');


$accordion_heading = "bg-white hover:bg-black";
$accordion_content = "bg-lightneutral";
$text_colour = "text-black";

if ($bg) :
    switch ($bg) {
        case "bg-deepgreen":
            $accordion_heading = "bg-white text-black hover:bg-black hover:text-white";
            $accordion_content = "bg-lightneutral";
            $text_colour = "text-white";
            break;
        case "bg-white":
            $accordion_heading = "bg-lightgreen text-black hover:bg-black hover:text-white";
            $accordion_content = "bg-lightgreen";
            $text_colour = "text-black";
            break;
    }
endif; ?>

<?php
$args = array(
    'post_type'      => 'career',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_key'       => 'closing_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => 'closing_date',
            'value'   => date('Y-m-d H:i:s'), // Compare with current date & time
            'compare' => '>=',
            'type'    => 'DATETIME'
        )
    )
);

$query = new WP_Query($args); ?>

<section class="relative bg-white text-black pb-10">
    <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
        <div data-aos="fade">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
                <?php
                if ($query->have_posts()) {
                    $i=0;
                    while ($query->have_posts()) {
                        $i++;
                        $query->the_post();
                        ?>
                      
                    <?php get_template_part('templates/partials/post-card-career'); ?>
                    <?php
                    }
                } else {
                    echo '<p class="font-sans font-medium text-black text-3xl my-2">No positions are available at the moment, check back again soon. </p>';
                }
                wp_reset_postdata();
                    ?>
            </div>
        </div>
    </div>
</section>