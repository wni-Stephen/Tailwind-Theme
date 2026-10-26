<?php
/* Template Name: Document */

get_header();

  $markupFixer  = new TOC\MarkupFixer();
  $tocGenerator = new TOC\TocGenerator();
  $content = $markupFixer->fix(get_the_content());

?>

<section class="py-8 lg:py-12 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">


    <div class="grid xl:grid-cols-12 gap-8 xl:gap-x-32">
      <div class="leading-none xl:col-span-12">
        <h1
        data-aos="fade-up"
        class="fluid-3xl mb-16"
        ><?php the_title(); ?></h1>
      </div>

      <div
        class="toc xl:col-span-3"
        data-aos="fade-up">
        <h2 class="mb-8 uppercase font-semibold text-sm text-gray-500">Table of Contents</h2>
        <?= $tocGenerator->getHtmlMenu($content, 2, 3); ?>
      </div>

      <div class="xl:col-span-9">
        <div
          data-aos="fade-up"
          class="max-w-screen-lg">
          <?= wpautop($content); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
get_footer();
?>
