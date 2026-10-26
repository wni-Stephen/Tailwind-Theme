<!-- Pass through theme style to determine which logo is shown -->
<?php set_query_var('theme', 'bg-deepgreen dark'); ?>
<?php set_query_var('logo', 'Dark'); ?>
<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>

<?php $current_term_slug = isset($_GET['resource_category']) ? sanitize_text_field($_GET['resource_category']) : ''; ?>
<?php $current_order = isset($_GET['order']) ? $_GET['order'] : 'desc'; ?>

<section class="py-4 md:pb-8 lg:pb-16 lg:pt-4 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="flex items-center justify-between gap-10 mb-10">
      <div class="mb-10 flex gap-4 items-center justify-between w-full">
        <div class="resources-category-filter w-full md:w-auto grid grid-cols-2 md:flex items-start gap-4 flex-row flex-wrap md:flex-row md:items-center">

          <?php
          $terms = get_terms(array(
            'taxonomy'   => 'resource_category',
            'hide_empty' => true,
            'order' => 'DESC'
          ));

          $current_term = get_queried_object();
          $current_term_name = $current_term->name;

          if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
              $term_name = $term->name;
              if ($term->name == "Case Study") {
                $term_name = "Case Studies";
              } else if ($term->name == "Insight") {
                $term_name = "Insights";
              } else if ($term->name == "Documents") {
                $term_name = "Document Library";
              } else {
                $term_name = $term->name;
              }
              $is_active = (is_tax('resource_category', $term->slug)) ? 'active' : '';
              $term_link = esc_url(get_term_link($term));
              if ($current_order) {
                $term_link .= '?order=' . $current_order; // Maintain sorting when switching categories
              }
              echo '<a href="' . esc_url(get_term_link($term)) . '" class="filter-button font-sora w-full md:w-auto bg-lightgreen md:bg-white rounded-[25px] px-6 py-3 hover:bg-lightgreen hover:text-deepgreen ' . esc_attr($is_active) . '">'
                . esc_html($term_name) . '</a>';
            }
          }

          ?>
        </div>
        <div class="hidden md:flex md:items-center">
          <div class="sort-dropdown">
            <label for="sort-order" class="text-sm text-manrope mr-3 lg:mr-5">Sort by:</label>
            <select id="sort-order" class="border-none font-medium ring-0">
              <option value="?order=desc" <?php echo ($current_order == 'desc') ? 'selected' : ''; ?>>Newest</option>
              <option value="?order=asc" <?php echo ($current_order == 'asc') ? 'selected' : ''; ?>>Oldest</option>
            </select>
          </div>
        </div>
      </div>
    </div>


    <div id="resource-list" class="mb-10 lg:mb-20">
      <?php
      $current_term = get_queried_object();
      $args = array(
        'post_type'      => 'resources',
        'posts_per_page' => -1,
        'tax_query'      => array(
          array(
            'taxonomy' => 'resource_category',
            'field'    => 'slug',
            'terms'    => $current_term->slug,
          ),
        ),
        'orderby' => 'date',
        'order'   => ($current_order === 'asc') ? 'ASC' : 'DESC',
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) : ?>
        <div class="grid <?php echo (strtolower($current_term_name) == "documents") ? 'grid-cols-1 gap-5' : 'md:grid-cols-2 lg:grid-cols-3 md:gap-8 lg:gap-16'; ?>">
          <?php while ($query->have_posts()) : $query->the_post();
            $terms = get_the_terms(get_the_ID(), 'resource_category');
          ?>
            <?php if ($terms[0]->name == "Documents") : ?>
              <?php if (get_field('file')): ?>
                <div class="resource-item">
                  <a class="bg-[#EEFFEA] text-deepgreen font-sora font-medium text-lg p-8 lg:p-10 h-full group hover:bg-deepgreen hover:text-white duration-300 ease-in-out rounded-[20px] w-full flex items-start lg:items-center justify-between flex-col lg:flex-row gap-6 " href="<?php the_field('file'); ?>" target="_blank" title="Download file: <?php echo the_title(); ?> (opens in new tab)">
                    <span class="text-base lg:text-lg font-medium w-full "><?php echo the_title(); ?></span>
                    <div class="flex items-center gap-6 w-full justify-between lg:justify-end font-normal">
                      <span class="hidden md:block text-base">Download PDF</span>
                      <download-arrow></download-arrow>
                    </div>
                  </a>
                </div>
              <?php endif; ?>
            <?php else : ?>
              <a title="Read <?php the_title(); ?>" href="<?php the_permalink(); ?>" class="group h-full w-full rounded-xl resource-item">
                <div class="h-full flex flex-col justify-between">
                  <?php if (has_post_thumbnail()):
                    $image = wp_get_attachment_url(get_post_thumbnail_id(), 'full');
                  ?>
                    <picture>
                      <img class="object-cover object-center w-full h-[350px] rounded-xl" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
                    </picture>
                  <?php endif; ?>
                  <?php if ($terms): ?>
                    <span class="w-full text-deepgreen font-bold font-manrope mt-6 lg:mt-10 block text-sm"><?php echo $terms[0]->name; ?> </span>
                  <?php endif; ?>
                  <p class="font-sora font-medium mt-6 fluid-lg block group transition-all duration-30">
                    <?php the_title(); ?>
                  </p>
                  <div class=" my-6 max-w-none font-normal text-left font-manrope dark:text-white line-clamp-2"><?php the_excerpt(); ?></div>
                  <div class="flex justify-between items-center flex-row w-full group">
                    <span class="py-3 px-10 font-manrope font-bold group text-deepgreen bg-black group-hover:bg-black group-hover:text-white duration-300 ease-in-out transition-all rounded-[32px]">View article</span>
                  </div>
                </div>
              </a>
            <?php endif; ?>
        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
        </div>
    </div>
  </div>
