<?php

/**
 * *The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package demo
 */
get_header();

?>


<section class="py-8 lg:py-12 bg-white">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
    <div class="relative pt-24 pb-16 space-y-16">
      <div class="mb-8">
        <h1 class="text-5xl font-sans font-semibold text-inter mb-6 lg:max-w-[90%] block text-black">
          &#x1F9BA; You've wandered off the site!
        </h1>
        <p class="text-lg text-black font-sans lg:w-3/4"> We can't find the page you were after — maybe it's down a trench somewhere. <br>Let's get you back on solid ground.</p>
      </div>
      <div class="flex gap-6 justify-start">
        <a class="text-black hover:underline hover:underline-offset-8 mt-8 py-4 inline-flex duration-300 font-semiboldfont-sans gap-2 text-base items-center justify-between dark:text-white" href="/" target="_blank" rel="nofollow noreferrer">
          <span class="font-semibold font-sans">Home</span>
          <arrow class="w-10 h-5 stroke-2 tilted-arrow"></arrow>
        </a>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>