<?php $closing_date_raw = get_post_meta(get_the_ID(), 'closing_date', true);

// Convert stored date (ACF format: YYYY-MM-DD HH:MM:SS) to readable format
if (!empty($closing_date_raw)) {
  $date_obj = DateTime::createFromFormat('Y-m-d H:i:s', $closing_date_raw);
  if ($date_obj) {
    $closing_date_formatted = $date_obj->format('jS F Y, g a'); // e.g., "12th March 2025, 1pm"
  } else {
    $closing_date_formatted = esc_html($closing_date_raw); // Fallback if conversion fails
  }
} else {
  $closing_date_formatted = 'No closing date provided';
}


?>
<div data-aos="fade-up">
  <a href="<?= get_permalink() ?>" class="w-full flex flex-col group bg-black hover:shadow-lg transition-all duration-500">
    <div class="flex-shrink-0 relative overflow-hidden">
      <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-tr from-black/75 via-black/25"></div>
      <?php $image = wp_get_attachment_url(get_post_thumbnail_id(), 'large'); ?>
      <div class="w-full flex h-[450px]">
        <div class="transition-all duration-500 object-cover object-center w-full group-hover:h-full"></div>
        <div class="absolute bottom-0 lg:bottom-auto lg:top-0 right-0 lg:w-20 h-[70px] bg-black flex items-center justify-center transition-all duration-500 ease-in-out w-full group-hover:bg-red" title="View <?php the_title(); ?>">
          <arrow class="hidden lg:block text-white absolute top-7 right-7 group-hover:rotate-45 transition-transform duration-200"></arrow>
        </div>
        <div class="lg:hidden absolute lg:top-0 right-0 w-20 h-20 bg-black flex items-center justify-center transition-all duration-500 ease-in-out lg:group-hover:w-full lg:group-hover:h-full" title="View <?php the_title(); ?>">
          <arrow class="text-white absolute top-8 right-8 group-hover:rotate-45 transition-transform duration-200"></arrow>
        </div>
      </div>
    </div>
  </a>
  <div class="transition-all duration-500 absolute bottom-0 left-0 right-0 text-white group-hover:text-white flex flex-col p-6 xl:p-8 h-auto py-6">
    <div class="transition-all duration-500 absolute bottom-0 left-0 right-0 z-0 pointer-events-none bg-red group-hover:h-0 h-full"></div>
    <div class="relative flex flex-col h-full items-start justify-center">
      <p class="text-base lg:text-lg text-white font-sans group group-hover:text-white transition-all duration-500">
        <?php the_title() ?>
      </p>
      <span class="text-sm"><?php echo '<p>Closing Date: ' . esc_html($closing_date_formatted) . '</p>'; ?></span>
    </div>
  </div>
</div>