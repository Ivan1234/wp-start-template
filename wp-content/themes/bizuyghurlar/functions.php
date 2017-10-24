<?php
function theme_scripts()
{
    // Register and including styles
    wp_enqueue_style('main_style', get_template_directory_uri().'/css/style.min.css', array(), false, '');
    wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/fonts.min.css', array(), false, '');
    wp_enqueue_style('theme-fonts', get_template_directory_uri().'/css/theme-fonts.css', array(), false, '');
    
    // Register and including scripts
    //wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', get_theme_file_uri( 'libs/jquery/dist/jquery.min.js' ), false, null, true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('main_scripts', get_template_directory_uri().'/js/scripts.min.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );



function bizuyghurlar_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'bizuyghurlar' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bizuyghurlar' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'bizuyghurlar-featured-image', 2000, 1200, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'bizuyghurlar' ),
		'social' => __( 'Social Links Menu', 'bizuyghurlar' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );


}
add_action( 'after_setup_theme', 'bizuyghurlar_setup' );


/*function starter_customize_register( $wp_customize ) 
{
    $wp_customize->add_section( 'header_section' , array(
        'title'    => __( 'Header', 'starter' ),
        'priority' => 30
    ) );   

    $wp_customize->add_setting( 'header_overlay' , array(
        'default'   => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_overlay', array(
        'label'    => __( 'Header Overlay', 'starter' ),
        'section'  => 'header_section',
        'settings' => 'header_overlay',
    ) ) );
}
add_action( 'customize_register', 'starter_customize_register');*/

function get_intro_post ($post_obj) { 
	if ($post_obj) {
		ob_start(); ?>
		<div class="home-intro__item">
			<?php
			$excerpt = get_the_excerpt( $post_obj );
			$thumbnail = get_the_post_thumbnail( $post_obj->ID, 'large' ); 
			if ($thumbnail) { ?>
				<div class="home-intro__image">
					<span class="home-intro__label">
						<?php _e('Последние новости', 'bizuyghurlar'); ?>
					</span>
					<a href="<?php echo get_permalink($post_obj); ?>">
						<?php echo $thumbnail; ?>
					</a>
				</div>
			<?php } ?>
			<div class="home-intro__title">
				<a href="<?php echo get_permalink($post_obj); ?>">
					<?php echo $post_obj->post_title; ?>
				</a>
			</div>
			<div class="home-intro__excerpt">
				<?php 
				if ($post_obj->post_excerpt) {
					echo $post_obj->post_excerpt;
				} else {
					echo wp_trim_words( $post_obj->post_content, 28, ' ...' );	
				} ?>
			</div>
			<div class="home-intro__read_more">
				<a href="<?php echo get_permalink($post_obj); ?>">
					<?php _e('Читать далее', 'bizuyghurlar'); ?>
				</a>
			</div>
		</div>
		<?php 
		$result = ob_get_contents();
		ob_clean();
		return $result;
	}
	return '';
}


// Add term page
function bizuyghurlar_category_add_new_meta_field() {
    // this will add the custom meta field to the add new term page
    ?>
    <div class="form-field">
        <label for="term_meta[custom_color]"><?php _e( 'Сolor', 'bizuyghurlar' ); ?></label>
        <input type="color" name="term_meta[custom_color]" id="term_meta[custom_color]" value="">
        <p class="description"><?php _e( 'Enter a value for this field','bizuyghurlar' ); ?></p>
    </div>
<?php
}
add_action( 'category_add_form_fields', 'bizuyghurlar_category_add_new_meta_field', 10, 2 );

// Edit term page
function bizuyghurlar_category_edit_meta_field($term) {
 
    // put the term ID into a variable
    $t_id = $term->term_id;
 
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option( "taxonomy_$t_id" ); ?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[custom_color]"><?php _e( 'Сolor', 'bizuyghurlar' ); ?></label></th>
        <td>
            <input type="color" name="term_meta[custom_color]" id="term_meta[custom_color]" value="<?php echo esc_attr( $term_meta['custom_color'] ) ? esc_attr( $term_meta['custom_color'] ) : ''; ?>">
            <p class="description"><?php _e( 'Enter a value for this field','bizuyghurlar' ); ?></p>
        </td>
    </tr>
<?php
}
add_action( 'category_edit_form_fields', 'bizuyghurlar_category_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_category_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}  
add_action( 'edited_category', 'save_category_custom_meta', 10, 2 );  
add_action( 'create_category', 'save_category_custom_meta', 10, 2 );