<?php

$categories = function_exists('maxus_get_model_categories') ? maxus_get_model_categories() : array();

if (empty($categories)) {
    return;
}
?>

<section class="categories">
    <div class="categories__header container">
        <span class="categories__eyebrow">Segmentos</span>
        <h2 class="categories__title">Elige tu categoría</h2>
    </div>

    <div class="categories__grid container">
        <?php foreach ($categories as $category) : ?>
            <a href="<?php echo esc_url($category['link']); ?>" class="category-card">

                <?php if (! empty($category['cover_url'])) : ?>
                    <img
                        class="category-card__image"
                        src="<?php echo esc_url($category['cover_url']); ?>"
                        alt="<?php echo esc_attr($category['name']); ?>"
                        loading="lazy">
                <?php endif; ?>

                <span class="category-card__arrow" aria-hidden="true">
                    <i class="ri-arrow-right-up-line"></i>
                </span>

                <div class="category-card__content">
                    <h3 class="category-card__name"><?php echo esc_html($category['name']); ?></h3>
                    <?php if (! empty($category['description'])) : ?>
                        <p class="category-card__description"><?php echo esc_html($category['description']); ?></p>
                    <?php endif; ?>
                </div>

            </a>
        <?php endforeach; ?>
    </div>
</section>
