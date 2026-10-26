<section class="relative">
    <?php if($headline = get_sub_field('headline')) : ?>
    <div class="leading-none mb-8">
      <h2 class="fluid-2xl"><?= $headline; ?></h2>
    </div>
    <?php endif; ?>

    <?php if(get_sub_field('provider') === 'youtube'){
       preg_match('#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', get_sub_field('video_url'), $matches);
       $provider = 'youtube';
       $source = $matches[0];
     }elseif(get_sub_field('provider') === 'vimeo') {
       preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', get_sub_field('video_url'), $matches);
       $provider = 'vimeo';
       $source = $matches[3];
     }

    ?>
    <div class="aspect-video overflow-hidden w-full">
        <video-player provider="<?= $provider; ?>" video_id="<?= $source; ?>"></video-player>
    </div>
</section>
