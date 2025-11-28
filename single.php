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
                    <span class="sh-meta-author">By <?php the_author(); ?></span>
                    <span class="sh-meta-date"> • <?php echo get_the_date(); ?></span>
                    <span class="sh-meta-cat"> • <?php the_category(', '); ?></span>
                </div>

                
                <!-- ARTICLE CONTENT -->
                <div class="sh-content">
                    <?php the_content(); ?>
                </div>

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
