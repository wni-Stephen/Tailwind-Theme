<?php get_header();

$related_services = get_field('related_services');
$logo = get_field('logo');
$external_link = get_field('external_link');
?>

<section class="relative my-8 md:my-16 lg:mb-20 text-block bg-white">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">
  <?php if(get_the_title()) : ?>
    <div class="text-left" data-aos="fade">
      <h1 class="fluid-3xl font-sans font-bold mb-6 lg:w-full block text-darkpurple relative"><?php echo the_title(); ?></h1>
    </div>
    <?php endif; ?>
    <div class="grid md:grid-cols-2 gap-8 lg:gap-20 text-left mt-4 lg:mt-20" data-aos="fade">
      <div class="flex justify-between flex-col">
        <div class="relative">
          <?php if( $external_link ): 
              $link_url = $external_link['url'];
              $link_title = $external_link['title'];
              $link_target = $external_link['target'] ? $external_link['target'] : '_self';
              ?>
              <p class="font-dm-sans font-bold   mt-4 lg:mt-10">Project link</p>
              <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">View campaign</a>
          <?php endif; ?>
        </div>
        <?php if (!empty($logo)) : ?>
          <picture class="relative h-full w-full flex mt-10">
            <img class="object-contain object-center w-[250px]" src="<?= esc_url($logo['url']); ?>" height="<?= esc_attr($logo['height']); ?>" width="<?= esc_attr($logo['width']); ?>" alt="<?= esc_attr($logo['alt']); ?>" />
          </picture>
          <?php endif; ?>
          <div class="relative hidden md:block">
          <div class="h-24 w-24 rounded-bl-full absolute bottom-0 left-1/2 custom-spin2 bg-pink"></div>
          <div class="h-24 w-24 rounded-br-full absolute bottom-0 left-0 custom-spin bg-darkpink"></div>
        </div>
      </div>
      <div class="text-lg text-black font-sans font-normal font-dm-sans mx-auto text-lg text-purple" data-aos="fade">
        <?php echo the_field('introduction'); ?>
      </div>
    </div>
  </div>
</section>

<?php
get_template_part( 'templates/dev/block-render'); ?>

<div class="my-5 lg:my-10">
  <a class="text-purple hover:text-black mt-2 duration-300 font-bold font-dm-sans gap-5 text-base items-center justify-between flex flex-col" href="/case-studies" rel="nofollow noreferrer">
    <span class="font-bold">Back to Case Studies</span>
      <arrow class="w-10 h-5 stroke-2 rotate-180"></arrow>
  </a>
</div>

<?php get_footer();?>