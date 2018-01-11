<?php get_header(); ?>

<?php if(is_page(17)) { ?>
<div class='maxwid'>
 <?php
    $gallery_shortcode = '[gallerys id="' . intval( $post->post_parent ) . '"]';
    print apply_filters( 'the_content', $gallery_shortcode );
 ?>
 </div>
<?php }else{ ?>
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
					get_template_part( 'content-single', get_post_format() );
  
				endwhile; endif; 
			?>
<?php } ?>

<?php get_footer(); ?>