<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpBrigade_challenge
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php
echo 'Debug: Entering sidebar.php';
if (is_active_sidebar('sidebar-1')) :
?>
    <aside id="secondary" class="widget-area">
        <?php
        echo 'Debug: Before dynamic_sidebar';
        dynamic_sidebar('sidebar-1');
        echo 'Debug: After dynamic_sidebar';
        ?>
    </aside>
<?php endif; ?>


<!-- <aside id="secondary" class="widget-area">
	<php dynamic_sidebar( 'sidebar-1' ); ?>
</aside> -->


<!-- #secondary -->
