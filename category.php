<?php
/**
 * Category template – Sweety High Archive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="sh-site-main">

	<header class="sh-category-header">
		<h1 class="sh-category-title">
			<?php single_cat_title(); ?>
		</h1>
		<?php if ( category_description() ) : ?>
			<div class="sh-category-description">
				<?php echo category_description(); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( have_posts() ) : ?>

		<?php
		// First post as category hero.
		the_post();
		?>
		<section class="sh-hero-section">
			<div class="sh-hero-main">
				<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'sh-hero' ); ?>
					<?php endif; ?>
					<h2 class="sh-hero-main-title"><?php the_title(); ?></h2>
				</a>
				<div class="sh-hero-main-excerpt">
					<?php the_excerpt(); ?>
				</div>
			</div>
		</section>

		<section class="sh-category-grid">
			<div class="sh-post-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="sh-post-card">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'sh-card' ); ?>
							<?php endif; ?>
							<h3 class="sh-post-card-title"><?php the_title(); ?></h3>
						</a>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="sh-pagination">
				<?php the_posts_pagination(); ?>
			</div>
		</section>

	<?php else : ?>

		<p>No posts found in this category.</p>

	<?php endif; ?>

</main>

<?php
get_footer();