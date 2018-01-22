<?php get_header(); ?>

<div id='utama'>
<div id='k1' class='seksi'>
<div id='rela'>
<header id='naver'>
<div class='maxwid'>
<a class='img' href='<?php echo esc_url( home_url( '/' ) ); ?>'>
<img src='<?php echo esc_url( get_template_directory_uri() ); ?>/CSS/img/logo.png'/>
</a>
<nav id='navgay'>
<ul>
<li><a href='<?php echo esc_url( get_template_directory_uri() ); ?>/tentang'>Tentang Kami</a></li>
<li><a href='<?php echo esc_url( get_template_directory_uri() ); ?>/asuhan'>Asuhan</a></li>
<li><a href='<?php echo esc_url( get_template_directory_uri() ); ?>/program'>Program</a></li>
<li><a href='<?php echo esc_url( get_template_directory_uri() ); ?>/gallery'>Galeri</a></li>
<li><a href='#'>Donasi</a></li>
<li><a href='<?php echo esc_url( get_template_directory_uri() ); ?>/artikel'>Artikel</a></li>
<li><a href='<?php echo esc_url( get_template_directory_uri() ); ?>/kontak'>Kontak Kami</a></li>
</ul>
</nav>
<img class='img' src='<?php echo esc_url( get_template_directory_uri() ); ?>/CSS/img/logob.png'/>
</div>
</header>
<div id='slider'>
<ul class="rslides" id='sliders'>
  <li><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/Material/Images/foto/slide1.jpg" alt=""></li>
  <li><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/Material/Images/foto/slide4.jpg" alt=""></li>
  <li><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/Material/Images/foto/slide3.jpg" alt=""></li>
</ul>
</div>

<div id='horizon'>
<div class='anak tig'><div class='tabler'><div class='borderer'><img src='<?php echo esc_url( get_template_directory_uri() ); ?>/CSS/img/boy.png'/>  2000 anak asuhan</div></div></div> <div class='lansia tig'><div class='borderer'><div class='tabler'><img src='<?php echo esc_url( get_template_directory_uri() ); ?>/CSS/img/grandmother2.png'/> 2000 lansia asuhan</div></div></div> <div class='program tig'><div class='tabler'><div class='borderer'><img src='<?php echo esc_url( get_template_directory_uri() ); ?>/CSS/img/give-love.png'/> 100 program kebaikan</div></div></div>
<div style='clear: both;'></div>
</div>
</div>

</div>
<div id='k2' class='seksi'>
<div class='maxwid'>
<div id='pemul'>
<div id='hadis'>
Aku dan pemelihara anak yatim di surga seperti ini (dan beliau memberi isyarat dengan telunjuk dan jari tengahnya, lalu membukanya (HR. Bukhari, Turmudzi, Abu Daud)
</div></div>
<div class='grbox'>
<div class='padder'>
<div class='thumber'>
<img src=''/>
</div>
box dalemnya foto, teks,
<div class='bawah'>
<a href='#' class='lanjut'>Lebih Lanjut</a>
<div style='clear: both;'></div>
</div>
</div>
</div>
<div style='clear: both;'></div>
</div>
</div>
<div id='k3' class='seksi'>
<div class='maxwid'>
<div class='apader'>
<?php
	$idObj = get_category_by_slug('bio'); 
	$id = $idObj->term_id;
	$args = array( 'numberposts' => '1', 'cat' => '-'.$id, 'post_status' => 'publish' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo "<img width='225px' style='float:left;margin-right: 20px;margin-bottom:20px;' src='".getim($recent['post_content'])."'>";
		echo '<h2 class="blog-post-title"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a></h2> ';
		echo '<div class="blog-post-meta">'. date('d-m-Y', strtotime($recent["post_date"])) . '</div>';
        echo '<p>'.wp_trim_words(wp_strip_all_tags( $recent['post_content']),60). '</p>';
		//the_excerpt();
	}
	//wp_reset_query();
	//the_excerpt();
	//var_dump($recent);
?>
<div style='clear: both;'></div>
<div class='bawah'>
<a href='<?php echo esc_url( home_url( '/' ) )."artikel"; ?>' class='lanjut' target='_blank'>Lebih Lanjut</a>
<div style='clear: both;'></div>
</div>
</div>
</div>
</div>
<div id='k4' class='seksi'>
<div class='maxwid'>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Name of Widgetized Area") ) : ?>
<?php endif;?>

<div style='clear: both;'></div>
<div class='bawah'>
<a href='<?php echo esc_url( home_url( '/' ) )."gallery"; ?>' class='lanjut'>Lebih Lanjut</a>
<div style='clear: both;'></div>
</div>
</div>
<div style='clear: both;height:1px'></div>
</div>
<div id='k5' class='seksi'>
<div class='maxwid'>
<h3>Mari berdonasi</h3>
</div>
</div>

<!--include footer here-->
</div>


<?php get_footer(); ?>