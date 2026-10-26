<?php
if (have_rows('blocks') && count(get_field('blocks'))) :
  $c = 0;
  while (have_rows('blocks')) : the_row();
   /**
   * Display block file name in dev mode
   */
    get_template_part( 'templates/dev/block', 'info', [
      'type' => 'block',
      'file' => get_row_layout()
    ]);
    /**
     * Render block
    */

    get_template_part( 'templates/blocks/' . get_row_layout() );
    if(is_singular( 'case-study' )) {
      if($c === 0 && get_row_layout() == 'intro'){
        get_template_part( 'templates/project', 'details');
      }
    }

    $c++;
  endwhile;
 endif;
