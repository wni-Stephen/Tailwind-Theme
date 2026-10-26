<!-- Pass through theme style to determine which logo is shown -->
<?php set_query_var('theme', 'bg-white light'); ?>
<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>

<section class="relative py-8 lg:py-12 text-block bg-transparent">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
    <div class="lg:max-w-screen-2xl text-left lg:w-10/12">
      <h1 class="fluid-3xl font-sans font-medium mb-6 lg:max-w-[90%] block dark:text-white text-deepgreen">Search</h1>
    </div>
    <div class="text-lg text-black font-sans max-w-none font-normal lg:max-w-[80%] text-left font-sans dark:text-white text-deepgreen mb-10">
      Use our search feature to quickly find specific content related to our waste management services, accreditations, community involvement, and more. Whether you're looking for case studies, sustainability reports, or specific service details, our search tool will help you navigate through all our available resources. Enter your query in the search bar to explore relevant information with ease.
    </div>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" id="search-input" class="w-full text-base bg-white border-lightgrey block px-6 py-3.5 border transition duration-100 ease-in-out focus:ring-2 focus:border-deepgreen focus:ring-deepgreen focus:ring-opacity-25 focus:outline-0 disabled:opacity-50 disabled:cursor-not-allowed text-inherit" placeholder="Search…" value="<?php echo get_search_query(); ?>" name="s" />
      <button aria-label="Submit" title="Submit" type="submit" class="text-base border-2 border-transparent font-normal text-center px-8 py-3 hover:text-deepgreen items-center transition-colors font-sans mt-10 bg-deepgreen text-white hover:bg-black rounded-[30px] flex gap-6 justify-start"><span>Search</span>
        <arrow class="w-10 h-5 stroke-2 dark:text-black"></arrow>
      </button>
    </form>
    <div id="search-results"></div>
  </div>
</section>

<?php
get_footer();
?>