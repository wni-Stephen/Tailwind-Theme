<!-- Pass through theme style to determine which logo is shown -->
<?php set_query_var('theme', 'bg-white light'); ?>
<?php set_query_var('logo', 'Dark'); ?>
<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>


<?php
$current_term_slug = isset($_GET['resource_category']) ? sanitize_text_field($_GET['resource_category']) : '';
$current_order = isset($_GET['order']) ? $_GET['order'] : 'desc';

// Get all taxonomy terms
$terms = get_terms(array(
  'taxonomy'   => 'resource_category',
  'hide_empty' => true,
  'order' => 'DESC',
));

?>
<section class="py-4 md:pb-8 lg:pb-16 lg:pt-4 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="flex items-center justify-between gap-10 mb-10">
      <div class="mb-10 flex gap-4 items-center">
        <div class="resources-category-filter flex items-center gap-4">
          <?php
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
              echo '<a href="' . esc_url(get_term_link($term)) . '" class="filter-button rounded-[25px] px-6 py-3 hover:bg-lightgreen hover:text-deepgreen ' . esc_attr($is_active) . '">'
                . esc_html($term_name) . '</a>';
            }
          }
          ?>
        </div>
        <!-- TODO: Capture the current category with this filter too e.g. news/insights etc -->
        <div class="mb-10">
          <!-- <form method="GET" id="sort-filter-form">
            <select name="sort_order" id="sort-order">
              <option value="DESC" <?php selected(isset($_GET['sort_order']) ? $_GET['sort_order'] : '', 'DESC'); ?>>Newest to Oldest</option>
              <option value="ASC" <?php selected(isset($_GET['sort_order']) ? $_GET['sort_order'] : '', 'ASC'); ?>>Oldest to Newest</option>
            </select>
            <noscript><input type="submit" value="Sort"></noscript>
          </form> -->
        </div>
      </div>
    </div>


    <div id="resource-list">
      <?php
      $args = array(
        'post_type'      => 'resources',
        'posts_per_page' => -1,
      );

      if (!empty($current_term_slug)) {
        $args['tax_query'] = array(
          array(
            'taxonomy' => 'resource_category',
            'field'    => 'slug',
            'terms'    => $current_term_slug,
          ),
        );
      }

      $query = new WP_Query($args);
      $current_category = sanitize_text_field($_GET['resource_category']);

      if ($query->have_posts()) : ?>
        <div class="grid <?php echo ($current_category == "documents") ? 'grid-cols-1 gap-5' : 'md:grid-cols-2 lg:grid-cols-3 md:gap-8 lg:gap-16'; ?>">
          <?php while ($query->have_posts()) : $query->the_post();
            $terms = get_the_terms(get_the_ID(), 'resource_category');
          ?>
            <?php if ($terms[0]->name == "Documents") : ?>
              <?php if (get_field('file')): ?>
                <div class="resource-item">
                  <a class="bg-[#EEFFEA] text-deepgreen font-sora font-medium text-lg p-8 lg:p-10 h-full group hover:bg-deepgreen hover:text-white duration-300 ease-in-out rounded-[20px] w-full flex items-center justify-between" href="<?php the_field('file'); ?>" target="_blank" title="Download file: <?php echo the_title(); ?> (opens in new tab)">
                    <span class="text-base lg:text-lg"><?php echo the_title(); ?></span>
                    <div class="flex items-center gap-6">
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
                    $image = wp_get_attachment_url(get_post_thumbnail_id(), 'full'); ?>
                    <picture>
                      <img class="object-cover object-center w-full h-[350px] rounded-xl" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
                    </picture>
                  <?php endif; ?>
                  <?php if ($terms): ?>
                    <span class="w-full text-deepgreen font-bold font-manrope mt-6 lg:mt-10 block text-sm"><?php echo $terms[0]->name; ?> </span>
                  <?php endif; ?>
                  <p class="font-sora font-medium mt-6 fluid-lg block group transition-all duration-300">
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
        else :
          echo '<p>No resources found.</p>';
        endif;
        ?>
        </div>
    </div>
  </div>
</section>
<?php
get_footer();
?>