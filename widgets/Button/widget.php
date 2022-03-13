<?php
/**
 * Button Widget.
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
use  Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class RRdevs_Button extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rrdevs_btutton';
	}

	public function get_title() {
		return __( 'Button', 'rrdevs-addons' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'rrdevs' ];
	}

    public function get_keywords()
    {
        return ['btn', 'button', 'link'];
    }

	protected function _register_controls() {

		$this->start_controls_section('content_section',
			[
				'label' => __( 'Butoon', 'rrdevs-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control('button_text',
			[
				'label' => __( 'Button Text', 'rrdevs-addons' ),
				'type' => Controls_Manager::TEXT,
                'dynamic'    => [ 'active' => true ],
				'placeholder' => __( 'Button Text', 'rrdevs-addons' ),
				'default' => __( 'Awsome Button', 'rrdevs-addons' ),
				'label_block' => true,
			]
		);

       $this->add_control('rrdevs_button_link_selection',
        [
            'label'         => __('Link Type', 'rrdevs-addons'),
            'type'          => Controls_Manager::SELECT,
            'options'       => [
                'url'   => __('URL', 'premium-addons-for-elementor'),
                'link'  => __('Existing Page', 'rrdevs-addons'),
            ],
            'default'       => 'url',
            'label_block'   => true,
        ]
        );
       $this->add_control('rrdevs_button_link',
            [
                'label'         => __('Link', 'rrdevs-addons'),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'   => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'placeholder'   => 'https://yourdomin.com/',
                'label_block'   => true,
                'condition'     => [
                    'rrdevs_button_link_selection' => 'url'
                ]
            ]
        );
        $this->add_control('rrdevs_button_existing_link',
            [
                'label'         => __('Existing Page', 'rrdevs-addons'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => rrdevs_get_all_pages(),
                'condition'     => [
                    'rrdevs_button_link_selection'     => 'link',
                ],
                'multiple'      => false,
                'separator'     => 'after',
                'label_block'   => true,
            ]
        );

        $this->add_responsive_control('rrdevs_button_align',
			[
				'label'             => __( 'Alignment', 'rrdevs-addons' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'left'    => [
						'title' => __( 'Left', 'rrdevs-addons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'rrdevs-addons' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'rrdevs-addons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
                'selectors'         => [
                    '{{WRAPPER}} .sb_wraper' => 'text-align: {{VALUE}}',
                ],
				'default' => 'left',
			]
		);
		$this->add_control('rrdevs_button_size',
        	[
            'label'         => __('Size', 'rrdevs-addons'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'lg',
            'options'       => [
                    'sm'        => __('Small', 'rrdevs-addons'),
                    'md'        => __('Regular', 'rrdevs-addons'),
                    'lg'        => __('Large', 'rrdevs-addons'),
                    'ex'        => __('Extra Large', 'rrdevs-addons'),
                    'block'     => __('Block', 'rrdevs-addons'),
                ],
            'label_block'   => true,
            'separator'     => 'after',
            ]
        );

        $this->add_control('rrdevs_icon_switcher',
	        [
	            'label'         => __('Icon', 'rrdevs-addons'),
	            'type'          => Controls_Manager::SWITCHER,
	            'description'   => __('Enable or disable button icon','rrdevs-addons'),
	        ]
        );

		$this->add_control(
			'rrdevs_button_icon',
			[
				'label' => __( 'Icon', 'rrdevs-addons' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'condition'     => [
                    'rrdevs_icon_switcher'  => 'yes'
                ],
			]
		);
		$this->add_control(
            'rrdevs_button_icon_position',
            [
                'label' => __( 'Icon Position', 'rrdevs-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'rrdevs-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'rrdevs-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'after',
                'condition' => [
                    'rrdevs_icon_switcher' => 'yes',
                    'rrdevs_button_icon!' => ''
                ]
            ]
        );

        $this->add_control(
			'button_css_id',
			[
				'label' => __( 'Button ID', 'rrdevs-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'rrdevs-addons' ),
				'label_block' => false,
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'themepaw-companion' ),
				'separator' => 'before',

			]
		);
		$this->end_controls_section();
		// End Content Section




		/*
		*Button Icon Style
		*/
		$this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'rrdevs-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'rrdevs_icon_switcher' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'icon_size',
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
                    '{{WRAPPER}} .rrdevs-btn-cion i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rrdevs-btn-cion svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_gap',
            [
                'label' => __('Icon gap', 'rrdevs-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-btn-cion .icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rrdevs-btn-cion .icon-after ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //icon hover

        //btn normal hover style
        $this->start_controls_tabs(
            'icon_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'icon_normal',
            [
                'label' => __('Normal', 'rrdevs-addons'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-btn-cion i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rrdevs-btn-cion path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_stroke_color',
            [
                'label' => __('Icon Stroke Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-btn-cion i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rrdevs-btn-cion path' => 'stroke: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'icon_hover',
            [
                'label' => __('Hover', 'rrdevs-addons'),
            ]
        );

        $this->add_control(
            'hover_icon_color',
            [
                'label' => __('Icon Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-button:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rrdevs-button:hover path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_icon_color_stock_hover',
            [
                'label' => __('Icon Stroke Color', 'rrdevs-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rrdevs-button:hover path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

		/*
		*Button Style
		*/
		$this->start_controls_section('style_section',
			[
				'label' => __( 'Button Style', 'rrdevs-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
        $this->add_control('button_gradient_background',
	        [
	            'label'         => __('Gradient Opction', 'rrdevs-addons'),
	            'type'          => Controls_Manager::SWITCHER,
	            'description'   => __('Use Gradient Background','rrdevs-addons'),
	        ]
        );
		$this->start_controls_tabs('button_style_tabs');

		//Button Tab Normal Start
		$this->start_controls_tab('style_normal_tab',
			[
				'label' => __( 'Normal', 'rrdevs-addons' ),
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'rrdevs_button_typo_normal',
                'selector'          => '{{WRAPPER}} .rrdevs-button',

            ]
        );
		$this->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'rrdevs-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1D263A',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-button' => 'color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'rrdevs_button_gradient_background_normal',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .rrdevs-button',
				'condition' => [
					'button_gradient_background' => 'yes'
				],
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background', 'rrdevs-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFCD28',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-button,
					 {{WRAPPER}} .rrdevs-button.rrdevs-button-style2-shutinhor:before,
					 {{WRAPPER}} .rrdevs-button.rrdevs-button-style2-shutinver:before,
					 {{WRAPPER}} .rrdevs-button.rrdevs-button-style3-radialin:before,
					 {{WRAPPER}} .rrdevs-button.rrdevs-button-style3-rectin:before'   => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_gradient_background!' => 'yes'
				],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),[
				'name' => 'button_box_shadow',
				'label' => __( 'Box Shadow', 'rrdevs-addons' ),
				'selector' => '{{WRAPPER}} .rrdevs-button',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'border_normal',
                'selector'      => '{{WRAPPER}} .rrdevs-button',
            ]

        );
        $this->add_control('border_radius_normal',
            [
                'label'         => __('Border Radius', 'rrdevs-addons'),
                'type'          => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .rrdevs-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		$this->add_responsive_control('padding',
			[
				'label' => __( 'Padding', 'rrdevs-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .rrdevs-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]

			]
		);
		$this->add_responsive_control('margin',
			[
				'label' => __( 'Margin', 'rrdevs-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .rrdevs-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]

			]
		);
		$this->end_controls_tab();
		// Button Tab Normal End

		//Button Tab Hover Start
		$this->start_controls_tab('style_hover_tab',
			[
				'label' => __( 'Hover', 'rrdevs-addons' ),
			]
		);


		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'rrdevs_button_typo_hover',
                'selector'          => '{{WRAPPER}} .rrdevs-button:hover',

            ]
        );
		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'rrdevs-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'rrdevs_button_gradient_background_hover',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .rrdevs-button:hover',
				'condition' => [
					'button_gradient_background' => 'yes'
				],
			]
		);
		$this->add_control(
			'background_hover_color',
			[
				'label' => __( 'Background', 'rrdevs-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222831',
				'selectors' => ['
					{{WRAPPER}} .rrdevs-button-none:hover,
					{{WRAPPER}} .rrdevs-button-style1-top:before,
					{{WRAPPER}} .rrdevs-button-style1-right:before,
					{{WRAPPER}} .rrdevs-button-style1-bottom:before,
					{{WRAPPER}} .rrdevs-button-style1-left:before,
					{{WRAPPER}} .rrdevs-button-style2-shutouthor:before,
					{{WRAPPER}} .rrdevs-button-style2-shutoutver:before,
					{{WRAPPER}} .rrdevs-button-style2-shutinhor,
					{{WRAPPER}} .rrdevs-button-style2-shutinver,
					{{WRAPPER}} .rrdevs-button-style2-dshutinhor:before,
					{{WRAPPER}} .rrdevs-button-style2-dshutinver:before,
					{{WRAPPER}} .rrdevs-button-style2-scshutouthor:before,
					{{WRAPPER}} .rrdevs-button-style2-scshutoutver:before,
					{{WRAPPER}} .rrdevs-button-style3-radialin,
					{{WRAPPER}} .rrdevs-button-style3-radialout:before,
					{{WRAPPER}} .rrdevs-button-style3-rectin:before,
					{{WRAPPER}} .rrdevs-button-style3-rectout:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_gradient_background!' => 'yes'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .rrdevs-button:hover',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'border_hover',
                'selector'      => '{{WRAPPER}} .rrdevs-button:hover',
            ]
        );


        //Animation Hover
        $this->add_control('rrdevs_button_hover_effect',
            [
                'label'         => __('Hover Effect', 'rrdevs-addons'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'none',
                'options'       => [
                    'none'          => __('None', 'rrdevs-addons'),
                    'style1'        => __('Slide', 'rrdevs-addons'),
                    'style2'        => __('Shutter', 'rrdevs-addons'),
                    'style3'        => __('In & Out', 'rrdevs-addons'),
                ],
                'label_block'   => true,
            ]
        );
		$this->add_control('rrdevs_button_style1_dir',
        [
            'label'         => __('Slide Direction', 'rrdevs-addons'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'bottom',
            'options'       => [
                'bottom'       => __('Top to Bottom', 'rrdevs-addons'),
                'top'          => __('Bottom to Top', 'rrdevs-addons'),
                'left'         => __('Right to Left', 'rrdevs-addons'),
                'right'        => __('Left to Right', 'rrdevs-addons'),
            ],
            'condition'     => [
                'rrdevs_button_hover_effect' => 'style1',
            ],
            'label_block'   => true,
            ]
        );
		$this->add_control('rrdevs_button_style2_dir',
        [
            'label'         => __('Shutter Direction', 'rrdevs-addons'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'shutouthor',
            'options'       => [
                'shutinhor'     => __('Shutter in Horizontal', 'rrdevs-addons'),
                'shutinver'     => __('Shutter in Vertical', 'rrdevs-addons'),
                'shutoutver'    => __('Shutter out Horizontal', 'rrdevs-addons'),
                'shutouthor'    => __('Shutter out Vertical', 'rrdevs-addons'),
                'scshutoutver'  => __('Scaled Shutter Vertical', 'rrdevs-addons'),
                'scshutouthor'  => __('Scaled Shutter Horizontal', 'rrdevs-addons'),
                'dshutinver'   => __('Tilted Left'),
                'dshutinhor'   => __('Tilted Right'),
            ],
            'condition'     => [
                'rrdevs_button_hover_effect' => 'style2',
            ],
            'label_block'   => true,
            ]
        );
		$this->end_controls_tabs();
		$this->end_controls_tab();
		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		//Button Text And Style
		$button_text = $settings['button_text'];
		$button_size = 'rrdevs-button-' . $settings['rrdevs_button_size'];
		$button_hover = $settings['rrdevs_button_hover_effect'];

		//Button Hover Effect
		if ($button_hover == 'none') {
			$button_hover_style = 'rrdevs-button-none';
		}elseif($button_hover == 'style1'){
			$button_hover_style = 'rrdevs-button-style1-' . $settings['rrdevs_button_style1_dir'];
		}elseif ($button_hover == 'style2') {
			$button_hover_style = 'rrdevs-button-style2-' . $settings['rrdevs_button_style2_dir'];
		}elseif ($button_hover == 'style3') {
			$button_hover_style = 'rrdevs-button-style3-' . $settings['rrdevs_button_style3_dir'];
		}

		//Butoon ID
		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'rrdevs_button', 'id', $settings['button_css_id'] );
		}

        if( $settings['rrdevs_button_link_selection'] == 'url' ){
            $button_url = $settings['rrdevs_button_link']['url'];
        } else {
            $button_url = get_permalink( $settings['rrdevs_button_existing_link'] );
        }
		//Button Class Href
		$this->add_render_attribute( 'rrdevs_button', [
			'class'	=> ['rrdevs-button', esc_attr($button_size), esc_attr($button_hover_style) ],
			'href'	=> esc_attr($button_url),
		]);


		if( $settings['rrdevs_button_link']['is_external'] ) {
			$this->add_render_attribute( 'rrdevs_button', 'target', '_blank' );
		}
		if( $settings['rrdevs_button_link']['nofollow'] ) {
			$this->add_render_attribute( 'rrdevs_button', 'rel', 'nofollow');
		}

		$this->add_render_attribute( 'rrdevs_button', 'data-text', esc_attr($settings['button_text'] ));

		?>
		<div  class="sb_wraper">
			<a  <?php echo $this->get_render_attribute_string( 'rrdevs_button' ); ?>>

			 	<?php if ( $settings['rrdevs_button_icon_position'] == 'before' && !empty($settings['rrdevs_button_icon']['value']) ) : ?>
					<span class="rrdevs-btn-cion icon-before"><?php Icons_Manager::render_icon($settings['rrdevs_button_icon'], ['aria-hidden' => 'true']) ?></span>
                <?php endif; ?>

				<span><?php echo esc_html($button_text) ?></span>

				<?php if ( $settings['rrdevs_button_icon_position'] === 'after' && !empty($settings['rrdevs_button_icon']['value'])) : ?>
                    <span class="rrdevs-btn-cion icon-after"><?php Icons_Manager::render_icon($settings['rrdevs_button_icon'], ['aria-hidden' => 'true']) ?></span>
                <?php endif; ?>
			</a>
		</div>
		<?php
	}
}
$widgets_manager->register_widget_type( new \RRdevs\Widgets\Elementor\RRdevs_Button() );