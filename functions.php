<?php

function exclude_category( $query ) {
$idObj = get_category_by_slug('bio'); 
$id = $idObj->term_id;
if ( $query->is_home() && $query->is_main_query() ) {
$query->set( 'cat', '-'.$id );
}
}
add_action( 'pre_get_posts', 'exclude_category' );
add_filter('jpeg_quality', function($arg){return 100;});
function getim($d) {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  if ( has_post_thumbnail() ) {
	  $thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
	  $first_img =$thumb_url[0];
  }
	  else {
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $d, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = esc_url( get_template_directory_uri() )."/Material/Images/default.jpg";
  }
	  }
  return $first_img;
}

add_filter('pre_get_posts', 'posts_in_category');

function posts_in_category($query){
    if ($query->is_category) {
        if (is_category('testimoni')) {
            $query->set('posts_per_archive_page', 12);
        }
    }

}
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/*CSS CUSTOM*/

/*custom*/
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Name of Widgetized Area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  )
);

/*widget gallery*/
function wpse97413_register_custom_widgets() {
    register_widget( 'wpse97411_Widget_Media_Gallery' );
}
add_action( 'widgets_init', 'wpse97413_register_custom_widgets' );
?>

<?php
/**
 * Widget API: WP_Widget_Media_Gallery class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.9.0
 */

/**
 * Core class that implements a gallery widget.
 *
 * @since 4.9.0
 *
 * @see WP_Widget
 */
 function wp_get_attachment_links( $id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false, $attr = '' ) {
	$_post = get_post( $id );

	if ( empty( $_post ) || ( 'attachment' !== $_post->post_type ) || ! $url = wp_get_attachment_url( $_post->ID ) ) {
		return __( 'Missing Attachment' );
	}

	if ( $permalink ) {
		$url = get_attachment_link( $_post->ID );
	}

	if ( $text ) {
		$link_text = $text;
	} elseif ( $size && 'none' != $size ) {
		$link_text = wp_get_attachment_images( $_post->ID, $size, $icon, $attr );
	} else {
		$link_text = '';
	}

	if ( '' === trim( $link_text ) ) {
		$link_text = $_post->post_title;
	}

	if ( '' === trim( $link_text ) ) {
		$link_text = esc_html( pathinfo( get_attached_file( $_post->ID ), PATHINFO_FILENAME ) );
	}
	/**
	 * Filters a retrieved attachment page link.
	 *
	 * @since 2.7.0
	 *
	 * @param string       $link_html The page link HTML output.
	 * @param int          $id        Post ID.
	 * @param string|array $size      Size of the image. Image size or array of width and height values (in that order).
	 *                                Default 'thumbnail'.
	 * @param bool         $permalink Whether to add permalink to image. Default false.
	 * @param bool         $icon      Whether to include an icon. Default false.
	 * @param string|bool  $text      If string, will be link text. Default false.
	 */
	return apply_filters( 'wp_get_attachment_link', "$link_text", $id, $size, $permalink, $icon, $text );
}
 function wp_get_attachment_images($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
	$html = '';
	$image = wp_get_attachment_image_src($attachment_id, $size, $icon);
	if ( $image ) {
		list($src, $width, $height) = $image;
		$hwstring = image_hwstring($width, $height);
		$size_class = $size;
		if ( is_array( $size_class ) ) {
			$size_class = join( 'x', $size_class );
		}
		$attachment = get_post($attachment_id);
		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size_class size-$size_class testimon",
		);

		$attr = wp_parse_args( $attr, $default_attr );

		// Generate 'srcset' and 'sizes' if not already present.
		if ( empty( $attr['srcset'] ) ) {
			$image_meta = wp_get_attachment_metadata( $attachment_id );

			if ( is_array( $image_meta ) ) {
				$size_array = array( absint( $width ), absint( $height ) );
				$srcset = wp_calculate_image_srcset( $size_array, $src, $image_meta, $attachment_id );
				$sizes = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment_id );

				/*if ( $srcset && ( $sizes || ! empty( $attr['sizes'] ) ) ) {
					//$attr['srcset'] = $srcset;

					if ( empty( $attr['sizes'] ) ) {
						$attr['sizes'] = $sizes;
					}
				}*/
			}
		}

		/**
		 * Filters the list of attachment image attributes.
		 *
		 * @since 2.8.0
		 *
		 * @param array        $attr       Attributes for the image markup.
		 * @param WP_Post      $attachment Image attachment post.
		 * @param string|array $size       Requested size. Image size or array of width and height values
		 *                                 (in that order). Default 'thumbnail'.
		 */
		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
		$attr = array_map( 'esc_attr', $attr );
		$html = rtrim("<img $hwstring");
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	}

	return $html;
}
function gallery_shortcodes( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filters the default gallery shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default gallery template.
	 *
	 * @since 2.5.0
	 * @since 4.2.0 The `$instance` parameter was added.
	 *
	 * @see gallery_shortcode()
	 *
	 * @param string $output   The gallery output. Default empty.
	 * @param array  $attr     Attributes of the gallery shortcode.
	 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
	 */
	$output = apply_filters( 'post_gallery', '', $attr, $instance );
	if ( $output != '' ) {
		return $output;
	}

	$html5 = current_theme_supports( 'html5', 'gallerys' );
	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';

	/**
	 * Filters whether to print default gallery styles.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $print Whether to print default gallery styles.
	 *                    Defaults to false if the theme supports HTML5 galleries.
	 *                    Otherwise, defaults to true.
	 */
	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$gallery_style = "";
	}

	$size_class = sanitize_html_class( $atts['size'] );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

	/**
	 * Filters the default gallery shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $gallery_style Default CSS styles and opening HTML div container
	 *                              for the gallery shortcode output.
	 */
	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	$j = 0;
	$reverse = array_reverse($attachments,true);
	foreach ( $reverse as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_links( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_images( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_links( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "";
		$output .= "
				$image_output";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "";
		}
		$output .= "";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
		$j++;
		if($j==6){break;}
	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}

	$output .= "
		</div>\n";

	return $output;
}
function gallery_shortcodese( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filters the default gallery shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default gallery template.
	 *
	 * @since 2.5.0
	 * @since 4.2.0 The `$instance` parameter was added.
	 *
	 * @see gallery_shortcode()
	 *
	 * @param string $output   The gallery output. Default empty.
	 * @param array  $attr     Attributes of the gallery shortcode.
	 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
	 */
	$output = apply_filters( 'post_gallery', '', $attr, $instance );
	if ( $output != '' ) {
		return $output;
	}

	$html5 = current_theme_supports( 'html5', 'gallerys' );
	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';

	/**
	 * Filters whether to print default gallery styles.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $print Whether to print default gallery styles.
	 *                    Defaults to false if the theme supports HTML5 galleries.
	 *                    Otherwise, defaults to true.
	 */
	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$gallery_style = "";
	}

	$size_class = sanitize_html_class( $atts['size'] );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

	/**
	 * Filters the default gallery shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $gallery_style Default CSS styles and opening HTML div container
	 *                              for the gallery shortcode output.
	 */
	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	$j = 0;
	$reverse = array_reverse($attachments,true);
	foreach ( $reverse as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_links( $id, $atts['size'], false, false, false, $attr,1 );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_images( $id, $atts['size'], false, $attr,1 );
		} else {
			$image_output = wp_get_attachment_links( $id, $atts['size'], true, false, false, $attr,1 );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "";
		$output .= "
				$image_output";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "";
		}
		$output .= "";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
		$j++;

	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}

	$output .= "
		</div>\n";

	return $output;
}
add_shortcode('gallerys', 'gallery_shortcodese');
class wpse97411_Widget_Media_Gallery extends WP_Widget_Media {

