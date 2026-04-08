<?php
$opts      = maxus_get_site_options();
$phone     = $opts['phone'];
$email     = $opts['email'];
$address   = $opts['address'];
$facebook  = $opts['facebook'];
$instagram = $opts['instagram'];
$whatsapp  = $opts['whatsapp'];
$schedule  = $opts['schedule'];
?>

<footer class="footer">
    <div class="footer__container container">

        <div class="footer__column footer__branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo_white.png" alt="<?php bloginfo('name'); ?>" class="footer__logo">
            <?php endif; ?>

            <p class="footer__description">
                Concesionario oficial Maxus en Chile. Venta de vehículos nuevos de las marcas Maxus, Jetour, Kaiyi y Karry, además de servicio técnico especializado.
            </p>

            <div class="footer__social">
                <?php get_template_part('template-parts/social-links'); ?>
            </div>
        </div>

        <div class="footer__column">
            <h3 class="footer__title">Navegación</h3>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'footer__list',
                'fallback_cb'    => false,
            ));
            ?>
        </div>

        <div class="footer__column">
            <h3 class="footer__title">Sucursal Larraín</h3>
            <ul class="footer__contact-info">
                <?php if ($address) : ?>
                    <li>
                        <i class="ri-map-pin-2-fill"></i>
                        <span class="text-pretty"><?php echo esc_html($address); ?></span>
                    </li>
                <?php endif; ?>

                <?php if ($phone) : ?>
                    <li>
                        <i class="ri-phone-fill"></i>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                    </li>
                <?php endif; ?>

                <?php if ($email) : ?>
                    <li>
                        <i class="ri-mail-fill"></i>
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    </li>
                <?php endif; ?>

                <?php if ($schedule) : ?>
                    <li>
                        <i class="ri-time-fill"></i>
                        <span><?php echo nl2br(esc_html($schedule)); ?></span>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>

    <div class="footer__bottom container">
        <div class="footer__divider"></div>
        <div class="footer__credits">
            <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>