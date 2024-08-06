<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpBrigade_challenge
 */

?>
	<footer id="colophon" class="site-footer" style="background-image: url('<?php echo get_template_directory_uri() . "/assets/images/pettern-3.png"; ?>');">
    <div class="footer-widgets">
        <div class="footer-column footer-column-1">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <?php dynamic_sidebar('footer-1'); ?>
            <?php endif; ?>
        </div>
        <div class="footer-column footer-column-2" >
            <?php if (is_active_sidebar('footer-2')) : ?>
                <?php dynamic_sidebar('footer-2'); ?>
            <?php endif; ?>
        </div>
        <div class="footer-column footer-column-3">
            <?php if (is_active_sidebar('footer-3')) : ?>
                <?php dynamic_sidebar('footer-3'); ?>
            <?php endif; ?>
        </div>
    </div>

    <?php
$options = get_option('theme_options_settings');
if (isset($options['footer_disclaimer']) && $options['footer_disclaimer']) {
     echo '<div class="footer-disclaimer">' . wpautop($options['footer_disclaimer_content']) . '</div>';
    // echo '<div class="footer-disclaimer">';
    // echo '<h3>Disclaimer:</h3>';
    // echo wpautop($options['footer_disclaimer_content']);
    // echo '</div>';
}
?>
</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
