<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my-tpl-resume
 */

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