	/**
	 * Constructor.
	 *
	 * @since 4.9.0
	 */
	public function __construct() {
		parent::__construct( 'media_gallery', __( 'Gallery Edit Klik Panah di Kanan' ), array(
			'description' => __( 'Displays an image gallery.' ),
			'mime_type'   => 'image',
		) );

		$this->l10n = array_merge( $this->l10n, array(
			'no_media_selected' => __( 'No images selected' ),
			'add_media' => _x( 'Add Images', 'label for button in the gallery widget; should not be longer than ~13 characters long' ),
			'replace_media' => '',
			'edit_media' => _x( 'Edit Gallery', 'label for button in the gallery widget; should not be longer than ~13 characters long' ),
		) );
	}

	/**
	 * Get schema for properties of a widget instance (item).
	 *
	 * @since 4.9.0
	 *
	 * @see WP_REST_Controller::get_item_schema()
	 * @see WP_REST_Controller::get_additional_fields()
	 * @link https://core.trac.wordpress.org/ticket/35574
	 * @return array Schema for properties.
	 */
	public function get_instance_schema() {
		$schema = array(
			'title' => array(
				'type' => 'string',
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',
				'description' => __( 'Title for the widget' ),
				'should_preview_update' => false,
			),
			'ids' => array(
				'type' => 'array',
				'items' => array(
					'type' => 'integer',
				),
				'default' => array(),
				'sanitize_callback' => 'wp_parse_id_list',
			),
			'columns' => array(
				'type' => 'integer',
				'default' => 3,
				'minimum' => 1,
				'maximum' => 9,
			),
			'size' => array(
				'type' => 'string',
				'enum' => array_merge( get_intermediate_image_sizes(), array( 'full', 'custom' ) ),
				'default' => 'thumbnail',
			),
			'link_type' => array(
				'type' => 'string',
				'enum' => array( 'post', 'file', 'none' ),
				'default' => 'post',
				'media_prop' => 'link',
				'should_preview_update' => false,
			),
			'orderby_random' => array(
				'type'                  => 'boolean',
				'default'               => false,
				'media_prop'            => '_orderbyRandom',
				'should_preview_update' => false,
			),
		);

		/** This filter is documented in wp-includes/widgets/class-wp-widget-media.php */
		$schema = apply_filters( "widget_{$this->id_base}_instance_schema", $schema, $this );

		return $schema;
	}

