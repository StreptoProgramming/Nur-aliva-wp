<?php get_header(); ?>
<div id='content'>
<!--BLOMG DI EDIT BLOG-->
 
			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
				get_template_part( 'content', get_post_format() );
  
			endwhile; ?>
			
	<div class="pager">
	<div class='buttonb' id='pp'><?php 
if($link = get_previous_posts_link()) {
	previous_posts_link( 'Sebelumnya' );
	} else {
		echo "<span>Sebelumnya</span>";
	}
	?></div>
		<div class='buttonb' id='pn'><?php
    if($link = get_next_posts_link()) {
	next_posts_link( 'Selanjutnya' );
	} else {
		echo "<span>Selanjutnya</span>";
	}
?></div>
		<div style='clear:both'></div>
	</div>
<?php endif; 
			?>

</div>
<!--BLOMG DI EDIT BLOG END-->
<?php get_footer(); ?>