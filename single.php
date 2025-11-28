<?php
/**
 * Single Article Template – SweetyHigh Accurate Layout
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<!-- FULL-WIDTH AD ABOVE TITLE -->
<div class="sh-fullwidth-ad-top">
    <?php echo do_shortcode('[ad_block_1]'); ?>
</div>

<div id="sh-article-container">

    <div class="sh-article-grid">

        <!-- LEFT COLUMN -->
        <div class="sh-article-left">

            <?php while ( have_posts() ) : the_post(); ?>

            <article <?php post_class('sh-article'); ?>>

                <!-- POST TITLE -->
                <h1 class="sh-title"><?php the_title(); ?></h1>

                <!-- META -->
                <div class="sh-meta">
                    <span class="sh-meta-author"><?php the_author(); ?></span>
                    <span class="sh-meta-date"><?php echo get_the_date(); ?></span>
                </div>

                <!-- FEATURED IMAGE -->
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="sh-featured-image">
                    <?php the_post_thumbnail( 'large' ); ?>
                    <?php 
                    $caption = get_the_post_thumbnail_caption();
                    if ( $caption ) : ?>
                        <p class="sh-featured-caption"><?php echo esc_html( $caption ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- ARTICLE CONTENT -->
                <div class="sh-content">
                    <?php the_content(); ?>
                </div>

                <!-- TAGS -->
                <?php 
                $tags = get_the_tags();
                if ( $tags ) : ?>
                <div class="sh-tags">
                    <?php 
                    foreach ( $tags as $tag ) {
                        echo '<span class="sh-tag">' . esc_html( $tag->name ) . '</span>';
                    }
                    ?>
                </div>
                <?php endif; ?>

                <!-- SUGGESTED ARTICLES -->
                <div class="sh-suggested">
                    <h2 class="sh-suggested-title">Suggested Articles</h2>
                    <?php echo do_shortcode('[relatedposts]'); ?>
                </div>

            </article>

            <?php endwhile; ?>

        </div>

        <!-- RIGHT SIDEBAR -->
        <aside class="sh-sidebar">
            <div class="sh-sidebar-sticky">

                <div class="sh-sidebar-ad">
                    <?php echo do_shortcode('[sidebar_ad_top]'); ?>
                </div>

                <div class="sh-sidebar-ad">
                    <?php echo do_shortcode('[sidebar_ad_second]'); ?>
                </div>

            </div>
        </aside>

    </div><!-- .sh-article-grid -->

</div><!-- #sh-article-container -->

<?php get_footer(); ?>
