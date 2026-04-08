<?php

$models     = function_exists('maxus_get_models') ? maxus_get_models() : array();
$categories = function_exists('maxus_get_model_categories') ? maxus_get_model_categories() : array();

if (empty($models)) {
    return;
}
?>

<section class="models">
    <div class="models__header container">
        <span class="models__eyebrow">Flota Completa</span>
        <h2 class="models__title">Nuestros Modelos</h2>
        <p class="models__description text-pretty">
            Diseñados para el trabajo, la aventura y el confort. Encuentra el Maxus ideal para tu estilo de vida.
        </p>
    </div>

    <?php if (! empty($categories)) : ?>
        <div class="models__filters container">
            <button class="models__filter is-active js-model-filter" data-filter="all" type="button">Todos</button>
            <?php foreach ($categories as $cat) : ?>
                <button class="models__filter js-model-filter" data-filter="<?php echo esc_attr($cat['slug']); ?>" type="button">
                    <?php echo esc_html($cat['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="models__grid container js-models-grid">
        <?php foreach ($models as $model) : ?>
            <article class="model-card js-model-card" data-category="<?php echo esc_attr($model['category_slug']); ?>">

                <div class="model-card__media">
                    <?php if (! empty($model['category'])) : ?>
                        <span class="model-card__badge"><?php echo esc_html($model['category']); ?></span>
                    <?php endif; ?>

                    <?php if (! empty($model['image_url'])) : ?>
                        <img
                            class="model-card__image"
                            src="<?php echo esc_url($model['image_url']); ?>"
                            alt="<?php echo esc_attr($model['title']); ?>"
                            loading="lazy">
                    <?php endif; ?>
                </div>

                <div class="model-card__body">
                    <h3 class="model-card__title"><?php echo esc_html($model['title']); ?></h3>

                    <dl class="model-card__specs">
                        <?php if (! empty($model['engine'])) : ?>
                            <div class="model-card__spec">
                                <dt>Motor</dt>
                                <dd><?php echo esc_html($model['engine']); ?></dd>
                            </div>
                        <?php endif; ?>
                        <?php if (! empty($model['transmision'])) : ?>
                            <div class="model-card__spec">
                                <dt>Trans.</dt>
                                <dd><?php echo esc_html($model['transmision']); ?></dd>
                            </div>
                        <?php endif; ?>
                        <?php if (! empty($model['featured'])) : ?>
                            <div class="model-card__spec">
                                <dt>Destacado</dt>
                                <dd><?php echo esc_html($model['featured']); ?></dd>
                            </div>
                        <?php endif; ?>
                    </dl>

                    <?php if (! empty($model['price_from'])) : ?>
                        <p class="model-card__price">Desde $<?php echo esc_html(number_format((float) $model['price_from'], 0, ',', '.')); ?></p>
                    <?php endif; ?>

                    <a href="#" class="button btn-primary model-card__cta">
                        Cotizar Ahora
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>

            </article>
        <?php endforeach; ?>
    </div>
</section>
