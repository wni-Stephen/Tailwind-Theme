<?php
$heading = get_sub_field('heading');
$description = get_sub_field('description');
$projects = get_sub_field('projects');
$count =  $projects ? count($projects) : FALSE;
?>

<?php if ($count) : ?>
    <section class="relative py-8 lg:py-16 bg-white font-sans featured-projects">
        <div class="absolute w-1/3 h-full bg-white z-10 left-0 top-0 bottom-0 hidden lg:block"></div>
        <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
            <div class="flex flex-row items-center justify-end">
                <a href="/projects" title="View all projects" class="text-black underline text-base hover:text-red font-semibold transition-colors duration-200 ease-in-out hidden lg:block">View all projects</a>
            </div>
            <div class="grid lg:grid-cols-3 gap-6 lg:gap-20 lg:mt-10 relative">
                <div class="absolute w-1/3 h-full bg-white z-10 left-0 top-0 bottom-0 hidden lg:block"></div>
                <div class="lg:col-span-1 md:border-l md:border-l-[#D4D2CC] md:pl-6 lg:pl-12 relative z-20">
                    <div class="flex flex-col justify-center items-start h-full gap-6">
                        <?php if ($heading) : ?>
                            <h3 class="font-extrabold text-xl  w-10 uppercase"><?php echo $heading; ?></h3>
                        <?php endif; ?>
                        <?php if ($description) : ?>
                            <div class="text-black text-lg">
                                <?php echo wp_kses_post($description); ?>
                            </div>
                        <?php endif; ?>
                        <a href="/projects" class="group flex items-center gap-6 font-semibold text-base duration-200 ease-in-out transition-all hover:underline hover:underline-offset-8">Find out more <span>
                                <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <project-slider pagination class="mt-10 lg:mt-0">
                        <?php $i = 0; ?>
                        <?php foreach ($projects as $post): ?>
                            <?php $i++;
                            setup_postdata($post); ?>
                             <?php get_template_part( 'templates/partials/post-card-project-slide'); ?>
                        <?php endforeach; ?>
                    </project-slider>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>