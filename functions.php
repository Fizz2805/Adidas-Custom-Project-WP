<?php
/**
 * wpBrigade challenge functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpBrigade_challenge
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wpbrigade_challenge_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wpBrigade challenge, use a find and replace
		* to change 'wpbrigade-challenge' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wpbrigade-challenge', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wpbrigade-challenge' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	/* add_theme_support(
		'custom-background',
		apply_filters(
			'wpbrigade_challenge_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
 */

 function your_theme_setup() {
    // Add custom background support
    add_theme_support(
        'custom-background',
        apply_filters(
            'your_theme_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add custom logo support
    add_theme_support('custom-logo', array(
		'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));

	  // Register secondary menu
	  register_nav_menus(array(
        'secondary' => __('Secondary Menu', 'your-theme'),
    ));
}
add_action('after_setup_theme', 'your_theme_setup');



	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wpbrigade_challenge_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wpbrigade_challenge_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wpbrigade_challenge_content_width', 640 );
}
add_action( 'after_setup_theme', 'wpbrigade_challenge_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
// function wpbrigade_challenge_widgets_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => esc_html__( 'Sidebar', 'wpbrigade-challenge' ),
// 			'id'            => 'sidebar-1',
// 			'description'   => esc_html__( 'Add widgets here.', 'wpbrigade-challenge' ),
// 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 			'after_widget'  => '</section>',
// 			'before_title'  => '<h2 class="widget-title">',
// 			'after_title'   => '</h2>',
// 		)
// 	);
//     register_widget('Events_Widget'); // Ensure this line is present
//     error_log('Events Widget registered successfully'); // Debugging line
// }
// add_action( 'widgets_init', 'wpbrigade_challenge_widgets_init' );
// Register widget and sidebar
function wpbrigade_challenge_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'wpbrigade-challenge'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'wpbrigade-challenge'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_widget('Events_Widget');
}
add_action('widgets_init', 'wpbrigade_challenge_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function wpbrigade_challenge_scripts() {
	wp_enqueue_style( 'wpbrigade-challenge-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wpbrigade-challenge-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wpbrigade-challenge-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpbrigade_challenge_scripts' );

function theme_enqueue_scripts() {
    wp_enqueue_script('theme-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


function load_custom_fonts() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'load_custom_fonts');



function register_my_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
     'secondary' => __('Secondary Menu')
    ));
}
add_action('init', 'register_my_menus');

/* -------//GOOGLE FONTS---------- */

function theme_enqueue_styles() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', false);
    wp_enqueue_style('poppins-font', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap', false);
	// wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* -------//add Theme Options START---------- */

// Hook to add menu page
add_action('admin_menu', 'add_theme_options_page');

function add_theme_options_page() {
    add_menu_page(
        'Themes Option',        // Page title
        'Themes Option',        // Menu title
        'manage_options',       // Capability
        'themes-option',        // Menu slug
        'theme_options_page_html', // Callback function
        'dashicons-admin-generic', // Icon URL
        100                      // Position
    );
}

// Callback function to display the options page
function theme_options_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['settings-updated'])) {
        add_settings_error('theme_options_messages', 'theme_options_message', __('Settings Saved', 'theme-options'), 'updated');
    }

    settings_errors('theme_options_messages');
    ?>

    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('theme_options');
            do_settings_sections('themes-option');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

// Hook to register settings
add_action('admin_init', 'register_theme_options_settings');

function register_theme_options_settings() {
    register_setting('theme_options', 'theme_options_settings');

    add_settings_section(
        'theme_options_section_top_navigation', // ID
        'Top Navigation',                       // Title
        'theme_options_section_top_navigation_cb', // Callback
        'themes-option'                         // Page
    );

    add_settings_field(
        'top_navigation_option',                // ID
        'Enable Top Navigation',                // Title
        'top_navigation_option_cb',             // Callback
        'themes-option',                        // Page
        'theme_options_section_top_navigation'  // Section
    );

    add_settings_field(
        'top_navigation_content',               // ID
        'Top Navigation Content',               // Title
        'top_navigation_content_cb',            // Callback
        'themes-option',                        // Page
        'theme_options_section_top_navigation'  // Section
    );

    add_settings_field(
        'top_navigation_link',                  // ID
        'Top Navigation Link',                  // Title
        'top_navigation_link_cb',               // Callback
        'themes-option',                        // Page
        'theme_options_section_top_navigation'  // Section
    );
  // Add the disclaimer section
  add_settings_section(
    'theme_options_section_disclaimer', // ID
    'Footer Disclaimer',                // Title
    'theme_options_section_disclaimer_cb', // Callback
    'themes-option'                     // Page
);

add_settings_field(
    'footer_disclaimer',                // ID
    'Enable Footer Disclaimer',         // Title
    'footer_disclaimer_cb',             // Callback
    'themes-option',                    // Page
    'theme_options_section_disclaimer'  // Section
);

add_settings_field(
    'footer_disclaimer_content',        // ID
    'Footer Disclaimer Content',        // Title
    'footer_disclaimer_content_cb',     // Callback
    'themes-option',                    // Page
    'theme_options_section_disclaimer'  // Section
);
    
}

function theme_options_section_top_navigation_cb() {
    echo '<p>Settings for the top navigation bar.</p>';
}

function top_navigation_option_cb() {
    $options = get_option('theme_options_settings');
    ?>
    <input type="checkbox" name="theme_options_settings[top_navigation]" value="1" <?php checked(1, isset($options['top_navigation']) ? $options['top_navigation'] : 0); ?> />
    <?php
}

function top_navigation_content_cb() {
    $options = get_option('theme_options_settings');
    ?>
    <textarea name="theme_options_settings[top_navigation_content]" rows="5" cols="50"><?php echo isset($options['top_navigation_content']) ? esc_textarea($options['top_navigation_content']) : ''; ?></textarea>
    <?php
}

function top_navigation_link_cb() {
    $options = get_option('theme_options_settings');
    ?>
    <input type="url" name="theme_options_settings[top_navigation_link]" value="<?php echo isset($options['top_navigation_link']) ? esc_url($options['top_navigation_link']) : ''; ?>" size="50" />
    <?php
}

//disclaimer
function theme_options_section_disclaimer_cb() {
    echo '<p>Settings for the footer disclaimer.</p>';
}

function footer_disclaimer_cb() {
    $options = get_option('theme_options_settings');
    ?>
    <input type="checkbox" name="theme_options_settings[footer_disclaimer]" value="1" <?php checked(1, isset($options['footer_disclaimer']) ? $options['footer_disclaimer'] : 0); ?> />
    <?php
}

function footer_disclaimer_content_cb() {
    $options = get_option('theme_options_settings');
    ?>
    <textarea name="theme_options_settings[footer_disclaimer_content]" rows="5" cols="50"><?php echo isset($options['footer_disclaimer_content']) ? esc_textarea($options['footer_disclaimer_content']) : ''; ?></textarea>
    <?php
}

// Register the repeater settings
// Register the repeater settings
add_action('admin_init', 'register_slider_settings');




function register_slider_settings() {
    register_setting('theme_options', 'theme_options_settings');

    add_settings_section(
        'theme_options_section_slider', // ID
        'Slider Options',               // Title
        'theme_options_section_slider_cb', // Callback
        'themes-option'                 // Page
    );

    add_settings_field(
        'slider_repeater',              // ID
        'Image Slider',                 // Title
        'slider_repeater_cb',           // Callback
        'themes-option',                // Page
        'theme_options_section_slider'  // Section
    );
     // Debug saving process
    add_action('update_option_theme_options_settings', function($old_value, $value) {
        error_log(print_r($value, true)); // Log the options to debug
    }, 10, 2);
}

function theme_options_section_slider_cb() {
    echo '<p>Manage the image slider here.</p>';
}

function slider_repeater_cb() {
    $options = get_option('theme_options_settings');
    $slider_items = isset($options['slider_repeater']) ? $options['slider_repeater'] : array();
    ?>
    <div id="slider-repeater-container">
        <?php foreach ($slider_items as $index => $item): ?>
            <div class="slider-repeater-item">
                <input type="hidden" name="theme_options_settings[slider_repeater][<?php echo $index; ?>][index]" value="<?php echo esc_attr($index); ?>" />
                <label>Image</label>
                <input type="hidden" class="image-url" name="theme_options_settings[slider_repeater][<?php echo $index; ?>][image]" value="<?php echo esc_url($item['image']); ?>" />
                <img src="<?php echo esc_url($item['image']); ?>" class="image-preview" style="max-width: 150px; display: <?php echo esc_url($item['image']) ? 'block' : 'none'; ?>;" />
                <button type="button" class="upload_image_button button">Upload Image</button>
                <label>Title</label>
                <input type="text" name="theme_options_settings[slider_repeater][<?php echo $index; ?>][title]" value="<?php echo esc_attr($item['title']); ?>" />
                <label>Description</label>
                <textarea name="theme_options_settings[slider_repeater][<?php echo $index; ?>][description]"><?php echo esc_textarea($item['description']); ?></textarea>
                <label>Video Link</label>
                <input type="url" name="theme_options_settings[slider_repeater][<?php echo $index; ?>][video]" value="<?php echo esc_url($item['video']); ?>" />
                <button type="button" class="remove_slider_item_button button">Remove</button>
            </div>
        <?php endforeach; ?>
        <button type="button" id="add_slider_item_button" class="button">Add Slider Item</button>
    </div>
    <?php
}



//register repeater end 


function themee_enqueue_scripts() {
    wp_enqueue_style('slick-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_script('slick-script', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'themee_enqueue_scripts');

//wordpress media uploader

function enqueue_media_uploader() {
    wp_enqueue_media();
    wp_enqueue_script('theme-options-script', get_template_directory_uri() . '/assets/js/theme-options.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');




//for banner youtube popup
function enqueue_fancybox() {
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_fancybox');


//custom post slider try

function create_slider_cpt() {
    $labels = array(
        'name' => _x('Slider Posts', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Slider Post', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('Slider Posts', 'textdomain'),
        'all_items' => __('All Slider Posts', 'textdomain'),
        'add_new_item' => __('Add New Slider Post', 'textdomain'),
        'edit_item' => __('Edit Slider Post', 'textdomain'),
        'new_item' => __('New Slider Post', 'textdomain'),
        'view_item' => __('View Slider Post', 'textdomain'),
        'search_items' => __('Search Slider Posts', 'textdomain'),
        'not_found' => __('Not found', 'textdomain'),
        'not_found_in_trash' => __('Not found in Trash', 'textdomain'),
    );

    $args = array(
        'label' => __('Slider Post', 'textdomain'),
        'description' => __('Custom Post Type for Slider', 'textdomain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('slider', $args);
}
add_action('init', 'create_slider_cpt', 0);


//TABS START
// Register settings for Match Info, Match Results, and Match Schedule
// Register settings for Match Info, Match Results, and Match Schedule
add_action('admin_init', 'register_tab_content_settings');

function register_tab_content_settings() {
    register_setting('theme_options', 'theme_tab_content_settings');

    add_settings_section(
        'theme_options_section_tabs', // ID
        'Tabs Content',               // Title
        'theme_options_section_tabs_cb', // Callback
        'themes-option'               // Page
    );

    add_settings_field(
        'match_info_content',         // ID
        'Match Info Content',         // Title
        'match_info_content_cb',      // Callback
        'themes-option',              // Page
        'theme_options_section_tabs'  // Section
    );

    add_settings_field(
        'match_results_content',      // ID
        'Match Results Content',      // Title
        'match_results_content_cb',   // Callback
        'themes-option',              // Page
        'theme_options_section_tabs'  // Section
    );

    add_settings_field(
        'match_schedule_content',     // ID
        'Match Schedule Content',     // Title
        'match_schedule_content_cb',  // Callback
        'themes-option',              // Page
        'theme_options_section_tabs'  // Section
    );
}

function theme_options_section_tabs_cb() {
    echo '<p>Manage the content for the tabs.</p>';
}

function match_info_content_cb() {
    $options = get_option('theme_tab_content_settings');
    ?>
    <textarea name="theme_tab_content_settings[match_info_content]" rows="5" cols="50"><?php echo isset($options['match_info_content']) ? esc_textarea($options['match_info_content']) : ''; ?></textarea>
    <?php
}

function match_results_content_cb() {
    $options = get_option('theme_tab_content_settings');
    ?>
    <textarea name="theme_tab_content_settings[match_results_content]" rows="5" cols="50"><?php echo isset($options['match_results_content']) ? esc_textarea($options['match_results_content']) : ''; ?></textarea>
    <?php
}

function match_schedule_content_cb() {
    $options = get_option('theme_tab_content_settings');
    ?>
    <textarea name="theme_tab_content_settings[match_schedule_content]" rows="5" cols="50"><?php echo isset($options['match_schedule_content']) ? esc_textarea($options['match_schedule_content']) : ''; ?></textarea>
    <?php
}


//TABS END

/* -------//Add Theme Options END---------- */

function enqueue_slider_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_style('slider-style', get_template_directory_uri() . '/assets/css/slider.css');
    wp_enqueue_script('slider-script', get_template_directory_uri() . '/assets/js/slider.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_slider_scripts');


//custom post slider end


//sticky post start
function get_random_sticky_post() {
    // Get all sticky posts
    $sticky_posts = get_option('sticky_posts');

    if ($sticky_posts) {
        // Get a random sticky post
        $random_sticky_id = $sticky_posts[array_rand($sticky_posts)];

        // Fetch the post object
        $random_sticky_post = get_post($random_sticky_id);

        // Check if the post exists
        if ($random_sticky_post) {
            // Return the post object
            return $random_sticky_post;
        }
    }

    return null;
}



//side bar EVENTS WIDGET START

// Register Custom Post Type for events widget
function create_event_cpt() {
    $labels = array(
        'name' => _x('Events', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Event', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => _x('Events', 'Admin Menu text', 'textdomain'),
        'name_admin_bar' => _x('Event', 'Add New on Toolbar', 'textdomain'),
    );
    $args = array(
        'label' => __('Event', 'textdomain'),
        'description' => __('Events with date and time', 'textdomain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('event', $args);
}
add_action('init', 'create_event_cpt', 0);

// Add Custom Fields
function add_event_meta_boxes() {
    add_meta_box("event_date", "Event Date", "event_date_meta_box_markup", "event", "side", "high", null);
    add_meta_box("event_time", "Event Time", "event_time_meta_box_markup", "event", "side", "high", null);
}
add_action("add_meta_boxes", "add_event_meta_boxes");

function event_date_meta_box_markup($post) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    $event_date = get_post_meta($post->ID, "event_date", true);
    ?>
    <label for="event_date">Date</label>
    <input type="date" name="event_date" value="<?php echo $event_date; ?>">
    <?php
}

function event_time_meta_box_markup($post) {
    $event_time = get_post_meta($post->ID, "event_time", true);
    ?>
    <label for="event_time">Time</label>
    <input type="time" name="event_time" value="<?php echo $event_time; ?>">
    <?php
}

function save_event_meta_box($post_id, $post, $update) {
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if (!current_user_can("edit_post", $post_id))
        return $post_id;

    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "event";
    if ($slug != $post->post_type)
        return $post_id;

    $event_date = "";
    $event_time = "";

    if (isset($_POST["event_date"])) {
        $event_date = $_POST["event_date"];
    }
    update_post_meta($post_id, "event_date", $event_date);

    if (isset($_POST["event_time"])) {
        $event_time = $_POST["event_time"];
    }
    update_post_meta($post_id, "event_time", $event_time);
}
add_action("save_post", "save_event_meta_box", 10, 3);


//event widget reistration

class Events_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'events_widget',
            __('Events Widget', 'textdomain'),
            array('description' => __('Displays events with date and time', 'textdomain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', 'Events') . $args['after_title'];
        ?>
        <div id="events-widget">
            <div class="events-content">
                <!-- <p>Debug: Widget is running</p>
                <p>Simple Test: This is a test output</p> -->
                <?php $this->get_events(); ?>
            </div>
            <div class="event" style="color: #fff; background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-1.png"; ?>');">
            <div class="events-navigation">
                <button class="prev-events"></button>
                <button class="next-events"></button>
            </div>
    </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    private function get_events($offset = 0) {
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => 3,
            'offset' => $offset,
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => 'EXISTS',
                ),
                array(
                    'key' => 'event_time',
                    'compare' => 'EXISTS',
                ),
            ),
            'orderby' => 'meta_value',
            'order' => 'ASC',
        );

        $events_query = new WP_Query($args);
        if ($events_query->have_posts()) {
            echo '<p>Debug: Entering get_events method.</p>';
            while ($events_query->have_posts()) {
                $events_query->the_post();
                $event_date = get_post_meta(get_the_ID(), 'event_date', true);
                $event_time = get_post_meta(get_the_ID(), 'event_time', true);
                ?>
                
                <div class="event">
                   
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail();
                    } ?>
                    <div class="event-details">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo $event_date . ' at ' . $event_time; ?></p>
                    </div>
                </div>
                <?php
            }
            echo '<p>Debug: Found events. Exiting get_events method.</p>';
            wp_reset_postdata();
        } else {
            echo '<p>Debug: No events found.</p>';
        }
    }

    public function form($instance) {
        // Widget admin form
    }

    public function update($new_instance, $old_instance) {
        // Save widget options
    }
}

function register_events_widget() {
    register_widget('Events_Widget');
}
add_action('widgets_init', 'register_events_widget');


// displaying data on page
function handle_load_events() {
    if (!isset($_POST['offset'])) {
        wp_send_json_error('Offset not set.');
    }

    $offset = intval($_POST['offset']);
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => 3,
        'offset' => $offset,
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => 'EXISTS',
            ),
            array(
                'key' => 'event_time',
                'compare' => 'EXISTS',
            ),
        ),
        'orderby' => 'meta_value',
        'order' => 'ASC',
    );

    $events_query = new WP_Query($args);
    $first_event = true; // Initialize the first_event flag
    if ($events_query->have_posts()) {
        while ($events_query->have_posts()) {
            $events_query->the_post();
            $event_date = get_post_meta(get_the_ID(), 'event_date', true);
            $event_time = get_post_meta(get_the_ID(), 'event_time', true);
            ?>
          
                <!-- <div class="event-label">Eveggnts</div> -->
             <div class="event" style="color: #fff; background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-1.png"; ?>');">
             <?php if ($first_event): ?>
                    <div class="event-label" style=" padding: 10px; background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-3.png"; ?>');">EVENTS</div>
                    <?php $first_event = false; ?>
                <?php endif; ?>
            
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail();
                } ?>
                <div class="event-details">
                    <h3><?php the_title(); ?></h3>
                    <!-- <p><php echo $event_date . ' at ' . $event_time; ?></p> -->
                    <p><?php echo $event_date; ?></p>
                    <p><?php echo $event_time; ?></p>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    } 
    else {
        echo '<p>No more events.</p>';
    }

    wp_die(); // This is required to terminate immediately and return a proper response.
}
add_action('wp_ajax_load_events', 'handle_load_events');
add_action('wp_ajax_nopriv_load_events', 'handle_load_events');

// function load_events() {
//     echo 'Debug: AJAX Handler is working';
//     wp_die();
// }
// add_action('wp_ajax_load_events', 'load_events');
// add_action('wp_ajax_nopriv_load_events', 'load_events');

// function load_events() {
//     $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

//     // Basic validation
//     if (!is_numeric($offset)) {
//         wp_send_json_error('Invalid offset.');
//         wp_die();
//     }

//     // Output buffering
//     ob_start();

//     try {
//         $events_widget = new Events_Widget();
//         $events_widget->get_events($offset);
//         $content = ob_get_clean();
//         wp_send_json_success($content);
//     } catch (Exception $e) {
//         error_log('Error loading events: ' . $e->getMessage());
//         wp_send_json_error('Error loading events.');
//     }

//     wp_die(); // Always call wp_die() to end AJAX processing
// }
// add_action('wp_ajax_load_events', 'load_events');
// add_action('wp_ajax_nopriv_load_events', 'load_events');





// enqueue widget scripts 

function enqueue_events_widget_scripts() {
    wp_enqueue_script('events-widget-ajax', get_template_directory_uri() . '/assets/js/events-widget-ajax.js', array('jquery'), null, true);
    wp_localize_script('events-widget-ajax', 'events_ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_events_widget_scripts');

function enqueue_custom_scripts() {
    wp_enqueue_script('events-widget-ajax', get_template_directory_uri() . '/assets/js/events-widget-ajax.js', array('jquery'), null, true);
    wp_localize_script('events-widget-ajax', 'ajaxobject', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&display=swap', false);
}
add_action('wp_enqueue_scripts', 'enqueue_google_fonts');


//WIDGET EVENT END 

define('OPENWEATHERMAP_API_KEY', '12ab7c641bb1c0b9fcba55133f6c3dd8');

// Register Weather Widget
function register_weather_widget() {
    register_widget('Weather_Widget');
}
add_action('widgets_init', 'register_weather_widget');

// Define the Weather Widget
class Weather_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'weather_widget', // Base ID
            'Weather Widget', // Name
            array('description' => __('A widget that displays the current weather.', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {
        $city = !empty($instance['city']) ? $instance['city'] : 'London';
        $api_key = '12ab7c641bb1c0b9fcba55133f6c3dd8'; // Replace with your actual API key
        $weather_data = $this->get_weather($city, $api_key);

        if ($weather_data && isset($weather_data->main) && isset($weather_data->weather[0])) {
            $temperature = $weather_data->main->temp - 273.15; // Convert from Kelvin to Celsius
            $weather_description = $weather_data->weather[0]->description;
            $city_name = $weather_data->name;
            $weather_icon = $weather_data->weather[0]->icon;
            $icon_url = "http://openweathermap.org/img/wn/{$weather_icon}.png";
    
            echo '<div class="weather-widget-block">';
            echo '<div class="weather-widget-block-heading" style="padding: 10px; background-image: url(\'' . get_template_directory_uri() . '/assets/images/pettern-3.png\');">Weather</div>';

            echo '<div class="weather-widget" style="padding: 10px; background-image: url(\'' . get_template_directory_uri() . '/assets/images/weather.avif\');">';
            echo '<h2 class="weather-title">Weather in ' . esc_html($city_name) . '</h2>';
            echo '<div class="weather-content">';
            echo '<img class="weather-icon" src="' . esc_url($icon_url) . '" alt="' . esc_attr($weather_description) . '">';
            echo '<p class="weather-temp">' . round($temperature) . '°C</p>';
            echo '<p class="weather-description">' . esc_html(ucfirst($weather_description)) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            // echo $args['before_widget'];
            // echo $args['before_title'] . 'Weather' . $args['after_title'];
            // echo '<p>City: ' . esc_html($city_name) . '</p>';
            // echo '<p>Temperature: ' . round($temperature) . '°C</p>';
            // echo '<p>Weather: ' . esc_html(ucfirst($weather_description)) . '</p>';
            // echo $args['after_widget'];
        } else {
            // echo $args['before_widget'];
            // echo $args['before_title'] . 'Weather' . $args['after_title'];
            // echo '<p>Unable to fetch weather data.</p>';
            // echo $args['after_widget'];
            echo '<div class="weather-widget">';
            echo '<h2 class="weather-title">Weather</h2>';
            echo '<p class="weather-error">Unable to fetch weather data.</p>';
            echo '</div>';
        }
        echo $args['after_widget'];
    }

    public function form($instance) {
        $city = !empty($instance['city']) ? $instance['city'] : 'London';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('city'); ?>">City:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo esc_attr($city); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['city'] = (!empty($new_instance['city'])) ? sanitize_text_field($new_instance['city']) : '';

        return $instance;
    }

    private function get_weather($city, $api_key) {
        $response = wp_remote_get("http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$api_key}");

        if (is_array($response) && !is_wp_error($response)) {
            $body = $response['body'];
            $weather_data = json_decode($body);

            // Remove the debugging output
            // echo '<pre>';
            // print_r($weather_data);
            // echo '</pre>';

            return $weather_data;
        } else {
            // Debugging: print the error
            // echo '<pre>';
            // print_r($response);
            // echo '</pre>';

            return false;
        }
    }
}


// DATE AND TIME WIDGET
// class Date_Time_Widget extends WP_Widget {
//     function __construct() {
//         parent::__construct(
//             'date_time_widget',
//             __('Date and Time Widget', 'text_domain'),
//             array('description' => __('A widget to display the current date and time of a selected city', 'text_domain'))
//         );
//     }

//     public function widget($args, $instance) {
//         $city = !empty($instance['city']) ? $instance['city'] : 'Europe/London';

//         // Fetch the current date and time of the selected city
//         $datetime = $this->get_city_datetime($city);

//         echo $args['before_widget'];
//         if (!empty($instance['title'])) {
//             echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
//         }

//         if ($datetime) {
//             echo '<div class="date-time-widget">';
//             echo '<p class="current-date">' . esc_html($datetime['date']) . '</p>';
//             echo '<p class="current-time">' . esc_html($datetime['time']) . '</p>';
//             echo '</div>';
//         } else {
//             echo '<p class="date-time-error">Unable to fetch date and time.</p>';
//         }

//         echo $args['after_widget'];
//     }

//     public function form($instance) {
//         $title = !empty($instance['title']) ? $instance['title'] : '';
//         $city = !empty($instance['city']) ? $instance['city'] : 'Europe/London';
//         >
//         <p>
//             <label for="<?php echo esc_attr($this->get_field_id('title')); >"><?php _e('Title:'); ></label>
//             <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); >" name="<?php echo esc_attr($this->get_field_name('title')); >" type="text" value="<?php echo esc_attr($title); >">
//         </p>
//         <p>
//             <label for="<?php echo esc_attr($this->get_field_id('city')); >"><?php _e('City Timezone:'); ></label>
//             <input class="widefat" id="<?php echo esc_attr($this->get_field_id('city')); >" name="<?php echo esc_attr($this->get_field_name('city')); >" type="text" value="<?php echo esc_attr($city); >" placeholder="e.g., Europe/London, America/New_York">
//         </p>
//         <?php
//     }

//     public function update($new_instance, $old_instance) {
//         $instance = array();
//         $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
//         $instance['city'] = (!empty($new_instance['city'])) ? strip_tags($new_instance['city']) : '';
//         return $instance;
//     }

//     private function get_city_datetime($city) {
//         $response = wp_remote_get("http://worldtimeapi.org/api/timezone/{$city}");

//         if (is_array($response) && !is_wp_error($response)) {
//             $body = json_decode($response['body'], true);
//             if (!empty($body) && isset($body['datetime'])) {
//                 $datetime = new DateTime($body['datetime']);
//                 $date = $datetime->format('l, d F, Y');
//                 $time = $datetime->format('H:i:s');
//                 return array('date' => $date, 'time' => $time);
//             }
//         }
//         return false;
//     }
// }

// function register_date_time_widget() {
//     register_widget('Date_Time_Widget');
// }

// add_action('widgets_init', 'register_date_time_widget');
// coorect above 


// Register Date and Time Widget
// Register Date and Time Widget
// function register_date_time_widget() {
//     register_widget('Date_Time_Widget');
// }
// add_action('widgets_init', 'register_date_time_widget');

// class Date_Time_Widget extends WP_Widget {
//     function __construct() {
//         parent::__construct(
//             'date_time_widget',
//             __('Date and Time Widget', 'text_domain'),
//             array('description' => __('Displays the current date and time of a selected city.', 'text_domain'))
//         );
//     }
//     public function widget($args, $instance) {
//         $timezone = !empty($instance['timezone']) ? $instance['timezone'] : 'UTC';
    
//         $date_time_data = $this->get_date_time($timezone);
    
//         echo $args['before_widget'];
//         echo '<div class="date-time-widget-block">';
//         echo '<div class="date-time-widget-block-heading">Date And Time</div>';
    
//         if ($date_time_data) {
//             echo '<div class="date-time-widget">';
//             echo '<p class="date-time-date">' . esc_html($date_time_data['date']) . '</p>';
//             echo '<p class="date-time-time">' . esc_html($date_time_data['time']) . '</p>';
//             echo '</div>';
//         } else {
//             echo '<p class="date-time-error">Unable to fetch data.</p>';
//         }
    
//         echo '</div>';
//         echo $args['after_widget'];
//     }
//     public function form($instance) {
//         $timezone = !empty($instance['timezone']) ? $instance['timezone'] : '';
//         >
//         <p>
//             <label for="<?php echo esc_attr($this->get_field_id('timezone')); >"><?php esc_attr_e('Time Zone:', 'text_domain'); ></label>
//             <input class="widefat" id="<?php echo esc_attr($this->get_field_id('timezone')); >" name="<?php echo esc_attr($this->get_field_name('timezone')); >" type="text" value="<?php echo esc_attr($timezone); >" placeholder="e.g., America/New_York">
//         </p>
//         <?php
//     }

//     public function update($new_instance, $old_instance) {
//         $instance = array();
//         $instance['timezone'] = (!empty($new_instance['timezone'])) ? strip_tags($new_instance['timezone']) : '';
//         return $instance;
//     }

//     private function get_date_time($timezone) {
//         $response = wp_remote_get("http://worldtimeapi.org/api/timezone/{$timezone}");
    
//         if (is_array($response) && !is_wp_error($response)) {
//             $body = wp_remote_retrieve_body($response);
//             $date_time_data = json_decode($body);
    
//             if (isset($date_time_data->datetime)) {
//                 $date_time = new DateTime($date_time_data->datetime);
//                 $formatted_date = $date_time->format('l, d F, Y');
//                 $formatted_time = $date_time->format('H:i:s');
//                 return array('date' => $formatted_date, 'time' => $formatted_time);
//             }
//         }
    
//         return false;
//     }
// }
class DateTime_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'date_time_widget',
            __('Date and Time Widget', 'text_domain'),
            array('description' => __('A Widget to display current date and time of a city', 'text_domain'))
        );
    }

    private function get_date_time($timezone) {
        // Check if we have a cached version of the data
        $transient_key = 'date_time_' . sanitize_title($timezone);
        $cached_data = get_transient($transient_key);

        if ($cached_data) {
            return $cached_data;
        }

        // Make the API request if no cached data
        $response = wp_remote_get("http://worldtimeapi.org/api/timezone/{$timezone}", array(
            'timeout' => 10 // Increase the timeout to 10 seconds
        ));

        if (is_wp_error($response)) {
            error_log(print_r($response, true)); // Log the error for debugging
            return false;
        }

        if (is_array($response) && !is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $date_time_data = json_decode($body);

            if (isset($date_time_data->datetime)) {
                $date_time = new DateTime($date_time_data->datetime);
                $formatted_date = $date_time->format('l, d F, Y');
                $formatted_time = $date_time->format('H:i:s');
                $data = array('date' => $formatted_date, 'time' => $formatted_time);
                
                // Cache the data for 10 minutes
                set_transient($transient_key, $data, 10 * MINUTE_IN_SECONDS);

                return $data;
            } else {
                error_log(print_r($date_time_data, true)); // Log the response for debugging
            }
        }

        return false;
    }

    public function widget($args, $instance) {
        $timezone = !empty($instance['timezone']) ? $instance['timezone'] : 'UTC';

        $date_time_data = $this->get_date_time($timezone);

        echo $args['before_widget'];
        echo '<div class="date-time-widget-block">';
        echo '<div class="date-time-widget-block-heading">Date & Time</div>';

        if ($date_time_data) {
            echo '<div class="date-time-widget">';
            echo '<p class="date-time-date">' . esc_html($date_time_data['date']) . '</p>';
            echo '<p class="date-time-time">' . esc_html($date_time_data['time']) . '</p>';
            echo '</div>';
        } else {
            echo '<p class="date-time-error">Unable to fetch data.</p>';
        }

        echo '</div>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        $timezone = !empty($instance['timezone']) ? $instance['timezone'] : 'UTC';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('timezone')); ?>"><?php esc_attr_e('Timezone:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('timezone')); ?>" name="<?php echo esc_attr($this->get_field_name('timezone')); ?>" type="text" value="<?php echo esc_attr($timezone); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['timezone'] = (!empty($new_instance['timezone'])) ? strip_tags($new_instance['timezone']) : 'UTC';

        // Clear the transient cache when the widget is updated
        $transient_key = 'date_time_' . sanitize_title($instance['timezone']);
        delete_transient($transient_key);

        return $instance;
    }
}

function register_date_time_widget() {
    register_widget('DateTime_Widget');
}
add_action('widgets_init', 'register_date_time_widget');



// DATE AND TIME WIDGET END

//side bar end


//footer area start
function register_footer_menu() {
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_footer_menu');

//register footer widget area 
function footer_widgets_init() {
    register_sidebar( array(
        'name'          => 'Footer Column 1',
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget footer-1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar( array(
        'name'          => 'Footer Column 2',
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-widget footer-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar( array(
        'name'          => 'Footer Column 3',
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer-widget footer-3">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'footer_widgets_init');


class Footer_Menu_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'footer_menu_widget', 
            __('Footer Menu Widget'), 
            array('description' => __('A Custom Footer Menu Widget'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        // Set default title to "Site Map"
        $title = !empty($instance['title']) ? $instance['title'] : 'Site Map';
        if (!empty($title)) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'container'      => 'div',
            'container_class'=> 'footer-menu',
        ));
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Site Map');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php 
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : 'Site Map';
        return $instance;
    }
}

function register_footer_menu_widget() {
    register_widget('Footer_Menu_Widget');
}
add_action('widgets_init', 'register_footer_menu_widget');
//footer menu widget end


//footer link widget start
// class Footer_Links_Widget extends WP_Widget {
//     function __construct() {
//         parent::__construct(
//             'footer_links_widget', 
//             __('Footer Links Widget'), 
//             array('description' => __('A Custom Footer Links Widget'))
//         );
//     }

//     public function widget($args, $instance) {
//         echo $args['before_widget'];
//         $title = !empty($instance['title']) ? $instance['title'] : 'Useful Links';
//         if (!empty($title)) {
//             echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
//         }
//         echo '<ul>';
//         // Add your links here
//         echo '<li><a href="https://example.com/link1">Link 1</a></li>';
//         echo '<li><a href="https://example.com/link2">Link 2</a></li>';
//         echo '<li><a href="https://example.com/link3">Link 3</a></li>';
//         echo '</ul>';
//         echo $args['after_widget'];
//     }

//     public function form($instance) {
//         $title = !empty($instance['title']) ? $instance['title'] : __('Useful Links');
//         >
//         <p>
//             <label for="<?php echo $this->get_field_id('title'); >"><?php _e('Title:'); ></label> 
//             <input class="widefat" id="<?php echo $this->get_field_id('title'); >" name="<?php echo $this->get_field_name('title'); >" type="text" value="<?php echo esc_attr($title); >">
//         </p>
//         <?php 
//     }

//     public function update($new_instance, $old_instance) {
//         $instance = array();
//         $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
//         return $instance;
//     }
// }

// function register_footer_links_widget() {
//     register_widget('Footer_Links_Widget');
// }
// add_action('widgets_init', 'register_footer_links_widget');





class Footer_Links_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'footer_links_widget',
            __('Footer Links Widget'),
            array('description' => __('A Custom Footer Links Widget'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : 'Useful Links';
        if (!empty($title)) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        echo '<ul>';
        for ($i = 1; $i <= 5; $i++) {
            if (!empty($instance['link' . $i]) && !empty($instance['text' . $i])) {
                echo '<li><a href="' . esc_url($instance['link' . $i]) . '">' . esc_html($instance['text' . $i]) . '</a></li>';
            }
        }
        echo '</ul>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Useful Links';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            $link = !empty($instance['link' . $i]) ? $instance['link' . $i] : '';
            $text = !empty($instance['text' . $i]) ? $instance['text' . $i] : '';
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('link' . $i); ?>"><?php printf(__('Link %s URL:'), $i); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('link' . $i); ?>" name="<?php echo $this->get_field_name('link' . $i); ?>" type="text" value="<?php echo esc_url($link); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('text' . $i); ?>"><?php printf(__('Link %s Text:'), $i); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('text' . $i); ?>" name="<?php echo $this->get_field_name('text' . $i); ?>" type="text" value="<?php echo esc_html($text); ?>">
            </p>
            <?php
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        for ($i = 1; $i <= 5; $i++) {
            $instance['link' . $i] = (!empty($new_instance['link' . $i])) ? strip_tags($new_instance['link' . $i]) : '';
            $instance['text' . $i] = (!empty($new_instance['text' . $i])) ? strip_tags($new_instance['text' . $i]) : '';
        }
        return $instance;
    }
}

function register_footer_links_widget() {
    register_widget('Footer_Links_Widget');
}
add_action('widgets_init', 'register_footer_links_widget');


//footer link widget end



//footer last widget start

function custom_footer_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Column 3', 'text_domain'),
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer-column-3">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'custom_footer_widgets_init');

function shortcode_current_year() {
    return date('Y');
}
add_shortcode('current_year', 'shortcode_current_year');

// Shortcode function to generate a link with optional title
function wpb_link_shortcode($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
            'url'   => '',
            'title' => '',
        ),
        $atts,
        'wpb-link'
    );

    // Return the link HTML
    return '<a href="' . esc_url($atts['url']) . '" title="' . esc_attr($atts['title']) . '">' . esc_html($atts['title']) . '</a>';
}
add_shortcode('wpb-link', 'wpb_link_shortcode');

// Example shortcode function
function simple_shortcode() {
    return 'This is a simple shortcode.';
}
add_shortcode('simple_shortcode', 'simple_shortcode');

add_filter('widget_text', 'do_shortcode');

// <img src="http://wp-theme-challenge.local/wp-content/uploads/2024/08/adidas2.png" alt="Footer Image" style="width: 200px;  max-height: 60px;">
// <p>Copyrights © [current_year]. All rights reserved.</p>
// <p>[wpb-link url="https://wpbrigade.com/terms-and-conditions/" title="Terms & Conditions"] | [wpb-link url="https://wpbrigade.com/privacy-policy/" title="Privacy Policy"]</p>
// <p>Designed by: WPBrigade</p>


//footer last widget end

//footer area end



//sticky post end


// Include the Composer autoload file
// require get_template_directory() . '/vendor/autoload.php';

// // Use the TwitterOAuth library
// use Abraham\TwitterOAuth\TwitterOAuth;

// // Define your Twitter API credentials
// define('CONSUMER_KEY', 'y6PvBJGlf0ibhFj5SmhvJ0mB6B');
// define('CONSUMER_SECRET', 'ZA89v9vF5L74xVq8dj37CjpQSlSA5SwnAViX5Na26q2TsNoBs');
// define('ACCESS_TOKEN', '1818990358417608704-1qFAQVkUv5gRICtO0S4Gv3Rd9yz3nw');
// define('ACCESS_TOKEN_SECRET', '553XSsyQdRVpGPc58pviRu214MFJeoYFIEcA4fZMezWzF');

// // Create a new TwitterOAuth object with increased timeout
// $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
// $twitter->setTimeouts(30, 60); // Increase the timeout to 30 seconds

// function fetch_and_display_tweets($count = 3) {
//     // Create a new TwitterOAuth object
//     $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

//     // Fetch tweets
//     $tweets = $connection->get("statuses/user_timeline", ["count" => $count]);

//     if ($connection->getLastHttpCode() == 200) {
//         return $tweets;
//     } else {
//         // Log the error code for debugging
//         error_log('Twitter API Error: ' . $connection->getLastHttpCode());
//         return [];
//     }
// }

// function display_custom_tweets() {
//     $tweets = fetch_and_display_tweets(3); // Fetch 3 tweets

//     if (empty($tweets)) {
//         return '<p>No tweets found or an error occurred.</p>';
//     }

//     $output = '<div class="tweets-container">';
//     foreach ($tweets as $tweet) {
//         $output .= '<div class="tweet">';
//         if (!empty($tweet->entities->media)) {
//             foreach ($tweet->entities->media as $media) {
//                 if ($media->type == 'photo') {
//                     $output .= '<div class="tweet-image"><img src="' . esc_url($media->media_url_https) . '" alt="Tweet Image"></div>';
//                 }
//             }
//         }
//         $output .= '<div class="tweet-content">';
//         $output .= '<p class="tweet-text">' . esc_html($tweet->text) . '</p>';
//         $output .= '</div>';
//         $output .= '</div>';
//     }
//     $output .= '</div>';

//     return $output;
// }

// // Register the shortcode
// add_shortcode('display_custom_tweets', 'display_custom_tweets');



// function get_youtube_embed_url($url) {
//     parse_str(parse_url($url, PHP_URL_QUERY), $query);
//     return 'https://www.youtube.com/embed/' . $query['v'];
// }






/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

?>