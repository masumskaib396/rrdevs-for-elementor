<?php
/**
 * Tab
 *
 *
 * @since 1.0.0
 */
namespace RRdevs_Addons\Widgets;

use Elementor\Controls_Manager;
use Elementor\DIVIDER;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class RRdevs_Addons_Tabs extends \Elementor\Widget_Base {
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rrdevs-addons-tab';
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Tabs', 'rrdevs-addons');
    }
    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['rrdevs-addons'];
    }
    public function get_keywords() {
        return ['tabs', 'tab', 'rrdevs-addons', 'acc'];
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Tabs', 'rrdevs-addons'),
            ]
        );

        //Start Repetare Content  tab one
        $repeater = new Repeater();

        $repeater->add_control(
            'active_tabs',
            [
                'label'     => __('Active Item', 'rrdevs-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('No', 'rrdevs-addons'),
                'label_off' => __('yes', 'rrdevs-addons'),
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'tab_icon', [
                'label'       => __('Tab Icon', 'rrdevs-addons'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title', [
                'label'       => __('Tab Title', 'rrdevs-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'selected_template',
			[
				'label' => __( 'Select Template', 'rrdevs-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => rrdevs_cpt_slug_and_id('elementor_library'),
			]
		);

        //End Repeater Control field
        $this->add_control(
            'tabs',
            [
                'label'        => __('Tab List', 'rrdevs-addons'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',

            ]
        );

        $this->end_controls_section();
          /**
         * Style tab
         */
        $this->start_controls_section(
            'tab_icon_style',
            [
                'label' => __( 'Tab Icon', 'rrdevs-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
					'tab_icon[value]!' => '',
				],
            ]
        );
        $this->start_controls_tabs(
            'icon_style_tabs'
        );

        $this->start_controls_tab(
            'icon_style_normal_tab',
            [
                'label' => __( 'Normal', 'rrdevs-addons' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_fill_color',
            [
                'label'     => __( 'Icon Fill Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bg_color',
            [
                'label'     => __( 'Icon Background', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_gap',
            [
                'label'      => __( 'Icon gap', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon'          => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label'      => __( 'Icon Size', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_box_size',
            [
                'label'      => __( 'Icon Box Size', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}; display:inline-flex; align-items:center;justify-content:center',
                ],
            ]
        );


        $this->add_responsive_control(
            'icon_box_radius',
            [
                'label'      => __( 'Border Radius', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .rrdevs-addons-tab-icon'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_style_hover_tab',
            [
                'label' => __( 'Hover', 'rrdevs-addons' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __( 'Icon Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .rrdevs-addons-tab-icon,{{WRAPPER}} .tabs li.current .rrdevs-addons-tab-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tabs li:hover .rrdevs-addons-tab-icon path,{{WRAPPER}} .tabs li.current .rrdevs-addons-tab-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_fill_color_hover',
            [
                'label'     => __( 'Icon Fill Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .rrdevs-addons-tab-icon path,{{WRAPPER}} .tabs li.current .rrdevs-addons-tab-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bg_color_hover',
            [
                'label'     => __( 'Icon Background', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .rrdevs-addons-tab-icon, {{WRAPPER}} .tabs li.current .rrdevs-addons-tab-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();



        $this->end_controls_section();

        $this->start_controls_section(
            'tab_link_style',
            [
                'label' => __( 'Tab Links', 'rrdevs-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->start_controls_tabs(
            'tabs_style_tabs'
        );

        $this->start_controls_tab(
            'tabs_style_normal_tab',
            [
                'label' => __( 'Normal', 'rrdevs-addons' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tabs_typography',
                'label'    => __( 'Typography', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li',
            ]
        );

        $this->add_control(
            'tabs_color',
            [
                'label'     => __( 'Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tabs_background',
            [
                'label'     => __( 'Background Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_border',
                'label'    => __( 'Border', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_shadow',
                'label'    => __( 'Shadow', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li',
            ]
        );
        $this->add_responsive_control(
            'tabs_width',
            [
                'label'      => __( 'Min Width', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li'          => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_height',
            [
                'label'      => __( 'Min Height', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li'          => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_radius',
            [
                'label'      => __( 'Border Radius', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tabs_padding',
            [
                'label'      => __( 'Padding', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_margin',
            [
                'label'      => __( 'Margin', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_style_hover_tab',
            [
                'label' => __( 'Hover', 'rrdevs-addons' ),
            ]
        );

        $this->add_control(
            'tabs_hover_color',
            [
                'label'     => __( 'Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li.current' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tabs_hover_background',
            [
                'label'     => __( 'Background Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li.current' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_hover_border',
                'label'    => __( 'Border', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li.current',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_hover_shadow',
                'label'    => __( 'Tabs Shadow', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li.current',
            ]
        );

        $this->add_responsive_control(
            'tabs_hover_radius',
            [
                'label'      => __( 'Border Radius', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li.current'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs>li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'tabs_wrap_style',
            [
                'label' => __( 'Tabs', 'rrdevs-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tabs_align',
            [
                'label'        => __( 'Box Align', 'rrdevs-addons' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __( 'Left', 'rrdevs-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'top', 'rrdevs-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'rrdevs-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'  => [
                        'title' => __( 'Right', 'rrdevs-addons' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'devices'      => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu' => 'text-align: {{VALUE}}',
                ],
                'toggle'       => true,
            ]
        );

        $this->add_responsive_control(
			'tabs_justify_content',
			[
				'label' => __( 'Horizontal Align', 'rrdevs-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    '' => __('Default', 'rrdevs-addons'),
                    'flex-start' => __( 'Start', 'rrdevs-addons' ),
                    'center' => __( 'Center', 'rrdevs-addons' ),
                    'flex-end' => __( 'End', 'rrdevs-addons' ),
                    'space-between' => __( 'Space Between', 'rrdevs-addons' ),
                    'space-around' => __( 'Space Around', 'rrdevs-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs' => 'justify-content: {{VALUE}}',
                ],
			]
		);

        $this->add_control(
            'tabs_ul_background',
            [
                'label'     => __( 'Background Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_ul_shadow',
                'label'    => __( 'Shadow', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_ul_border',
                'label'    => __( 'Border', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs',
            ]
        );

        $this->add_responsive_control(
            'tab_ul_width',
            [
                'label'      => __( 'Width', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs'          => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_radius',
            [
                'label'      => __( 'Border Radius', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tabs_ul_padding',
            [
                'label'      => __( 'Padding', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_margin',
            [
                'label'      => __( 'Margin', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-menu ul.tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'tabs_content_style',
            [
                'label' => __( 'Content Box', 'rrdevs-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'tabs_content_background',
            [
                'label'     => __( 'Background Color', 'rrdevs-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons--tab-content-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_content_shadow',
                'label'    => __( 'Shadow', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-content-wrap',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_content_border',
                'label'    => __( 'Border', 'rrdevs-addons' ),
                'selector' => '{{WRAPPER}} .rrdevs-addons--tab-content-wrap',
            ]
        );

        $this->add_responsive_control(
            'tab_content_width',
            [
                'label'      => __( 'Width', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-content-wrap'          => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_radius',
            [
                'label'      => __( 'Border Radius', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-content-wrap'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tabs_content_padding',
            [
                'label'      => __( 'Padding', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-content-wrap'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_margin',
            [
                'label'      => __( 'Margin', 'rrdevs-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons--tab-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    //End Repetare Content
    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();



        ?>
            <div class="rrdevs-addons-tabs-wrapper">
                <div class="rrdevs-addons--tab-menu-wrap">
                    <div class="rrdevs-addons--tab-menu">
                        <ul class="tabs">
                            <?php foreach ($settings['tabs'] as $value):
                                    $active = $value['active_tabs'] == 'yes' ? 'current' : '';

                                    ?>
	                                <li class="tab-link <?php echo esc_attr($active) ?>" data-tab="tab-<?php echo esc_attr($value['_id']) ?>">

	                                    <?php if ($value['tab_icon']['value']): ?>
	                                        <div class="rrdevs-addons-tab-icon">
	                                            <?php \Elementor\Icons_Manager::render_icon($value['tab_icon'], ['aria-hidden' => 'true']);?>
	                                        </div>
	                                    <?php endif;?>

                                    <?php if ($value['tab_title']): ?>
                                        <span><?php echo esc_html($value['tab_title']); ?></span>
                                    <?php endif;?>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>

                <div class="rrdevs-addons--tab-content-wrap">
                <?php foreach ($settings['tabs'] as $value):
                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';

                        ?>
	                    <div id="tab-<?php echo esc_attr($value['_id']) ?>" class="rrdevs-addons-tab-content-single animated fadeInUp
                        <?php echo esc_attr($active) ?>">
                            <?php
                            if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
                                echo '<div class="rrdevs-addons-elm-edit-wrap"><a href="'.\Elementor\Plugin::$instance->documents->get( $value['selected_template'] )->get_edit_url().'" class="rrdevs-addons-elm-edit">'.esc_html__('Edit Template', 'rrdevs-addons').'</a></div>';
                            }
                            ?>
	                        <?php echo rrdevs_layout_content($value['selected_template']) ?>
	                    </div>
	                <?php endforeach;?>
                </div>
            </div>



	<?php
}
}
$widgets_manager->register_widget_type(new \RRdevs_Addons\Widgets\RRdevs_Addons_Tabs());
