<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package my-tpl-resume
 */

get_header();
?>

<section class="nothing-found" is="tpl-nothing-found">
    <div class="container-center">
        <div class="nothing-found-wrapper">
            <div class="nothing-found-box">
                <h1><?php pll_e( 'Title Nothing Found', 'my-tpl-resume' ); ?></h1>
                <?php pll_e( 'Description Nothing Found', 'my-tpl-resume' ); ?>
            </div>
            <a href="<?= get_permalink(pll_get_post(2)); ?>"><?php pll_e( 'Page link Nothing Found', 'my-tpl-resume' ); ?></a>
        </div>
    </div>
</section>

<?php
get_footer();
