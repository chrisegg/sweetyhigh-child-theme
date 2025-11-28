<?php
/**
 * Front page template – Sweety High Homepage
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main class="sh-site-main">

	<?php
	// HERO SECTION – latest posts from "featured" category.
	$hero_query = new WP_Query( array(
		'posts_per_page' => 5,
		'category_name'  => 'featured', // change to your real slug
	) );
	?>

	<?php if ( $hero_query->have_posts() ) : ?>
		<section class="sh-hero-section">
			<div class="sh-hero-grid">
				<div class="sh-hero-main">
					<?php
					// First post as main hero.
					$hero_query->the_post();
					?>
					<a href="<?php the_permalink(); ?>">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'sh-hero' );
						}
						?>
						<h2 class="sh-hero-main-title"><?php the_title(); ?></h2>
					</a>
					<div class="sh-hero-main-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>

				<div class="sh-hero-side-list">
					<?php
					// Remaining posts on the side.
					while ( $hero_query->have_posts() ) :
						$hero_query->the_post();
						?>
						<article>
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'sh-card' ); ?>
								<?php endif; ?>
								<h3><?php the_title(); ?></h3>
							</a>
						</article>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php
	// SECOND SECTION – e.g. latest "news" category posts.
	$news_query = new WP_Query( array(
		'posts_per_page' => 9,
		'category_name'  => 'news', // change to your real category
	) );
	?>

	<?php if ( $news_query->have_posts() ) : ?>
		<section class="sh-section-news">
			<header class="sh-category-header">
				<h2 class="sh-category-title">Latest News</h2>
			</header>

			<div class="sh-post-grid">
				<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
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
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

</main>

<?php
get_footer();