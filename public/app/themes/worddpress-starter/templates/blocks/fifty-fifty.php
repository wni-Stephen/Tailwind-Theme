<?php
$heading = get_sub_field('heading');
$heading_size = get_sub_field('heading_size');
$heading_colour = "text-" . get_sub_field('heading_colour');
$subheading = get_sub_field('subheading');
$image = get_sub_field('image');
$image_position = get_sub_field('image_position');
$logo = get_sub_field('logo');
$bg = 'bg-' . get_sub_field('background_colour');

$padding = "";
$text_colour = $heading_colour;
$arrow_colour = "text-red";

$link_style = get_sub_field('link_style');
$button_text = "text-black";
$button_text_hover = "hover:text-red";

$overall_heading = get_sub_field('overall_heading');

if ($bg) :
    switch ($bg) {
        case "bg-white":
            $arrow_colour = "text-black";
            $padding = "px-10";
            $text_colour = "text-black";
            $padding = "px-0";
            break;
        case "bg-lightgrey":
            $arrow_colour = "text-black";
            $padding = "px-10";
            $text_colour = "text-black";
            $bg = "bg-lightestgrey";
            break;
        case "bg-black":
            $heading_colour = "text-white";
            $arrow_colour = "text-white";
            $padding = "px-10";
            $text_colour = "text-white";
            $button_text = "text-white";
            $button_text_hover = "hover:text-red";
            break;
        case "bg-red":
            $heading_colour = "text-white";
            $arrow_colour = "text-white";
            $button_text = "text-white";
            $button_text_hover = "hover:text-white";
            $padding = "px-10";
            $text_colour = "text-white";
            break;
    }
endif;
?>

<section class="relative my-8 md:my-16 fifty-fifty <?php echo $text_colour;?>">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl relative text-left mx-auto">
        <div class="grid md:grid-cols-2 md:gap-8 fifty-fity-content <?php echo $bg; ?>">
            <div class="flex items-start flex-col justify-center py-16 <?php if ($image_position == "Left"): ?>md:order-last<?php endif; ?> <?php echo $padding;?>">
                <?php if (!empty($logo)): ?>
                    <div data-aos-delay="0.1" class="flex items-stretch w-full justify-start mb-6 lg:mb-10" data-aos="fade-up">
                        <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="object-contain w-[60px] h-[60px]" />
                    </div>
                <?php endif; ?>
                <?php if ($heading) : ?>
                    <div class="text-left">
                        <?php echo '<' . $heading_size ?> class="text-2xl lg:text-4xl lg:leading-[45px] font-sans font-semibold mb-6 block lg:pr-10 <?php echo $text_colour;?>">
                        <?php echo $heading; ?>
                        <?php echo '</' . $heading_size . '>' ?>
                    </div>
                <?php endif; ?>

                <?php if ($subheading) : ?>
                    <div class="text-left" data-aos="fade">
                        <p class="text-2xl font-sans font-medium mb-6 block <?php echo $text_colour;?>"><?php echo $subheading; ?></p>
                    </div>
                <?php endif; ?>

                <div class="w-full">
                    <div data-aos="fade">
                        <div class="text-lg max-w-none font-normal text-left font-sans show-spaces <?php echo $text_colour;?>">
                            <?= get_sub_field('text'); ?>
                        </div>
                        <?php
                        if (have_rows('links')): $i = 0; ?>
                            <div class="flex gap-6 justify-start flex-col lg:flex-row lg:gap-8 mt-8">
                                <?php while (have_rows('links')) : the_row();
                                    $i++; ?>
                                    <?php if (get_sub_field('link')): ?>
                                        <?php
                                            $link = get_sub_field('link');
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" class="group flex items-center gap-4 font-semibold text-base duration-200 ease-in-out transition-colors <?php echo $button_text;?> <?php echo $button_text_hover;?>"><?php echo esc_html($link_title); ?><span>
                                                    <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <div class="order-first md:order-last<?php if ($image_position == "Left"): ?>order-first<?php endif; ?>">
                <?php if (!empty($image)) : ?>
                    <picture class="relative h-full flex w-full aspect-auto max-h-full" data-aos="fade" data-aos-delay="100">
                        <img class="object-cover object-center w-full h-full" src="<?= esc_url($image['url']); ?>" height="<?= esc_attr($image['height']); ?>" width="<?= esc_attr($image['width']); ?>" alt="<?= esc_attr($image['alt']); ?>" />
                    </picture>
                <?php endif; ?>
            </div>
        </div>
</section>