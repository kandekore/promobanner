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
            'heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'default' => 'Your Promotional Heading Here'
            ]
        );

        $this->add_control(
            'regular_price',
            [
                'label' => 'Regular Price',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'sale_price',
            [
                'label' => 'Sale Price',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'price_text',
            [
                'label' => 'Text Next to Price',
                'type' => Controls_Manager::TEXT,
                'default' => '+ VAT'
            ]
        );
        
        $this->add_control(
    'price_text_top',
    [
        'label' => 'Top Price Text (e.g. Limited Time Offer)',
        'type' => Controls_Manager::TEXT,
        'default' => '',
    ]
);


        /* Buttons */

        $this->add_control(
            'button_1_text',
            [
                'label' => 'Button 1 Text',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_1_link',
            [
                'label' => 'Button 1 Link',
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'button_2_text',
            [
                'label' => 'Button 2 Text',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_2_link',
            [
                'label' => 'Button 2 Link',
                'type' => Controls_Manager::URL,
            ]
        );

        /* Images */

        $this->add_control(
            'image_1',
            [
                'label' => 'Circle Image 1',
                'type' => Controls_Manager::MEDIA,
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

        ?>

        <div class="promo-banner">
            <div class="promo-left">

                <?php if (!empty($settings['launch_date'])) : ?>
                    <div class="promo-countdown-wrapper">
    <div class="promo-countdown" data-date="<?php echo esc_attr($settings['launch_date']); ?>">
        <span class="days">00</span>d
        <span class="hours">00</span>h
        <span class="minutes">00</span>m
        <span class="seconds">00</span>s
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
            <?php if (!empty($settings['regular_price'])) : ?>
                <span class="regular-price">
                    <?php echo esc_html($settings['regular_price']); ?>
                </span>
            <?php endif; ?>
<br>
            <?php if (!empty($settings['sale_price'])) : ?>
                <span class="sale-price">
                    <?php echo esc_html($settings['sale_price']); ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="promo-pricing-right">
            <?php if (!empty($settings['price_text_top'])) : ?>
                <span class="price-text-top">
                   <strong><?php echo esc_html($settings['price_text_top']); ?></strong> 
                </span>
            <?php endif; ?>

            <?php if (!empty($settings['price_text'])) : ?>
                <span class="price-text">
                    <?php echo esc_html($settings['price_text']); ?>
                </span>
            <?php endif; ?>
        </div>

    </div>
<?php endif; ?>


                <div class="promo-buttons">
                    <?php if (!empty($settings['button_1_text'])) : ?>
                        <a href="<?php echo esc_url($settings['button_1_link']['url']); ?>"
                           class="promo-btn">
                           <?php echo esc_html($settings['button_1_text']); ?>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($settings['button_2_text'])) : ?>
                        <a href="<?php echo esc_url($settings['button_2_link']['url']); ?>"
                           class="promo-btn secondary">
                           <?php echo esc_html($settings['button_2_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>

            <div class="promo-right">

                <?php foreach (['image_1','image_2','image_3'] as $img) :
                    if (!empty($settings[$img]['url'])) : ?>
                        <div class="promo-circle"
                             style="border-color: <?php echo esc_attr($settings['circle_border_color']); ?>">
                            <img src="<?php echo esc_url($settings[$img]['url']); ?>">
                        </div>
                <?php endif; endforeach; ?>

            </div>
        </div>

        <?php
    }
}
