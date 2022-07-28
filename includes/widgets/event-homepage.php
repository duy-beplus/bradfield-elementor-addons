<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use ElementorPro\Modules\MotionFX\Controls_Group;

class EventHomeWidget extends Widget_Base
{
    public function get_name()
    {
        return 'event_home';
    }

    public function get_title()
    {
        return 'Event Homepage';
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
        wp_register_script('event_homepage-script', plugins_url('assets/js/event-homepage.js', __FILE__), array(), rand(1, 9999));
        return [
            'event_homepage-script'
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('event_homepage_style', plugins_url('assets/css/event-homepage.css', __FILE__), array(), rand(1, 9999));
        return [
            'event_homepage_style'
        ];
    }

    protected function register_query_controls()
    {
        $this->start_controls_section(
            'upcoming_query',
            [
                'label' => 'Query',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'choose',
            [
                'label' => 'Choose Upcoming Event?',
                'type' => Controls_Manager::SWITCHER,
                'default' => ''
            ]
        );
        $this->add_control(
            'number_event',
            [
                'label' => 'Number Event to show',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                    10 => '10',
                ],
                'default' => 3,
                'condition' => [
                    'choose' => ''
                ]
            ]
        );
        $getPosts = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'ajde_events',
                'meta_key' => 'evotx_tix',
                'meta_value' => 'yes'
            )
        );
        $optionEvents = [];
        foreach ($getPosts as $getPost) {
            $optionEvents[$getPost->ID] = $getPost->post_title;
        }
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'event_list',
            [
                'label' => 'Event List',
                'type' => Controls_Manager::SELECT,
                'options' => $optionEvents
            ]
        );
        $this->add_control(
            'upcoming_event',
            [
                'label' => 'Select Upcoming Event',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'choose' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'layout',
            [
                'label' => 'Layout',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'direction_block',
            [
                'label' => 'Select layout',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'column' => 'Horizontal',
                    'row' => 'Vertical'
                ],
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}} .upcoming-event' => 'flex-direction: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'display_date',
            [
                'label' => 'Display Date',
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->end_controls_section();
    }

    protected function register_style_controls()
    {
        $this->start_controls_section(
            'title_style',
            [
                'label' => 'Event Title',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .event-title',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'date_style',
            [
                'label' => 'Event Date',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'date_color',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-time' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'selector' => '{{WRAPPER}} .event-time',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => 'Button',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'button_bgcolor',
            [
                'label' => 'Background Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button-buy a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => 'Text Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button-buy a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .button-buy a',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'layout_style',
            [
                'lable' => 'Layout',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'layout_gap',
            [
                'label' => 'Column gap',
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_query_controls();
        $this->register_style_controls();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $upcomingEvent = $settings['upcoming_event'];
?>
        <div class="upcoming-event">
            <?php
            wp_reset_postdata();
            if ($settings['choose'] === 'yes') {
                foreach ($upcomingEvent as $items) :
                    $item = get_post($items['event_list']);
                    $get_event = get_post_meta($items['event_list']);
                    $event_time = get_post_meta($items['event_list'], 'evcal_srow', true);
                    $now = current_time('timestamp');
            ?>
                    <div class="upcoming-item">
                        <a href="<?php echo get_the_permalink($item->ID) ?>" class="event-thumbnail">
                            <?php echo get_the_post_thumbnail($item->ID, 'full') ?>
                        </a>
                        <?php if ($settings['display_date'] === 'yes') : ?>
                            <div class="event-time">
                                <?php
                                if ($event_time < $now) {
                                    echo '<div class="time-red">Event is Past</div>';
                                } else {
                                    echo '<div class="time-blue">' . gmdate("F d, Y - g:i a", $event_time) . '</div>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="event-info">
                            <a href="<?php echo get_the_permalink($item->ID) ?>" class="event-title">
                                <?php echo get_the_title($item->ID); ?>
                            </a>
                            <div class="button-buy">
                                <a href="<?php echo get_permalink($get_event['tx_woocommerce_product_id'][0]); ?>">Buy ticket</a>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                wp_reset_postdata();
            } else {
                $getEvents = get_posts(
                    array(
                        'numberposts' => $settings['number_event'],
                        'post_type' => 'ajde_events',
                        'meta_key' => 'evotx_tix',
                        'meta_value' => 'yes'
                    )
                );
                foreach ($getEvents as $getEvent) :
                    $get_event = get_post_meta($getEvent->ID);
                    $event_time = get_post_meta($getEvent->ID, 'evcal_srow', true);
                    $now = current_time('timestamp');
                ?>
                    <div class="upcoming-item">
                        <a href="<?php echo get_the_permalink($getEvent->ID) ?>" class="event-thumbnail">
                            <?php echo get_the_post_thumbnail($getEvent->ID, 'full') ?>
                        </a>
                        <?php if ($settings['display_date'] === 'yes') : ?>
                            <div class="event-time">
                                <?php
                                if ($event_time < $now) {
                                    echo '<div class="time-red">Event is Past</div>';
                                } else {
                                    echo '<div class="time-blue">' . gmdate("F d, Y - g:i a", $event_time) . '</div>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="event-info">
                            <a href="<?php echo get_the_permalink($getEvent->ID) ?>" class="event-title">
                                <?php echo get_the_title($getEvent->ID); ?>
                            </a>
                            <?php if ($get_event['evotx_tix'][0] == 'yes') : ?>
                                <div class="button-buy">
                                    <a href="<?php echo get_permalink($get_event['tx_woocommerce_product_id'][0]); ?>">Buy ticket</a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
            <?php
                endforeach;
            }
            ?>
        </div>
<?php
    }
}
