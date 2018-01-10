<?php get_header(); ?>
<html>
<head>
<title>Homepage</title>
<link  rel='stylesheet' type='text/css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/css/micin.css'/>
<style>
@font-face {
    font-family: roboto;
    src: url(./Font/Roboto-Regular.ttf);
}
@font-face {
    font-family: rosarivo;
    src: url(./Font/Rosarivo-Regular.ttf);
}
/*
*/
</style>
<script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/JS/jquery.js'></script>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/responsiveslides.css">
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/responsiveslides.min.js"></script>

</head>
<body>
<div id='utama'>
<div id='k1' class='seksi'>
<div id='rela'>
Logo Tentang kami Asuhan Program Galeri Donasi Artikel Kontak Kami
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
	$idObj = get_category_by_slug('testimoni'); 
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
<a href='<?php echo esc_url( home_url( '/' ) )."blog"; ?>' class='lanjut' target='_blank'>Lebih Lanjut</a>
<div style='clear: both;'></div>
</div>
</div>
</div>
</div>
<div id='k4' class='seksi'>
<div class='maxwid'>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Name of Widgetized Area") ) : ?>
<?php endif;?>
<!--<a class='testimon' style='' ><span class='textOverImage'>
									
						</span></a>
						<a class='testimon' style='' ><span class='textOverImage'>
									
						</span></a>
						<a class='testimon' style='' ><span class='textOverImage'>
									
						</span></a>
						<a class='testimon' style='' ><span class='textOverImage'>
									
						</span></a>
						<a class='testimon' style='' ><span class='textOverImage'>
									
						</span></a>
						<a class='testimon' style='' ><span class='textOverImage'>
									
						</span></a>-->
<div style='clear: both;'></div>
<div class='bawah'>
<a href='#' class='lanjut'>Lebih Lanjut</a>
<div style='clear: both;'></div>
</div>
</div>
<div style='clear: both;height:1px'></div>
</div>
<div id='k5' class='seksi'>
<div class='maxwid'>
Mari berdonasi
</div>
</div>

<!--include footer here-->
</div>


<?php get_footer(); ?>