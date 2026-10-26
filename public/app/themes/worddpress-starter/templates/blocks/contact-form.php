<?php 

$bg = 'bg-' . get_sub_field('background_colour');

if(get_sub_field('background_colour') == "") {
  $bg = "bg-lightestgrey";
}

?>

<div id="contact" name="contact"></div>
<section class="py-10 lg:py-16 overflow-hidden <?php echo $bg;?>">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 xl:gap-32">
      <div class="lg:w-full pb-8">
        <div class="text-left">
          <h3 class="fluid-2xl font-sans font-semibold mb-6 lg:mb-10 block text-black">Get in touch with our team</h3>
        </div>
        <contact-form></contact-form>
      </div>
    </div>
  </div>
</section>