<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class EventTypeWidget extends Widget_Base
{
    public function get_name()
    {
        return 'event_type';
    }

    public function get_title()
    {
        return 'Event Type';
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
    public function get_script_depends()
    {
        wp_register_script('event_type_script', plugins_url('assets/js/event-type.js', __FILE__));
        return [
            'event_type_script'
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('event_type_style', plugins_url('assets/css/event-type.css', __FILE__));
        return [
            'event_type_style'
        ];
    }

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
            'choose_page',
            [
                'label' => 'Choose Event page?',
                'type' => Controls_Manager::SWITCHER,
                'default' => ''
            ]
        );

        // Set up the objects needed
        $my_wp_query = new WP_Query();
        $all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));

        // Get the page as an Object
        $parent =  get_page_by_title('Facilities');

        // Filter through all pages and find Portfolio's children
        $getChildren = get_page_children($parent->ID, $all_wp_pages);
        $optionsChild = [];
        foreach ($getChildren as $item) {
            $optionsChild[$item->ID] = $item->post_title;
        }
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'page_list',
            [
                'label' => 'Select Category',
                'type' => Controls_Manager::SELECT,
                'label_block' => 'false',
                'options' => $optionsChild
            ]
        );
        $this->add_control(
            'page_repeater',
            [
                'label' => 'Event type',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'choose_page' => 'yes'
                ]
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
?>
        <section class="term-section">
            <?php
            if ($settings['choose_page'] === 'yes') :
                foreach ($settings['page_repeater'] as $getChoses) :
                    $item = get_post($getChoses['page_list']);
            ?>
                    <a href="<?php echo get_the_permalink($item->ID); ?>" class="term-items">
                        <img class="term-items-thumbnail" src="<?php echo get_the_post_thumbnail($item->ID, 'full'); ?>">
                        <div class="term-items-info">
                            <div class="term-info-title"><?php echo get_the_title($item->ID); ?></div>
                            <div class="term-info-desc"><?php echo get_the_excerpt($item->ID) ?></div>
                        </div>
                    </a>
                <?php
                endforeach;
                wp_reset_postdata();
            elseif ($settings['choose_page'] === '') :
                // Set up the objects needed
                $my_wp_query = new WP_Query();
                $all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));

                // Get the page as an Object
                $parent =  get_page_by_title('Facilities');

                // Filter through all pages and find Portfolio's children
                $getChildren = get_page_children($parent->ID, $all_wp_pages);
                foreach ($getChildren as $item) :
                ?>
                    <a href="<?php echo get_the_permalink($item->ID); ?>" class="term-items">
                        <img class="term-items-thumbnail" src="<?php echo get_the_post_thumbnail($item->ID, 'full') ?>">
                        <div class="term-items-info">
                            <div class="term-info-title"><?php echo get_the_title($item->ID) ?></div>
                            <div class="term-info-desc"><?php echo get_the_excerpt($item->ID, 8); ?></div>
                        </div>
                    </a>
            <?php
                endforeach;
            endif;
            wp_reset_postdata();
            ?>
            <div class="term-section-loader">
                <div class="term-section-loadmore">
                    <input type="submit" value="Load more" id="load-more">
                </div>
                <div class="term-section-preload">
                    <img src="<?php echo site_url() ?>/wp-content/uploads/2022/07/Ellipse-loadmore.png" alt="">
                </div>
            </div>
        </section>
<?php
    }
}
