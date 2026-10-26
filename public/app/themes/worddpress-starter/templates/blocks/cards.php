<?php
$background_colour = get_sub_field('background_colour'); 
$headline = get_sub_field('headline');
$carousel = get_sub_field('carousel');
$items = get_sub_field('items');
$count =  $items ? count($items) : FALSE;
$bg_styles= "";

switch ($background_colour) {
    case 'white':
        $bg_styles = 'bg-white text-black';
        break;
    case 'midgrey':
        $bg_styles = 'bg-midgrey text-black';
        break;
    case 'lightgrey':
        $bg_styles = 'bg-lightgrey text-black';
        break;

    }
?>


<section class="py-20 px-6 <?php echo $bg_styles; ?> <?php echo $carousel = 1 ? 'slider ' : '' ?>">
    <div class="w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
        <?php if ($headline) : ?>
            <p class="fluid-2xl font-normal mb-8 lg:max-w-[75%]">
                <?php echo $headline; ?>
            </p>
        <?php endif; ?>
        <?php if (get_sub_field('carousel')) : ?>
        <?php if( have_rows('items') ): ?>
            <news-slider pagination>
                <?php $i =0; ?>

                <?php  while( have_rows('items') ) : the_row(); ?>
                <?php $i++;
                    $card_bg = get_sub_field('card_background_colour');
                    $show_lagan_logo = get_sub_field('show_lagan_logo');
                    $image = get_sub_field('image');
                    $logo = get_sub_field('logo');
                    $year = get_sub_field('year');
                    $headline = get_sub_field('headline');
                    $text = get_sub_field('text');
                    $link = get_sub_field('link');

                    switch ($card_bg) {
                        case 'maroon':
                            $styles = 'bg-black text-white hover:bg-darkmaroon';
                            $button = 'bg-white text-black ';
                            break;
                        case 'darkmaroon':
                            $styles = 'bg-darkmaroon text-white hover:bg-black';
                            $button = 'bg-white text-black ';
                            break;
                        case 'darkgrey':
                            $styles = 'bg-darkgrey text-white hover:bg-black';
                            $button = 'bg-white text-black ';
                            break;
                        case 'midgrey':
                            $styles = 'bg-midgrey text-black hover:bg-darkgrey';
                            $button = 'bg-white text-black ';
                            break;
                        case 'lightgrey':
                            $styles = 'bg-lightgrey text-black hover:bg-midgrey';
                            $button = 'bg-white text-black ';
                            break;
                        case 'gold':
                            $styles = 'bg-gold text-white hover:bg-black';
                            $button = 'bg-white text-black ';
                            break;
                        case 'pink':
                            $styles = 'bg-pink text-white hover:bg-black';
                            $button = 'bg-white text-black ';
                            break;
                        case 'darkblue':
                            $styles = 'bg-darkblue text-white hover:bg-black';
                            $button = 'bg-white text-black ';
                            break;
                        case 'lightblue':
                            $styles = 'bg-lightblue text-white hover:bg-darkblue';
                            $button = 'bg-white text-black ';
                            break;
                        case 'black':
                            $styles = 'bg-black text-white hover:bg-darkmaroon';
                            $button = 'bg-white text-black ';
                            break;
                    }
                ?>
                <div class="embla__slide mx-4 flex flex-[0_0_100%] md:flex-[0_0_48%] xl:flex-[0_0_31.5%] group ">
                <div data-aos="fade-up" data-delay="<?= $i * 0.1 ?>" class="duration-300 group w-full <?php echo $styles; ?><?php if( !empty( $image ) ): ?> p-0 <?php else: ?> p-10 <?php endif; ?>">
                    <?php if( !empty( $image ) ): ?>
                        <img class="object-cover object-center w-full min-h-[250px] max-h-[250px]"  src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                    <?php if( !empty( $image ) ): ?>
                        <div class="p-10">
                    <?php else: ?>
                        <div class="p-0">
                    <?php endif; ?>
                    <div class="flex items-center gap-5">
                        <?php if($show_lagan_logo) : ?>
                            <logo-icon></logo-icon>
                        <?php endif; ?>
                        <?php if($logo) : ?>
                            <?php if( !empty( $logo ) ): ?>
                                <img class="object-contain object-center min-h-[75px] max-h-[75px]" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($year) : ?>
                        <p class="max-w-2xl mx-auto text-2xl lg:text-4xl mb-6 font-bold">
                        <?php echo $year; ?>
                    </p>
                    <?php endif;?>
                    <?php if ($headline) : ?>
                    <p class="max-w-2xl mx-auto text-lg lg:text-xl mb-6 font-semibold mt-10">
                        <?php echo $headline; ?>
                    </p>
                    <?php endif; ?>
                    <?php if ($text): ?>
                    <div class="font-sans max-w-2xl mx-auto text-base lg:text-lg mb-10 card-text">
                        <?php echo $text; ?>
                    </div>
                    <?php endif; ?>
                    <?php
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                    <a class="group flex justify-start items-center gap-5 font-sans font-semibold hover:underline hover:underline-offset-8 text-sm lg:text-lg"
                        href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?><span>
                            <?php if($card_bg == "Red"): ?>
                            <arrow-white></arrow-white>
                            <?php else : ?>
                            <arrow></arrow>
                            <?php endif; ?>
                        </span>
                    </a>
                    <?php endif; ?>
                </div>
                            </div>
                </div>
                <?php endwhile; ?>

            </news-slider>
        <?php endif; ?>


        <?php else : ?>

        <?php
        if (have_rows('items') ):
            if($count <= 2) : ?>
                <div class="grid md:grid-cols-2 gap-5 lg:mt-10">
            <?php elseif ($count == 4) :?>
                <div class="grid md:grid-cols-2 gap-5 lg:mt-10">
            <?php else: ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 lg:mt-10">
            <?php endif; ?>

                <?php $i=0; ?>
                <?php  while( have_rows('items') ) : the_row(); ?>
                <?php $i++;
                     $card_bg = get_sub_field('card_background_colour');
                     $show_lagan_logo = get_sub_field('show_lagan_logo');
                     $image = get_sub_field('image');
                     $logo = get_sub_field('logo');
                     $year = get_sub_field('year');
                     $headline = get_sub_field('headline');
                     $text = get_sub_field('text');
                     $link = get_sub_field('link');
 
                     switch ($card_bg) {
                         case 'maroon':
                             $styles = 'bg-black text-white hover:bg-darkmaroon';
                             $button = 'bg-white text-black ';
                             break;
                         case 'darkmaroon':
                             $styles = 'bg-darkmaroon text-white hover:bg-black';
                             $button = 'bg-white text-black ';
                             break;
                         case 'darkgrey':
                             $styles = 'bg-darkgrey text-white hover:bg-black';
                             $button = 'bg-white text-black ';
                             break;
                         case 'midgrey':
                             $styles = 'bg-midgrey text-black hover:bg-darkgrey';
                             $button = 'bg-white text-black ';
                             break;
                         case 'lightgrey':
                             $styles = 'bg-lightgrey text-black hover:bg-midgrey';
                             $button = 'bg-white text-black ';
                             break;
                         case 'gold':
                             $styles = 'bg-gold text-white hover:bg-black';
                             $button = 'bg-white text-black ';
                             break;
                         case 'pink':
                             $styles = 'bg-pink text-white hover:bg-black';
                             $button = 'bg-white text-black ';
                             break;
                         case 'darkblue':
                             $styles = 'bg-darkblue text-white hover:bg-black';
                             $button = 'bg-white text-black ';
                             break;
                         case 'lightblue':
                             $styles = 'bg-lightblue text-white hover:bg-darkblue';
                             $button = 'bg-white text-black ';
                             break;
                         case 'black':
                             $styles = 'bg-black text-white hover:bg-darkmaroon';
                             $button = 'bg-white text-black ';
                             break;
                     }
                ?>
                <div data-aos="fade-up" data-delay="<?= $i * 0.1 ?>" class="duration-300 group w-full <?php echo $styles; ?><?php if( !empty( $image ) ): ?> p-0 <?php else: ?> p-10 <?php endif; ?>">
                    <?php if( !empty( $image ) ): ?>
                        <img class="object-cover object-center w-full min-h-[250px] max-h-[250px]"  src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                    <?php if( !empty( $image ) ): ?>
                        <div class="p-10">
                    <?php else: ?>
                        <div class="p-0">
                    <?php endif; ?>
                    <div class="flex items-center gap-5">
                        <?php if($show_lagan_logo) : ?>
                            <logo-icon></logo-icon>
                        <?php endif; ?>
                        <?php if($logo) : ?>
                            <?php if( !empty( $logo ) ): ?>
                                <img class="object-contain object-center min-h-[75px] max-h-[75px]" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                            <?php endif; ?>
                        <?php endif; ?>
                        
                    </div>
                    <?php if ($year) : ?>
                    <p class="max-w-2xl mx-auto text-2xl lg:text-4xl mb-6 font-bold">
                        <?php echo $year; ?>
                    </p>
                    <?php endif;?>
                    <?php if ($headline) : ?>
                    <p class="max-w-2xl mx-auto text-lg lg:text-xl mb-6 font-semibold mt-10">
                        <?php echo $headline; ?>
                    </p>
                    <?php endif; ?>
                    <?php if ($text): ?>
                    <div class="font-sans max-w-2xl mx-auto text-base lg:text-lg mb-10 card-text">
                        <?php echo $text; ?>
                    </div>
                    <?php endif; ?>
                    <?php
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                    <a class="group flex justify-start items-center gap-5 font-sans font-semibold hover:underline hover:underline-offset-8 text-sm lg:text-lg"
                        href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?><span>
                            <?php if($card_bg == "Red"): ?>
                            <arrow-white></arrow-white>
                            <?php else : ?>
                            <arrow></arrow>
                            <?php endif; ?>
                        </span>
                    </a>
                    <?php endif; ?>
                </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php
            else :
            endif; ?>
            <?php endif; ?>
        </div>
</section>