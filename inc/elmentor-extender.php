<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// Add Alignment Feature on counter
add_action('elementor/element/counter/section_title/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('RRdevs Extra', 'rrdevs-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'counter_align',
        [
            'label' => __('Counter Alignment', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'rrdevs-addons'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'rrdevs-addons'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'rrdevs-addons'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper ' => 'text-align: {{VALUE}}; display: block;',
            ],
        ]
    );
    $element->add_responsive_control(
        'title_align',
        [
            'label' => __('Title Alignment', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'rrdevs-addons'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'rrdevs-addons'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'rrdevs-addons'),
                    'icon' => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => __('Justified', 'rrdevs-addons'),
                    'icon' => 'eicon-text-align-justify',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-title ' => 'text-align: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'counter_gap',
        [
            'label' => __('Counter Gap', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// Add select dropdown control to button widget
add_action('elementor/element/image-box/section_style_content/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('RRdevs Extra', 'rrdevs-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'img_hover_scale',
        [
            'label' => __('Image Hover Scale', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 100,
            'step' => 0.1,
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-img:hover' => 'transform: scale({{VALUE}});',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'image_hover_shadow',
            'label' => __('Image Hover Shadow', 'rrdevs-addons'),
            'selector' => '{{WRAPPER}}:hover .elementor-image-box-img',
        ]
    );
    $element->add_responsive_control(
        'image_margin',
        [
            'label' => __('Image Margin', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
            ],
        ]
    );
    $element->add_responsive_control(
        'title_padding',
        [
            'label' => __('Content Padding', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'image_border',
            'label' => __('Image Border', 'rrdevs-addons'),
            'selector' => '{{WRAPPER}} .elementor-image-box-img img',
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// Add select dropdown control to button widget
add_action('elementor/element/video/section_lightbox_style/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('RRdevs Extra', 'rrdevs-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'play_icon_bg',
        [
            'label' => __('Icon Box Background Color', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );
    $element->add_control(
        'iamge_overly_color',
        [
            'label' => __('Image Overlay Color', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );
    $element->add_responsive_control(
        'iamge_overly_opacity',
        [
            'label' => __('Opacity', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'opacity: {{SIZE}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    $element->add_responsive_control(
        'play_icon_box_size',
        [
            'label' => __('Icon Box Size', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'video_border',
            'label' => __('Item Border', 'rrdevs-addons'),
            'selector' => '{{WRAPPER}}  .elementor-custom-embed-play',
        ]
    );
    $element->add_responsive_control(
        'icon_radius',
        [
            'label' => __('Video Icon Radius', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'overlay_radius',
        [
            'label' => __('Image Overlay Radius', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-image-overlay img, {{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// icon box
add_action('elementor/element/icon-box/section_style_icon/after_section_start', function ($element, $args) {
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'icon_box_border',
            'label' => __('Item Border', 'rrdevs-addons'),
            'selector' => '{{WRAPPER}} .elementor-icon-box-icon .elementor-icon',
        ]
    );
},10, 2);
// button
add_action('elementor/element/button/section_style/after_section_start', function ($element, $args) {
    $element->add_control(
        'button_width',
        [
            'label' => esc_html__( 'Width', 'rrdevs-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'button_height',
        [
            'label' => esc_html__( 'Height', 'rrdevs-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'button_icon',
        [
            'label' => esc_html__( 'Icon', 'rrdevs-addons' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_control(
        'btn_icon_size',
        [
            'label' => esc_html__( 'Icon Size', 'rrdevs-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'btn_icon_gap',
        [
            'label' => esc_html__( 'Icon Gap', 'rrdevs-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon' => 'margin-top: {{SIZE}}{{UNIT}};'
            ],
        ]
    );
},10, 2);
add_action('elementor/element/before_section_end', function ($element, $section_id, $args) {
    /** @var \Elementor\Element_Base $element */
    if ('section_background' === $section_id) {
        $element->add_control(
            'custom_bg_css',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom CSS', 'rrdevs-addons'),
                'selectors' => [
                    '{{WRAPPER}} ' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
			'rtl_css_on',
			[
				'label' => __( 'RTL CSS', 'rrdevs-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rrdevs-addons' ),
				'label_off' => __( 'Hide', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        $element->add_control(
            'custom_bg_css_rtl',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom RTl CSS', 'rrdevs-addons'),
                'selectors' => [
                    'body.rtl {{WRAPPER}} ' => '{{VALUE}}',
                ],
                'condition' => [
                    'rtl_css_on' => 'yes',
                ]
            ]
        );
    }
    //overly Slider Control
    if ('section_background_overlay' === $section_id) {
        $element->add_responsive_control(
            'custom_bg_overlay_css_slider',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => __('Width', 'rrdevs-addons'),
                'size_units' => [ '%', 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    }
    if ('section_background_overlay' === $section_id) {
        $element->add_responsive_control(
            'bc_padding',
            [
                'label' => __('Padding', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .elementor-background-overlay' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
    }
    if ('section_background_overlay' === $section_id) {
        $element->add_control(
            'custom_bg_overlay_css',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom CSS', 'rrdevs-addons'),
                'selectors' => [
                    '{{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
			'overlaY_rtl_css_on',
			[
				'label' => __( 'RTL CSS', 'rrdevs-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rrdevs-addons' ),
				'label_off' => __( 'Hide', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        $element->add_control(
            'overlay_bg_css_rtl',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom RTl CSS', 'rrdevs-addons'),
                'selectors' => [
                    'body.rtl {{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
                'condition' => [
                    'overlaY_rtl_css_on' => 'yes',
                ]
            ]
            );
    }
}, 10, 3);
// Add Alignment Feature on counter
add_action('elementor/element/testimonial/section_style_testimonial_job/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('RRdevs Extra', 'rrdevs-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'counter_gap',
        [
            'label' => __('Content Gap', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-content ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'name_gap',
        [
            'label' => __('Name Gap', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-name ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// Add Alignment Feature on counter
add_action('elementor/element/accordion/section_toggle_style_content/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('RRdevs Extra', 'rrdevs-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'acc_item_border_hading',
        [
            'label' => __( 'Content border', 'plugin-name' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'acc_content_border',
            'label' => __('Item Border', 'rrdevs-addons'),
            'selector' => '{{WRAPPER}}  .elementor-tab-content',
        ]
    );
    $element->add_control(
        'more_options',
        [
            'label' => __( 'Box border', 'plugin-name' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'acc_border',
            'label' => __('Item Border', 'rrdevs-addons'),
            'selector' => '{{WRAPPER}}  .elementor-accordion-item',
        ]
    );
    $element->add_control(
        'acc_bg',
        [
            'label' => __('Accordion Item Background Color', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item ' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_radius',
        [
            'label' => __('Item Border Radius', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_content_margin',
        [
            'label' => __('Content Margin', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_paddingn',
        [
            'label' => __('Item Padding', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_margin',
        [
            'label' => __('Item Margin', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// / Add select dropdown control to button widget
add_action('elementor/element/icon-list/section_icon_style/after_section_start', function ($element, $args) {
    $element->add_control(
        'icon_line_color',
        [
            'label' => __( 'Line Color', 'rrdevs-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon svg path' => 'stroke: {{VALUE}};',
            ],
        ]
    );
    $element->add_control(
        'icon_bg_color',
        [
            'label' => __( 'Background Color', 'rrdevs-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_width',
        [
            'label' => __('Width', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_height',
        [
            'label' => __('Height', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_ border_radius',
        [
            'label' => __('Border Radius', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_self_align_position',
        [
            'label' => esc_html__( 'Icon Position', 'elementor' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Top', 'elementor' ),
                    'icon' => 'eicon-align-start-v',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'elementor' ),
                    'icon' => 'eicon-align-center-v',
                ],
                'flex-end' => [
                    'title' => esc_html__( 'End', 'elementor' ),
                    'icon' => 'eicon-align-end-v',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'align-items:{{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_Icon_gap',
        [
            'label' => __('Icon gap', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);
add_action('elementor/element/icon-list/section_text_style/after_section_start', function ($element, $args) {
    $element->add_responsive_control(
        'icon_list_margin',
        [
            'label' => __('Margin', 'rrdevs-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);
// social icon
add_action('elementor/element/social-icons/section_social_style/after_section_start', function ($element, $args) {
     $element->add_responsive_control(
        'icon_font_size',
        [
            'label' => esc_html__( 'Icon Size', 'elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}',
            ],
        ]
    );
 }, 10, 2);
function rrdevs_stickyregister_controls( $element, $args )
{
    $element->add_control(
        'rrdevs_sticky',
        [
           'label' => __('Sticky', 'rrdevs-addons'),
           'type' => \Elementor\Controls_Manager::SELECT,
           'options' => [
               'yes' => __('Yes', 'rrdevs-addons'),
               'no' => __('No', 'rrdevs-addons'),
           ],
           'default' => 'no',
           'separator' => 'before',
           'prefix_class' => 'RRdevs-addons-sticky-',
           'frontend_available' => true,
           'render_type'    => 'template'
       ]
    );
    $element->add_control(
       'rrdevs_sticky_bg',
       [
           'label' => __('Background Color', 'rrdevs-addons'),
           'type' => \Elementor\Controls_Manager::COLOR,
           'selectors' => [
               '{{WRAPPER}}.reveal-sticky' => 'background-color: {{VALUE}}',
           ],
           'condition' => [
               'rrdevs_sticky' => 'yes',
           ],
           ]
       );
       $element->add_group_control(
           \Elementor\Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'rrdevs_sticky_shadow',
               'label' => __('Shadow', 'rrdevs-addons'),
               'selector' => '{{WRAPPER}}.reveal-sticky',
               'condition' => [
                   'rrdevs_sticky' => 'yes',
               ],
           ]
       );
   $element->add_group_control(
       \Elementor\Group_Control_Border::get_type(),
       [
           'name' => 'rrdevs_sticky_border',
           'label' => __('Border', 'rrdevs-addons'),
           'selector' => '{{WRAPPER}}.reveal-sticky',
           'condition' => [
               'rrdevs_sticky' => 'yes',
           ],
       ]
   );
}
add_action('elementor/element/section/section_effects/after_section_start', 'rrdevs_stickyregister_controls' ,10, 2 );
add_action('elementor/element/common/section_effects/after_section_start', 'rrdevs_stickyregister_controls' ,10, 2 );
add_action('elementor/element/before_section_end', function ($element, $section_id, $args) {
    /** @var \Elementor\Element_Base $element */
    if ('section_shape_divider' === $section_id) {
        $element->add_control(
            'animation_on',
            [
               'label' => __('Animation', 'rrdevs-addons'),
               'type' => \Elementor\Controls_Manager::SELECT,
               'options' => [
                   'no' => __('None', 'rrdevs-addons'),
                   'animation-one' => __('Animation-one', 'rrdevs-addons'),
                   'animation-two' => __('Animation-two', 'rrdevs-addons'),
                   'animation-three' => __('Animation-three', 'rrdevs-addons'),
               ],
               'default' => 'no',
               'separator' => 'before',
               'prefix_class' => 'rrdevs-custom-animation-',
               'frontend_available' => true,
               'render_type'    => 'template'
           ]
        );
    }
}, 10, 3);
