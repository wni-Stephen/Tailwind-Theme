<?php
$images = get_sub_field('images');
$variant = get_sub_field('variant') ? get_sub_field('variant') : 'slider';

if( $images ): ?>

  <?php
    if( $variant === 'slider' ):
    $size = 'full'; // (thumbnail, medium, large, full or custom size)
  ?>
    <div class="overflow-hidden relative"
          data-aos="fade-up"
          data-delay="0">
        <gallery-slider>
          <?php foreach( $images as $image_id ): ?>
                <div class="embla_slide w-full flex flex-[0_0_100%]">
                    <picture  class="flex w-full aspect-video overflow-hidden">
                      <img class="w-full object-cover object-center block" src="<?php echo wp_get_attachment_url( $image_id, $size ); ?>" alt="Gallery" />
                    </picture>
                </div>
          <?php endforeach; ?>
        </gallery-slider>
    </div>

<?php
elseif( $variant === 'list' ):
$size = 'full'; // (thumbnail, medium, large, full or custom size)
$i = 0;
?>
<div class="overflow-hidden space-y-4 relative">
      <?php foreach( $images as $image_id ): $i++; ?>
        <picture  class="flex w-full overflow-hidden"
        data-aos="fade-up"
        data-delay="<?= $i * 0.1 ?>">
          <img class="w-full object-cover object-center block" src="<?php echo wp_get_attachment_url( $image_id, $size ); ?>" alt="Gallery" />
        </picture>
      <?php endforeach; ?>
</div>

<?php
else:
  $size = 'medium';
  $i = 0;
?>
<div class="overflow-hidden relative">
    <gallery class="pswp-gallery grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8">
      <?php foreach( $images as $image_id ): $i++;

        $image =  wp_get_attachment_image_src( $image_id,  'full' );

        ?>
          <a
              href="<?php echo $image[0]; ?>"
              :data-pswp-width="<?php echo $image[1]; ?>"
              :data-pswp-height="<?php echo $image[2]; ?>"
              target="_blank"
              rel="noreferrer"
              class="flex w-full aspect-square overflow-hidden"
              data-aos="fade-up"
              data-delay="<?= $i * 0.1 ?>"
            >
             <img class="w-full object-cover object-center block" src="<?php echo wp_get_attachment_image_src( $image_id, 'medium' )[0]; ?>" alt="" />

            </a>
      <?php endforeach; ?>
    </gallery>
</div>


<?php endif; ?>



<?php endif; ?>
