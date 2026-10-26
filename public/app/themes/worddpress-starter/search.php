<!-- Pass through theme style to determine which logo is shown -->
<?php set_query_var('theme', 'bg-white light'); ?>
<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>

<section class="relative py-8 lg:py-12 text-block bg-transparent">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
    <div class="lg:max-w-screen-2xl text-left lg:w-10/12">
      <h1 class="fluid-3xl font-sora font-medium mb-6 lg:mb-10 lg:max-w-[90%] block dark:text-white text-deepgreen"><?php printf('Search results for: "%s"', get_search_query()); ?></h1>
    </div>
    <?php if (have_posts()) : $i = 0 ?>
      <div class="search-results grid grid-cols-1 gap-5">
        <?php while (have_posts()) : the_post();
          $i++; ?>
          <div class="search-result-item">
            <div class="resource-item">
              <a class="bg-[#EEFFEA] text-deepgreen font-sora font-medium text-lg p-8 lg:p-10 h-full group hover:bg-deepgreen hover:text-white duration-300 ease-in-out rounded-[20px] w-full flex items-center justify-between" href="<?php the_permalink(); ?>" title="View: <?php the_permalink(); ?>">
                <span class="text-base lg:text-lg"><?php the_title(); ?></span>
                <div class="flex items-center gap-6">
                  <span class="hidden md:block text-base">View</span>
                  <arrow></arrow>
                </div>
              </a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <?php
      the_posts_pagination();
      ?>
    <?php else : ?>
      <p class="text-lg text-black font-sans max-w-none font-normal lg:max-w-[80%] text-left font-sans dark:text-white text-deepgreen mb-10">No results found for: "<?php echo get_search_query(); ?>"</p>
    <?php endif; ?>
  </div>

  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left mt-20 block border-t border-lightgrey pt-20">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" id="search-input" class="w-full text-base bg-white border-lightgrey block px-6 py-3.5 border transition duration-100 ease-in-out focus:ring-2 focus:border-deepgreen focus:ring-deepgreen focus:ring-opacity-25 focus:outline-0 disabled:opacity-50 disabled:cursor-not-allowed text-inherit" placeholder="Can't find what you're looking for? Try again..." value="" name="s" />
      <button type="submit" aria-label="Search" title="Search" class="text-base border-2 border-transparent font-normal text-center px-8 py-3 hover:text-deepgreen items-center transition-colors font-sora mt-10 bg-deepgreen text-white hover:bg-black rounded-[30px] flex gap-6 justify-start"><span>Search</span>
        <arrow class="w-10 h-5 stroke-2 dark:text-black"></arrow>
      </button>
    </form>
  </div>
</section>
<?php
get_footer();
?>