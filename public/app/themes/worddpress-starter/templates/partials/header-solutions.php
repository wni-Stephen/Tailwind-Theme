<?php

/**
 *Display block file name in dev mode
 */
get_template_part('templates/dev/block', 'info', [
  'type' => 'template',
  'file' => basename(__FILE__)
]);

?>

<section class="relative overflow-hidden bg-white mt-8">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="lg:max-w-screen-2xl">
      <p class="text-xl lg:text-3xl font-bold font-sans uppercase text-black">
        Solutions
      </p>
    </div>
  </div>
</section>