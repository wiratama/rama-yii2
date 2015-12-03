<?php
/**
 * Grand Istama Rama functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Grand_Istama_Rama
 */

if ( ! function_exists( 'grand_istama_rama_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function grand_istama_rama_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Grand Istama Rama, use a find and replace
	 * to change 'grand-istama-rama' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'grand-istama-rama', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'grand-istama-rama' ),
		'sechond' => esc_html__( 'Sechond Menu', 'grand-istama-rama' ),
		
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'grand_istama_rama_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // grand_istama_rama_setup
add_action( 'after_setup_theme', 'grand_istama_rama_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function grand_istama_rama_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'grand_istama_rama_content_width', 640 );
}
add_action( 'after_setup_theme', 'grand_istama_rama_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function grand_istama_rama_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'grand-istama-rama' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'grand_istama_rama_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function grand_istama_rama_scripts() {
	wp_enqueue_style( 'grand-istama-rama-style', get_stylesheet_uri() );

	wp_enqueue_script( 'grand-istama-rama-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'grand-istama-rama-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'grand_istama_rama_scripts' );

function alter_comment_form_fields($fields){
    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Your name, please' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" placeholder="John Smith" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    $fields['email'] = '';  //removes email field
    $fields['url'] = '';  //removes website field
    return $fields;
}

add_filter('comment_form_default_fields','alter_comment_form_fields');

function get_benefitpage($atts) {
    extract( shortcode_atts( array('pageid' => get_the_ID(),'orderby'=> 'date','order'=> 'asc'), $atts ) );
    query_posts(array( 'post_type' =>'Benefit','paged' => $paged, 'orderby' => $orderby, 'order' => $order ) );
     global $more;
     while (have_posts()) : the_post();
    $more = 0; 
?>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                       <?php the_post_thumbnail('benefit-pic', array('class' => 'img-responsive full')); ?>
                       <h3 class="no-margin-bottom"><?php the_title(); ?></h3>
                       <hr class="member-line">
                       <?php the_content(); ?>
                   </div>                   
<?php endwhile; /*wp_pagenavi();*/ wp_reset_query(); ?> 

<?php } 
function cleanbenefitloop($atts){
    ob_start();
        get_benefitpage($atts);
        $output_string=ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode('benefit', 'cleanbenefitloop');

function get_newpage($atts) {
    extract( shortcode_atts( array('pageid' => get_the_ID(),'orderby'=> 'date','order'=> 'asc'), $atts ) );
    query_posts(array( 'post_type' =>'new','paged' => $paged, 'orderby' => $orderby, 'order' => $order ) );
     global $more;
     while (have_posts()) : the_post();
    $more = 0; 
?>
                  <div div class="col-md-12 jarak-content">
                    <div class="col-md-4">
                      <?php the_post_thumbnail('new-pic', array('class' => 'img-responsive full')); ?><!-- <img src="images/news-img.jpg" class="img-repsonsive" style="border-radius: 5px;"> -->
                    </div>
                    <div class="col-md-8">
                      <h3><?php the_title(); ?></h3>
                      <p><?php $content = get_the_content(); echo mb_strimwidth($content, 0, 300, '...');?> <a href="<?php the_permalink(); ?>">[ read more ]</a></p>
                    </div>
                  </div>
                  <div class="col-md-12"><hr></div>                    
<?php endwhile; /*wp_pagenavi();*/ wp_reset_query(); ?> 

<?php } 
function cleannewloop($atts){
    ob_start();
        get_newpage($atts);
        $output_string=ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode('new', 'cleannewloop');

function get_testimonialpage($atts) {
    extract( shortcode_atts( array('pageid' => get_the_ID(),'orderby'=> 'date','order'=> 'asc'), $atts ) );
    query_posts(array( 'post_type' =>'Testimonial','paged' => $paged, 'orderby' => $orderby, 'order' => $order ) );
     global $more;
     while (have_posts()) : the_post();
    $more = 0; 
?>
                    <div class="col-md-12">
                      <div class="col-md-3">
                      	<?php the_post_thumbnail('testimonial-pic', array('class' => 'img-rounded img-testimonial center-block')); ?>
                      </div>
                      <div class="col-md-8">
                        <div class="triangle-border left">
                          <h4>"<?php the_title(); ?>"</h4>
                          <span class="testi-week">
                            <i>Reviewed by <?php the_field('review_by'); ?></i>
                          </span>
                          <p class="text-justify"><?php the_content(); ?></p>
                        </div>
                      </div>
                    </div>
              
<?php endwhile; /*wp_pagenavi();*/ wp_reset_query(); ?> 

<?php } 
function cleantestimonialloop($atts){
    ob_start();
        get_testimonialpage($atts);
        $output_string=ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode('testimonial', 'cleantestimonialloop');

function get_awardpage($atts) {
    extract( shortcode_atts( array('pageid' => get_the_ID(),'orderby'=> 'date','order'=> 'asc'), $atts ) );
    query_posts(array( 'post_type' =>'award','paged' => $paged, 'orderby' => $orderby, 'order' => $order ) );
     global $more;
     while (have_posts()) : the_post();
    $more = 0; 
?>
                   <div class="col-md-4 col-sm-4 col-xs-12 jarak-content jarak-content">
                      <div class="box-awd">
                         <?php the_post_thumbnail('award-pic', array('class' => 'img-responsive full')); ?>
                        <h4> <?php the_title(); ?> </h4>
						<p><?php $content = get_the_content(); echo mb_strimwidth($content, 0, 235, '...');?></p>
                      </div>
                   </div>                   
<?php endwhile; /*wp_pagenavi();*/ wp_reset_query(); ?> 

<?php } 
function cleanawardloop($atts){
    ob_start();
        get_awardpage($atts);
        $output_string=ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode('award', 'cleanawardloop');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
require_once('wp_bootstrap_navwalker.php');
require_once('options/functions.php');