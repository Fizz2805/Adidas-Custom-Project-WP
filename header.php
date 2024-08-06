<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpBrigade_challenge
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
    <!-- for facebook like page -->
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v20.0" nonce="8XYHeF0N"></script>

</head>

<!-- -------//TOP NAVIGATION CUSTOMIZATION Options START----------  -->
<?php
$options = get_option('theme_options_settings');
if (isset($options['top_navigation']) && $options['top_navigation']) {
    echo '<div style="margin-top: 30px; display: flex; align-items: center; justify-content: center;" class="top-navigation-content">';
    echo '<div class="nav-content-text">';
    echo wp_kses_post($options['top_navigation_content']);
    if (isset($options['top_navigation_link']) && !empty($options['top_navigation_link'])) {
        echo ' <a href="' . esc_url($options['top_navigation_link']) . '" style="text-decoration: underline; color: #217f40;">Watch Now</a>';
    }
    echo '</div>';
    echo '<img src="' . get_template_directory_uri() . '/assets/images/icons8-cross-24.png" alt="Your Image" class="nav-content-image" style="margin-left: 20px;"/>';
    echo '</div>';
}
?>
<!-- -------//TOP NAVIGATION CUSTOMIZATION Options END----------  -->

<!-- -------//CUSTOM & DEFAULT LOGO START----------  -->
<?php
function your_theme_custom_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/adidas2.png" alt="Default Logo">';
    }
}
?>
<!-- -------//CUSTOM & DEFAULT LOGO END----------  -->



<!-- -------//Secondary Menu, Search Bar And Primary Menu----------  -->
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wpbrigade-challenge' ); ?></a>

    <header id="masthead" class="site-header">
        <!-- <div class="header-background" style="background-image: url('<php echo get_the_post_thumbnail_url() ? esc_url(get_the_post_thumbnail_url()) : get_template_directory_uri() . "/assets/images/pettern-2.png"; ?>');"> -->
        <div class="header-background" style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-2.png"; ?>');">
            <div class="site-logo">
                <?php your_theme_custom_logo(); ?>
            </div>
            <nav class="secondary-menu">
                <?php wp_nav_menu(array('theme_location' => 'secondary')); ?>
            </nav>
        </div>

        <!-- <div class="primary-menu-container" style="background-image: url('<php echo get_the_post_thumbnail_url() ? esc_url(get_the_post_thumbnail_url()) : get_template_directory_uri() . "/assets/images/pettern-3.png"; ?>');"> -->
		<div class="primary-menu-container" style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-3.png"; ?>');">
            <nav class="primary-menu">
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'primary-menu',
                )); ?>
            </nav>
            <div class="search-bar">
                <?php get_search_form(); ?>
            </div>
        </div>
        <!-- <button class="hamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button> -->
    </header><!-- #masthead -->

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
        </main><!-- #main -->
    </div><!-- #primary -->

    <?php wp_footer(); ?>
</div><!-- #page -->
</body>