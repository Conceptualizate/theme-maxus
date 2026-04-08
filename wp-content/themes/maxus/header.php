<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<?php
$opts      = maxus_get_site_options();
$phone     = $opts['phone'];
$email     = $opts['email'];
$address   = $opts['address'];
$facebook  = $opts['facebook'];
$instagram = $opts['instagram'];
$whatsapp  = $opts['whatsapp'];
$slogan    = $opts['slogan'];
?>

<body <?php body_class(); ?>>
    <header class="header">
        <nav class="navbar container">
            <div class="navbar__brand">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo_white.png" alt="<?php bloginfo('name'); ?>" class="navbar__logo">
                    </a>
                <?php endif; ?>
                <?php if ($slogan) : ?>
                    <span class="navbar__slogan">
                        <?php echo esc_html($slogan); ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'navbar__menu',
                'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
            ));
            ?>

            <div class="navbar__actions">
                <a href="<?php echo esc_url(home_url('/#cotizador')); ?>" class="button btn-primary">Cotizar</a>
                <a href="<?php echo esc_url(home_url('/#maxus')); ?>" class="button btn-outline">Maxus</a>
            </div>

            <!-- Hamburger (mobile) -->
            <button class="navbar__hamburger" aria-label="Abrir menú" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </nav>

        <div class="mobile-menu">
            <div class="mobile-menu__header">
                <span class="mobile-menu__title">MENÚ</span>
                <button class="mobile-menu__close" aria-label="Cerrar menú">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <div class="mobile-menu__divider"></div>

            <nav class="mobile-menu__nav">
                <?php
                $locations  = get_nav_menu_locations();
                $menu_id    = isset($locations['primary']) ? $locations['primary'] : 0;
                $menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : [];
                if ($menu_items) :
                    $i = 1;
                    foreach ($menu_items as $item) :
                        if ($item->menu_item_parent == 0) : ?>
                            <a href="<?php echo esc_url($item->url); ?>" class="mobile-menu__link">
                                <span class="mobile-menu__number"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
                                <span class="mobile-menu__text"><?php echo esc_html($item->title); ?></span>
                                <i class="ri-arrow-right-up-line"></i>
                            </a>
                <?php
                            $i++;
                        endif;
                    endforeach;
                endif;
                ?>
            </nav>
            <a href="<?php echo esc_url(home_url('/#cotizador')); ?>" class="mobile-menu__cta button btn-primary">COTIZAR AHORA</a>

            <div class="mobile-menu__contact">
                <?php if ($phone) : ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="mobile-menu__contact-item">
                        <i class="ri-phone-fill"></i>
                        <span><?php echo esc_html($phone); ?></span>
                    </a>
                <?php endif; ?>

                <?php if ($email) : ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="mobile-menu__contact-item">
                        <i class="ri-mail-fill"></i>
                        <span><?php echo esc_html($email); ?></span>
                    </a>
                <?php endif; ?>

                <?php if ($address) : ?>
                    <div class="mobile-menu__contact-item">
                        <i class="ri-map-pin-fill"></i>
                        <span><?php echo esc_html($address); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mobile-menu__footer">
                <div class="mobile-menu__social">
                    <?php get_template_part('template-parts/social-links'); ?>
                </div>


            </div>
        </div> <!-- Mobile Menu -->
    </header>