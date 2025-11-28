<?php
/**
 * Header template for SweetyHigh GeneratePress Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<?php
/**
 * generate_before_header hook.
 */
do_action( 'generate_before_header' );
?>

<header <?php generate_do_attr( 'header' ); ?>>
	<?php
	/**
	 * generate_header hook.
	 *
	 * @hooked generate_construct_header - 10
	 */
	do_action( 'generate_header' );
	?>
</header>

<?php
/**
 * generate_after_header hook.
 */
do_action( 'generate_after_header' );
?>

<div id="page" class="site grid-container container hfeed">
	<div id="content" class="site-content">