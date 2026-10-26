<?php 

$eyebrow = get_field('cs_eyebrow', 'option');
$heading = get_field('cs_heading', 'option');
$text = get_field('cs_text', 'option');

?>

<section class="relative my-8 md:my-16 text-block bg-white">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-center">
  <?php if($eyebrow) : ?>
  <p class="fluid-sm font-regular font-dm-sans uppercase mb-6 lg:mb-6 text-purple !tracking-wider text-center mx-auto lg:w-10/12"><?php echo $eyebrow; ?></p>
  <?php endif; ?>
  <?php if($heading) : ?>
    <div class="lg:max-w-screen-2xl mx-auto text-center lg:w-10/12" data-aos="fade">
      <h1 class="fluid-3xl font-sans font-bold mb-6 lg:max-w-[90%] mx-auto block text-darkpurple"><?php echo $heading; ?></h1>
    </div>
    <?php endif; ?>
  </div>
  <?php if($text) : ?>
  <div class="px-6 w-full lg:w-10/12 mx-auto relative max-w-screen-2xl ">
    <div data-aos="fade">
      <div class="text-lg text-black font-sans max-w-none font-normal lg:max-w-[80%] text-center font-dm-sans mx-auto text-lg text-purple">
        <?php echo $text; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</section>
