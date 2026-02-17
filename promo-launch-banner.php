<?php
/**
 * Plugin Name: Promo Launch Banner for Elementor
 * Description: Custom promotional launch banner with countdown, pricing, buttons and circular image cluster.
 * Version: 1.0
 * Author: D Kandekore
 */

if (!defined('ABSPATH')) exit;

final class Promo_Launch_Banner_Plugin {

    const VERSION = '1.0';

    public function __construct() {

        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {

        if (!did_action('elementor/loaded')) {
            return;
        }

        add_action('elementor/widgets/register', [$this, 'register_widget']);
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    }

    public function register_assets() {

        wp_register_style(
            'promo-banner-style',
            plugins_url('assets/css/promo-banner.css', __FILE__),
            [],
            self::VERSION
        );

        wp_register_script(
            'promo-countdown-script',
            plugins_url('assets/js/promo-countdown.js', __FILE__),
            [],
            self::VERSION,
            true
        );
    }

    public function register_widget($widgets_manager) {

        require_once(__DIR__ . '/widgets/promo-banner-widget.php');
        $widgets_manager->register(new \Promo_Banner_Widget());
    }
}

new Promo_Launch_Banner_Plugin();
