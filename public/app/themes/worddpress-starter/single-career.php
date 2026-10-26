<?php get_header();

// $closing_date_raw = get_post_meta(get_the_ID(), 'closing_date', true);

// // Convert stored date (ACF format: YYYY-MM-DD HH:MM:SS) to readable format
// if (!empty($closing_date_raw)) {
//   $date_obj = DateTime::createFromFormat('Y-m-d H:i:s', $closing_date_raw);
//   if ($date_obj) {
//     $closing_date_formatted = $date_obj->format('jS F Y, g a'); // e.g., "12th March 2025, 1pm"
//   } else {
//     $closing_date_formatted = esc_html($closing_date_raw); // Fallback if conversion fails
//   }
// } else {
//   $closing_date_formatted = 'No closing date provided';
// }

?>
<section>
  <p>Add content here</p>
</section>
<?php get_template_part('templates/dev/block-render'); ?>
<?php get_footer(); ?>