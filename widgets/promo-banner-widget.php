<?php

if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

class Promo_Banner_Widget extends Widget_Base {

    public function get_name() {
        return 'promo_launch_banner';
    }

    public function get_title() {
        return 'Promo Launch Banner';
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_style_depends() {
        return ['promo-banner-style'];
    }

    public function get_script_depends() {
        return ['promo-countdown-script'];
    }

    protected function register_controls() {

        /* =========================
           CONTENT SECTION
        ==========================*/

        $this->start_controls_section(
            'content_section',
            ['label' => 'Content']
        );

        $this->add_control(
            'launch_date',
            [
                'label' => 'Launch Date & Time',
                'type' => Controls_Manager::DATE_TIME,
            ]
        );

        $this->add_control(
            'sale_badge_text',
            [
                'label' => 'Sale Badge Text',
                'type' => Controls_Manager::TEXT,
                'default' => 'Sale',
                'description' => 'Short label shown after the countdown (e.g. "Sale"). Leave empty to hide.',
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'default' => 'Your Promotional Heading Here'
            ]
        );

        /* --- Pricing --- */

        $this->add_control(
            'sale_price',
            [
                'label' => 'Sale Price',
                'type' => Controls_Manager::TEXT,
                'placeholder' => '£549',
            ]
        );

        $this->add_control(
            'price_suffix',
            [
                'label' => 'Price Suffix (e.g. +VAT)',
                'type' => Controls_Manager::TEXT,
                'default' => '+VAT',
            ]
        );

        $this->add_control(
            'regular_price',
            [
                'label' => 'Regular / Old Price (struck through)',
                'type' => Controls_Manager::TEXT,
                'placeholder' => '£700+VAT',
            ]
        );

        $this->add_control(
            'price_text_top',
            [
                'label' => 'Pricing Info – Line 1',
                'type' => Controls_Manager::TEXT,
                'default' => 'Limited Time Special Offer',
            ]
        );

        $this->add_control(
            'price_text_bottom',
            [
                'label' => 'Pricing Info – Line 2',
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => 'e.g. Book Before 28th February',
            ]
        );

        /* --- Button 1 (Popup) --- */

        $this->add_control(
            'button_1_text',
            [
                'label' => 'Button 1 Text',
                'type' => Controls_Manager::TEXT,
                'default' => 'Book Your Course Today',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'popup_id',
            [
                'label' => 'Button 1 – Elementor Popup ID',
                'type' => Controls_Manager::TEXT,
                'description' => 'Enter the Elementor popup template ID to open on click.',
                'placeholder' => '1234',
            ]
        );

        /* --- Button 2 (Phone) --- */

        $this->add_control(
            'button_2_text',
            [
                'label' => 'Button 2 Text',
                'type' => Controls_Manager::TEXT,
                'default' => 'Call Us',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => 'Phone Number',
                'type' => Controls_Manager::TEXT,
                'placeholder' => '0800 118 2589',
                'description' => 'Displayed on the button and used as the tel: link.',
            ]
        );

        /* --- Images --- */

        $this->add_control(
            'image_1',
            [
                'label' => 'Circle Image 1',
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_2',
            [
                'label' => 'Circle Image 2',
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'image_3',
            [
                'label' => 'Circle Image 3',
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();


        /* =========================
           STYLE SECTION
        ==========================*/

        $this->start_controls_section(
            'style_section',
            ['label' => 'Style', 'tab' => Controls_Manager::TAB_STYLE]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'selector' => '{{WRAPPER}} .promo-banner'
            ]
        );

        $this->add_control(
            'circle_border_color',
            [
                'label' => 'Circle Border Colour',
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if (
            empty($settings['heading']) &&
            empty($settings['launch_date']) &&
            empty($settings['regular_price']) &&
            empty($settings['sale_price'])
        ) {
            return;
        }

        /* Build popup URL if a popup ID is set */
        $popup_url = '#';
        if (!empty($settings['popup_id'])) {
            $popup_id_val = absint($settings['popup_id']);
            $encoded = base64_encode(json_encode(['id' => (string) $popup_id_val, 'toggle' => false]));
            $popup_url = '#elementor-action:action=popup:open&settings=' . $encoded;
        }

        /* Clean phone number for tel: href */
        $phone_display = !empty($settings['phone_number']) ? esc_html($settings['phone_number']) : '';
        $phone_href    = 'tel:' . preg_replace('/[^0-9+]/', '', $settings['phone_number'] ?? '');

        ?>

        <div class="promo-banner">
            <div class="promo-left">

                <?php if (!empty($settings['launch_date'])) : ?>
                    <div class="promo-countdown-wrapper">
                        <div class="promo-countdown" data-date="<?php echo esc_attr($settings['launch_date']); ?>">
                            <span class="days">00</span>d&nbsp;|&nbsp;<span class="hours">00</span>h&nbsp;|&nbsp;<span class="minutes">00</span>m&nbsp;|&nbsp;<span class="seconds">00</span>s
                            <?php if (!empty($settings['sale_badge_text'])) : ?>
                                <span class="promo-sale-badge"><?php echo esc_html($settings['sale_badge_text']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['heading'])) : ?>
                    <h2 class="promo-heading">
                        <?php echo esc_html($settings['heading']); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($settings['sale_price']) || !empty($settings['regular_price'])) : ?>
                    <div class="promo-pricing">

                        <div class="promo-pricing-left">
                            <?php if (!empty($settings['sale_price'])) : ?>
                                <div class="promo-sale-line">
                                    <span class="sale-price"><?php echo esc_html($settings['sale_price']); ?></span>
                                    <?php if (!empty($settings['price_suffix'])) : ?>
                                        <span class="price-suffix"><?php echo esc_html($settings['price_suffix']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($settings['regular_price'])) : ?>
                                <span class="regular-price"><?php echo esc_html($settings['regular_price']); ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($settings['price_text_top']) || !empty($settings['price_text_bottom'])) : ?>
                            <div class="promo-pricing-right">
                                <?php if (!empty($settings['price_text_top'])) : ?>
                                    <span class="price-text-top"><?php echo esc_html($settings['price_text_top']); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($settings['price_text_bottom'])) : ?>
                                    <span class="price-text"><?php echo esc_html($settings['price_text_bottom']); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <div class="promo-buttons">

                    <?php if (!empty($settings['button_1_text'])) : ?>
                        <a href="<?php echo esc_url($popup_url); ?>" class="promo-btn">
                            <?php echo esc_html($settings['button_1_text']); ?>
                            <span class="btn-arrow">&#8594;</span>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($phone_display)) : ?>
                        <a href="<?php echo esc_attr($phone_href); ?>" class="promo-btn phone-btn">
                            <i class="btn-phone-icon">&#9990;</i>
                            <?php if (!empty($settings['button_2_text'])) : ?>
                                <?php echo esc_html($settings['button_2_text']); ?>&nbsp;
                            <?php endif; ?>
                            <?php echo $phone_display; ?>
                        </a>
                    <?php endif; ?>

                </div>

            </div>

            <div class="promo-right">

                <?php foreach (['image_1', 'image_2', 'image_3'] as $img) :
                    if (!empty($settings[$img]['url'])) : ?>
                        <div class="promo-circle"
                             style="border-color: <?php echo esc_attr($settings['circle_border_color']); ?>">
                            <img src="<?php echo esc_url($settings[$img]['url']); ?>" alt="">
                        </div>
                    <?php endif; endforeach; ?>

            </div>
        </div>

        <?php
    }
}
