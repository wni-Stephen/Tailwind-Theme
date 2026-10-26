<section class="py-8 lg:py-16 bg-lightgrey relative" id="solutions-block">
  <div class="w-[1px] bg-[#FFFFFF80] h-full absolute inset-y-0 left-1/2 transform -translate-x-1/2 hidden lg:flex items-center justify-center "></div>
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto">
    <p class="text-2xl leading-tight py-6 font-sans font-extrabold uppercase pb-10 lg:pb-20">Solutions</p>

    <?php
    $args = [
      'post_type'      => 'solutions',
      'posts_per_page' => -1,
      'post_parent'    => 0,
      'orderby'        => 'menu_order',
      'order'          => 'ASC',
    ];
    $solutions = get_posts($args);
    ?>

    <?php if ($solutions): ?>
      <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8">

        <!-- Left Column (tabs) -->
        <div class="flex flex-col justify-between">

          <!-- Mobile Dropdown -->
          <div class="lg:hidden relative mb-6">
            <!-- Dropdown button -->
            <button id="solution-dropdown-btn" class="w-full bg-black text-white border border-black rounded p-3 text-left flex justify-between items-center text-lg font-normal font-sans">
              <span id="solution-dropdown-selected"><?php echo esc_html($solutions[0]->post_title); ?></span>
              <svg id="solution-dropdown-arrow" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Dropdown list -->
            <ul id="solution-dropdown-list" class="absolute z-20 w-full mt-1 bg-black text-white border border-black rounded shadow-lg max-h-64 overflow-auto hidden">
              <?php foreach ($solutions as $solution): ?>
                <li class="px-4 py-3 hover:bg-white hover:text-black cursor-pointer text-lg" data-target="solution-<?php echo $solution->ID; ?>">
                  <?php echo esc_html($solution->post_title); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>



          <!-- Desktop Tabs (hidden on mobile) -->
          <div class="hidden lg:flex flex-col items-baseline">
            <?php foreach ($solutions as $index => $solution): ?>
              <button
                class="solution-tab text-5xl font-extrabold text-left flex items-start gap-2 transition-colors duration-300 uppercase mb-6 hover:text-[#888782] leading-10 <?php echo $index === 0 ? 'text-black' : 'text-white'; ?>"
                data-target="solution-<?php echo $solution->ID; ?>"  data-label="<?php echo esc_attr($solution->post_title); ?>">
                <?php $solution_title = $solution->post_title; ?>
                <?php if ($solution_title == "Civil Engineering") : ?>
                  <span class="inline-block">Civil<arrow-thin class="inline-block h-12 w-12 pl-3 -top-2 relative"></arrow-thin><br />Engineering</span>
                <?php else : ?>
                  <?php echo esc_html($solution->post_title); ?>
                  <span class="inline-block">
                    <arrow-thin class="inline-block h-12 w-12 pl-3 -top-2 relative"></arrow-thin>
                  </span>
                <?php endif; ?>
              </button>
            <?php endforeach; ?>
          </div>

        </div>

        <!-- Right Column (panels container) -->
        <div id="solution-panels-container" class="relative w-full transition-all duration-500 border-t border-[#FFFFFF80] lg:border-t-0 lg:border-none">
          <?php foreach ($solutions as $index => $solution):
            $heading = get_field('heading', $solution->ID);
            $text    = get_field('text', $solution->ID);
          ?>
            <div
              id="solution-<?php echo $solution->ID; ?>"
              class="solution-panel absolute inset-0 w-full lg:p-4 transition-opacity duration-500 lg:-mt-16 lg:pl-20 pt-10 lg:pt-0 <?php echo $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0'; ?>">

              <?php if ($heading): ?>
                <h2 class="text-xl lg:text-2xl font-extrabold font-sans mb-6 uppercase text-black pr-10"><?php echo esc_html($heading); ?></h2>
              <?php endif; ?>

              <?php if ($text): ?>
                <div class="mb-6 font-sans text-black text-lg lg:mb-10"><?php echo wp_kses_post($text); ?></div>
              <?php endif; ?>

              <div class="flex gap-6 justify-start flex-col xl:flex-row lg:gap-6 mt-8">
                <a href="<?php echo get_permalink($solution->ID); ?>" class="group flex items-center gap-4 font-semibold text-base duration-200 ease-in-out transition-colors text-black">View <?php echo esc_html($solution->post_title); ?><span>
                    <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                  </span>
                </a>

                <!-- <a href="<?php echo get_post_type_archive_link('solutions'); ?>" class="group flex items-center gap-4 font-semibold text-base duration-200 ease-in-out transition-colors text-black hover:text-red">View all solutions<span>
                    <arrow class="h-4 w-4 group-hover:rotate-45 transition-transform duration-200"></arrow>
                  </span>
                </a> -->
              </div>

            </div>
          <?php endforeach; ?>
        </div>

      </div>
    <?php endif; ?>
  </div>
</section>