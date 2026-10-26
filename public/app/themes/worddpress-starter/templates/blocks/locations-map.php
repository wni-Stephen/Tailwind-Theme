<?php
$args = array(
    'post_type' => 'locations',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

?>

<?php
$query = new WP_Query($args);
if ($query->have_posts()) : ?>
    <?php while ($query->have_posts()): $query->the_post(); ?>
        <div class="office-marker hidden" data-lat="<?php echo get_field('latitude', $post->ID); ?>" data-lng="<?php echo get_field('longitude', $post->ID); ?>" data-name="<?php echo the_title(); ?>" data-address="<?php echo get_field('address', $post->ID); ?>" data-contact="<?php echo get_field('phone_number', $post->ID); ?>"><?php echo the_title(); ?></div>
    <?php endwhile; ?>
<?php endif; ?>

<section class="relative my-8 md:my-16 fifty-fifty">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl relative text-left mx-auto">
        <div class="grid md:grid-cols-2 md:gap-8 rounded-[32px] fifty-fity-content bg-black text-deepgreen">
            <div class="flex items-start flex-col justify-center py-16 px-8 lg:p-16 order-2 md:order-1">
                <div id="map-location-name" class="lg:text-2xl w-full text-left font-sora font-medium mb-6 text-deepgreen">Coleraine</div>
                <div id="map-location-address" class="lg:text-2xl w-full text-left font-sora font-medium mb-6 text-deepgreen">
                    <p>56 Craigmore Road<br>
                        Ringsend, Garvagh<br>
                        Co. Derry BT51 5HF</p>
                </div>
            </div>
            <div id="map" class="font-sora text-white relative rounded-[32px] order-1 md:order-2 z-0"></div>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>