<?php

  $bg_video = get_field('background_video');
  $video_id = get_field('video_id');
  $provider = get_field('provider');

?>
<section class="header h-[48rem] xl:h-[54rem] bg-secondary-900 text-white relative overflow-hidden" data-aos="fade">
  <?php if( $bg_video ): ?>
        <video class="inset-0 absolute z-0 flex object-center object-cover w-full h-full" autoplay muted loop playsinline preload="none" data-aos="parallax">
            <source src="<?= $bg_video; ?>" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    <?php else: ?>
      <?php if(has_post_thumbnail()):
        $image = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
      ?>
        <picture class="inset-0 absolute z-0 flex" data-aos="parallax">
            <img class="w-full h-full object-cover object-center block" src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
        </picture>
      <?php endif; ?>
  <?php endif; ?>
  <div class="absolute z-0 left-0 right-0 top-0 h-44 pointer-events-none bg-gradient-to-b from-darkgrey/50 via-darkgrey/25">
    </div>
    <div class="absolute z-0 inset-0 pointer-events-none bg-gradient-to-tr from-darkgrey/50 via-darkgrey/25"></div>

  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative h-full">
      <div class="flex w-full h-full">

          <a href="/" class="home-logo square-0 transition duration-700 block aspect-square bg-white h-1/4 absolute left-0 top-0 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 1200 1200">
            	<path fill="#6E6E6E" d="M861.8,888.2c4.2,5.4,9.2,9.5,15.1,12.3c5.8,2.7,12.6,4.1,20.2,4.1c7.3,0,13-1.4,17.4-4.1
            	c4.4-2.7,6.6-6.4,6.6-11c0-7.2-9.3-12.2-27.9-14.9c-4.2-0.7-7.4-1.1-9.7-1.6c-13.9-2.3-24.1-6.4-30.5-12.2
            	c-6.5-5.8-9.7-13.9-9.7-24.2c0-13,4.8-23.6,14.3-31.6c9.6-8,22.1-12.1,37.8-12.1c12.1,0,23,2.1,32.6,6.2
            	c9.6,4.2,17.8,10.2,24.6,18.4l-23.1,17.4c-5.2-5.6-10.4-9.7-15.9-12.4c-5.4-2.6-11.3-4-17.6-4c-6.1,0-11,1.3-14.6,3.9
            	c-3.7,2.5-5.4,5.9-5.4,10.1c0,3.9,1.7,6.7,4.9,8.8c3.2,2,10.3,3.8,21.2,5.3c9.5,1.4,16.5,2.5,20.7,3.4c4.2,0.8,7.3,1.8,9.3,2.6
            	c8,3.5,13.8,7.8,17.3,12.8c3.4,5,5.2,11.6,5.2,19.6c0,13.8-5.2,24.7-15.6,32.9s-24.6,12.2-42.6,12.2c-13.5,0-25.1-2.3-35.1-7
            	s-17.8-11.5-23.6-20.4L861.8,888.2z M729.3,927V795.8h95.1v25.5h-64.2v24.3h57.6v24.5h-57.6v31.4h69.9V927H729.3z M632.4,927V795.8
            	h31v104.4h50.2V927L632.4,927L632.4,927z M534.2,819.9v36.4h22.4c8.9,0,15.2-1.4,19.1-4.2c3.9-2.8,5.7-7.4,5.7-13.8
            	c0-6.8-1.8-11.5-5.3-14.3c-3.5-2.7-10-4.1-19.4-4.1h-22.5V819.9z M503.2,927V795.8h55.4c18.3,0,31.9,3.3,40.8,10
            	c8.9,6.7,13.4,17,13.4,30.9c0,9.3-2.3,17.1-6.8,23.4c-4.5,6.3-11.2,11-20,14.1l29.5,52.8h-35.2l-25.4-46.4h-20.9V927L503.2,927
            	L503.2,927z M399.7,927h-33.6l47.8-131.1h33.3L494.8,927h-33.7l-6.7-20.7h-47.8L399.7,927z M414.2,882.2h32.8l-16.4-52L414.2,882.2z
            	 M245.8,927V795.8h31v47.6h50v-47.6h30.9V927h-30.9v-55.4h-50V927H245.8z M231.2,896.8c-6.1,11.2-13.6,19.6-22.6,25.1
            	c-9.1,5.5-19.6,8.3-31.6,8.3c-18.9,0-34-6.2-45.1-18.6c-11.2-12.4-16.8-29.1-16.8-50.2c0-20.7,5.8-37.2,17.4-49.9
            	c11.7-12.6,26.9-18.9,45.9-18.9c11.9,0,22.2,2.8,31.1,8.5c8.9,5.6,15.6,13.9,20.6,24.6l-24.2,12.8c-2.8-6.3-6.6-11.1-11.3-14.3
            	c-4.7-3.2-10-4.9-16.3-4.9c-9.6,0-17.2,3.8-22.8,11.2c-5.6,7.5-8.3,17.7-8.3,30.8c0,13.1,2.7,23.4,8.3,30.7c5.5,7.3,13.4,11,23.3,11
            	c6.3,0,11.7-1.6,16.4-4.6c4.6-3.1,8.5-7.7,11.5-14L231.2,896.8z M649.6,1088.7V957.5h42.9c24.5,0,42.6,5.3,54,15.9
            	c11.5,10.5,17.2,27.1,17.2,49.7c0,21.9-5.7,38.4-17.1,49.2c-11.4,10.9-28.6,16.3-51.6,16.3h-45.4V1088.7z M680.6,1062H696
            	c12,0,21.1-3.2,26.9-9.7c5.9-6.5,8.9-16.2,8.9-29.2s-2.9-22.7-8.9-29.2c-5.9-6.4-14.9-9.6-26.9-9.6h-15.4v77.7H680.6z M513.8,1088.7
            	V957.5h32.8l50.2,91.1l-2.6-91.1h29.7v131.1h-32.6l-50.4-89.9l2.6,89.9H513.8z M410.3,1088.7h-33.6l47.8-131.1h33.3l47.7,131.1
            	h-33.7l-6.7-20.7h-47.8L410.3,1088.7z M424.7,1043.9h32.8l-16.4-52L424.7,1043.9z M290,981.6v36.4h22.4c8.9,0,15.2-1.4,19.1-4.2
            	c3.9-2.8,5.7-7.4,5.7-13.8c0-6.8-1.8-11.5-5.3-14.3c-3.5-2.7-10-4.1-19.4-4.1H290V981.6z M258.9,1088.7V957.5h55.4
            	c18.3,0,31.9,3.3,40.8,10c8.9,6.7,13.4,17,13.4,30.9c0,9.3-2.3,17.1-6.8,23.4c-4.5,6.3-11.2,11-20,14.1l29.5,52.8H336l-25.4-46.4
            	h-20.9v46.4H258.9z M131.4,1088.7V957.5h56.1c16.9,0,29.3,2.6,37.4,7.8c7.9,5.2,11.9,13.4,11.9,24.4c0,9.4-2.6,16.8-7.9,22.1
            	c-5.2,5.3-12.8,8.2-22.5,8.8c12.3,1.1,21.2,4.2,26.7,9.2s8.2,12.5,8.2,22.6c0,7.1-1.7,13.4-5.1,18.8c-3.3,5.5-8,9.5-14.1,12.2
            	c-4.3,1.9-9,3.1-14.2,4c-5.2,0.8-13.4,1.3-24.4,1.3H131.4z M162.3,1032.8v32.3h19.5c11.2,0,18.6-1.3,22.4-3.5
            	c3.8-2.4,5.7-6.6,5.7-12.5c0-6.1-1.9-10.2-5.6-12.6c-3.8-2.4-11.3-3.5-22.4-3.5h-19.6V1032.8z M163.2,981.1v27.9h17.6
            	c9.9,0,16.6-1,20.1-3.1c3.5-2.1,5.3-5.6,5.3-10.9s-1.8-8.9-5.2-10.9c-3.4-2.1-10.2-3.1-20.2-3.1h-17.6V981.1z"/>
            	<path d="M775.8,1054.8H807v31.2h-31.2V1054.8z" fill="#9E0038"/>
            </svg>
          </a>


