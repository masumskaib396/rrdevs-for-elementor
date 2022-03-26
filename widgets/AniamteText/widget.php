<?php
namespace RRdevs_Addons\Widgets\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class RRdevs_Animated_Text extends Widget_Base {
	public function get_name() {
		return 'rrdevs-animated';
	}
	public function get_title() {
		return esc_html__( 'Animated Text', 'rrdevs-addons' );
	}
	public function get_icon() {
		return 'eicon-animated-headline';
	}
   	public function get_categories() {
		return [ 'rrdevs-addons' ];
	}
	public function get_keywords() {
        return [ 'rrdevs-addons', 'fancy', 'heading', 'animate', 'animation' ];
    }
	protected function register_controls() {
	    /*
	    * Animated Text Content
	    */
	    $this->start_controls_section(
	        'rrdevs_section_animated_text_content',
	        [
	            'label' => esc_html__( 'Content', 'rrdevs-addons' )
	        ]
		);
		$this->add_control(
	        'rrdevs_animated_text_before_text',
	        [
				'label'   => esc_html__( 'Before Text', 'rrdevs-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'This is', 'rrdevs-addons' ),
				'dynamic'     => [ 'active' => true ],
	        ]
		);
		$this->add_control(
			'rrdevs_animated_text_animated_heading',
			[
				'label'       => esc_html__( 'Animated Text', 'rrdevs-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your animated text with comma separated.', 'rrdevs-addons' ),
				'description' => __( '<b>Write animated heading with comma separated. Example: Exclusive, Addons, Elementor</b>', 'rrdevs-addons' ),
				'default'     => esc_html__( 'RRdevs, Addons, Elementor', 'rrdevs-addons' ),
				'dynamic'     => [ 'active' => true ]
			]
		);
		$this->add_control(
	        'rrdevs_animated_text_after_text',
	        [
				'label'   => esc_html__( 'After Text', 'rrdevs-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'For You.', 'rrdevs-addons' ),
				'dynamic'     => [ 'active' => true ],
	        ]
		);
		$this->add_control(
			'rrdevs_animated_text_animated_heading_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'rrdevs-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'h3',
				'toggle'  => false,
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'rrdevs-addons' ),
						'icon'  => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'rrdevs-addons' ),
						'icon'  => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'rrdevs-addons' ),
						'icon'  => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'rrdevs-addons' ),
						'icon'  => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'rrdevs-addons' ),
						'icon'  => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'rrdevs-addons' ),
						'icon'  => 'eicon-editor-h6'
					]
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_animated_heading_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'rrdevs-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => true,
				'options' => [
					'left'   => [
						'title' => __( 'Left', 'rrdevs-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __( 'Center', 'rrdevs-addons' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'  => [
						'title' => __( 'Right', 'rrdevs-addons' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'left',
				'selectors'     => [
                    '{{WRAPPER}} .rrdevs-animated-text-align' => 'text-align: {{VALUE}};'
                ]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Container Style
	    */
	    $this->start_controls_section(
	        'rrdevs_section_animated_text_animation_tyle',
	        [
				'label' => esc_html__( 'Animation', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_control(
			'rrdevs_animated_text_animated_heading_animated_type',
			[
				'label'   => esc_html__( 'Animation Type', 'rrdevs-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'rrdevs-typed-animation',
				'options' => [
					'rrdevs-typed-animation'   => __( 'Typed', 'rrdevs-addons' ),
					'rrdevs-morphed-animation' => __( 'Animate', 'rrdevs-addons' )
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_animated_heading_animation_style',
			[
				'label'   => esc_html__( 'Animation Style', 'rrdevs-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'            => __( 'Fade In', 'rrdevs-addons' ),
					'fadeInUp'          => __( 'Fade In Up', 'rrdevs-addons' ),
					'fadeInDown'        => __( 'Fade In Down', 'rrdevs-addons' ),
					'fadeInLeft'        => __( 'Fade In Left', 'rrdevs-addons' ),
					'fadeInRight'       => __( 'Fade In Right', 'rrdevs-addons' ),
					'zoomIn'            => __( 'Zoom In', 'rrdevs-addons' ),
					'zoomInUp'          => __( 'Zoom In Up', 'rrdevs-addons' ),
					'zoomInDown'        => __( 'Zoom In Down', 'rrdevs-addons' ),
					'zoomInLeft'        => __( 'Zoom In Left', 'rrdevs-addons' ),
					'zoomInRight'       => __( 'Zoom In Right', 'rrdevs-addons' ),
					'slideInDown'       => __( 'Slide In Down', 'rrdevs-addons' ),
					'slideInUp'         => __( 'Slide In Up', 'rrdevs-addons' ),
					'slideInLeft'       => __( 'Slide In Left', 'rrdevs-addons' ),
					'slideInRight'      => __( 'Slide In Right', 'rrdevs-addons' ),
					'bounce'            => __( 'Bounce', 'rrdevs-addons' ),
					'bounceIn'          => __( 'Bounce In', 'rrdevs-addons' ),
					'bounceInUp'        => __( 'Bounce In Up', 'rrdevs-addons' ),
					'bounceInDown'      => __( 'Bounce In Down', 'rrdevs-addons' ),
					'bounceInLeft'      => __( 'Bounce In Left', 'rrdevs-addons' ),
					'bounceInRight'     => __( 'Bounce In Right', 'rrdevs-addons' ),
					'flash'             => __( 'Flash', 'rrdevs-addons' ),
					'pulse'             => __( 'Pulse', 'rrdevs-addons' ),
					'rotateIn'          => __( 'Rotate In', 'rrdevs-addons' ),
					'rotateInDownLeft'  => __( 'Rotate In Down Left', 'rrdevs-addons' ),
					'rotateInDownRight' => __( 'Rotate In Down Right', 'rrdevs-addons' ),
					'rotateInUpRight'   => __( 'rotate In Up Right', 'rrdevs-addons' ),
					'rotateIn'          => __( 'Rotate In', 'rrdevs-addons' ),
					'rollIn'            => __( 'Roll In', 'rrdevs-addons' ),
					'lightSpeedIn'      => __( 'Light Speed In', 'rrdevs-addons' )
				],
				'condition' => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-morphed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Settings
	    */
	    $this->start_controls_section(
	        'rrdevs_section_animated_text_settings',
	        [
				'label' => esc_html__( 'Settings', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_control(
			'rrdevs_animated_text_animation_speed',
			[
				'label'     => __( 'Animation Speed', 'rrdevs-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 100,
				'max'       => 10000,
				'condition' => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-morphed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_type_speed',
			[
				'label'   => __( 'Type Speed', 'rrdevs-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
				'min'     => 10,
				'max'     => 200,
				'step'    => 10,
				'condition' => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_start_delay',
			[
				'label'     => __( 'Start Delay', 'rrdevs-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_back_type_speed',
			[
				'label'     => __( 'Back Type Speed', 'rrdevs-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 200,
				'step'      => 10,
				'condition' => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_back_delay',
			[
				'label'     => __( 'Back Delay', 'rrdevs-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_loop',
			[
				'label'        => __( 'Loop', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'rrdevs-addons' ),
				'label_off'    => __( 'OFF', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_show_cursor',
			[
				'label'        => __( 'Show Cursor', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'rrdevs-addons' ),
				'label_off'    => __( 'OFF', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_fade_out',
			[
				'label'        => __( 'Fade Out', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'rrdevs-addons' ),
				'label_off'    => __( 'OFF', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_smart_backspace',
			[
				'label'        => __( 'Smart Backspace', 'rrdevs-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'rrdevs-addons' ),
				'label_off'    => __( 'OFF', 'rrdevs-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'rrdevs_animated_text_animated_heading_animated_type' => 'rrdevs-typed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text pre animated Text Style
		*/
	    $this->start_controls_section(
	        'rrdevs_pre_animated_text_style',
	        [
				'label'     => esc_html__( 'Pre Animated text', 'rrdevs-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'rrdevs_animated_text_before_text!' => ''
				]
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'rrdevs_pre_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .rrdevs-animated-text-pre-heading',
			]
		);
		$this->add_control(
			'rrdevs_pre_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-animated-text-pre-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text animated Text Style
	    */
	    $this->start_controls_section(
	        'rrdevs_animated_text_style',
	        [
				'label' => esc_html__( 'Animated text', 'rrdevs-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'rrdevs_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .rrdevs-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor'
			]
		);
		$this->add_control(
			'rrdevs_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'rrdevs_animated_text_spacing',
			[
				'label'      => __( 'Spacing', 'rrdevs-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default'    => [
                    'unit'   => 'px',
                    'size'   => 8
                ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 50
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .rrdevs-animated-text-animated-heading' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text post animated Text Style
	    */
	    $this->start_controls_section(
	        'rrdevs_post_animated_text_style',
	        [
				'label'     => esc_html__( 'Post Animated text', 'rrdevs-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'rrdevs_animated_text_after_text!' => ''
				]
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'rrdevs_post_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .rrdevs-animated-text-post-heading'
			]
		);
		$this->add_control(
			'rrdevs_post_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'rrdevs-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .rrdevs-animated-text-post-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$id            = substr( $this->get_id_int(), 0, 3 );
		$type_heading  = explode( ',', $settings['rrdevs_animated_text_animated_heading'] );
		$before_text   = $settings['rrdevs_animated_text_before_text'];
		$heading_text  = $settings['rrdevs_animated_text_animated_heading'];
		$after_text    = $settings['rrdevs_animated_text_after_text'];
		$heading_tag   = $settings['rrdevs_animated_text_animated_heading_tag'];
		$heading_align = $settings['rrdevs_animated_text_animated_heading_alignment'];
		$this->add_render_attribute( 'rrdevs_typed_animated_string', 'class', 'rrdevs-typed-strings' );
		$this->add_render_attribute( 'rrdevs_typed_animated_string',
			[
				'data-type_string'       => esc_attr(json_encode($type_heading)),
				'data-heading_animation' => esc_attr( $settings['rrdevs_animated_text_animated_heading_animated_type'] )
			]
		);
		if($settings['rrdevs_animated_text_animated_heading_animated_type'] === 'rrdevs-typed-animation'){
			$this->add_render_attribute( 'rrdevs_typed_animated_string',
				[
					'data-type_speed'      => esc_attr( $settings['rrdevs_animated_text_type_speed'] ),
					'data-back_type_speed' => esc_attr( $settings['rrdevs_animated_text_back_type_speed'] ),
					'data-loop'            => esc_attr( $settings['rrdevs_animated_text_loop'] ),
					'data-show_cursor'     => esc_attr( $settings['rrdevs_animated_text_show_cursor'] ),
					'data-fade_out'        => esc_attr( $settings['rrdevs_animated_text_fade_out'] ),
					'data-smart_backspace' => esc_attr( $settings['rrdevs_animated_text_smart_backspace'] ),
					'data-start_delay'     => esc_attr( $settings['rrdevs_animated_text_start_delay'] ),
					'data-back_delay'      => esc_attr( $settings['rrdevs_animated_text_back_delay'] )
				]
			);
		}
		if($settings['rrdevs_animated_text_animated_heading_animated_type'] === 'rrdevs-morphed-animation'){
			$this->add_render_attribute( 'rrdevs_typed_animated_string',
				[
					'data-animation_style' => esc_attr( $settings['rrdevs_animated_text_animated_heading_animation_style'] ),
					'data-animation_speed' => esc_attr( $settings['rrdevs_animated_text_animation_speed'] )
				]
			);
		}
		$this->add_render_attribute( 'rrdevs_animated_text_animated_heading',
			[
				'id'    => 'rrdevs-animated-text-'.$id,
				'class' => 'rrdevs-animated-text-animated-heading'
			]
		);
		$this->add_render_attribute( 'rrdevs_animated_text_before_text', 'class', 'rrdevs-animated-text-pre-heading' );
        $this->add_inline_editing_attributes( 'rrdevs_animated_text_before_text' );
		$this->add_render_attribute( 'rrdevs_animated_text_after_text', 'class', 'rrdevs-animated-text-post-heading' );
        $this->add_inline_editing_attributes( 'rrdevs_animated_text_after_text' );
		echo '<div class="rrdevs-animated-text-align">';
			do_action( 'rrdevs_animated_text_wrapper_before' );
			echo '<'.esc_attr($heading_tag).' '.$this->get_render_attribute_string( 'rrdevs_typed_animated_string' ).'>';
				do_action( 'rrdevs_animated_text_content_before' );
				$before_text ? printf( '<span '.$this->get_render_attribute_string( 'rrdevs_animated_text_before_text' ).'>%s</span>', wp_kses_post($before_text) ) : '';
				if( 'rrdevs-typed-animation' === $settings['rrdevs_animated_text_animated_heading_animated_type'] ) {
					echo '<span id="rrdevs-animated-text-'.esc_attr($id).'" class="rrdevs-animated-text-animated-heading"></span>';
				}
				if( 'rrdevs-morphed-animation' === $settings['rrdevs_animated_text_animated_heading_animated_type'] ) {
					echo '<span '.$this->get_render_attribute_string( 'rrdevs_animated_text_animated_heading' ).'>'.wp_kses_post($heading_text).'</span>';
				}
				$after_text ? printf( '<span '.$this->get_render_attribute_string( 'rrdevs_animated_text_after_text' ).'>%s</span>', wp_kses_post($after_text) ) : '';
				do_action( 'rrdevs_animated_text_content_after' );
			echo '</'.esc_attr($heading_tag).'>';
			do_action( 'rrdevs_animated_text_wrapper_after' );
		echo '</div>';
	}
}
$widgets_manager->register_widget_type(new \RRdevs_Addons\Widgets\Elementor\RRdevs_Animated_Text());