<?php
$image = get_sub_field('image');
?>

<section class="hero h-full">
<?php if( !empty( $image ) ): ?>
    <img class="h-full object-cover w-full max-h-[600px]" data-aos="" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
<?php endif; ?>
</section>
