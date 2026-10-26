<?php
$variant = !empty(get_sub_field('variant')) ? get_sub_field('variant') : 'default';
$image = get_sub_field('image');

$container = [
  'default' => 'sm:py-8 lg:py-12 relative bg-white',
  'full' => 'relative',
];

$picture = [
  'default' => 'sm:px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto flex',
  'full' => 'flex aspect-video overflow-hidden',
];

?>

<section class="<?= $container[$variant]; ?>">
  <picture class="<?= $picture[$variant]; ?>">
    <img
      src="<?= esc_url($image['url']); ?>"
      height="<?= esc_attr($image['height']); ?>"
      width="<?= esc_attr($image['width']); ?>"
      alt="<?= esc_attr($image['alt']); ?>"
      class="object-cover object-center w-full h-full"
    />
  </picture>
</section>
