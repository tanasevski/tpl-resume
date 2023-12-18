<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my-tpl-resume
 */

?>

<section class="nothing-found" is="tpl-nothing-found" data-scroll-section>
    <div class="container-center">
        <div class="nothing-found-wrapper">
            <div class="nothing-found-box">
                <div class="overflow">
                    <h1 class="t-100 d-3s" data-scroll><?php pll_e( 'Title Nothing Found', 'my-tpl-resume' ); ?></h1>
                </div>
                <div class="overflow">
                    <div class="t-100 d-4s" data-scroll><?php pll_e( 'Description Nothing Found', 'my-tpl-resume' ); ?></div>
                </div>
            </div>
            <div class="overflow">
                <div class="t-100 d-5s" data-scroll>
                    <a href="<?= get_permalink(pll_get_post(2)); ?>"><?php pll_e( 'Page link Nothing Found', 'my-tpl-resume' ); ?></a>
                </div> 
            </div>
        </div>
    </div>
</section>
