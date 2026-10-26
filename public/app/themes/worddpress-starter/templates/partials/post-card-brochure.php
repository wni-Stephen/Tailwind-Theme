<?php $brochure_link = get_field( 'brochure_link', $featured_post->ID );?>

<div class="embla__slide relative group mx-4 flex flex-[0_0_100%] md:flex-[0_0_48%] lg:flex-[0_0_75%] h-[400px]">
    <div data-aos="fade-up" class="w-full">
        <a href="<?php echo $brochure_link['url']; ?>" target="_blank" download class="w-full flex flex-col group bg-black hover:shadow-lg transition-all duration-500">
            <div class="flex-shrink-0 relative overflow-hidden">
                <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-t from-black/100 via-black/0"></div>
                <?php $image = wp_get_attachment_url(get_post_thumbnail_id(), 'medium'); ?>
                <picture class="w-full flex lg:aspect-[4/5] h-[400px]">
                    <img class="transition-all duration-500 object-cover object-center w-full group-hover:h-full" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
                    <div class="absolute bottom-auto top-0 right-0 w-20 h-20 bg-black flex items-center justify-center transition-all duration-500 ease-in-out lg:group-hover:w-full lg:group-hover:h-full" title="Download <?php the_title(); ?> Brochure">
                    </div>
                    <div class="absolute lg:top-0 right-0 w-20 h-20 flex items-center justify-center transition-all duration-500 ease-in-out lg:group-hover:w-full lg:group-hover:h-full" title="Download <?php the_title(); ?> Brochure">
                        <arrow class="text-white absolute top-7 right-7 group-hover:rotate-[135deg] transition-transform duration-200"></arrow>
                    </div>

                <div class="transition-all duration-500 absolute bottom-0 left-0 right-0 text-white group-hover:text-white flex flex-col p-6 xl:p-8 lg:h-[130px] xl:h-[100px] py-6">
                    <div class="relative flex flex-col h-full items-start justify-center">
                        <p class="text-base lg:text-lg text-white font-sans group group-hover:text-white transition-all duration-500">
                            <?php the_title() ?>
                        </p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>