<?php /*
          <div class="square-1 aspect-square bg-white w-48 absolute left-0 top-0 z-0 pointer-events-none"></div>
          <div class="square-3 aspect-square bg-white w-48 absolute left-0 top-0 z-0 pointer-events-none"></div>
          <div class="square-4 aspect-square bg-white w-48 absolute left-0 top-0 z-0 pointer-events-none"></div>
          <div class="square-5 aspect-square bg-white w-48 absolute left-0 top-0 z-0 pointer-events-none"></div>
          <div class="square-6 aspect-square bg-white w-48 absolute left-0 top-0 z-0 pointer-events-none"></div>
          <div class="square-7 hover:bg-white hover:text-secondary-500 transition-colors duration-500 aspect-square bg-secondary-500 w-48 absolute left-0 top-0 z-0 flex items-center justify-center text-white cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20" class="w-12 h-12">
                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
              </svg>
          </div>
*/ ?>


          <div class="square aspect-square bg-white h-1/4 absolute right-0 bottom-0 origin-top-left z-0 pointer-events-none"></div>
          <div class="square aspect-square bg-secondary-500 h-1/4 absolute right-0 bottom-0 z-0 origin-top-left pointer-events-none"></div>
          <div class="square aspect-square bg-secondary-500 h-1/4 absolute left-0 top-0 z-0 origin-top-left pointer-events-none"></div>
          <div class="square aspect-square bg-white h-1/4 absolute left-0 top-0 z-10 origin-top-left pointer-events-none"></div>
          <div class="square aspect-square bg-white h-1/4 absolute left-0 top-0 z-10 origin-top-left pointer-events-none"></div>
          <div class="square aspect-square bg-white h-1/4 absolute left-0 bottom-0 z-10 origin-top-left pointer-events-none"></div>

          <?php if( $video_id): ?>
                <div @click="$refs.header_video.show()" class="square hover:bg-white hover:text-secondary-500 transition-colors duration-500 aspect-square bg-secondary-500 h-1/4 origin-top-left absolute right-0 bottom-0 z-0 flex items-center justify-center text-white cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20" class="w-12 h-12">
                      <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                    </svg>
                </div>
          <?php endif; ?>

        <div class="md:w-2/3 lg:px-8 py-16 leading-none flex items-end relative">
          <h1
          data-aos="fade-up"
          data-delay="0.1"
          class="fluid-5xl font-normal"
          ><?php
              if ( is_post_type_archive() ){
                post_type_archive_title();
              }elseif(is_category()){
                single_cat_title();
              }else{
                the_title();
              }
              ?></h1>
        </div>
      </div>
  </div>
</section>
<?php if( $video_id): ?>
<modal ref="header_video" variant="video">
  <video-player provider="<?= $provider; ?>" video_id="<?= $video_id; ?>" :autoplay="true"></video-player>
</modal>
<?php endif; ?>
