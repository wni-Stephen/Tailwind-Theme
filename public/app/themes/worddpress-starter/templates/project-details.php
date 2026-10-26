<?php
  $project = [];
  $n = 0;

  if($client = get_field('client'))
    $project['Client'] = $client;
  if($value = get_field('value'))
    $project['Value'] = $value;
  if($duration = get_field('duration'))
    $project['Duration'] = $duration;

?>

<?php if($total = count($project)): ?>
<section class="my-8 md:my-16">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-xl mx-auto relative">
    <div class="grid lg:grid-cols-3 gap-4 lg:gap-x-16">
      <?php foreach ($project as $key => $value): $n++; ?>
        <div class="md:pr-8 xl:pr-16 <?php if($n < $total): ?>pb-8 lg:pb-0 border-b lg:border-b-0 lg:border-r<?php endif; ?>" data-aos="fade">
          <div class="uppercase mb-4 text-sm tracking-wide"><?= $key; ?></div>
          <div class="leading-tight">
            <h2 class="text-xl"><?= $value; ?></h2>
          </div>
        </div>
      <?php  endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