</section>

<!-- Show CTA if case study page -->

<?php if ($current_term->slug == "case-study") : ?>

  <section class="call-to-action relative overflow-hidden py-16 lg:pt-24 bg-deepgreen text-white rounded-t-[32px]">
    <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl">
      <div class="block md:grid md:grid-cols-2 gap-16 lg:gap-16 xl:gap-32">
        <div>
          <div class="w-full xl:max-w-[80%] text-left font-sora lg:text-3xl font-medium mb-0 call-to-action-text pr-10 text-wrap">
          Covering <span class="text-black">95%</span> of Northern Ireland's postcodes directly, we are never far away.
          </div>
          <div class="flex gap-6 justify-start md:mb-10">
            <a class="inline-flex duration-300 font-semibold font-sora hover:text-black gap-5 lg:gap-10 items-center justify-start  " href="tel:+44(0)2895313313" target="_blank" rel="nofollow noreferrer" title="Call us">
              <span class="font-semibold font-sora mt-1 text-black">+44 (0)28 95 313 313</span>
            </a>
          </div>
          <div class="text-lg text-black font-sans max-w-none font-normal lg:max-w-[80%] text-left font-sans dark:text-white text-white pr-10 mb-6">
          Speak to our team today for more help.<br>
          <a class="font-semibold font-sora text-black" href="tel:+44(0)2895313313">+44 (0)28 95 313 313</a>
          </div>
          <a data-aos="fade" data-aos-delay="0.1" class="text-white hover:underline hover:underline-offset-8 mt-8 py-4 inline-flex duration-300 font-semiboldfont-sora gap-2 text-base items-center justify-between dark:text-white" href="/contact"  target="_blank" rel="nofollow noreferrer">
            <span class="font-semibold font-sora">Get in touch</span>
            <arrow class="w-10 h-5 stroke-2 text-black dark:text-black"></arrow>
          </a>
        </div>
        <div class="hidden md:block text-black">
          <speech-bubbles class="text-black"></speech-bubbles>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php get_footer(); ?>