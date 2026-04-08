<?php

$services = function_exists('maxus_get_services') ? maxus_get_services() : array();

if (empty($services)) {
    return;
}
?>

<section class="services">
    <div class="services__header container">
        <span class="services__eyebrow">Por qué elegirnos</span>
        <h2 class="services__title">40 años de confianza</h2>
    </div>

    <div class="services__grid container">
        <?php foreach ($services as $service) : ?>
            <article class="service-card">

                <?php if (! empty($service['icon'])) : ?>
                    <span class="service-card__icon">
                        <i class="<?php echo esc_attr($service['icon']); ?>"></i>
                    </span>
                <?php endif; ?>

                <h3 class="service-card__title"><?php echo esc_html($service['title']); ?></h3>

                <?php if (! empty($service['description'])) : ?>
                    <p class="service-card__description"><?php echo esc_html($service['description']); ?></p>
                <?php endif; ?>

            </article>
        <?php endforeach; ?>
    </div>
</section>
