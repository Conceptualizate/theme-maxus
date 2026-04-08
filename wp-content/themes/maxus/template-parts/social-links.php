<?php
/**
 * Social Links — Shared between footer and mobile menu.
 * Renders the <a> tags only; the parent wrapper is responsabilidad del caller.
 */

$opts      = maxus_get_site_options();
$facebook  = $opts['facebook'];
$instagram = $opts['instagram'];
$whatsapp  = $opts['whatsapp'];
?>

<?php if ($facebook) : ?>
    <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
        <i class="ri-facebook-fill"></i>
    </a>
<?php endif; ?>
<?php if ($instagram) : ?>
    <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
        <i class="ri-instagram-fill"></i>
    </a>
<?php endif; ?>
<?php if ($whatsapp) : ?>
    <a href="<?php echo esc_url($whatsapp); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
        <i class="ri-whatsapp-line"></i>
    </a>
<?php endif; ?>
