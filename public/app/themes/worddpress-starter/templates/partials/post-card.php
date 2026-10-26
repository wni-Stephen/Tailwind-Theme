<div
  data-aos="fade-up"
>
  <a href="<?= get_permalink() ?>" class="w-full flex flex-col group bg-gray-800 hover:shadow-lg transition-all duration-500">
    <div class="flex-shrink-0 relative overflow-hidden">
      <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-tr from-black/75 via-black/25"></div>
        <?php if(has_post_thumbnail()):
          $image = wp_get_attachment_url( get_post_thumbnail_id(), 'medium' );
        ?>
        <picture class="w-full flex aspect-[4/5]">
        <img class="transition-all duration-500 object-cover object-center w-full group-hover:h-full h-3/4" src="<?php echo $image; ?>" alt="<?php the_title() ?>">
        </picture>
       <?php else: ?>
        <div class="transition-all duration-500 object-cover object-center w-full flex items-center justify-center w-full group-hover:h-full h-3/4 bg-secondary-500">
          <div class="aspect-square bg-primary-500 w-1/3 absolute right-0 top-0 z-0 pointer-events-none"></div>
          <div class="aspect-square bg-primary-500 w-1/3 absolute right-0 top-0 -translate-x-full translate-y-full z-0 pointer-events-none"></div>
          <div class="aspect-square bg-primary-500 w-1/3 absolute right-0 top-0 z-0 translate-y-[200%] pointer-events-none"></div>
        </div>
        <?php endif; ?>

       <div class="transition-all duration-500 absolute bottom-0 left-0 right-0 group-hover:text-white flex flex-col p-6 xl:p-8 min-h-[30%]">
         <div class="transition-all duration-500 absolute bottom-0 left-0 right-0 z-0 pointer-events-none bg-gray-200 group-hover:h-0 h-full"></div>
         <div class="relative flex flex-col h-full">
           <h2 class="fluid-lg mb-8 line-clamp-2 min-h-[60px]">
            <?php the_title() ?>
           </h2>
         </div>
         <div class="flex justify-between items-center w-full mt-auto absolute bottom-0 left-0 right-0 p-6 xl:p-8">
           <div class="text-sm">
             <?php the_time('M j, Y') ?>
           </div>
           <arrow class="w-10 h-5 stroke-2"></arrow>
         </div>
       </div>

    </div>
  </a>
</div>
