<?php

$hero_slides = function_exists('maxus_get_hero_slides') ? maxus_get_hero_slides() : array();

if (empty($hero_slides)) {
    return;
}
?>

<section class="hero">
    <div class="swiper hero-slider js-hero-slider">
        <div class="swiper-wrapper">
            <?php foreach ($hero_slides as $index => $slide) : ?>
                <article class="swiper-slide hero-slide">

                    <div class="hero-slide__media">
                        <?php if (! empty($slide['image_url'])) : ?>
                            <img
                                class="hero-slide__image"
                                src="<?php echo esc_url($slide['image_url']); ?>"
                                alt="<?php echo esc_attr($slide['title']); ?>"
                                <?php echo 0 === $index ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
                        <?php endif; ?>
                    </div>

                    <div class="hero-slide__overlay"></div>

                    <div class="hero-slide__content container">
                        <div class="hero-slide__inner">

                            <?php if (! empty($slide['subtitle'])) : ?>
                                <span class="hero-slide__eyebrow">
                                    <?php echo esc_html($slide['subtitle']); ?>
                                </span>
                            <?php endif; ?>

                            <?php $heading_tag = (0 === $index) ? 'h1' : 'h2'; ?>
                            <<?php echo $heading_tag; ?> class="hero-slide__title js-hero-title">
                                <span class="hero-slide__title-line">
                                    <?php echo esc_html($slide['title']); ?>
                                </span>
                                <?php if (! empty($slide['title_highlight'])) : ?>
                                    <span class="hero-slide__title-line hero-slide__title-line--highlight">
                                        <?php echo esc_html($slide['title_highlight']); ?>
                                    </span>
                                <?php endif; ?>
                            </<?php echo $heading_tag; ?>>

                            <?php if (! empty($slide['description'])) : ?>
                                <p class="hero-slide__description js-hero-copy">
                                    <?php echo esc_html($slide['description']); ?>
                                </p>
                            <?php endif; ?>

                            <?php if (! empty($slide['cta_1_text']) || ! empty($slide['cta_2_text'])) : ?>
                                <div class="hero-slide__actions">
                                    <?php if (! empty($slide['cta_1_text']) && ! empty($slide['cta_1_url'])) : ?>
                                        <a href="<?php echo esc_url($slide['cta_1_url']); ?>" class="button btn-primary">
                                            <?php echo esc_html($slide['cta_1_text']); ?>
                                            <i class="ri-arrow-right-line"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (! empty($slide['cta_2_text']) && ! empty($slide['cta_2_url'])) : ?>
                                        <a href="<?php echo esc_url($slide['cta_2_url']); ?>" class="button btn-outline">
                                            <?php echo esc_html($slide['cta_2_text']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>

        <div class="hero-slider__controls container">
            <div class="hero-slider__nav">
                <button class="hero-slider__arrow hero-slider__arrow--prev" type="button" aria-label="Slide anterior">
                    <i class="ri-arrow-left-line"></i>
                </button>
                <div class="hero-slider__pagination"></div>
                <button class="hero-slider__arrow hero-slider__arrow--next" type="button" aria-label="Siguiente slide">
                    <i class="ri-arrow-right-line"></i>
                </button>
            </div>

            <div class="hero-slider__counter">
                <span class="hero-slider__current">01</span>
                <span class="hero-slider__separator">/</span>
                <span class="hero-slider__total"><?php echo esc_html(str_pad((string) count($hero_slides), 2, '0', STR_PAD_LEFT)); ?></span>
            </div>
        </div>
</section>