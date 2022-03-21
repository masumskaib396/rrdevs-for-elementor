<?php
namespace RRdevs_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

/**
 * Finest title widget.
 *
 * Finest widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class RRdevs_Heading extends Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve title widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rrdevs-title';
    }
    /**
     * Get widget title.
     *
     * Retrieve title widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Heading', 'rrdevs-addons' );
    }
    /**
     * Get widget icon.
     *
     * Retrieve title widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-heading';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the title widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['rrdevs-addons'];
    }
    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['heading', 'title', 'text'];
    }
    /**
     * Register title widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title', 'rrdevs-addons' ),
            ]
        );

        $this->add_control(
            'show_page_title',
            [
                'label'        => __( 'Show Page Title', 'rrdevs-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'rrdevs-addons' ),
                'label_off'    => __( 'Hide', 'rrdevs-addons' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'rrdevs-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your title', 'rrdevs-addons' ),
                'default'     => __( 'Add Your Title Text Here', 'rrdevs-addons' ),
                'condition'   => [
                    'show_page_title!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'link',
            [
                'label'     => __( 'Link', 'rrdevs-addons' ),
                'type'      => Controls_Manager::URL,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'header_size',
            [
                'label'   => __( 'HTML Tag', 'rrdevs-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h2',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label'     => __( 'Alignment', 'rrdevs-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __( 'Left', 'rrdevs-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __( 'Center', 'rrdevs-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'rrdevs-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'rrdevs-addons' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'view',
            [
                'label'   => __( 'View', 'rrdevs-addons' ),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title', 'rrdevs-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Text Color', 'rrdevs-addons' ),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .rrdevs-addons-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .rrdevs-addons-title',
            ]
        );
        $this->add_control(
            'blend_mode',
            [
                'label'     => __( 'Blend Mode', 'rrdevs-addons' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''            => __( 'Normal', 'rrdevs-addons' ),
                    'multiply'    => 'Multiply',
                    'screen'      => 'Screen',
                    'overlay'     => 'Overlay',
                    'darken'      => 'Darken',
                    'lighten'     => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation'  => 'Saturation',
                    'color'       => 'Color',
                    'difference'  => 'Difference',
                    'exclusion'   => 'Exclusion',
                    'hue'         => 'Hue',
                    'luminosity'  => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-title' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_stock_color',
            [
                'label' => __( 'Strok Style', 'rrdevs-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'stroke_width',
            [
                'label'      => __( 'Strok Width', 'rrdevs-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'stroke_color',
            [
                'label'     => __( 'Strok Color', 'rrdevs-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-title' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'stroke_fill_color',
            [
                'label'     => __( 'Strok Fill Color', 'rrdevs-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-title' => '-webkit-text-fill-color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_line_style',
            [
                'label' => __( 'Line Style', 'rrdevs-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_line',
            [
                'label'        => __( 'Enable Line?', 'rrdevs-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'rrdevs-addons' ),
                'label_off'    => __( 'No', 'rrdevs-addons' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label'     => __( 'Line Color', 'rrdevs-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rrdevs-addons-title:after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_width',
            [
                'label'      => __( 'Line Width', 'rrdevs-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons-title:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'enable_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_height',
            [
                'label'      => __( 'Line height', 'rrdevs-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons-title:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'enable_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_x_position',
            [
                'label'      => __( 'Shape Y Position', 'rrdevs-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons-title:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'enable_line' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_y_position',
            [
                'label'      => __( 'Shape X Position', 'rrdevs-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rrdevs-addons-title:after'          => 'left: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rrdevs-addons-title:after' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'enable_line' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render title widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( '' === $settings['title'] ) {
            return;
        }
        if ( 'yes' == $settings['show_page_title'] ) {
            $title = get_the_title();
        } else {
            $title = $settings['title'];
        }
        $this->add_render_attribute( 'title', 'class', 'rrdevs-addons-title' );
        $this->add_render_attribute( 'title', 'class', 'show-line-' . $settings['enable_line'] );
        if ( !empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'url', $settings['link'] );
            $title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
        }
        $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'title' ), $title );
        echo $title_html;
    }
}

$widgets_manager->register_widget_type( new \RRdevs_Addons\Widgets\RRdevs_Heading() );