	/**
	 * Render the media on the frontend.
	 *
	 * @since 4.9.0
	 *
	 * @param array $instance Widget instance props.
	 * @return void
	 */
	public function render_media( $instance ) {
		$instance = array_merge( wp_list_pluck( $this->get_instance_schema(), 'default' ), $instance );

		$shortcode_atts = array_merge(
			$instance,
			array(
				'link' => $instance['link_type'],
			)
		);

		// @codeCoverageIgnoreStart
		if ( $instance['orderby_random'] ) {
			$shortcode_atts['orderby'] = 'rand';
		}

		// @codeCoverageIgnoreEnd
		echo gallery_shortcodes( $shortcode_atts );
	}

	/**
	 * Loads the required media files for the media manager and scripts for media widgets.
	 *
	 * @since 4.9.0
	 */
	public function enqueue_admin_scripts() {
		parent::enqueue_admin_scripts();

		$handle = 'media-gallery-widget';
		wp_enqueue_script( $handle );

		$exported_schema = array();
		foreach ( $this->get_instance_schema() as $field => $field_schema ) {
			$exported_schema[ $field ] = wp_array_slice_assoc( $field_schema, array( 'type', 'default', 'enum', 'minimum', 'format', 'media_prop', 'should_preview_update', 'items' ) );
		}
		wp_add_inline_script(
			$handle,
			sprintf(
				'wp.mediaWidgets.modelConstructors[ %s ].prototype.schema = %s;',
				wp_json_encode( $this->id_base ),
				wp_json_encode( $exported_schema )
			)
		);

		wp_add_inline_script(
			$handle,
			sprintf(
				'
					wp.mediaWidgets.controlConstructors[ %1$s ].prototype.mime_type = %2$s;
					_.extend( wp.mediaWidgets.controlConstructors[ %1$s ].prototype.l10n, %3$s );
				',
				wp_json_encode( $this->id_base ),
				wp_json_encode( $this->widget_options['mime_type'] ),
				wp_json_encode( $this->l10n )
			)
		);
	}

	/**
	 * Render form template scripts.
	 *
	 * @since 4.9.0
	 */
	public function render_control_template_scripts() {
		parent::render_control_template_scripts();
		?>
		<script type="text/html" id="tmpl-wp-media-widget-gallery-preview">
			<# var describedById = 'describedBy-' + String( Math.random() ); #>
			<# if ( data.ids.length ) { #>
				<div class="gallery media-widget-gallery-preview">
					<# _.each( data.ids, function( id, index ) { #>
						<#
						var attachment = data.attachments[ id ];
						if ( ! attachment ) {
							return;
						}
						#>
						<# if ( index < 6 ) { #>
						
								<# if ( attachment.sizes.thumbnail ) { #>
									<img src="{{ attachment.sizes.thumbnail.url }}" width="{{ attachment.sizes.thumbnail.width }}" height="{{ attachment.sizes.thumbnail.height }}" alt="" />
								<# } else { #>
									<img src="{{ attachment.url }}" alt="" />
								<# } #>
								<# if ( index === 5 && data.ids.length > 6 ) { #>
									
								<# } #>
								
						<# } #>
					<# } ); #>
				</div>
			<# } else { #>
				<div class="attachment-media-view">
					<p class="placeholder"><?php echo esc_html( $this->l10n['no_media_selected'] ); ?></p>
				</div>
			<# } #>
		</script>
		<?php
	}

	/**
	 * Whether the widget has content to show.
	 *
	 * @since 4.9.0
	 * @access protected
	 *
	 * @param array $instance Widget instance props.
	 * @return bool Whether widget has content.
	 */
	protected function has_content( $instance ) {
		if ( ! empty( $instance['ids'] ) ) {
			$attachments = wp_parse_id_list( $instance['ids'] );
			foreach ( $attachments as $attachment ) {
				if ( 'attachment' !== get_post_type( $attachment ) ) {
					return false;
				}
			}
			return true;
		}
		return false;
	}
}
?>