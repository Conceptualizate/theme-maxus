<?php
/**
 * CTA Section — Reusable across pages.
 * All fields come from ACF Options.
 */

$opts        = maxus_get_site_options();
$eyebrow     = $opts['cta_eyebrow'];
$title       = $opts['cta_title'];
$highlight   = $opts['cta_highlight'];
$description = $opts['cta_description'];
$cta_1_text  = $opts['cta_1_text'];
$cta_1_url   = $opts['cta_1_url'];
$cta_2_text  = $opts['cta_2_text'];
$cta_2_url   = $opts['cta_2_url'];

if (empty($title)) {
    return;
}
?>

<section class="cta">
    <div class="cta__card">
        <div class="cta__inner">

            <?php if ($eyebrow) : ?>
                <span class="cta__eyebrow">
                    <?php echo esc_html($eyebrow); ?>
                    <i class="ri-steering-2-fill"></i>
                </span>
            <?php endif; ?>

            <h2 class="cta__title">
                <?php echo esc_html($title); ?>
                <?php if ($highlight) : ?>
                    <span class="cta__highlight"><?php echo esc_html($highlight); ?></span>
                <?php endif; ?>
            </h2>

            <?php if ($description) : ?>
                <p class="cta__description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>

            <?php if ($cta_1_text || $cta_2_text) : ?>
                <div class="cta__actions">
                    <?php if ($cta_1_text && $cta_1_url) : ?>
                        <a href="<?php echo esc_url($cta_1_url); ?>" class="button btn-primary">
                            <?php echo esc_html($cta_1_text); ?>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    <?php endif; ?>
                    <?php if ($cta_2_text && $cta_2_url) : ?>
                        <a href="<?php echo esc_url($cta_2_url); ?>" class="button btn-outline btn-outline--dark">
                            <?php echo esc_html($cta_2_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
