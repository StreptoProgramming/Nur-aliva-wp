<?php get_header(); $category_id = get_cat_ID( 'testimoni' );?>
<div id='content'>
	<div class="row">
		<div class="col-sm-12">

			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
	get_template_part( 'content-single', get_post_format() );

	if ( comments_open() || get_comments_number() ) :
	  comments_template();
	endif;

endwhile; ?>

<div class="pager">
	<div class='buttonb' id='pp'><?php
	if(!has_category('testimoni')){
if($link = get_previous_post_link('%link','Sebelumnya',TRUE,$category_id )) {
	previous_post_link( '%link','Sebelumnya',TRUE,$category_id );
	} else {
		echo "<span>Sebelumnya</span>";
	}
	}else{
		if($link = get_previous_post_link('%link','Sebelumnya',TRUE)) {
	previous_post_link( '%link','Sebelumnya',TRUE);
	} else {
		echo "<span>Sebelumnya</span>";
	}
	}
	?></div>
		<div class='buttonb' id='pn'><?php
		if(!has_category('testimoni')){
    if($link = get_next_post_link('%link', 'Selanjutnya',TRUE,$category_id )) {
	next_post_link( '%link', 'Selanjutnya',TRUE,$category_id );
	} else {
		echo "<span>Selanjutnya</span>";
	}
		}else{
		    if($link = get_next_post_link('%link', 'Selanjutnya',TRUE)) {
	next_post_link( '%link', 'Selanjutnya',TRUE);
	} else {
		echo "<span>Selanjutnya</span>";
	}	
		}
?></div>
		<div style='clear:both'></div>
	</div>

<?php endif; 
			?>

		</div> <!-- /.col -->
	</div> <!-- /.row -->
</div>
<?php get_footer(); ?>