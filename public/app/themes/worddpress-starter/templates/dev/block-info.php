<?php if(WP_ENV === 'development'): ?>
<div class="relative z-10">
  <div class="absolute left-0 top-0 text-xs flex group">
    <div class="transition-all flex items-center absolute inset-y-0 p-2 px-4 bg-white whitespace-nowrap -left-[400px] group-hover:left-8"><?= $args['type'] .': '. basename($args['file'], ".php"); ?></div>
    <div class="bg-secondary-500 text-white relative p-2">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="block w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
      </svg>
    </div>
  </div>
</div>
<?php endif; ?>
