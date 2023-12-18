<?php
/**
 * Template Name: Home
 * Template Post Type: page
 */
__( 'Home', 'my-tpl-resume' );

get_header();
?>

<?php if( have_rows('resume_group') ): while ( have_rows('resume_group') ) : the_row();
$my_photo = get_sub_field('personal-photo');
$employment = get_sub_field_object('employment-repeater');
$skills = get_sub_field_object('skills');
$exp = get_sub_field_object('work-experiance');
$lang = get_sub_field_object('knowledge-languages');
$edu = get_sub_field_object('education');
$date = new DateTime(get_sub_field('my-start-date-work'));
$bday = new DateTime(get_sub_field('my-bday'));
?>
<main class="resume-card" is="my-resume">
    <aside class="resume-left">
        <div class="content">
            <div class="resume-left-wrapper">
                <?php if(ICL_LANGUAGE_CODE=='ru'): ?>
                    <div class="info-box photo-box">
                        <figure class="figure">       
                            <img src="<?= $my_photo['url'] ?>" alt="<?= $my_photo['alt'] ?>" title="<?= $my_photo['title'] ?>">
                        </figure>
                    </div>
                <?php endif; ?>
                <div class="info-box">
                    <h6 class="heading"><?= $employment['label']; ?></h6>
                    <ul class="list">
                        <?php if( have_rows('employment-repeater') ): while ( have_rows('employment-repeater') ) : the_row();
                        $employ = get_sub_field('employment');
                        $schedule = get_sub_field('schedule'); ?>
                        <li>
                            <span class="list-title"><?= $employ['label']; ?></span>
                            <span class="list-description"><?= $schedule['label']; ?></span>
                        </li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
                <div class="info-box">
                    <h6 class="heading"><?= $exp['label']; ?></h6>
                    <div class="exp-wrapper">
                        <ul class="list">
                            <?php if( have_rows('work-experiance') ): while ( have_rows('work-experiance') ) : the_row(); ?>
                            <li>
                                <span class="list-title"><?= get_sub_field('company'); ?></span>
                                <span class="list-description"><?= get_sub_field('experiance'); ?></span>
                            </li>
                            <?php endwhile; endif; ?>
                        </ul>
                        <div class="final-exp">
                            <span><?php if(ICL_LANGUAGE_CODE=='ru'): ?><?= $date->diff(new DateTime)->format('%y лет %m месяцев'); ?><?php elseif(ICL_LANGUAGE_CODE=='en'): ?><?= $date->diff(new DateTime)->format('%y years %m months'); ?><?php endif; ?></span>
                        </div>
                    </div>
                </div>
                <div class="info-box">
                    <h6 class="heading"><?= $skills['label']; ?></h6>
                    <ul class="skills">
                        <?php if( have_rows('skills') ): while ( have_rows('skills') ) : the_row(); ?>
                        <li><span><?= get_sub_field('skill'); ?></span></li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
                <div class="info-box">
                    <h6 class="heading"><?= $lang['label']; ?></h6>
                    <ul class="list">
                        <?php if( have_rows('knowledge-languages') ): while ( have_rows('knowledge-languages') ) : the_row();
                        $language_level = get_sub_field('lang-lvl');
                        ?>
                        <li>
                            <span class="list-title"><?= get_sub_field('lang-name'); ?></span>
                            <span class="list-description"><?= $language_level['label'] ?></span>
                    </li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <section class="resume-right">
        <div class="content">
            <div class="sub-line"><?= get_sub_field('my-position'); ?></div>
                <h1 class="h5 text-blue">
                    <?= get_sub_field('my-name'); ?>, <span class="text-blue-semi h6"><?php if(ICL_LANGUAGE_CODE=='ru'): ?><?= $bday->diff(new DateTime)->format('%y лет'); ?><?php elseif(ICL_LANGUAGE_CODE=='en'): ?><?= $bday->diff(new DateTime)->format('%y y.o.'); ?><?php endif; ?></span>
                </h1>
            <ul class="social">
                <?php if( have_rows('contact-repeater') ): while ( have_rows('contact-repeater') ) : the_row();
                $contact_link = get_sub_field('url-contact');
                $contact_link_url = $contact_link['url'];
                $contact_link_title = $contact_link['title'];
                $contact_link_target = $contact_link['target'] ? '_blank' : '_self';
                $contact_type = get_sub_field('type-contact'); ?>
                <li <?php if( get_sub_field('priority-contact') == 'true' ): ?>class="priority"<?php endif; ?>><span class="icon"><?= get_sub_field('icon-contact'); ?></span><a href="<?= $contact_link['url']; ?>" target="<?= $contact_link_target; ?>" title="<?= $contact_type['label']; ?>"><?= $contact_link['title']; ?><?php if( get_sub_field('priority-contact') == 'true' ): ?><span class="tooltip"><?php pll_e( 'Social Priority', 'my-tpl-resume' ); ?></span><?php endif; ?></a><?php if( get_sub_field('priority-contact') == 'true' ): ?><span class="icon-priority"><i class="fa-solid fa-check fa-sm"></i></span><?php endif; ?></li>
                <?php endwhile; endif; ?>
            </ul>
        </div>
        <div class="content">
            <div class="personal-description">
                <?= get_sub_field('description'); ?>
            </div>
            <div class="content-experiance">
                <div class="content-experiance-title">
                    <div class="content-experiance-title-left">
                        <h6 class="heading text-blue"><?= $exp['label']; ?></h6>
                    </div>
                    <div class="content-experiance-title-right">
                        <button type="button" id="expand" class="work-button show"><?php pll_e( 'Expand', 'my-tpl-resume' ); ?> <span><i class="fa-sharp fa-light fa-arrow-down fa-xs"></i></span></button>
                        <button type="button" id="collapse" class="work-button"><?php pll_e( 'Collapse', 'my-tpl-resume' ); ?> <span><i class="fa-sharp fa-light fa-arrow-up fa-xs"></i></span></button>
                    </div>
                </div>
                <?php if( have_rows('work-experiance') ): while ( have_rows('work-experiance') ) : the_row(); ?>
                <div class="stepper timeline<?php if( get_sub_field('work-status') == 'true' ): ?> completed<?php endif; ?>">
                    <div class="line-stepper">
                        <div class="circle"></div>
                        <div class="line"></div>
                    </div>
                    <div class="stepper-left">
                        <ul class="list">
                            <li>
                                <span class="list-title"><?= get_sub_field('company'); ?></span>
                                <span class="list-description"><?= get_sub_field('company-time'); ?></span>
                                <span class="list-description"><?= get_sub_field('company-position'); ?></span>
                                <?php
                                $company_website = get_sub_field('company-website');
                                if($company_website):
                                $company_website_url = $company_website['url'];
                                $company_website_title = $company_website['title'];
                                $company_website_target = $company_website['target'] ? '_blank' : '_self'; ?>
                                <a href="<?= $company_website['url']; ?>" target="<?= $company_website_target; ?>" title="<?= $company_website['title']; ?>"><?= $company_website['title']; ?></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="stepper-right">
                        <div class="stepper-content">
                        <div class="long-text">
                                <?= get_sub_field('work-description-long'); ?>
                            </div>
                            <ul class="short-text">
                                <?php if( have_rows('work-description-short') ): while ( have_rows('work-description-short') ) : the_row(); ?>
                                    <li><?= get_sub_field('wd-short'); ?></li>
                                <?php endwhile; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
            <div class="content-experiance">
                <div class="content-experiance-title">
                    <div class="content-experiance-title-left">
                        <h6 class="heading text-blue"><?= $edu['label'] ?></h6>
                    </div>
                    <div class="content-experiance-title-right">
                        <?php $education_level = get_sub_field('edu-level'); ?>
                        <div class="education-lvl"><?= $education_level['label']; ?></div>
                    </div>
                </div>
                <?php if( have_rows('education') ): while ( have_rows('education') ) : the_row(); ?>
                <div class="stepper">
                    <div class="stepper-left">
                        <ul class="list">
                            <li><span class="list-title"><?= get_sub_field('edu-year'); ?></span></li>
                        </ul>
                    </div>
                    <div class="stepper-right">
                        <div class="stepper-content">
                            <ul class="list education">
                            <?php
                                $edu_university = get_sub_field('edu-name');
                                $edu_university_url = $edu_university['url'];
                                $edu_university_title = $edu_university['title'];
                                $edu_university_target = $edu_university['target'] ? '_blank' : '_self'; ?>
                                <li><span class="list-title"><a href="<?= $edu_university['url']; ?>" target="<?= $edu_university_target; ?>"><?= $edu_university['title']; ?></a></span></li>
                                <li><span class="list-description"><?= get_sub_field('edu-department'); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>
</main>
<?php endwhile; endif; ?>
<ul class="actions">
    <li><?php lang_switcher(); ?></li>
    <li><button type="button" class="print"><span class="icon"><i class="fa-solid fa-print"></i></span></button></li>
</ul>
<?php
get_footer();