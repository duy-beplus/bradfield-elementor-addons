<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class LoadEventByOptions extends Widget_Base
{
    public function get_name()
    {
        return 'load_event_by_options';
    }

    public function get_title()
    {
        return 'Load Events By Options';
    }

    public function get_icon()
    {
        return 'eicon-elementor';
    }

    public function get_categories()
    {
        return ['custom-category'];
    }

    public function get_keywords()
    {
        return ['key', 'value'];
    }
    // Register Script
    // public function get_script_depends()
    // {
    //     wp_register_script('event_type_script', plugins_url('assets/js/event-type.js', __FILE__));
    //     return [
    //         'event_type_script'
    //     ];
    // }

    // public function get_style_depends()
    // {
    //     wp_register_style('event_type_style', plugins_url('assets/css/event-type.css', __FILE__));
    //     return [
    //         'event_type_style'
    //     ];
    // }

    protected function register_query_control()
    {
        $this->start_controls_section(
            'query_control',
            [
                'label' => 'Query',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'select_options',
            [
                'label' => 'Select Event Options',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'all' => 'All',
                    'ticket' => 'By have Ticket',
                    'upcoming' => 'By Upcoming',
                ],
                'default' => 'all',
                'label_block' => 'false'
            ]
        );
        $this->add_control(
            'sort_date',
            [
                'label' => 'Sort Event',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ]
            ]
        );
        $this->add_control(
            'choose_page',
            [
                'label' => 'Choose Event page?',
                'type' => Controls_Manager::SWITCHER,
                'default' => ''
            ]
        );
        $this->end_controls_section();
    }

    protected function register_style_control()
    {
        $this->start_controls_section(
            'term_title_style',
            [
                'label' => 'Term title',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs(
            'title_style'
        );
        $this->start_controls_tab(
            'term_title_style_normal',
            [
                'label' => 'Normal'
            ]
        );
        $this->add_control(
            'title_color_normal',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-info-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'term_title_style_hover',
            [
                'label' => 'Hover'
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-info-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .term-info-title',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .term-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .term-info-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'term_desc_style',
            [
                'label' => 'Term desc',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-info-desc' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .term-info-desc',
            ]
        );
        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .term-info-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .term-info-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'loadmore_style',
            [
                'label' => 'Loadmore Button',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs(
            'loadmore_style_tab'
        );
        $this->start_controls_tab(
            'loadmore_style_normal',
            [
                'label' => 'Normal'
            ]
        );
        $this->add_control(
            'loadmore_color_normal',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-section-loadmore input' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'loadmore_bgcolor_normal',
            [
                'label' => 'Background Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-section-loadmore input' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'loadmore_style_hover',
            [
                'label' => 'Hover'
            ]
        );
        $this->add_control(
            'loadmore_color_hover',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-section-loadmore input:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'loadmore_bgcolor_hover',
            [
                'label' => 'Background Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-section-loadmore input:hover' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'loadmore_typography',
                'selector' => '{{WRAPPER}} .term-section-loadmore input',
            ]
        );
        $this->add_responsive_control(
            'loadmore_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .term-section-loadmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'loadmore_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .term-section-loadmore input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_query_control();
        $this->register_style_control();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $all = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'  => -1,
            'order'           => $settings['sort_date'],
            // 'meta_key'            => 'evcal_srow',
            // 'orderby'			=> 'meta_value',
            // 'meta_query' => array(
            //     array(
            //         'key' => 'evcal_srow',
            //         'value' => $now,
            //         'compare' => '<',
            //     ) ,
            // ) ,
        );
        $now = current_time('timestamp');
        $ticket = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'  => -1,
            'order'           => $settings['sort_date'],
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'evotx_tix',
                    'value' => 'yes',
                ),
                array(
                    'key'     => 'evcal_srow',
                    'value' => $now,
                    'compare' => '>',
                ),
            ),
        );
        $upcoming = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'  => -1,
            'order'           => $settings['sort_date'],
            'meta_key'            => 'evcal_srow',
            'orderby'            => 'meta_value',
            'meta_query' => array(
                array(
                    'key' => 'evcal_srow',
                    'value' => $now,
                    'compare' => '>',
                ),
            ),
        );
?>
    
        
<?php
    }
}
