<html>
<head>
<title><?php if ( is_category() ) {
	echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
} elseif ( is_tag() ) {
	echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
} elseif ( is_archive() ) {
	wp_title(''); echo ' Archive | '; bloginfo( 'name' );
} elseif ( is_search() ) {
	echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
} elseif ( is_home() || is_front_page() ) {
	bloginfo( 'name' );
}  elseif ( is_404() ) {
	echo 'Error 404 Not Found | '; bloginfo( 'name' );
} elseif ( is_single() ) {
	wp_title('');
} else {
	echo wp_title( ' | ', false, right ); bloginfo( 'name' );
} ?></title>
<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php the_excerpt_rss(); ?>" />
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php endif; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="<?php echo esc_url( home_url( '/' ) ); ?>/favicon.ico">
<link  rel='stylesheet' type='text/css' href='<?php echo esc_url( get_template_directory_uri() ); ?>/index.css'/>
<script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/JS/jquery.js'></script>
<!-- Stylesheet -->
<!--<link rel="stylesheet" href="./CSS/fss.css">-->
<!--<script src="<?php //echo esc_url( get_template_directory_uri() ); ?>/JS/fss.js"></script>-->
<link  rel='stylesheet' type='text/css' href='./css/micin.css'/>
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
<?php if (is_front_page()) { ?>


<link rel="stylesheet" href="./css/responsiveslides.css">
  <script src="./js/responsiveslides.min.js"></script>
<?php } ?>

<style type='text/css'>
<?php
if( is_page() || is_single() ){
 $custom_fields = get_post_custom($post_id);//Current post id
  $my_custom_field = $custom_fields['css'];//key name
  if(isset($my_custom_field)){
  foreach ( $my_custom_field as $key => $value )
  echo $value;
  }
}
?>
</style>

</head>
<body>