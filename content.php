<div class="blog-post rapiher">
	 <img width='225px' height='225px' src='<?php echo getim(get_the_content()); ?>'>
	 <h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	 <div class="blog-post-meta"><?php echo get_the_date('d/m/y'); ?></div>
	 <p><?php echo wp_trim_words(wp_strip_all_tags(get_the_content()),60) ?></p>
	
<div style='clear:both;'></div>
</div><!-- /.blog-post -->
