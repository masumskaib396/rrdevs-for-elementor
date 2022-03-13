<?php
namespace RRdevs_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class RRdevs_Modal_Popup extends Widget_Base {

	public function get_name() {
		return 'rrdevs-modal-popup';
	}

	public function get_title() {
		return esc_html__( 'Modal Popup', 'rrdevs-addons' );
	}

	public function get_icon() {
		return 'eicon-video-camera';
	}

	public function get_categories() {
		return [ 'rrdevs' ];
	}

	public function get_keywords() {
		return [ 'rrdevs', 'lightbox', 'popup', 'quickview', 'video', 'btn', 'button' ];
	}

	protected function register_controls() {

		/**
		 * Modal Popup Content section
		 */
		$this->start_controls_section(
			'rrdevs_modal_content_section',
			[
				'label' => __( 'Contents', 'rrdevs-addons' )
			]
		);

		$this->add_control(
			'rrdevs_modal_content',
			[
				'label'   => __( 'Type of Modal', 'rrdevs-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
					'image'          => __( 'Image', 'rrdevs-addons' ),
					'image-gallery'  => __( 'Image Gallery', 'rrdevs-addons' ),
					'html_content'   => __( 'HTML Content', 'rrdevs-addons' ),
					'youtube'        => __( 'Youtube Video', 'rrdevs-addons' ),
					'vimeo'          => __( 'Vimeo Video', 'rrdevs-addons' ),
					'external-video' => __( 'Self Hosted Video', 'rrdevs-addons' ),
					'external_page'  => __( 'External Page', 'rrdevs-addons' ),
					'shortcode'      => __( 'ShortCode', 'rrdevs-addons' )
				]
			]
		);

		/**
		 * Modal Popup image section
		 */
		$this->add_control(
			'rrdevs_modal_image',
			[
				'label'      => __( 'Image', 'rrdevs-addons' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' 	 => Utils::get_placeholder_image_src()
				],
				'dynamic'    => [
					'active' => true
                ],
                'condition'  => [
                    'rrdevs_modal_content' => 'image'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
                    'rrdevs_modal_content' => 'image'
                ]
			]
		);

		/**
		 * Modal Popup image gallery
		 */

		$this->add_control(
			'rrdevs_modal_image_gallery_column',
			[
				'label'   => __( 'Column', 'rrdevs-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'column-three',
                'options' => [
					'column-one'   => __( 'Column 1', 'rrdevs-addons' ),
					'column-two'   => __( 'Column 2', 'rrdevs-addons' ),
					'column-three' => __( 'Column 3', 'rrdevs-addons' ),
					'column-four'  => __( 'Column 4', 'rrdevs-addons' ),
					'column-five'  => __( 'Column 5', 'rrdevs-addons' ),
					'column-six'   => __( 'Column 6', 'rrdevs-addons' )
				],
				'condition' => [
					'rrdevs_modal_content' => 'image-gallery'
				]
			]
		);

		$image_repeater = new Repeater();

		$image_repeater->add_control(
			'rrdevs_modal_image_gallery',
			[
				'label'   => __( 'Image', 'rrdevs-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$image_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
			]
		);

		$image_repeater->add_control(
			'rrdevs_modal_image_gallery_text',
			[
				'label' => __( 'Description', 'rrdevs-addons' ),
				'type'  => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'rrdevs_modal_image_gallery_repeater',
			[
				'label'   => esc_html__( 'Image Gallery', 'rrdevs-addons' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $image_repeater->get_controls(),
				'default' => [
					[ 'rrdevs_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'rrdevs_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'rrdevs_modal_image_gallery' => Utils::get_placeholder_image_src() ]
				],
				'condition' => [
					'rrdevs_modal_content' => 'image-gallery'
				]
			]
		);
		/**
		 * Modal Popup html content section
		 */
		$this->add_control(
			'rrdevs_modal_html_content',
			[
				'label'     => __( 'Add your content here (HTML/Shortcode)', 'rrdevs-addons' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your popup content here', 'rrdevs-addons' ),
				'dynamic'   => [ 'active' => true ],
				'condition' => [
				  	'rrdevs_modal_content' => 'html_content'
			  	]
			]
		);

		/**
		 * Modal Popup video section
		 */

		$this->add_control(
            'rrdevs_modal_youtube_video_url',
            [
				'label'       => __( 'Provide Youtube Video URL', 'rrdevs-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',
				'placeholder' => __( 'Place Youtube Video URL', 'rrdevs-addons' ),
				'title'       => __( 'Place Youtube Video URL', 'rrdevs-addons' ),
				'condition'   => [
                    'rrdevs_modal_content' => 'youtube'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );


        $this->add_control(
            'rrdevs_modal_vimeo_video_url',
            [
				'label'       => __( 'Provide Vimeo Video URL', 'rrdevs-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://vimeo.com/347565673',
				'placeholder' => __( 'Place Vimeo Video URL', 'rrdevs-addons' ),
				'title'       => __( 'Place Vimeo Video URL', 'rrdevs-addons' ),
				'condition'   => [
                    'rrdevs_modal_content' => 'vimeo'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
		);

		/**
		 * Modal Popup external video section
		 */
		$this->add_control(
			'rrdevs_modal_external_video',
			[
				'label'      => __( 'External Video', 'rrdevs-addons' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'dynamic' => [
					'active' => true,
				],
				'condition'  => [
                    'rrdevs_modal_content' => 'external-video'
                ]
			]
		);

		$this->add_control(
            'rrdevs_modal_external_page_url',
            [
				'label'       => __( 'Provide External URL', 'rrdevs-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://rrdevsdevs.com',
				'placeholder' => __( 'Place External Page URL', 'rrdevs-addons' ),
				'condition'   => [
                    'rrdevs_modal_content' => 'external_page'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_responsive_control(
            'rrdevs_modal_video_width',
            [
				'label'        => __( 'Content Width', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 720
                ],
                'selectors'    => [
					'{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element iframe,
					{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-video-hosted' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rrdevs-modal-item' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'rrdevs_modal_content' => [ 'youtube', 'vimeo', 'external_page', 'external-video' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'rrdevs_modal_video_height',
            [
				'label'        => __( 'Content Height', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
						'min'  => 0,
						'max'  => 100
                    ]
                ],
                'default'      => [
					'unit'     => 'px',
					'size'     => 400
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rrdevs-modal-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'rrdevs_modal_content' => [ 'youtube', 'vimeo', 'external_page' ]
                ]
            ]
        );

        $this->add_control(
            'rrdevs_modal_shortcode',
            [
				'label'       => __( 'Enter your shortcode', 'rrdevs-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( '[gallery]', 'rrdevs-addons' ),
				'condition'   => [
                    'rrdevs_modal_content' => 'shortcode'
                ]
            ]
		);

		$this->add_responsive_control(
			'rrdevs_modal_content_width',
			[
				'label' => __( 'Content Width', 'rrdevs-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-item' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
                    'rrdevs_modal_content' => [ 'image', 'image-gallery', 'html_content', 'shortcode' ]
                ]
			]
		);

		$this->add_control(
			'rrdevs_modal_btn_text',
			[
				'label'       => __( 'Button Text', 'rrdevs-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'rrdevs-addons' ),
				'dynamic'     => [
					'active'  => true
				]
			]
		);

		$this->add_control(
			'rrdevs_modal_btn_icon',
			[
				'label'       => __( 'Button Icon', 'rrdevs-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-brands'
                ]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup settings section
		 */
		$this->start_controls_section(
			'rrdevs_modal_setting_section',
			[
				'label' => __( 'Settings', 'rrdevs-addons' )
			]
		);

		$this->add_control(
			'rrdevs_modal_button_overlay',
			[
				'label'        => __( 'Button Animaion overlay', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'rrdevs-addons' ),
				'label_off'    => __( 'Hide', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'rrdevs_modal_button_overlay_color',
			[
				'label'     => __( 'Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => [
				'{{WRAPPER}} .rrdevs-modal-button::after' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'rrdevs_modal_button_overlay' => 'yes'
				]
			]
		);


		

		$this->add_control(
			'rrdevs_modal_overlay',
			[
				'label'        => __( 'Background overlay', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'rrdevs-addons' ),
				'label_off'    => __( 'Hide', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'rrdevs_modal_overlay_click_close',
			[
				'label'     => __( 'Close While Clicked Outside', 'rrdevs-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'ON', 'rrdevs-addons' ),
				'label_off' => __( 'OFF', 'rrdevs-addons' ),
				'default'   => 'yes',
				'condition' => [
					'rrdevs_modal_overlay' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup button style
		 */

		$this->start_controls_section(
			'rrdevs_modal_display_settings',
			[
				'label' => __( 'Button', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		/**
		 * display settings for button normal and hover
		 */
		$this->start_controls_tabs( 'rrdevs_modal_btn_typhography_color', ['separator' => 'before' ] );

			$this->start_controls_tab( 'rrdevs_modal_btn_typhography_color_normal_tab', [ 'label' => esc_html__( 'Normal', 'rrdevs-addons' )] );

				$this->add_control(
					'rrdevs_modal_btn_typhography_color_normal',
					[
						'label'     => __( 'Color', 'rrdevs-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action span' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'rrdevs_modal_btn_background_normal',
					[
						'label'     => __( 'Background Color', 'rrdevs-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#4243DC',
						'selectors' => [
							'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_responsive_control(
					'rrdevs_modal_btn_align',
					[
						'label'         => __( 'Alignment', 'rrdevs-addons' ),
						'type'          => Controls_Manager::CHOOSE,
						'default'       => 'center',
						'toggle'        => false,
						'separator'     => 'before',
						'options'       => [
							'left'      => [
								'title' => __( 'Left', 'rrdevs-addons' ),
								'icon'  => 'eicon-text-align-left'
							],
							'center'    => [
								'title' => __( 'Center', 'rrdevs-addons' ),
								'icon'  => 'eicon-text-align-center'
							],
							'right'     => [
								'title' => __( 'Right', 'rrdevs-addons' ),
								'icon'  => 'eicon-text-align-right'
							]
						],
						'selectors'     => [
							'{{WRAPPER}} .rrdevs-modal-button' => 'text-align: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'rrdevs_modal_btn_typhography',
						'label'     => __( 'Button Typography', 'rrdevs-addons' ),
						'selector'  => '{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action span'
					]
				);

				$this->add_control(
					'rrdevs_modal_btn_enable_fixed_width_height',
					[
						'label' => __( 'Enable Fixed Height & Width?', 'rrdevs-addons' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'Show', 'rrdevs-addons' ),
						'label_off' => __( 'Hide', 'rrdevs-addons' ),
						'return_value' => 'yes',
						'default' => 'yes',
					]
				);

				$this->add_control(
					'rrdevs_modal_btn_fixed_width_height',
					[
						'label' => __( 'Fixed Height & Width', 'rrdevs-addons' ),
						'type' => Controls_Manager::POPOVER_TOGGLE,
						'label_off' => __( 'Default', 'rrdevs-addons' ),
						'label_on' => __( 'Custom', 'rrdevs-addons' ),
						'return_value' => 'yes',
						'default' => 'yes',
						'condition' => [
							'rrdevs_modal_btn_enable_fixed_width_height' => 'yes'
						]
					]
				);

				$this->start_popover();

					$this->add_responsive_control(
						'rrdevs_modal_btn_fixed_width',
						[
							'label'      => esc_html__( 'Width', 'rrdevs-addons' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'

							],
							'condition' => [
								'rrdevs_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

					$this->add_responsive_control(
						'rrdevs_modal_btn_fixed_height',
						[
							'label'      => esc_html__( 'Height', 'rrdevs-addons' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action' => 'height: {{SIZE}}{{UNIT}};'
							],
							'condition' => [
								'rrdevs_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

				$this->end_popover();

				$this->add_responsive_control(
					'rrdevs_modal_btn_width',
					[
						'label'        => esc_html__( 'Width', 'rrdevs-addons' ),
						'type'         => Controls_Manager::SLIDER,
						'size_units'   => [ 'px', '%' ],
						'range'        => [
							'px'       => [
								'min'  => 0,
								'max'  => 500,
								'step' => 1
							],
							'%'        => [
								'min'  => 0,
								'max'  => 100
							]
						],
						'default'      => [
							'unit'     => 'px',
							'size'     => 70
						],
						'selectors'    => [
							'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'
						],
						'condition' => [
							'rrdevs_modal_btn_enable_fixed_width_height!' => 'yes'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'rrdevs_modal_btn_border_normal',
						'selector'           => '{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action'
					]
				);

				$this->add_responsive_control(
					'rrdevs_modal_btn_radius',
					[
						'label'      => __( 'Border Radius', 'rrdevs-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'default'    => [
							'top'    => '50',
							'right'  => '50',
							'bottom' => '50',
							'left'   => '50',
							'unit'   => 'px'
						],
						'selectors'  => [
							'{{WRAPPER}} .rrdevs-modal-image-action, {{WRAPPER}} .rrdevs-modal-image-action::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

				$this->add_responsive_control(
					'rrdevs_modal_btn_padding',
					[
						'label'        => __( 'Padding', 'rrdevs-addons' ),
						'type'         => Controls_Manager::DIMENSIONS,
						'size_units'   => [ 'px', '%' ],
						'default'      => [
							'top'      => '20',
							'right'    => '0',
							'bottom'   => '20',
							'left'     => '0',
							'unit'     => 'px',
							'isLinked' => false
						],
						'selectors'    => [
							'{{WRAPPER}} .rrdevs-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'rrdevs_modal_btn_typhography_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'rrdevs-addons' ) ] );

				$this->add_control(
					'rrdevs_modal_btn_color_hover',
					[
						'label'     => __( 'Text Color', 'rrdevs-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#fff',
						'selectors' => [
							'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action:hover span' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'rrdevs_modal_btn_background_hover',
					[
						'label'     => __( 'Background Color', 'rrdevs-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#EF2469',
						'selectors' => [
							'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'rrdevs_modal_btn_border_hover',
						'selector' => '{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action:hover'
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();

		/**
		 * Modal Popup Icon section
		 */
		$this->start_controls_section(
			'rrdevs_modal_icon_section',
			[
				'label' => __( 'Icon', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
				]
		);

		$this->add_control(
			'rrdevs_modal_btn_icon_color',
			[
				'label'     => __( 'Icon Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action span i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'rrdevs_modal_btn_icon_align',
			[
				'label'     => __( 'Icon Position', 'rrdevs-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'rrdevs-addons' ),
					'right' => __( 'After', 'rrdevs-addons' )
				],
				'condition' => [
                    'rrdevs_modal_btn_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'rrdevs_modal_btn_icon_indent',
			[
				'label'       => __( 'Icon Spacing', 'rrdevs-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action span.rrdevs-modal-action-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rrdevs-modal-button .rrdevs-modal-image-action span.rrdevs-modal-action-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
                    'rrdevs_modal_btn_icon[value]!' => ''
                ]
			]
		);
		$this->end_controls_section();

		/**
		 * Modal Popup Container section
		 */
		$this->start_controls_section(
			'rrdevs_modal_container_section',
			[
				'label' => __( 'Container', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'rrdevs_modal_content_align',
			[
				'label'     => __( 'Alignment', 'rrdevs-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'center',
				'options'   => [
					'left'  => [
						'title' => __( 'Left', 'rrdevs-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'rrdevs-addons' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'rrdevs-addons' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element' => 'text-align: {{VALUE}};'
				],
				'condition' => [
					'rrdevs_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_responsive_control(
			'rrdevs_modal_content_height',
			[
				'label' => __( 'Contant Height for Tablet & Mobile', 'rrdevs-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-item.modal-vimeo' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'rrdevs_modal_image_gallery_description_typography',
				'selector'  => '{{WRAPPER}} .rrdevs-modal-content .rrdevs-modal-element .rrdevs-modal-element-card .rrdevs-modal-element-card-body p',
				'condition' => [
					'rrdevs_modal_content' => [ 'image-gallery' ]
				]
			]
		);

		$this->add_control(
			'rrdevs_modal_image_gallery_description_color',
			[
				'label'     => __( 'Description Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-content .rrdevs-modal-element .rrdevs-modal-element-card .rrdevs-modal-element-card-body p'  => 'color: {{VALUE}};'
				],
				'condition' => [
					'rrdevs_modal_content' => [ 'image-gallery' ]
				]
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'rrdevs_modal_content_border',
				'selector' => '{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element'
			]
		);

		$this->add_control(
			'rrdevs_modal_image_gallery_bg',
			[
				'label'     => __( 'Background Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element'  => 'background: {{VALUE}};'
				],
				'condition' => [
					'rrdevs_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_control(
			'rrdevs_modal_image_gallery_padding',
			[
				'label'      => __( 'Padding', 'rrdevs-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element .rrdevs-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'rrdevs_modal_content' => [ 'image-gallery', 'html_content' ]
				]
			]
		);

        $this->add_responsive_control(
            'rrdevs_modal_image_gallery_description_margin',
            [
                'label'      => __('Margin(Description)', 'rrdevs-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-modal-item .rrdevs-modal-content .rrdevs-modal-element .rrdevs-modal-element-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'condition'  => [
					'rrdevs_modal_content' => [ 'image-gallery' ]
				]
            ]
        );

		$this->add_control(
			'rrdevs_modal_overlay_overflow_x',
			[
				'label'        => __( 'Overflow X', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'rrdevs-addons' ),
				'label_off'    => __( 'No', 'rrdevs-addons' ),
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'rrdevs_modal_overlay_overflow_y',
			[
				'label'        => __( 'Overflow Y', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'rrdevs-addons' ),
				'label_off'    => __( 'No', 'rrdevs-addons' ),
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rrdevs_modal_animation_tab',
			[
				'label' => __( 'Animation', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'rrdevs_modal_transition',
			[
				'label'   => __( 'Style', 'rrdevs-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-to-middle',
				'options' => [
					'top-to-middle'    => __( 'Top To Middle', 'rrdevs-addons' ),
					'bottom-to-middle' => __( 'Bottom To Middle', 'rrdevs-addons' ),
					'right-to-middle'  => __( 'Right To Middle', 'rrdevs-addons' ),
					'left-to-middle'   => __( 'Left To Middle', 'rrdevs-addons' ),
					'zoom-in'          => __( 'Zoom In', 'rrdevs-addons' ),
					'zoom-out'         => __( 'Zoom Out', 'rrdevs-addons' ),
					'left-rotate'      => __( 'Rotation', 'rrdevs-addons' )
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup overlay style
		 */

		$this->start_controls_section(
			'rrdevs_modal_overlay_tab',
			[
				'label'     => __( 'Overlay', 'rrdevs-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'rrdevs_modal_overlay' => 'yes'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'rrdevs_modal_overlay_color',
                'types'           => [ 'classic' ],
                'selector'        => '{{WRAPPER}} .rrdevs-modal-overlay',
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => 'rgba(0,0,0,.5)'
                    ]
                ]
            ]
        );

		$this->end_controls_section();

		/**
		 * Modal Popup Close button style
		 */

		$this->start_controls_section(
			'rrdevs_modal_close_btn_style',
			[
				'label' => __( 'Close Button', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'rrdevs_modal_close_btn_position',
			[
				'label' => __( 'Close Button Position', 'rrdevs-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'rrdevs-addons' ),
				'label_on' => __( 'Custom', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->start_popover();

            $this->add_responsive_control(
                'rrdevs_modal_close_btn_position_x_offset',
                [
                    'label' => __( 'X Offset', 'rrdevs-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rrdevs-modal-item.modal-vimeo .rrdevs-modal-content .rrdevs-close-btn' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'rrdevs_modal_close_btn_position_y_offset',
                [
                    'label' => __( 'Y Offset', 'rrdevs-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rrdevs-modal-item.modal-vimeo .rrdevs-modal-content .rrdevs-close-btn' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

		$this->add_responsive_control(
            'rrdevs_modal_close_btn_icon_size',
            [
				'label'      => __( 'Icon Size', 'rrdevs-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
                    'px'       => [
						'min'  => 0,
						'max'  => 30,
                    ],
                ],
                'default'   => [
                    'unit'  => 'px',
                    'size'  => 20
                ],
                'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-item.modal-vimeo .rrdevs-modal-content .rrdevs-close-btn span::before' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rrdevs-modal-item.modal-vimeo .rrdevs-modal-content .rrdevs-close-btn span::after' => 'height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_control(
			'rrdevs_modal_close_btn_color',
			[
				'label'     => __( 'Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-item.modal-vimeo .rrdevs-modal-content .rrdevs-close-btn span::before, {{WRAPPER}} .rrdevs-modal-item.modal-vimeo .rrdevs-modal-content .rrdevs-close-btn span::after'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'rrdevs_modal_close_btn_bg_color',
			[
				'label'    => __( 'Background Color', 'rrdevs-addons' ),
				'type'     => Controls_Manager::COLOR,
				'default'  => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-modal-item.modal-vimeo .rrdevs-modal-content .rrdevs-close-btn'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings            = $this->get_settings_for_display();

		if( 'youtube' === $settings['rrdevs_modal_content'] ){
			$url = $settings['rrdevs_modal_youtube_video_url'];

			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

			$youtube_id = $matches[1];
		}

		if( 'vimeo' === $settings['rrdevs_modal_content'] ){
			$vimeo_url       = $settings['rrdevs_modal_vimeo_video_url'];
			$vimeo_id_select = explode('/', $vimeo_url);
			$vidid           = explode( '&', str_replace('https://vimeo.com', '', end($vimeo_id_select) ) );
			$vimeo_id        = $vidid[0];
		}

		$this->add_render_attribute( 'rrdevs_modal_action', [
			'class'             => 'rrdevs-modal-image-action image-modal',
			'data-rrdevs-modal'   => '#rrdevs-modal-' . $this->get_id(),
			'data-rrdevs-overlay' => esc_attr( $settings['rrdevs_modal_overlay'] )
		] );

		$this->add_render_attribute( 'rrdevs_modal_overlay', [
			'class'                         => 'rrdevs-modal-overlay',
			'data-rrdevs_overlay_click_close' => $settings['rrdevs_modal_overlay_click_close']
		] );

		$this->add_render_attribute( 'rrdevs_modal_item', 'class', 'rrdevs-modal-item' );
		$this->add_render_attribute( 'rrdevs_modal_item', 'class', 'modal-vimeo' );
		$this->add_render_attribute( 'rrdevs_modal_item', 'class', $settings['rrdevs_modal_transition'] );
		$this->add_render_attribute( 'rrdevs_modal_item', 'class', $settings['rrdevs_modal_content'] );
		$this->add_render_attribute( 'rrdevs_modal_item', 'class', esc_attr('rrdevs-content-overflow-x-' . $settings['rrdevs_modal_overlay_overflow_x'] ) );
		$this->add_render_attribute( 'rrdevs_modal_item', 'class', esc_attr('rrdevs-content-overflow-y-' . $settings['rrdevs_modal_overlay_overflow_y'] ) );

         $rdevs_overly = $settings['rrdevs_modal_button_overlay'];

		 $overly = '';
		 if('yes' == $rdevs_overly ){
			$overly = 'rrdevs-modal-overly-button';
		 }else{
			$overly = '';
		 }
	
		?>

		<div class="rrdevs-modal">
			<div class="rrdevs-modal-wrapper">

				<div class="rrdevs-modal-button <?php echo esc_attr( $overly ); ?>    rrdevs-modal-btn-fixed-width-<?php echo esc_attr($settings['rrdevs_modal_btn_enable_fixed_width_height']);?>">
					<a href="#" <?php echo $this->get_render_attribute_string('rrdevs_modal_action');?> >
						<span class="rrdevs-modal-action-icon-<?php echo esc_attr($settings['rrdevs_modal_btn_icon_align']);?>">
							<?php if( 'left' === $settings['rrdevs_modal_btn_icon_align'] && !empty( $settings['rrdevs_modal_btn_icon']['value'] ) ) {
								Icons_Manager::render_icon( $settings['rrdevs_modal_btn_icon'], [ 'aria-hidden' => 'true' ] );
							}
							echo esc_html( $settings['rrdevs_modal_btn_text'] );
							if( 'right' === $settings['rrdevs_modal_btn_icon_align'] && !empty( $settings['rrdevs_modal_btn_icon']['value'] ) ) {
								Icons_Manager::render_icon( $settings['rrdevs_modal_btn_icon'], [ 'aria-hidden' => 'true' ] );
							} ;?>
						</span>
					</a>
				</div>

				<div id="rrdevs-modal-<?php echo esc_attr( $this->get_id() );?>" <?php echo $this->get_render_attribute_string('rrdevs_modal_item') ;?> >
					<div class="rrdevs-modal-content">
						<div class="rrdevs-modal-element <?php echo esc_attr( $settings['rrdevs_modal_image_gallery_column'] );?>">
							<?php if ( 'image' === $settings['rrdevs_modal_content'] ) {
								echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'rrdevs_modal_image' );
							}

							if ( 'image-gallery' === $settings['rrdevs_modal_content'] ) {
								foreach ( $settings['rrdevs_modal_image_gallery_repeater'] as $gallery ) : ?>
									<div class="rrdevs-modal-element-card">
										<div class="rrdevs-modal-element-card-thumb">
											<?php echo Group_Control_Image_Size::get_attachment_image_html( $gallery, 'thumbnail', 'rrdevs_modal_image_gallery' );?>
										</div>
										<?php if ( !empty( $gallery['rrdevs_modal_image_gallery_text'] ) ) {?>
											<div class="rrdevs-modal-element-card-body">
												<p><?php echo wp_kses_post( $gallery['rrdevs_modal_image_gallery_text'] );?></p>
											</div>
										<?php } ;?>
									</div>
								<?php
								endforeach;
							}

							if ( 'html_content' === $settings['rrdevs_modal_content'] ) { ?>
								<div class="rrdevs-modal-element-body">
									<p><?php echo wp_kses_post( $settings['rrdevs_modal_html_content'] );?></p>
								</div>
							<?php }

							if ( 'youtube' === $settings['rrdevs_modal_content'] ) { ?>
								<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id );?>" frameborder="0" allowfullscreen></iframe>
							<?php }

							if ( 'vimeo' === $settings['rrdevs_modal_content'] ) { ?>
								<iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr( $vimeo_id );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'external-video' === $settings['rrdevs_modal_content'] ) { ?>
								<video class="rrdevs-video-hosted" src="<?php echo esc_url( $settings['rrdevs_modal_external_video']['url'] );?>" controls="" controlslist="nodownload">
								</video>
							<?php }

							if ( 'external_page' === $settings['rrdevs_modal_content'] ) { ?>
								<iframe src="<?php echo esc_url( $settings['rrdevs_modal_external_page_url'] );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'shortcode' === $settings['rrdevs_modal_content'] ) {
								echo do_shortcode( $settings['rrdevs_modal_shortcode'] );
							} ;?>

							<div class="rrdevs-close-btn">
								<span></span>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div <?php echo $this->get_render_attribute_string('rrdevs_modal_overlay');?>></div>
		</div>
	<?php
	}
}
$widgets_manager->register_widget_type( new \RRdevs_Addons\Widgets\RRdevs_Modal_Popup() );