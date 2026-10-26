<?php

/**
 *Display block file name in dev mode
 */
get_template_part('templates/dev/block', 'info', [
  'type' => 'template',
  'file' => basename(__FILE__)
]);

// Get all solution terms
$solutions = get_terms(array(
  'taxonomy' => 'solution',
  'hide_empty' => false,
));

$current_solution = get_query_var('solution');

?>

<section class="relative bg-white my-8">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="lg:max-w-screen-2xl flex flex-col md:flex-row justify-between items-start md:items-center">
      <h1 class="text-xl lg:text-3xl font-bold font-sans uppercase text-black">
        <?php if (is_post_type_archive()) {
          post_type_archive_title();
        } elseif (is_category()) {
          single_cat_title();
        } elseif (is_tax()) {
          $queried_object = get_queried_object();
          if ($queried_object) {
            $tax = get_taxonomy($queried_object->taxonomy);
            single_term_title('');
          }
        } else {
          the_title();
        } ?>
      </h1>
      <div class="block w-full md:w-auto mt-6 md:mt-0">
        <div class="relative w-full z-20">
          <button id="solutionToggle" class="w-full border px-6 py-3 border-gray-300 bg-white text-black uppercase text-base font-semibold rounded-full tracking-wide flex items-center justify-between hover:border-gray-400 transition gap-10">
            <span id="solutionLabel">Projects by Solution</span>
            <svg id="solutionIcon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.65948 0.99999L6.65947 12.224" stroke="black" stroke-width="2" stroke-linecap="round"/>
              <path d="M12.4287 6.66049L6.57918 12.51L1.00042 6.93125" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
          <div id="solutionDropdown" class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-300 rounded-md shadow-lg hidden">
            <a href="/projects" class="block px-6 py-3 hover:bg-gray-100 text-black text-sm font-semibold tracking-wide uppercase">
              All Solutions
            </a>
            <?php foreach ($solutions as $solution) : ?>
              <a href="/projects/?solution=<?php echo $solution->slug; ?>"
                class="block px-6 py-3 text-sm font-semibold tracking-wide uppercase <?php echo $current_solution === $solution->slug ? 'bg-black text-white hover:text-white hover:bg-black hover:text-black' : 'text-black hover:text-black hover:bg-lightestgrey'; ?>">
                <?php echo $solution->name; ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if (has_excerpt() && !is_post_type_archive()): ?>
    <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
      <div data-aos="fade">
        <div class="text-lg text-black font-sans pr-6 max-w-none font-normal lg:max-w-[75%]">
          <?php the_excerpt(); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>