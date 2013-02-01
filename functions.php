<?php
$themename = "Kiera Theme";  
$shortname = "kt";  

$options = array (
    array( "name" => $themename." Options",
           "type" => "title"),
    array( "type" => "open"),
    array( "name" => "Menu position",
			"desc" => "Position of the main navigation menu",
			"id" => $shortname."_menu_position",
			"type" => "select",
			"options" => array("left", "right"),
			"std" => "left"),
	array( "name" => "Title position",
			"desc" => "Position of the site title",
			"id" => $shortname."_title_position",
			"type" => "select",
			"options" => array("left", "right"),
			"std" => "left"),
	array( "name" => "Content position",
			"desc" => "Position of the main content window",
			"id" => $shortname."_content_position",
			"type" => "select",
			"options" => array("left", "right"),
			"std" => "left"),
    array( "name" => "Description",
			"desc" => "Display description underneath the title",
			"id" => $shortname."_description",
			"type" => "checkbox",
			"std" => ""),
	array( "name" => "Footer copyright notice",
			"desc" => "Year and copyright notice in the footer",
			"id" => $shortname."_copyright",
			"type" => "checkbox",
			"std" => ""),
    array( "name" => "Footer left text",
           "desc" => "Enter text used in the right side of the footer. It can be HTML",
           "id" => $shortname."_footer_left",
           "type" => "text",
           "std" => ""),
    array( "name" => "Footer right text",
           "desc" => "Enter text used in the right side of the footer. It can be HTML",
           "id" => $shortname."_footer_right",
           "type" => "text",
           "std" => ""),
    array( "name" => "Show theme author",
			"desc" => "Display theme author in footer (THANKS)",
			"id" => $shortname."_author",
			"type" => "checkbox",
			"std" => ""),
    array( "name" => "Google Analytics Code",
           "desc" => "Paste your Google Analytics or other tracking code in this box.",
           "id" => $shortname."_ga_code",
           "type" => "textarea",
           "std" => ""),
    array( "type" => "close"));
	
function kiera_add_admin() {
	global $themename, $shortname, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
			header("Location: themes.php?page=functions.php&saved=true");
			die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] ); }
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
	}
	add_menu_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'kiera_admin');
}

function kiera_add_init() {
}

require_once('includes/ajax.php');

require_once('includes/options.php');



if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

}

/*
 * ========================================================================
 * Functions
 * ========================================================================
 */

//  navigation
function navigation_menu()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'nav', 
		'container_class' => 'nav-collapse collapse', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="nav">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load Custom Theme Scripts using Enqueue
function kiera_scripts()
{
    if (!is_admin()) {

        wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        
        wp_register_script('TweenLite', get_template_directory_uri() . '/js/TweenLite.min.js', array('jquery'), '1.0.0'); // TweenLite
        wp_enqueue_script('TweenLite'); // Enqueue it!
        
        wp_register_script('CSSPlugin', get_template_directory_uri() . '/js/CSSPlugin.min.js', array('jquery'), '1.0.0'); // CSS Plugin for TweenLite
        wp_enqueue_script('CSSPlugin'); // Enqueue it!
        
        wp_register_script('ImagesLoaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array('jquery'), '1.0.0'); // JQuery Images Loaded
        wp_enqueue_script('ImagesLoaded'); // Enqueue it!
        
        wp_register_script('jscrollpane', get_template_directory_uri() . '/js/jquery.jscrollpane.min.js', array('jquery'), '1.0.0'); // JScrollPane Scroller
        wp_enqueue_script('jscrollpane'); // Enqueue it!
        
        wp_register_script('jquerymouse', get_template_directory_uri() . '/js/jquery.mousewheel.js', array('jquery'), '1.0.0'); // jQuery Mousewheel
        wp_enqueue_script('jquerymouse'); // Enqueue it!
        
        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0'); // Twitter Bootstrap
        wp_enqueue_script('bootstrap'); // Enqueue it!
        
        wp_register_script('mainjs', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('mainjs'); // Enqueue it!
        
        wp_register_script('ajaxjs', get_template_directory_uri() . '/js/ajax.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('ajaxjs'); // Enqueue it!
    }
}


// Theme Stylesheets using Enqueue
function kiera_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/stylesheets/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!
    
    wp_register_style('bootstrap', get_template_directory_uri() . '/stylesheets/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!
    
    wp_register_style('bootstrapresponsive', get_template_directory_uri() . '/stylesheets/bootstrap-responsive.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrapresponsive'); // Enqueue it!
    
    wp_register_style('scrollpanestyle', get_template_directory_uri() . '/stylesheets/jquery.jscrollpane.css', array(), '1.0', 'all');
    wp_enqueue_style('scrollpanestyle'); // Enqueue it!
    
    wp_register_style('mainstyle', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('mainstyle'); // Enqueue it!
    
    wp_register_style('screenstyle', get_template_directory_uri() . '/stylesheets/screen.css', array(), '1.0', 'all');
    wp_enqueue_style('screenstyle'); // Enqueue it!
    
    wp_register_style('printstyle', get_template_directory_uri() . '/stylesheets/print.css', array(), '1.0', 'all');
    wp_enqueue_style('printstyle'); // Enqueue it!
    
    wp_register_style('iestyle', get_template_directory_uri() . '/stylesheets/ie.css', array(), '1.0', 'all');
    wp_enqueue_style('iestyle'); // Enqueue it!
}

// Load Optimised Google Analytics in the footer
// Change the UA-XXXXXXXX-X to your Account ID
function add_google_analytics()
{
    $google = "<!-- Google Analytics -->";
    $google .= "<script>";
    $google .= "var _gaq=[['_setAccount','UA-XXXXXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));";
    $google .= "</script>";
    echo $google;
}


// Register Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5wp_view_article($more)
{
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*
 * ========================================================================
 * Actions + Filters + ShortCodes
 * ========================================================================
 */

// Add Actions
add_action('init', 'kiera_scripts'); // Add Custom Scripts
add_action('wp_footer', 'add_google_analytics'); // Google Analytics optimised in footer
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'kiera_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5wp_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*
 * ========================================================================
 * Custom Post Types
 * ========================================================================
 */

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
            'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
            'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*
 * ========================================================================
 *  Shortcodes
 * ========================================================================
 */

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

?>
