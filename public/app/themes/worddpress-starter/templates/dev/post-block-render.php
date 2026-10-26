<?php
if (have_rows('blocks') && count(get_field('blocks'))) :
  ?><div class="space-y-8 lg:space-y-16"><?php
  while (have_rows('blocks')) : the_row();
    /**
     * Render block
    */
    get_template_part( 'templates/posts/' . get_row_layout() );
  endwhile;
  ?></div><?php
 endif;
