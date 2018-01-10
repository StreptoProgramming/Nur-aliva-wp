<?php
/**
* A Simple Category Template
*/
get_header();
?> 
<div id='content'>

<?php if(is_category( 'testimoni' )){
?>

 <div>
 <h2 class='lovestory'>LOVE STORIES</h2>
			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();?>
									<a class='testimon' style='background-image:url(<?php echo getim(get_the_content());?>)' href="<?php the_permalink(); ?>"><span class='textOverImage'>
									<span class='tcont'><span class='tjud'><?php the_title(); ?></span><span class='tbod'><?php echo mb_strimwidth(wp_strip_all_tags(get_the_content()),0,250, '...');?></span></span>
						</span></a>

			<?php endwhile; ?>
			

						
						
			<div style='clear:both'></div>
			</div>
					


			<nav>

</nav> 

<?php endif;?>
<?php }else{ ?>
			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
				get_template_part( 'content', get_post_format() );
  
			endwhile; ?>
			
<?php endif; 
			?>
<?php } ?>
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
</div>

<?php get_footer(); ?>