<?php
$slides = get_sub_field('slides');
$count =  $slides ? count($slides) : FALSE;
$slides_full_height = get_sub_field('slides_full_height');
$height = "h-screen";

if(!$slides_full_height) {
    $height = "h-screen lg:h-[600px]";
}
?>

<section class="hero relative <?php echo $height;?>">
    <?php if ($count > 1): ?>
        <hero-slider pagination>
    <?php endif; ?>
    
        <?php if (have_rows('slides')): ?>
            <?php while (have_rows('slides')) : the_row(); ?>
                <div class="embla_slide w-full flex flex-[0_0_100%] relative <?php echo $height;?>">
                    
                    <?php
                    $media_type = get_sub_field('media_type');
                    $image = get_sub_field('image');
                    $heading = get_sub_field('heading');
                    ?>

                    <?php if ($media_type == "Image" && !empty($image)): ?>
                        <img class="<?php echo $height;?> object-cover w-full rounded-none" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php else: ?>
                        <?php $file = get_sub_field('mp4'); ?>
                        <video class="<?php echo $height;?> w-full object-cover" autoplay muted loop>
                            <source src="<?php echo esc_url($file['url']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif; ?>

                    <!-- Gradient overlay -->
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-t from-[rgba(0,0,0,0.8)] to-[rgba(0,0,0,0)] z-10"></div>

                    <!-- Text content -->
                    <div class="absolute bottom-32 lg:bottom-24 px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto z-20">
                        <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
                            <?php if ($count <= 1) : ?>
                                <h1 class="text-white uppercase text-5xl font-sans font-bold max-w-[400px] md:max-w-full lg:max-w-[620px] leading-tighter tracking-wide"><?php echo $heading; ?></h1>
                            <?php else : ?>
                                <p class="text-white uppercase text-2xl lg:text-5xl font-sans font-bold max-w-[400px] lg:max-w-[620px] leading-normal tracking-wide pr-10"><?php echo $heading; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    
    <?php if ($count > 1): ?>
        </hero-slider>
    <?php endif; ?>
</section>