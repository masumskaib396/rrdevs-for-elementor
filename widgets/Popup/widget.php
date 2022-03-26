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

class RRdevs_Popup extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rrdevs-popup';
	}

	public function get_title() {
		return __( 'Popup', 'rrdevs-addons' );
	}

	public function get_icon() {
		return 'eicon-slider-device';
	}

	public function get_categories() {
		return [ 'rrdevs' ];
	}

    public function get_keywords()
    {
        return ['popup', 'video', 'modal', 'rrdevs'];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Popup Content', 'rrdevs-addons'),
            ]
        );

        $this->add_control(
			'popup_selected_template',
			[
				'label' => __( 'Select Template', 'rrdevs-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => rrdevs_cpt_slug_and_id('elementor_library'),
			]
		);

        $this->add_control(
			'rrdevs_popup_button_icon',
			[
				'label' => __( 'Open Icon', 'rrdevs-addons' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
                'default' => [
                    'value' => 'fas fa-bars',
                    'library' => 'fa-solid',
                ],
			]
		);

		$this->add_control(
			'rrdevs_popup_button_icon_close',
			[
				'label' => __( 'Close Icon', 'rrdevs-addons' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
                'default' => [
                    'value' => 'fas fa-close',
                    'library' => 'fa-solid',
                ],
			]
		);
        $this->end_controls_section();
		// box
		$this->start_controls_section('modal_box',
			[
				'label' => __( 'Box', 'rrdevs-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'box_bg',
            [
                'label' => __('Box Background', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-popup-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Shadow', 'techex-hp' ),
                'selector' => '{{WRAPPER}} .techex-btn',
            ]
        );
		$this->add_responsive_control(
            'box_margin',
            [
                'label' => __('Margin', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-popup-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .rrdevs-addons-popup-content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'box_border_radius',
            [
                'label' => __('Border Radius', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-popup-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .rrdevs-addons-popup-content' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'box_padding',
            [
                'label' => __('Padding', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-popup-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .rrdevs-addons-popup-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section('open_content_section',
			[
				'label' => __( 'Open Icon', 'rrdevs-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		//normal hover style
		$this->start_controls_tabs(
            'open_style_tabs'
        );

		// normal
        $this->start_controls_tab(
            'icon_open_normal',
            [
                'label' => __('Normal', 'rrdevs-addons'),
            ]
        );
		$this->add_control(
            'open_icon_color',
            [
                'label' => __('Icon Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .popup-menubar path' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .popup-menubar path' => 'fill: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'open_icon_bg_color',
            [
                'label' => __('Icon Background Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'icon_open_size',
            [
                'label' => __('Icon Size', 'rrdevs-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .popup-menubar svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'open_icon_margin',
            [
                'label'          => __('Margin', 'rrdevs-addons'),
                'type'           => Controls_Manager::DIMENSIONS,
                'selectors'      => [
                    '{{WRAPPER}} .popup-menubar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'open_icon_padding',
            [
                'label'          => __('Padding', 'rrdevs-addons'),
                'type'           => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'      => [
                    '{{WRAPPER}} .popup-menubar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'open_icon_border_radius',
            [
                'label'          => __('Border Radius', 'rrdevs-addons'),
                'type'           => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'      => [
                    '{{WRAPPER}} .popup-menubar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();

		// Hover
        $this->start_controls_tab(
            'icon_open_hover',
            [
                'label' => __('Hover', 'rrdevs-addons'),
            ]
        );
	
		$this->add_control(
            'open_icon_hovercolor',
            [
                'label' => __('Hover Icon Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .popup-menubar:hover path' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .popup-menubar:hover path' => 'fill: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'open_icon_hover_bg_color',
            [
                'label' => __('Hover Icon Background Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-menubar:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section('close_content_section',
			[
				'label' => __( 'Close Icon', 'rrdevs-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		//normal hover style
		$this->start_controls_tabs(
			'close_style_tabs'
		);

		// normal
		$this->start_controls_tab(
			'icon_close_normal',
			[
				'label' => __('Normal', 'rrdevs-addons'),
			]
		);
		$this->add_control(
            'icon_close_size',
            [
                'label' => __('Icon Size', 'rrdevs-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #offset-menu-close-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #offset-menu-close-btn svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'close_icon_color',
			[
				'label' => __('Icon Color', 'rrdevs-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #offset-menu-close-btn i' => 'color: {{VALUE}}',
					'{{WRAPPER}} #offset-menu-close-btn path' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} #offset-menu-close-btn path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'close_icon_bg_color',
			[
				'label' => __('Icon Color', 'rrdevs-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #offset-menu-close-btn' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'close_icon_margin',
			[
				'label'          => __('Margin', 'rrdevs-addons'),
				'type'           => Controls_Manager::DIMENSIONS,
				'selectors'      => [
					'{{WRAPPER}} #offset-menu-close-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_icon_padding',
			[
				'label'          => __('Padding', 'rrdevs-addons'),
				'type'           => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'      => [
					'{{WRAPPER}} #offset-menu-close-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_icon_border_radius',
			[
				'label'          => __('Border Radius', 'rrdevs-addons'),
				'type'           => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'      => [
					'{{WRAPPER}} #offset-menu-close-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_close_hover',
			[
				'label' => __('Hover', 'rrdevs-addons'),
			]
		);
		$this->add_control(
			'close_icon_hover_color',
			[
				'label' => __('Hover Icon Color', 'rrdevs-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #offset-menu-close-btn:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} #offset-menu-close-btn:hover path' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} #offset-menu-close-btn:hover path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'close_icon_hover_bg_color',
			[
				'label' => __('Hover Icon Background Color', 'rrdevs-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #offset-menu-close-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
        


        ?>

            <div class="rrdevs-addons-popup-content-wraper">

                
				<div class="rrdevs-addons-popup-content">
					<span id="offset-menu-close-btn">
						<?php Icons_Manager::render_icon( $settings['rrdevs_popup_button_icon_close'], ['aria-hidden' => 'true'] ); ?>
					</span>
					<?php echo rrdevs_layout_content($settings['popup_selected_template']); ?>
				</div>
			
                <div class="rrdevs-addons-popup">
                    <span class="popup-menubar">
						<?php Icons_Manager::render_icon( $settings['rrdevs_popup_button_icon'], ['aria-hidden' => 'true'] ); ?>
					</span>
                </div>

            </div>

        <?php
	}
}
$widgets_manager->register_widget_type( new \RRdevs\Widgets\Elementor\RRdevs_Popup() );