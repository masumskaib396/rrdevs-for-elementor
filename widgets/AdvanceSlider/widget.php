<?php
/**
 * Slider Widget.
 *
 *
 * @since 1.0.0
 */
namespace RRdevs\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;   
use  Elementor\Repeater;
use  Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class RRdevs_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rrdevs_slider';
	}

	public function get_title() {
		return __( 'Slider', 'rrdevs-addons' );
	}

	public function get_icon() {
		return 'eicon-slider-device';
	}

	public function get_categories() {
		return [ 'rrdevs' ];
	}

    public function get_keywords()
    {
        return ['slider', 'slide', 'hero', 'rrdevs'];
    }

	protected function register_controls() {


        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Sliders', 'rrdevs-addons'),
            ]
        );

        //Start Repetare Content  Slider one
        $repeater = new Repeater();




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
            'sliders',
            [
                'label'        => __('Slider List', 'rrdevs-addons'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater->get_controls(),

            ]
        );
        $this->end_controls_section();

        //Slider Setting
        $this->start_controls_section('slider_settings',
            [
            'label' => __('Slider Settings', 'rrdevs-addons'),
            'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __( 'Slider Items', 'rrdevs-addons' ),
                'type' => Controls_Manager::SELECT,
                'default'            => 1,
                'tablet_default'     => 1,
                'mobile_default'     => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __( 'Show arrows?', 'rrdevs-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rrdevs-addons' ),
                'label_off' => __( 'Hide', 'rrdevs-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __( 'Show Dots?', 'rrdevs-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rrdevs-addons' ),
                'label_off' => __( 'Hide', 'rrdevs-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label' => __( 'Show MouseDrag', 'rrdevs-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rrdevs-addons' ),
                'label_off' => __( 'Hide', 'rrdevs-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Auto Play?', 'rrdevs-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rrdevs-addons' ),
                'label_off' => __( 'Hide', 'rrdevs-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Infinite Loop', 'rrdevs-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rrdevs-addons' ),
                'label_off' => __( 'Hide', 'rrdevs-addons' ),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __( 'Autoplay Timeout', 'rrdevs-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __( '1 Second', 'rrdevs-addons' ),
                    '2000'  => __( '2 Second', 'rrdevs-addons' ),
                    '3000'  => __( '3 Second', 'rrdevs-addons' ),
                    '4000'  => __( '4 Second', 'rrdevs-addons' ),
                    '5000'  => __( '5 Second', 'rrdevs-addons' ),
                    '6000'  => __( '6 Second', 'rrdevs-addons' ),
                    '7000'  => __( '7 Second', 'rrdevs-addons' ),
                    '8000'  => __( '8 Second', 'rrdevs-addons' ),
                    '9000'  => __( '9 Second', 'rrdevs-addons' ),
                    '10000' => __( '10 Second', 'rrdevs-addons' ),
                    '11000' => __( '11 Second', 'rrdevs-addons' ),
                    '12000' => __( '12 Second', 'rrdevs-addons' ),
                    '13000' => __( '13 Second', 'rrdevs-addons' ),
                    '14000' => __( '14 Second', 'rrdevs-addons' ),
                    '15000' => __( '15 Second', 'rrdevs-addons' ),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __( 'Previous Icon', 'rrdevs-addons' ),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_next_icon',
            [
                'label' => __( 'Next Icon', 'rrdevs-addons' ),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        *
        Dots
        */
        $this->start_controls_section(
            'dots_navigation',
            [
                'label' => __('Navigation - Dots', 'rrdevs-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'yes'
                ],
            ]
        );
        $this->start_controls_tabs('_tabs_dots');

        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __('Normal', 'rrdevs-addons'),
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_align',
            [
                'label' => __( 'Alignment', 'rrdevs-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'rrdevs-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'rrdevs-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'rrdevs-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_box_width',
            [
                'label' => __('Width', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_box_height',
            [
                'label' => __('Height', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label'          => __('Gap Right', 'rrdevs-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_min_margin',
            [
                'label'      => __('Margin', 'rrdevs-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hero-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .hero-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => __('Border Radius', 'rrdevs-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __('Active', 'rrdevs-addons'),
            ]
        );
        $this->add_control(
            'dots_color_active',
            [
                'label' => __('Active Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_width',
            [
                'label' => __('Width', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_height',
            [
                'label' => __('Height', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-hero-slider ul.hero-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /*
        *
        Arrows
        */
        $this->start_controls_section(
            'arrows_navigation',
            [
                'label' => __('Navigation - Arrow', 'rrdevs-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs('_tabs_arrow');

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'rrdevs-addons'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .hero-slider-arrow button svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color_fill',
            [
                'label' => __('Line Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => "#222",
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .hero-slider-arrow button ',
            ]
        );

        $this->add_control(
            'popover-toggle',
            [
                'label'        => __( 'Field advanced option', 'rrdevs-addons' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'rrdevs-addons' ),
                'label_on'     => __( 'Custom', 'rrdevs-addons' ),
                'return_value' => 'yes',
            ]
        );
      $this->start_popover();

        $this->add_responsive_control(
            'rrdevs_addons_position_type',
            [
                'label' => __('Position Type', 'rr-addons'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('Default', 'rr-addons'),
                    'static' => __('Static', 'rr-addons'),
                    'relative' => __('Relative', 'rr-addons'),
                    'absolute' => __('Absolute', 'rr-addons'),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow' => 'position:{{VALUE}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'rrdevs_addons_position_top',
            array(
                'label' => __('Top', 'rr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .hero-slider-arrow' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'rrdevs_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'rrdevs_addons_position_right',
            array(
                'label' => __('Right', 'rr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .hero-slider-arrow' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'rrdevs_addons_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'rrdevs_addons_position_bottom',
            array(
                'label' => __('Bottom', 'rr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .hero-slider-arrow' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'rrdevs_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'rrdevs_addons_position_left',
            array(
                'label' => __('Left', 'rr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .hero-slider-arrow' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'rrdevs_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'rrdevs_addons_position_from_center',
            array(
                'label' => __('From Center', 'rr-addons'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'rr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .hero-slider-arrow' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'rrdevs_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'rrdevs_addons_position_zindex',
            array(
                'label' => __('Z-Index', 'rr-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .hero-slider-arrow' => 'z-index:{{VALUE}};',
                ),
            )
        );

        // End Custom Postion

        $this->add_control(
            'arrow_horizontal_position',
            [
                'label'             => __( 'Horizontal Position', 'rrdevs-addons' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'space_between',
                'options'           => [
                    'default'    =>   __('Default',    'rrdevs-addons'),
                    'space_between'    =>   __('Space Between',    'rrdevs-addons'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'arrow_position_x_prev',
            [
                'label' => __( 'Horizontal Prev', 'rrdevs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .hero-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],

            ]
        );

        $this->add_responsive_control(
            'arrow_position_right',
            [
                'label' => __( 'Horizontal Next', 'rrdevs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __( 'Arrow Gap', 'rrdevs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                    '{{WRAPPER}} .hero-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_arrow',
            [
                'label' => __( 'Alignment', 'rrdevs-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'rrdevs-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'rrdevs-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'rrdevs-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

    $this->end_popover();

        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label' => __('Icon Size', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .hero-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .hero-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label' => __('Size', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrow_size_line_height',
            [
                'label' => __('Line Height', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'rrdevs-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .hero-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .hero-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'rrdevs-addons'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .hero-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .hero-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_active',
            [
                'label' => __('Active', 'rrdevs-addons'),
            ]
        );

        $this->add_control(
            'arrow_active_color',
            [
                'label' => __('Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .hero-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_active_fill_color',
            [
                'label' => __('Line Color', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .hero-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_active_color',
            [
                'label' => __('Background Color Hover', 'rrdevs-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();

         //this code slider option
		$slider_extraSetting = array(

	        'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
	        'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
	        'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
        	'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
        	'mousedrag' => (!empty($settings['mousedrag']) && 'yes' === $settings['mousedrag']) ? true : false,
        	'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',

        	//this a responsive layout
            'per_coulmn' =>        (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );

        $jasondecode = wp_json_encode($slider_extraSetting);


        $this->add_render_attribute('slider_version', 'class', array('rrdevs-hero-slider'));
        $this->add_render_attribute('slider_version', 'data-settings', $jasondecode);



        ?>
        <div class="rrdevs-addons--slider-content-wrap">
            <div <?php echo $this->get_render_attribute_string('slider_version'); ?>>
                <?php foreach ($settings['sliders'] as $value):

                        ?>
                        <div class="rrdevs-addons-Slider-content-single">
                            <?php
                                if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
                                    echo '<div class="rrdevs-addons-elm-edit-wrap"><a target="_blank" href="'.\Elementor\Plugin::$instance->documents->get( $value['selected_template'] )->get_edit_url().'" class="rrdevs-addons-elm-edit">'.esc_html__('Edit Template', 'rrdevs-addons').'</a></div>';
                                }
                            ?>
                            <?php echo rrdevs_layout_content($value['selected_template']) ?>
                        </div>
                    <?php endforeach;?>
                </div>

                <?php if ( 'yes' == $settings['arrows'] ): ?>
                    <div class="hero-slider-arrow">
                        <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                            <button type="button" class="slick-prev prev slick-arrow slick-active">
                                <?php Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?>
                            </button>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                            <button type="button" class="slick-next next slick-arrow ">
                                <?php Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php
	}
}
$widgets_manager->register_widget_type( new \RRdevs\Widgets\Elementor\RRdevs_Slider() );